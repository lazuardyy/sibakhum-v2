<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth;

// use App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Str;
use Auth;

class LoginController extends Controller
{

  use AuthenticatesUsers;

  public function index()
  {
    return view('auth.login', [
      'title' => 'Login'
    ]);
  }

  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'username' => 'required',
      'password' => 'required',
    ]);

    if(Auth::attempt($credentials))
    {
      $request->session()->regenerate();

      if(Auth::user()->role === 'superAdmin')
      {
        return redirect()->intended('home');
      }
      else if (Auth::user()->role === 'admin')
      {
        return redirect()->intended('home');
      }
      else if (Auth::user()->role === 'dosen')
      {
        return redirect()->intended('home/dosen');
      }
      else if (Auth::user()->role === 'faculty')
      {
        // return redirect()->intended('faculty/' . Auth::user()->faculty_id);
        return redirect()->route('faculty.show', Auth::user()->faculty_id);
      }
      else {
        return redirect()->intended('home/mahasiswa');
      }

    }

    return back()->withErrors([
      'username' => 'The provided credentials do not match our records.',
    ])->onlyInput('username');
  }

  // public function redirectTo ()
  // {
  //   if(Auth::user()->role === 'faculty')
  //   {
  //     return $this->redirecTo = url('faculty', Auth::user()->faculty_id);
  //   }
  // }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
