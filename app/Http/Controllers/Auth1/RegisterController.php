<?php

namespace App\Http\Controllers\Auth1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    // Menampilkan Form Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses Login dengan Validasi CAPTCHA
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ], [
            'captcha.captcha' => 'CAPTCHA yang dimasukkan salah.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function reloadCaptch()
    {
        return response()->json(['captcha' => captcha_src('flat')]);
    }

    // Menampilkan Halaman Registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses Registrasi dengan Validasi CAPTCHA
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'captcha' => 'required|captcha'
        ], [
            'captcha.captcha' => 'CAPTCHA yang dimasukkan salah.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Simpan User ke Database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Use Hash::make to hash the password
        ]);

        // Auto login setelah registrasi berhasil
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    // Fungsi untuk Reload CAPTCHA
    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_src('flat')]);
    }
}
