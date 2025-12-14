<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }
    public function showRegister() { return view('auth.register'); }

    public function register(Request $r)
    {

        $data = $r->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,users_email', 
            'password' => 'required|min:6|confirmed',
        ]);


        $user = User::forceCreate([
            'users_name' => $data['name'],
            'users_email' => $data['email'],
            'users_pass' => Hash::make($data['password']),
            'users_role' => 'user', 
        ]);

        Auth::login($user);
        
        return redirect()->route('home');
    }

    public function login(Request $r)
    {
        $r->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('users_email', $r->email)->first();

        if ($user && Hash::check($r->password, $user->users_pass)) {
            
            Auth::login($user);
            
            $r->session()->regenerate();

            if ($user->users_role === 'admin') {
                return redirect()->route('admin.songs.index');
            }

            return redirect()->route('home');
        }
        return back()->withErrors(['email' => 'Credentials not match']);
    }

    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect()->route('home');
    }
}