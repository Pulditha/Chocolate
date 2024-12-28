<?php  

namespace App\Http\Controllers\Auth;  

use App\Http\Controllers\Controller;  
use App\Models\User;  
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Hash;  
use Illuminate\Support\Facades\Validator;  

class RegisterController extends Controller  
{  
   
    public function register(Request $request)  
    {  
        $this->validator($request->all())->validate();  

        $user = User::create([  
            'name' => $request->name,  
            'email' => $request->email,  
            'password' => Hash::make($request->password), 
            'role' => 'user', 
        ]);  

        // Automatically log the user in  
        auth()->login($user);  

        return redirect('/')->with('success', 'Registration successful!');  
    }  

    protected function validator(array $data)  
    {  
        return Validator::make($data, [  
            'name' => ['required', 'string', 'max:255'],  
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],  
            'password' => ['required', 'string', 'min:8', 'confirmed'], 
            
        ]);  
    }  
}