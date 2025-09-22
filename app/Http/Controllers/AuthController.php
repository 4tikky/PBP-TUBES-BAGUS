<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // --- REGISTRATION ---

    /**
     * Menampilkan halaman form registrasi.
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        // Perintah ini akan menampilkan file:
        // resources/views/auth/register.blade.php
        return view('auth.register');
    }

    /**
     * Memproses data dari form registrasi.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // 'confirmed' akan mencocokkan dengan field 'password_confirmation'
        ]);

        // 2. Buat user baru di database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password sebelum disimpan
            'role' => 'user', // Default role untuk semua yang mendaftar
        ]);

        // 3. Login user secara otomatis setelah registrasi
        Auth::login($user);

        // 4. Arahkan ke halaman utama dengan pesan sukses
        return redirect('/')->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    // --- LOGIN ---

    /**
     * Menampilkan halaman form login.
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // Menampilkan file resources/views/auth/login.blade.php
        return view('auth.login');
    }

    /**
     * Memproses data dari form login.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Coba untuk melakukan autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // 3. Redirect ke halaman yang sesuai berdasarkan role
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            return redirect()->intended('/');
        }

        // 4. Jika login gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // --- LOGOUT ---
    
    /**
     * Melakukan logout user.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }
}

