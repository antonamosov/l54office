<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function show(Student $student)
    {
        if(!count($student->Exams)) {
            return 'Please firstly save student';
        }

        $pdf = \PDF::loadView('receipt.receipt', [
            'student' => $student,
            'date' => date("d/m/Y")
        ]);

        return $pdf->stream('receipt.pdf');
    }

    public function html(Student $student)
    {
        return view('receipt.receipt', [
            'student' => $student
        ]);
    }
}
