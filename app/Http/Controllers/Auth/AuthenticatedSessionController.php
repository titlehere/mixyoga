<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;
use App\Models\OwnerStudio;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login form.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => ['required', 'email', 'regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/'],
            'password' => ['required', 'string', 'min:5', 'max:12'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 5 karakter.',
            'password.max' => 'Password maksimal 12 karakter.',
        ]);

        // Cek apakah user adalah Member
        $user = Member::where('member_email', $request->email)->first();

        if (!$user) {
            // Jika tidak ditemukan di Member, cek di Owner
            $user = OwnerStudio::where('owner_email', $request->email)->first();

            if (!$user) {
                // Jika user tidak ditemukan
                return back()->withErrors(['email' => 'Email tidak ditemukan.'])
                             ->with('error', 'Login gagal! Email tidak ditemukan.');
            }
        }

        // Validasi password
        $hashedPassword = $user instanceof Member ? $user->member_pass : $user->owner_pass;

        if (!Hash::check($request->password, $hashedPassword)) {
            return back()->withErrors(['password' => 'Password yang dimasukkan salah.'])
                         ->with('error', 'Login gagal! Password salah.');
        }

        // Login pengguna
        Auth::login($user);
        $request->session()->regenerate();

        // Redirect berdasarkan peran
        if ($user instanceof Member) {
            return redirect()->route('/')
                             ->with('success', 'Login berhasil sebagai Member!');
        } elseif ($user instanceof OwnerStudio) {
            return redirect()->route('/')
                             ->with('success', 'Login berhasil sebagai Owner!');
        }

        // Default redirect
        return redirect()->intended('/home')
                         ->with('success', 'Login berhasil!');
    }

    /**
     * Log the user out of the application.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout.');
    }
}