<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthController extends Controller
{
    public function register(Request $request){
        //validate
        $fields=$request->validate([
            'name'=>['required','max:192','unique:users'],
            'email'=>['required','max:192','email','unique:users'],
            'password'=>['required','min:6','confirmed']

        ]);
        //register
        $user=User::create($fields); //or create(['name'=>$request->name])....
        //login
        Auth::login($user);

        event(new Registered($user));
        //redirect
        return redirect()->route('dashboard');
    }
    //  verify email notice handler
    public  function verifyNotice() {
        return view('auth.verify-email');
    }

    // email verification handler
    public function verifyEmail (EmailVerificationRequest $request) {
        $request->fulfill();  //fulfilling means resolving the request
     
        return redirect()->route('dashboard');
    }

    // Resending the Verification Email
    public function verifyHandler (Request $request) {
        $request->user()->sendEmailVerificationNotification();
     
        return back()->with('message', 'Verification link sent!');
    }

    //login user
    public function login(Request $request){
        // Validate the request
        $fields = $request->validate([
            'email' => ['required', 'max:192', 'email'],
            'password' => ['required']
        ]);
    
        // Check if the email belongs to an admin
        $admin = Admin::where('email', $fields['email'])->first();
        
        if ($admin) {
            // Try to log in as an admin
            if (Auth::guard('admin')->attempt($fields, $request->remember)) {
                return redirect()->intended('adminDashboard'); // or route('admin.dashboard');
                
                
            }
        } else {
            // Try to log in as a user
            if (Auth::attempt($fields, $request->remember)) {
                return redirect()->intended('dashboard'); // or route('home');
            }
        }
    
        // If authentication fails, return back with an error
        return back()->withErrors([
            'failed' => 'The provided credentials do not match any existing account'
        ]);
    }
    //logout user
    public function logout(Request $request){
        //logout
        Auth::logout();
        //invalidate user's session
        $request->session()->invalidate();
        //regenerate csrf token
        $request->session()->regenerateToken();
        //redirect to home page
        return redirect('/login'); // or route('esm route')
    }
}
