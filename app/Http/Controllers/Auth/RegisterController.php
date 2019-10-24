<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|alpha_num|max:255|unique:users|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      $mail_data = [
        "username"=>$data['name']
      ];

      //send mail to admin
      Mail::send('email.register-email-admin', $mail_data,
      function ($message) use ($data) {
           $message->subject('คุณมีผู้ใช้ใหม่! ชื่อผู้ใช้: '.$data['name']);
           $message->to("decoriq@gmail.com");
       });

       //send mail to user
      Mail::send('email.register-email-admin', $mail_data,
      function ($message) use ($data) {
           $message->subject("ขอบคุณที่สมัครสมาชิกกับ DECORIQ");
           $message->to($data['email']);
       });


      return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => 4,
            'password' => Hash::make($data['password']),
        ]);
    }
}
