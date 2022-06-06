<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $dataUser = User::all();
      return view('dashboard_sa.user', [
        'users' => $dataUser,
        'title' => 'Super Admin',
        'home' => 'home/superadmin',
        'header' => 'Data User SiBakhum UNJ',
      ]);
    }

    // public function user () {
    //   return Datatables::of(User::query())->make(true);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard_sa.create', [
        'title' => 'Create New User'
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $validateData = $request->validate([
        'username' => ['required', 'string', 'min:5', 'max:255', 'unique:users'],
        'role' => ['required'],
        'password' => ['required', 'min:8'],
        'confirm_password' => ['required', 'min:8', 'same:password'],
      ]);

      $validateData['password'] = Hash::make($validateData['password']);
      $validateData['confirm_password'] = Hash::make($validateData['confirm_password']);

      // [$username, $role, $password] = $validateData;

      User::create($validateData);

      if ($request !== null) {
        return back() -> with('success', 'User Created Successfully.');
      } else {
        return back() -> with('error', 'User Failed to Create.');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataUser = User::find($id);
        return view('dashboard_sa.edit', [
            'userId' => $dataUser,
            'title' => 'Edit User'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validateData = $request->validate([
        'username' => ['required', 'string', 'min:5', 'max:255'],
        'email' => ['required', 'email:dns', 'max:255'],
        'role' => ['required'],
        // 'password' => ['required', new MatchOldPassword],
        // 'new_password' => ['required', 'min:8'],
        // 'new_confirm_password' => ['required', 'min:8', 'same:new_password'],
      ]);

      // $validateData['password'] = Hash::make($validateData['password']);
      // $validateData['new_password'] = Hash::make($validateData['new_password']);
      // $validateData['new_confirm_password'] = Hash::make($validateData['new_confirm_password']);

      $user = User::find($id);
      $user->username = $validateData['username'];
      $user->role = $validateData['role'];
      $user->email = $validateData['email'];
      // $user->password = $validateData['new_password'];
      // $user->confirm_password = $validateData['new_confirm_password'];
      // $user->new_confirm_password = $validateData['new_confirm_password'];
      $user->save();

      // $request->session()->flash('success', 'User Updated Successfully.');

      // return redirect('/user');

      // dd('Password change successfully.');

      return back()->with('success', 'User Updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user -> delete();

        // return redirect() -> route('user.index');
        return back()->with('success', 'User Deleted Successfully.');
    }
}
