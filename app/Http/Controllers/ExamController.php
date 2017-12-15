<?php

namespace App\Http\Controllers;

use App\CourseType;
use App\Exam;
use App\SessionType;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::get();
        $sessionTypes = SessionType::get();
        $courseTypes = CourseType::get();

        return view('exam.index', compact('exams', 'sessionTypes', 'courseTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'price' => 'required|numeric'
        ]);

        $exam = new Exam($request->all());
        $exam->save();

        return redirect()->route('exam.index')->withmsg('Created successful');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        $sessionTypes = SessionType::get();
        $courseTypes = CourseType::get();

        return view('exam.edit', compact('exam', 'sessionTypes', 'courseTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Exam $exam, Request $request)
    {
        $this->validate($request, [
            'price' => 'required|numeric'
        ]);

        $exam->update($request->all());

        return redirect()->route('exam.index')->withMsg('Updated successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()->back();
    }
}
