<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use Illuminate\Http\Request;

//Models
use App\Models\User;

class AuthController extends Controller
{
    public function index(){
        return view('contents.welcome');
    }

    public function signUp(){
        return view('contents.auth.sign-up');
    }

    public function signUpAdmin(){
        return view('contents.auth.sign-up-admin');
    }

    public function login(){
        return view('contents.auth.login');
    }

    public function signUpPost(SignUpRequest $request){
        try {
            User::create([
                'role' => "User",
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            return back()->with('success', 'Registered!');
        } catch (\Throwable $th) {
           return back()->with('error', $th->getMessage());
        }
    }

    public function signUpAdminPost(SignUpRequest $request){
        try {
            User::create([
                'role' => "Admin",
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            return back()->with('success', 'Registered!');
        } catch (\Throwable $th) {
           return back()->with('error', $th->getMessage());
        }
    }

    public function loginPost(LoginRequest $request){

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            if(Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('tasks.index');
        }

        return back()->with('error', 'The credentials do not match our records.');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
