<?php

namespace App\Http\Controllers;

use App\Classes\FilterContent;
use App\Classes\SendEmail;
use App\Email;
use App\Exam;
use App\Http\Requests\StoreStudentRequest;
use App\Session;
use App\SessionType;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Get students
     *
     * @param $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $emails = Email::get();
        $sessions = Session::orderBy('date', 'asc')->get();
        $session_types = SessionType::get();

        //dd($request->all());

        $query = Student::orderBy('id', 'desc');
        foreach($request->all() as $key => $value) {
            if($key == 'session_type' && $value !== null) {
                $query->whereHas('exam', function ($query) use ($value)
                {
                    $query->where('session_type_id', '=', $value);
                });
                continue;
            }
            if($key == 'exam_date' && $value !== null) {
                $query->where($key.'_to', 'like', '%' . $value . '%')
                    ->orWhere($key.'_from', 'like', '%' . $value . '%');
                continue;
            }
            if($value !== null) {
                $query->where($key, 'like', '%' . $value . '%');
            }
        }
        $students = $query->get();

        return view('student.list', compact('emails', 'students', 'sessions', 'session_types'));
    }

    public function userPrint(Request $request)
    {
        if($studentIds = $request->input('ids')) {
            $studentIdsArr = explode(',', $studentIds);
            $students = Student::whereIn('id', $studentIdsArr)->get();
        }
        else {
            $students = Student::get();
        }

        $sessions = Session::get();

        return view('student.print', compact('students', 'sessions'));
    }

    /**
     * Create student from sessions
     *
     * @param Session $session
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getCreate(Session $session)
    {
        return $this->_getCreate($session);
    }

    /**
     * Get form for all create methods
     *
     * @param $session
     * @param $student
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function _getCreate($session, $student = null)
    {
        if(null == $student) {
            $student = new Student;
            $student->session_id = $session->id;
            $student->enrolment_exam = localDate($student->session->date);
        }

        $exams = Exam::get();
        $emails = Email::get();
        $sessions = Session::get();

        return view('student.create', [
            'student' => $student,
            'exams' => $exams,
            'emails' => $emails,
            'sessions' => $sessions
        ]);
    }

    /**
     * Save student (for admin)
     *
     * @param Session $session
     * @param StoreStudentRequest $request
     * @param Student $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Session $session, StoreStudentRequest $request, Student $student)
    {
        $input = $request->all();
        $input = array_merge($input, $this->sendCode($input, $student), [
            'created_user_id' => Auth::user()->id
        ]);

        foreach($input as $key => $value) {
            if($key === 'vat'
            || $key === 'fiscal_code') {
                $input[$key] = Str::upper($value);
            }
            elseif($key === 'payment_type') {
                $input['payment_type'] = json_encode($input['payment_type']);
            }
        }
        if(!isset($input['exam_date_to'])) {
            $input['exam_date_to'] = null;
        }
        if(isset($input['resident_in'])) {
            if(is_array($input['resident_in'])) {
                $input['resident_in'] = implode(',', $input['resident_in']);
            }
        }
        $student->fill($input);
        $student->save();
        $examsInput = $request->input('exam_id');
        $student->exams()->sync(is_array($examsInput) ? $examsInput : []);

        return redirect()->route('student', $student->id);
    }

    /**
     * Save student (for students)
     *
     * @param StoreStudentRequest $request
     * @param Student $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePublic(StoreStudentRequest $request, Student $student)
    {
        $input = $request->all();
        foreach($input as $key => $value) {
            if($key === 'vat'
                || $key === 'fiscal_code') {
                $input[$key] = Str::upper($value);
            }
        }
        if(isset($input['resident_in'])) {
            if(is_array($input['resident_in'])) {
                $input['resident_in'] = implode(',', $input['resident_in']);
            }
        }
        $student->fill($input);
        $student->save();

        if ( env('APP_ENV') === 'testing' || $request->input('screen_width') > 1100) {
            app('App\Http\Controllers\SendEmailController')->sendAutomaticPreEntryEmail($student);
            app('App\Http\Controllers\SendEmailController')->alertAdminsForNewSubscription($student);

            return redirect()->route('main.page')->withMsg("Pre-iscrizione effettuata! Ora controlla la tua e-mail e segui le indicazioni per confermarla.\r\nGrazie!");
        }
        else {
            session([
                'student_id' => $student->id
            ]);

            return redirect()->route('main.sig');
        }
    }

    /**
     * Update student
     *
     * @param Student $student
     * @param StoreStudentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Student $student, StoreStudentRequest $request)
    {
        $input = $request->all();
        //dd($input);
        $input = array_merge($input, $this->sendCode($input, $student), [
            'updated_user_id' => Auth::user()->id
        ]);

        foreach($input as $key => $value) {
            if($key === 'vat'
                || $key === 'fiscal_code') {
                $input[$key] = Str::upper($value);
            }
            elseif($key === 'payment_type') {
                $input['payment_type'] = json_encode($input['payment_type']);
            }
        }
        if(isset($input['resident_in'])) {
            if(is_array($input['resident_in'])) {
                $input['resident_in'] = implode(',', $input['resident_in']);
            }
        }
        if(isset($input['exam_date_to'])) {
            if($input['exam_date_to'] !== $student->enrolment_exam->format('Y-m-d')) {
                $input['enrolment_exam'] = $input['exam_date_to'];
                $student->fill(array_only($input, [
                    'exam_date_from',
                    'exam_date_to'
                ]));
                $student->changing_exam_send_date = date('Y-m-d H:i:s');
                $success = $this->sendChangingExamEmail($input['email'], $student);
                if(!$success) {
                    return redirect()->back()->withInfoMessage('Changing exam date template not exists.');
                }
            }
        }
        $examsInput = $request->input('exam_id');
        $student->exams()->sync(is_array($examsInput) ? $examsInput : []);
        $student->update($input);

        /*if(isset($input['exam_date_send'])) {
            $this->sendChangingExamEmail($student);
        }*/

        return redirect()->route('student', $student->id);
    }

    public function getUser(Student $student)
    {
        $student->update(['new' => false]);
        $exams = Exam::get();
        $emails = Email::get();
        $sessions = Session::get();

        return view('student.create', compact('student', 'exams', 'emails', 'sessions'));
    }

    public function getUserPrint(Student $student)
    {
        $exams = Exam::get();
        $emails = Email::get();
        $sessions = Session::get();

        return view('student.user_print', compact('student', 'exams', 'emails', 'sessions'));
    }

    private function sendChangingExamEmail($emailAddress, Student $student)
    {
        $email = new Email;
        $email = $email->getChangingExamDateTemplate();
        if($email) {
            $email->send('body', $emailAddress, $student);

            return true;
        }
        else {
            return false;
        }
    }

    private function sendCode($input, $student)
    {
        if($input['send_code'] === 'tan') {
            $template = Email::TAN;
        }
        elseif($input['send_code'] === 'tat') {
            $template = Email::TAT;
        }
        elseif($input['send_code'] === 'tas') {
            $template = Email::TAS;
        }
        elseif($input['send_code'] === 'fts') {
            $template = Email::FTS;
        }

        if($input['send_code']) {
            $emailTemplate = Email::whereType($template)->first();
            if($emailTemplate) {
                $emailTemplate->filterBodyVariables($student);
                $sent = Mail::send('emails.body', ['email' => $emailTemplate], function ($message) use ($input, $emailTemplate) {

                    $message->to($input['email'])->subject($emailTemplate->name);
                });

                $code_date[$input['send_code'] . '_date'] = date('Y-m-d H:i:s');

                return $code_date;
            }
        }

        return [];
    }
}
