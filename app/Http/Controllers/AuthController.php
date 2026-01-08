<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return back()->withErrors(['email' => 'Email atau sandi salah']);
        }

        $user = auth()->guard('api')->user();
        $cookie = cookie('token', $token, 60, null, null, false, true);

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->withCookie($cookie);
        }

        return redirect()->route('home')->withCookie($cookie);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'username' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pelanggan',
        ]);

        $token = JWTAuth::fromUser($user);
        $cookie = cookie('token', $token, 60, null, null, false, true);

        return redirect()->route('home')->withCookie($cookie);
    }

    public function logout()
    {
        auth()->guard('api')->logout();
        return redirect('/')->withoutCookie('token');
    }
}
