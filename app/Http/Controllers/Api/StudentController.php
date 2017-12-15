<?php

namespace App\Http\Controllers\Api;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Update confirmed field
     *
     * @param Student $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm(Student $student)
    {
        $student->update(['confirmed' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Update exam_already_taken field
     *
     * @param Student $student
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function examAlreadyTaken(Student $student, Request $request)
    {
        $student->update(['exam_already_taken' => $request->input('value')]);

        return response()->json(['success' => true]);
    }

    /**
     * Delete student
     *
     * @param Student $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Newest subscribed students
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lastStudents()
    {
        $students = Student::whereNew(Student::NEW_S)->get();

        $stdArr = [];
        foreach($students as $student) {
            $stdArr[] = [
                'name'    => $student->name,
                'surname' => $student->surname,
                'link'    => '/user/edit/' . $student->id,
                'time'    => $student->created_at->timezone("GMT+2")->format("H:i")
            ];
        }

        return response()->json([
            'success'  => true,
            'activity' => $stdArr
        ]);
    }

    /**
     * Get last created student
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lastCreated()
    {
        $student = Student::orderBy('created_at', 'desc')->whereNotNull('created_user_id')->first();

        if($student) {
            return response()->json([
                'success'  => true,
                'name'    => $student->userCreated->name,
                'link'    => '/user/edit/' . $student->id,
                'time'    => $student->created_at->timezone("GMT+2")->format("H:i")
            ]);
        }
        else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    /**
     * Get last updated student
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lastUpdated()
    {
        $student = Student::orderBy('updated_at', 'desc')->whereNotNull('updated_user_id')->first();

        if($student) {
            return response()->json([
                'success'  => true,
                'name'    => $student->userUpdated->name,
                'link'    => '/user/edit/' . $student->id,
                'time'    => $student->updated_at->timezone("GMT+2")->format("H:i")
            ]);
        }
        else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    /**
     * Save to student that student is editing
     *
     * @param Student $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function editing(Student $student)
    {
        $student->update([
            'editing_user_id' => Auth::user()->id,
            'editing_time'    => time()
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Check if student is editing by another manager
     *
     * @param Student $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function alreadyEditing(Student $student)
    {
        if($student->editing_user_id != Auth::user()->id && (time() - $student->editing_time) < 20) {
            $success = true;
        }
        else {
            $success = false;
        }

        return response()->json([
            'success' => $success,
            'message' => $student->name .  " are already on this record, please edit another students."
        ]);
    }

    /**
     * Update "select_as_memo" field in student
     *
     * @param Student $student
     * @return mixed
     */
    public function selectAsMemo(Student $student)
    {
        if($student->select_as_memo) {
            $value = 0;
        }
        else {
            $value = 1;
        }
        $student->update([
            'select_as_memo' => $value
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
