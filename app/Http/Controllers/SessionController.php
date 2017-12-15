<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionRequest;
use App\Session;
use App\SessionType;
use Carbon\Carbon;

class SessionController extends Controller
{
    public function create()
    {
        $session = new Session;
        $sessionTypes = SessionType::get();

        return view('session.create', compact('session', 'sessionTypes'));
    }

    public function index()
    {
        $sessions = Session::get();

        return view('session.list')->withSessions($sessions);
    }
    public function listForUsers()
    {
        $sessions = Session::where('date', '>', Carbon::now())->orderBy('date', 'asc')->get();

        return view('sessions')->withSessions($sessions);
    }



    public function store(StoreSessionRequest $request, Session $session)
    {
        //dd($request->all());

        $session->fill($request->all());
        $session->save();

        //dd($student);

        return redirect()->route('session.index');
    }

    public function edit(Session $session)
    {
        $sessionTypes = SessionType::get();

        return view('session.create', compact('session', 'sessionTypes'));
    }

    public function update(Session $session, StoreSessionRequest $request)
    {
        //dd($student);
        $session->update($request->all());

        return redirect()->route('session.index');
    }

    public function destroy(Session $session)
    {
        $session->delete();

        return redirect()->back();
    }

}
