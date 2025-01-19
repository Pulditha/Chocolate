<?php  

namespace App\Http\Controllers\Auth;  

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Auth;  

class LoginController extends Controller  
{  
    /**
     * Handle user login and issue Sanctum token.
     */
    public function login(Request $request)  
    {  
        $request->validate([  
            'email' => 'required|email',  
            'password' => 'required',  
        ]);  

        $credentials = $request->only('email', 'password');  

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Issue Sanctum token
            $token = $user->createToken($user->name)->plainTextToken;

            // Determine redirection route
            $redirectUrl = $user->role === 'admin' ? '/admin/dashboard' : '/account';

            return response()->json([
                'message' => 'Login successful!',
                'user' => $user,
                'token' => $token,
                'redirect_url' => $redirectUrl,
            ], 200);
        }

        return response()->json([
            'message' => 'The provided credentials do not match our records.',
        ], 401);  
    }  

    /**
     * Handle user logout and revoke token.
     */
    public function apiLogout(Request $request)
    {
        // Revoke the current access token
        $request->user()->currentAccessToken()->delete();
    
        return response()->json([
            'message' => 'Logged out successfully!',
        ], 200);
    }
    
    public function logout(Request $request)
{
    Auth::logout(); // End the user's session
    $request->session()->invalidate(); // Invalidate the session
    $request->session()->regenerateToken(); // Regenerate CSRF token for security

    return redirect('/'); // Redirect to home or login page
}


}

