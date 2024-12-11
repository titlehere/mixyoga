<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\OwnerStudio;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        $user = auth()->user();

        // Redirect berdasarkan role
        if ($user instanceof Member) {
            return route('member.dashboard');
        } elseif ($user instanceof OwnerStudio) {
            return route('owner.dashboard');
        }

        return route('home');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

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
            return redirect()->route('member.dashboard')
                ->with('success', 'Login berhasil sebagai Member!');
        } elseif ($user instanceof OwnerStudio) {
            return redirect()->route('owner.dashboard')
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

        return redirect('/login')->with('success', 'Anda telah logout.');
    }

    /**
     * Handle failed login attempts.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return back()->withErrors([
            'email' => __('Email atau password salah.'),
        ]);
    }

    /**
     * Validate login credentials.
     */
    protected function credentials(Request $request)
    {
        return [
            'email' => $request->email,
            'password' => $request->password,
        ];
    }
}