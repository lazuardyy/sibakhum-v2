<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;
use Auth;


class LoginController extends Controller
{
  protected $redirectsTo = '/login';

  public function index()
  {

      if (session ('isLoggedIn') == true){
          return redirect()->to('home');
      }
      return view('auth.login');

  }

  public function attemptLogin (Request $request)
  {
      $credentials = $request->validate([
          'username' => ['required','string'],
          'password' => ['required']
      ]);

      $credentials['Authorization'] = env('APP_AUTH');
      $url = env('APP_ENDPOINT');

      $response = Http::asForm()->post($url, $credentials);
      $response = json_decode($response);
      //return $response;
      if ($response->status != 200) {
          $this->logout($request);
          // $request->flash();
          return redirect()->to('login')->with('login_msg', 'Username atau Password salah');
      }

      $set_session = $this->setUserSession($response);
      // return $set_session;
      if ($set_session) {
          return redirect()->to('home');
      } else {
          return redirect()->to('login')->with('login_msg', 'Gagal melakukan koneksi ke SIAKAD');
      }

  }
  protected function setUserSession($user)
  {
      try {
          $akun = DB::table('ref_modes')->where('id', $user->mode)->first();
          $mode = $akun->mode;
          session([
              'user_name' => $user->nama,
              'user_username' => $user->username,
              'user_cmode' => $user->mode,
              'user_mode' => $mode,
              'user_sex' => $user->kelamin,
              'user_unit' => $user->unit,
              'user_token' => $user->Authorization,
              'isLoggedIn' => true,
          ]);

          return true;
      } catch (Exception $ex){
          Log::info('User failed to login : ', ['username' => $user->username]);
          Log::debug($ex);
          return false;
      }
  }

  public function logout(Request $request)
  {
      Auth::logout();

      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect($this->redirectsTo);
  }

}
