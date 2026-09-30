<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = User::paginate(9);
        return view("auth.list", compact('user'));
    }


    public function create()
    {
        return view("auth.register");
    }

    public function register(Request $REQUEST)
    {
        $REQUEST->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);


        User::create([
            'name' => $REQUEST->name,
            'email' => $REQUEST->username,
            'password' => bcrypt($REQUEST->password),
            'gender' => $REQUEST->gender,
            'is_admin' => $REQUEST->is_admin,
        ]);

        return redirect()->back();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('auth.verify', compact('user'));
    }

    public function update(Request $request, $id)        
    {
        $user = User::findOrFail($id);
        $user->gender = $request->gender;
        $user->is_admin = $request->is_admin;
        $user->is_active = $request->is_active;
        $user->save();
        return redirect()->back();
    }
}
