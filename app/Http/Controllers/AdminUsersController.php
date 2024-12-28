<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    /**
     * Display a list of users with statistics.
     */
    public function index()
    {
        $users = User::all();
        $totalUsers = $users->count();
        $activeUsers = $users->whereNotNull('last_login_at')->count();
        $admins = $users->where('role', 'admin')->count();

        return view('admins.users', compact('users', 'totalUsers', 'activeUsers', 'admins'));
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admins.users')->with('success', 'User deleted successfully.');
    }
}
