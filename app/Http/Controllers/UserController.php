<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required|unique:users,email,'. $user->id
        ]);

        $user->fill($request->all());
        $user->save();

        return back()->with('success', 'Profile updated!');
    }
}
