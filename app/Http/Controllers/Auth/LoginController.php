<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated($request, $user)
    {

        //dd($user);
        //Check if user type is 3 (or any other condition)
        if ($user->user_type == 2) {
            // Flash a welcome message to the session
            session()->flash('welcome', 'Welcome to your dashboard, ' . $user->name . '!');
        }
        if ($user->user_type == 3) {
            // Flash a welcome message to the session
            session()->flash('welcome', 'Welcome to your dashboard, ' . $user->name . '!');
        }
        
        // if(in_array($user->user_type,[2,3])){
        //     dd("dfjghdfjghdkfjhgjkdf");
        //      session()->flash('welcome', 'Welcome to your dashboard, ' . $user->name . '!');
        //       return redirect()->route('dashboard');
        // }else{
            
        //     dd("came here");
        //      Auth::logout();

        // // Redirect back to login with an error message
        // return redirect()->route('login')->withErrors(['error' => 'Not allowed to access this section.']);
        
        //     // return redirect()->route('login')->withErrors(['error' => 'Not allowed to access this section.']);

        // }
        
        
    }


}
