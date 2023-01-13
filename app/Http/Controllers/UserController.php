<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function show_login() {
        return view('authorization/login');
    }
    public function make_login(Request $request) {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route("home");
        }

        return back()->withErrors([
            'email' => 'Введены некорректные данные',
        ])->onlyInput('email');
    }
    public function show_register() {
        return view("authorization/register", ['user' => new User()]);
    }
    public function make_register(Request $request) {
        $user = new User($request->validate(User::$validation_rules));
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route("login");
    }
    public function logout() {
        Auth::logout();
        return redirect()->route("login");
    }
    public function show_profile() {
        return view("user/profile", ["user" => Auth::user()]);
    }
}
