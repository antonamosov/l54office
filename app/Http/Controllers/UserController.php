<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();

        return view('user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:255',
            'confirm_password' => 'required|same:password',
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->withMsg("User created successfully.");
    }

    public function destroy(User $user)
    {
        $current = Auth::user();
        if($current->id == $user->id) {
            return redirect()->back()->withErr("Can't delete yourself.");
        }
        $user->delete();

        return redirect()->back()->withMsg("User deleted successfully.");
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:6|max:255',
            'confirm_password' => 'required|same:password',
        ]);

        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->withMsg("User updated successfully.");
    }
}
