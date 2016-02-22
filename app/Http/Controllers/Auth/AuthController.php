<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

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

    private $redirectTo = '/home';

    protected $loginPath = '/login';
    
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function authenticate()
    {
        $email = Input::get('email');
        $password = Input::get('password');
        
        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            Session::flash('flash_message',' You have logged in Sucessfully!');
            return redirect()->intended('home');
            //return redirect('home');
        } else if (Auth::check()) {
            // The user is logged in...
            return redirect()->intended('home');
        } else if (!Auth::attempt(['email' => $email, 'password' => $password])){
            //Session::flash('flash_message',' Failed!');
            return redirect()->back()->with('flash_message','Invalid Email or Password!!');
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:3',
        ]);
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
            'firstname' => $data['name'],
            'lastname' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function doLogin()
    {
        $credentials = [
            //'email' => $request->input('email'),
            //'password' => $request->input('password'),
            'email' => Input::get('email'),
            'password' => Input::get('password'),
        ];

        if(Auth::attempt($credentials)){
                //Session::flash('flash_error','Something went wrong with your credentials');
                //Session::flash('flash_message',' Failed!');
                //return redirect()->back();
        } else{
            Session::flash('flash_message',' You have logged in Sucessfully!');
            //return redirect('home');
        }
    }

    public function doLogout(){
        Auth::logout();
        return redirect('/');
    }
}
