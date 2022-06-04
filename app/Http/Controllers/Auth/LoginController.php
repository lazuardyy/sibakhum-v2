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
use Illuminate\Support\Facades\Http;
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
        return redirect()->intended('dosen/' . Auth::user()->kodeProdi);
      }
      else if (Auth::user()->role === 'faculty')
      {
        return redirect()->intended('faculty/' . Auth::user()->kodeFakultas);
      }
      else {
        return redirect()->intended('home/mahasiswa');
      }
    }

    return back()->withErrors([
      'username' => 'The provided credentials do not match our records.',
    ])->onlyInput('username');
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
