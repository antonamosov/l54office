<?php

namespace App\Http\Controllers;

use App\CourseType;
use Illuminate\Http\Request;

class CourseTypeController extends Controller
{
    public function index()
    {
        $types = CourseType::get();

        return view('session.course.index', compact('types'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'numeric'
        ]);

        $type = new CourseType($request->all());
        $type->save();

        return redirect()->back()->withMsg('Course type has been created');
    }

    public function destroy(CourseType $courseType)
    {
        $courseType->delete();

        return redirect()->back()->withMsg('Course type has been deleted');
    }
}
