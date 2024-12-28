<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminProfileController extends Controller
{
    /**
     * Show the admin profile page.
     */
    public function edit()
    {
        return view('admins.profile', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Update the admin profile.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * Delete the admin account.
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();

        $user->delete();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }
}
