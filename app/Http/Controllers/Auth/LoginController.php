<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function login(Request $request){
 
        $information=$request->validate([
         'email'=>'required|email',
         'password'=>'required'
        ]);

        if(Auth::attempt($information)){
               $user=Auth::user()->role;
               if($user==1)
               {
               return redirect('/admin');
               }
               elseif($user==0)
               {
                return redirect('/client');
               }
               else
               {
                Auth::logout();
               }
        }else{
             return redirect('/login');
        }

    }
}
