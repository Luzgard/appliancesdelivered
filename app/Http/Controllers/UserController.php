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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|unique'
        ]);

        $user = auth()->user();

        $user->fill($request->all());
        $user->save();

        return back()->with('success', 'Update data');
    }
}
