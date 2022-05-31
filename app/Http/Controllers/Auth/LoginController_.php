<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

  public function redirectTo () {
    if (Auth::user()->role === 'superAdmin') {
      return $this -> redirectTo = route ('user.index');
      // return $this -> redirectTo;
    } else if (Auth::user()->role === 'admin') {
      return $this -> redirectTo = route ('home');
      // return $this -> redirectTo;
    }
  }

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  // protected $redirectTo = RouteServiceProvider::HOME;
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

  public function login(Request $request)
  {
    $input = $request->all();

    $this->validate($request, [
      'username' => 'required',
      'password' => 'required',
    ]);

    $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    if (auth()->attempt(array(
      $fieldType => $input['username'], 'password' => $input['password']
    )))
    {
      return redirect()->route('home');
    } else {
      return redirect()->route('login')->with('error','Username And Password Are Wrong.');
    }
  }

  // public function login(Request $request)
  // {
  //   $credentials = $request->validate([
  //     'mode' => ['required'],
  //     'username' => ['required', 'string'],
  //     'password' => ['required'],
  //     'captcha_id' => ['required'],
  //     'securid' => ['required']
  //   ]);

  //   if ($request->mode != 20) {
  //     $credentials['username'] = $request->username;
  //     $credentials['password'] = $request->password;

  //     $url = "http://103.8.12.212:36880/siakad_api/api/as400/login";

  //     $response = Http::asForm()->post($url, $credentials);

  //     $response = json_decode($response);

  //     var_dump($response);

  //     if ($response->status == false) {
  //       return redirect()-> route('login')->with('login_msg', 'Username atau Password salah');
  //     } else {
  //       // $response = $user;
  //       $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

  //       if (auth()->attempt(array(
  //         $fieldType => $input['username'], 'password' => $input['password']
  //       )))
  //       {
  //         return redirect()->route('home');
  //       }
  //       // else {
  //       //   return redirect()->route('login')->with('error','Username And Password Are Wrong.');
  //       // }
  //     }

  //     // $set_session = $this->setUserSession($response);

  //     // if ($set_session) {
  //     //   return redirect()->route('home');
  //     // } else {
  //     //   return redirect()->route('login')->with('login_msg', 'Gagal melakukan koneksi ke WS SISTER');
  //     // }
  //   }
  // }
}
