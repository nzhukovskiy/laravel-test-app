<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function showLogin() {
        return view('authorization/login');
    }
    public function makeLogin(Request $request) {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route("home");
        }

        return back()->withErrors([
            'name' => 'Введены некорректные данные',
        ])->onlyInput('name');
    }
    public function showRegister() {
        return view("authorization/register", ['user' => new User()]);
    }
    public function makeRegister(Request $request) {
        $user = new User($request->validate(User::$validation_rules));
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route("login");
    }
    public function logout() {
        Auth::logout();
        return redirect()->route("login");
    }
    public function showProfile() {
        return view("user/profile", ["user" => Auth::user()]);
    }
}
