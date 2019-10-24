<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use Auth;
use App\User;
use App\SocialAccount;
use App\Photo;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;


class LoginController extends Controller
{
  public function logout(Request $request) {
    Auth::logout();
    return redirect('/login');
  }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
    * Social Login
    */
   public function redirectToProvider($provider)
   {
       return Socialite::driver($provider)->redirect();
   }

   public function handleProviderCallback($provider)
   {
       $providerUser = Socialite::driver($provider)->user();

       $user = $this->createOrGetUser($provider, $providerUser);
       auth()->login($user);

       return redirect()->to('/');
   }


   public function createOrGetUser($provider, $providerUser)
   {
       /** Get Social Account */
       $account = SocialAccount::whereProvider($provider)
           ->whereProviderUserId($providerUser->id)
           ->first();


       if ($account->user) {
           return $account->user;
       } else {

           /** Get user detail */
           $userDetail = Socialite::driver($provider)->userFromToken($providerUser->token);

           /** Create new account */
           $account = new SocialAccount([
               'provider_user_id' => $providerUser->getId(),
               'provider' => $provider,
           ]);

           /** Get email or not */
           $email = !empty($providerUser->getEmail()) ? $providerUser->getEmail() : $providerUser->getId() . '@' . $provider . '.com';


           /** Get User Auth */
           if (auth()->check()) {
               $user = auth()->user();
           }else{
               $user = User::where('email',$email)->first();
           }

           if (!$user) {
             //   return dd('no user');
               /** Get Avatar */
               $image = $provider . "_" . $providerUser->getId() . "_".Str::random(6).".png";
               $imagePath = public_path(config('app.media.directory') . "images/" . $image);
               file_put_contents($imagePath, file_get_contents($providerUser->getAvatar()));


                $fullname = explode(" ", $providerUser->getName());
                $firstname = $fullname[0];
                $lastname = $fullname[1];
                $name = $fullname[0].$fullname[1];
                $profile_photo = Photo::create(['file'=>$image]);



               /** Create User */
               $user = User::create([
                   'role_id' => '4',
                   'is_active' => '0',
                   'name' => $provider . $providerUser->getId(),
                   'email' => $email,
                   'username' => $providerUser->getId(),
                   'password' => bcrypt(rand(1000, 9999)),
                   'photo_id' => $profile_photo->id,
                   'tel_number' => '',
                   'firstname' => $firstname,
                   'lastname' => $lastname
               ]);

               $mail_data = [
                 "username"=>$user['name']
               ];

               //send to admin
               Mail::send('email.register-email-admin', $mail_data,
               function ($message) use ($user) {
                     // dd($data);
                    $message->subject("คุณมีผู้ใช้ใหม่! ชื่อผู้ใช้: ".$user['name']);
                    $message->to("decoriq@gmail.com");
                });

                //send to user
               Mail::send('email.register-email-admin', $mail_data,
               function ($message) use ($user) {
                     // dd($data);
                    $message->subject("ขอบคุณที่สมัครสมาชิกกับ DECORIQ");
                    $message->to($user['email']);
                });

           }

           /** Attach User & Social Account */
           $account->user()->associate($user);
           $account->save();

           return $user;
       }
   }

}
