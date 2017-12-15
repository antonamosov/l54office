<?php

namespace App\Http\Controllers;

use App\Email;
use App\Invoice;
use App\Setting;
use App\Student;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    /**
     * Send email to the student
     *
     * @param Email $email
     * @param Request $request
     * @param Student $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function template(Email $email, Request $request, Student $student)
    {
        if(!($request->email && $request->student_id)) {
            return response()->json([
                'success' => false
            ]);
        }

        $email->send('body', $request->email, $student->find($request->student_id));

        return response()->json([
            'success'   => true,
            'date'      => date("Y-m-d H:i:s")
        ]);
    }

    /**
     * Send automatic pre-entry email to the student (with dynamic variables, after subscription)
     *
     * @param Student $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendAutomaticPreEntryEmail(Student $student)
    {
        $email = new Email;
        $emailTemplate = $email->getAutomaticPreEntryTemplate();
        if(!$emailTemplate) {
            Log::info('Automatic pre-entry email was not find.');
            return;
        }
        else {
            Log::info('Automatic pre-entry email has found.');
        }
        $emailTemplate->send('body', $student->email, $student);

        $student->update([
            'mail_pre_entry'        => 1,
            'mail_pre_entry_date'   => date("Y-m-d H:i:s")
        ]);

        return;
    }

    /**
     * Send pre-expired emails automatically for not confirmed students
     *
     * @param $email
     * @param $settings
     * @param $student
     */
    public function templateExpired(Email $email, Setting $settings, Student $student)
    {
        $expiredMailTimes = $settings->getExpiredMailTimes();
        $students = $student->getExpiredNotConfirmedAndNotNotifiedStudents($expiredMailTimes);
        $email = $email->getAutoExpiredTemplate();
        if(!$email) {
            return;
        }

        foreach($students as $student) {

            try {
                $emailTemplate = clone $email;
                $emailTemplate->send('body', $student->email, $student);
                $this->log("Was send to (created_at:" . $student->created_at->format("d.m.Y H:i") . "):");
                $this->log($student);
            }
            catch(\Exception $e)  {
                Log::error("templateExpired(): " . $e->getMessage());
                $this->log('Error while send: ' . $e->getMessage());
                continue;
            }

            $student->update([
                'mail_expired'        => Student::SENT,
                'mail_expired_date'   => date("Y-m-d H:i:s"),
                'expired_sent'        => Student::EXPIRED_SENT
            ]);
        }

        return;
    }

    /**
     * Debug log
     *
     * @param $message
     */
    private function log($message)
    {
        if(is_array($message) || is_object($message)) {
            var_dump($message);
        }
        elseif(is_string($message)) {
            echo "$message<br>";
        }
    }

    /**
     * Preview PDF file from email template
     *
     * @param Email $email
     * @param Student $student
     * @return mixed
     */
    public function templateDynamicPDFPreview(Email $email, Student $student)
    {
        $pdf = \PDF::loadView('emails.dynamic_pdf', [
            'pdfTemplate' => $email
        ]);

        return $pdf->stream($email->attach_name);
    }

    /**
     * Group sending emails
     *
     * @param Email $email
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function templates(Email $email, Request $request)
    {
        if(!$request->students){
            return response()->json([
                'success' => false
            ]);
        }
        $students = json_decode($request->input('students'));
        $stArr = [];
        foreach($students as $key => $studentId) {
            $stArr[] = $studentId->sid;
        }


        $students = Student::whereIn('id', $stArr)->get();
        $studentFields = config('email_templates.student_fields');
        foreach($students as $student) {
            $sent = Mail::send('emails.body', ['email' => $email], function ($message) use ($email, $student) {

                $message->to($student->email)->subject($email->name);
            });

            foreach($studentFields as $key => $value) {
                if($value['template_type'] === (int) $email->type) {
                    $fieldName = $value['field_name'];
                    if($value['boolean_exists']) {
                        $sentArr = [
                            $fieldName        => Student::SENT,
                        ];
                    }
                    else {
                        $sentArr = [];
                    }
                    $student->update(array_merge($sentArr, [
                        $fieldName . '_date' => date("Y-m-d H:i:s"),
                        'mailed'             => Student::MAILED
                    ]));
                    break;
                }
            }
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function invoice(Student $student, Request $request)
    {
        $data = [];
        $pdf = \PDF::loadView('invoice.invoice', $data);

        Mail::send('emails.invoice', [], function ($message) use ($student, $pdf) {

            $message
                ->to($student->email)
                ->subject('Invoice')
                ->attachData($pdf->output(), "invoice.pdf");
        });
    }

    public function sendInvoice(Request $request)
    {
        try {
            if($request->progressive_number) {
               $progressiveId = [
                   'id' => $request->progressive_number
               ];
            }
            else {
                $progressiveId = [];
            }
            $invoice = new Invoice(array_merge($request->all(), [
                'send_at' => date("Y-m-d H:i:s")
            ], $progressiveId));
            $invoice->save();

            $pdf = \PDF::loadView('invoice.invoice', ['invoice' => $invoice]);

            Mail::send('emails.invoice', [], function ($message) use ($invoice, $pdf) {

                $message
                    ->to($invoice->email)
                    ->subject('Invoice')
                    ->attachData($pdf->output(), "invoice.pdf");
            });

            return response()->json([
                'success' => true,
                'date' => $invoice->send_at->timezone('GMT+2')->format('d/m/Y H:i'),
                'id' => $invoice->id
            ]);
        }
        catch(\Exception $e) {
            return response()
                ->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function repeatSendInvoice(Invoice $invoice)
    {
        try {
            $pdf = \PDF::loadView('invoice.invoice', ['invoice' => $invoice]);

            Mail::send('emails.invoice', [], function ($message) use ($invoice, $pdf) {

                $message
                    ->to($invoice->email)
                    ->subject('Invoice')
                    ->attachData($pdf->output(), "invoice.pdf");
            });

            $invoice->update([
                'send_at' => date("Y-m-d H:i:s")
            ]);

            return response()->json([
                'success' =>true
            ]);
        }
        catch(\Exception $e) {
            return response(400)->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function alertAdminsForNewSubscription(Student $student)
    {
        $copiesTo = config('mail.to.' . env('APP_ENV', 'production'));
        $student = $student->toArray();

        Mail::send('emails.alert_admins_subscription', ['student' => $student], function ($message) use ($copiesTo) {

            foreach($copiesTo as $key => $emailAddress) {
                $message
                    ->to($emailAddress);
            }

            $message
                ->subject("Object: nuova pre-iscrizione");
        });
    }
}
