<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the authenticated user.
     *
     * @return \Inertia\Response
     */
    public function __invoke()
    {
        return Inertia::render('Profile/Edit', [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
        ]);
    }

    /**
     * Update the authenticated user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = Validator::make($request->all(), UserUpdate::getRules())->validate();

        if ($validatedData['password'] !== null) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $validatedData = array_filter($validatedData); // Array filter deletes all the null values

        Auth::user()->update($validatedData);

        return redirect()->back()->with('success', 'Profile was successfully updated!');
    }
}
