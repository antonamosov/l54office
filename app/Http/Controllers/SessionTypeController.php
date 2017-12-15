<?php

namespace App\Http\Controllers;

use App\SessionType;
use Illuminate\Http\Request;

class SessionTypeController extends Controller
{
    public function index()
    {
        $types = SessionType::get();

        return view('session.type.index', compact('types'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'numeric'
        ]);

        $type = new SessionType($request->all());
        $type->save();

        return redirect()->back()->withMsg('Session type has been created');
    }

    public function destroy(SessionType $sessionType)
    {
        $sessionType->delete();

        return redirect()->back()->withMsg('Session type has been deleted');
    }
}
