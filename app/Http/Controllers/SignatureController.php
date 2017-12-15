<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
    public function get(Student $student)
    {
        $student = $student->find(session('student_id'));

        return view('sig', [
            'student' => $student
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $this->validate($request, [
            'image' => 'required',
            'student_id' => 'required'
        ]);

        $student = $student->find($request->input('student_id'));
        $student->update([
           'image' => $request->input('image')
        ]);

        app('App\Http\Controllers\SendEmailController')->sendAutomaticPreEntryEmail($student);
        app('App\Http\Controllers\SendEmailController')->alertAdminsForNewSubscription($student);

        return redirect()->route('main.page')->withMsg("Pre-iscrizione effettuata! Ora controlla la tua e-mail e segui le indicazioni per confermarla.\r\nGrazie!");
    }
}
