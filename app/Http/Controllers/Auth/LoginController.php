<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;

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
    // protected $maxAttempts = 1; // Default is 5
    // protected $decayMinutes = 1; // Default is 1
    // protected function hasTooManyLoginAttempts(Request $request)
    // {
    //     $maxLoginAttempts = 3;
     
    //     $lockoutTime = 1; // Dalam menit
     
    //     return $this->limiter()->tooManyAttempts(
    //        $this->throttleKey($request), $maxLoginAttempts, $lockoutTime
    //     );
    // }
    // protected $maxAttempts = 1; // Default is 5
    // protected $decayMinutes = 1; // Default is 1
    use AuthenticatesUsers;
    
    public function showLoginForm()
    {
        return redirect('/');
    }
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/welcome';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function username()
    {
        return 'name';
    }
    
}
