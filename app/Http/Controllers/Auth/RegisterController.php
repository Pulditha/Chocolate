<?php  

namespace App\Http\Controllers\Auth;  

use App\Http\Controllers\Controller;  
use App\Models\User;  
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Hash;  
use Illuminate\Support\Facades\Validator;  

class RegisterController extends Controller  
{  
    /**
     * Handle user registration and issue Sanctum token.
     */
    public function register(Request $request)  
    {  
        // Validate the request data
        $this->validator($request->all())->validate();  

        // Create the user
        $user = User::create([  
            'name' => $request->name,  
            'email' => $request->email,  
            'password' => Hash::make($request->password),  
            'role' => 'user',  // Default role for new users
        ]);  

        // Automatically log the user in and issue Sanctum token
        $token = $user->createToken($request->name)->plainTextToken;

        // Return a JSON response with the token
        return response()->json([
            'message' => 'Registration successful!',
            'user' => $user,
            'token' => $token,
        ], 201);
    }  

    /**
     * Validate incoming registration data.
     */
    protected function validator(array $data)  
    {  
        return Validator::make($data, [  
            'name' => ['required', 'string', 'max:255'],  
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],  
            'password' => ['required', 'string', 'min:8', 'confirmed'],  
        ]);  
    }  
}
