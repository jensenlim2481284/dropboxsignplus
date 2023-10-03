<?php

namespace App\Http\Controllers\Dashboard;

use Auth;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Auth\Authenticatable;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    use Authenticatable;


    # login page
    public function index()
    {
        # 1 : Check if user already login - redirect back to account page 
        if (Auth::check())
            return redirect('/');

        return view('pages.dashboard.auth.login');
    }


    # Login Function 
    public function login(Request $request)
    {

        # Check user exists
        $user = User::where('email',$request->email)->first();
        if(!$user)
            return back()->with('err', translate('incorrect_username_password', "Incorrect Username or Password"));

        # Check Login Credential       
        $credentials = $request->only('email', 'password');         
        if (Auth::attempt($credentials))
            return redirect()->intended('/');

        return back()->with('err', translate('incorrect_username_password', "Incorrect Username or Password"));
    }


    # Function to verify google 2fa Code
    public function verifyGoogle2FA()
    {        
        return redirect(route('homepage'));    
    }

    
    # logout function     
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
