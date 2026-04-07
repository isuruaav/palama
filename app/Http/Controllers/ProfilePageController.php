<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilePageController extends Controller
{
    public function edit()
    {
        return view('pages.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required|max:100',
            'phone' => 'nullable',
        ]);

        auth()->user()->update([
            'name'  => $request->name,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'Profile updated!');
    }
}