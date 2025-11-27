<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        try {
            $response = Http::acceptJson()->post("http://localhost:8002/api/login", [
                'email'    => $request->email,
                'password' => $request->password
            ]);

            $result = $response->json();

            if ($response->successful() && isset($result['status']) && $result['status'] === true) {
                session(['api_token' => $result['token']]);

                $user = User::where('email', $result['user']['email'])->first();
                if ($user) {
                    Auth::login($user);
                    return redirect()->route('borrows.index');
                }
            }
            toast('Email atau Password anda salah.', 'error');

            return back()->withErrors(['email' => 'Login gagal, email atau password salah.']);
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'API tidak bisa diakses: ' . $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        try {
            $token = session('api_token');

            if ($token) {
                Http::withToken($token)->post("http://localhost:8002/api/logout");
            }

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            session()->forget('api_token');

            return redirect()->route('login')->with('success', 'Logout berhasil');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['logout' => 'Gagal logout: ' . $e->getMessage()]);
        }
    }
}
