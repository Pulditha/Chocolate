<?php  

namespace App\Http\Controllers\Auth;  

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Auth;  

class LoginController extends Controller  
{  
    public function login(Request $request)  
    {  
        $request->validate([  
            'email' => 'required|email',  
            'password' => 'required',  
        ]);  

        $credentials = $request->only('email', 'password');  

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect()->route($user->role === 'admin' ? 'admin.dashboard' : 'account')
                ->with('success', 'Login successful!');
        }
        

        return back()->withErrors([  
            'email' => 'The provided credentials do not match our records.',  
        ]);  
    }  
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the user's session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully!');
    }

}