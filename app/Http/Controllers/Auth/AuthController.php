<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $username = 'username';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'username.required'    => 'Username dibutuhkan.',            
            'password.required'    => 'Password dibutuhkan.',
            
        ];

        return Validator::make($data, [
            //'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ],$messages);
    }

    protected function validateLogin(Request $request)
    {
         $messages = [
            'username.required'    => 'Username dibutuhkan.',            
            'password.required'    => 'Password dibutuhkan.',
            
        ];

        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ],$messages);
    }

    protected function getFailedLoginMessage()
    {
        /*return Lang::has('auth.failed')
                ? Lang::get('auth.failed')
                : 'These credentials do not match our records.';*/
        return Lang::has('auth.failed')
                ? Lang::get('auth.failed')
                : 'Kombinasi Username dan Password tidak tepat.'; 
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
