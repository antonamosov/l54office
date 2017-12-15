<?php

namespace App\Jobs;

use App\Email;
use App\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class sendTemplateEmailToUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $student;

    /**
     * Create a new job instance.
     *
     * @param Email $email
     * @param Student $student
     * @return void
     */
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $student = $this->student;

        $emails = Email::whereAuto(Email::AUTO_AFTER_SUBSCRIPTION)->get();

        foreach($emails as $email) {
            $email->filterBodyVariables($student);

            Mail::send('emails.body', ['email' => $email], function ($message) use ($email, $student) {

                $message->to($student->email)->subject($email->name);
            });
        }
    }
}
