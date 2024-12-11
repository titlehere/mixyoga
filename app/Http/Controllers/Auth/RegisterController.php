<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\OwnerStudio;
use App\Models\StudioYoga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class RegisterController extends Controller
{
    /**
     * Menampilkan formulir registrasi
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // Sesuaikan dengan lokasi file `register.blade.php`
    }

    public function registerMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/', 'unique:member,member_email'],
            'phone' => ['required', 'regex:/^(\+62|62|0)8[1-9][0-9]{6,11}$/'],
            'password' => ['required', 'string', 'min:5', 'max:12'],
            'password_confirmation' => ['required', 'same:password'],
        ], [
            'password.min' => 'Password minimal 5 karakter.',
            'password.max' => 'Password maksimal 12 karakter.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            Member::create([
                'member_uuid' => \Illuminate\Support\Str::uuid(),
                'member_nama' => $request->username,
                'member_email' => $request->email,
                'member_pass' => Hash::make($request->password),
                'member_telp' => $request->phone,
                'member_status' => true,
            ]);

            return redirect()->route('home')->with('success', 'Member berhasil terdaftar!');
        } catch (QueryException $e) {
            return back()->with('error', 'Email sudah terdaftar. Silakan gunakan email lain.')->withInput();
        }
    }

    public function registerOwner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/', 'unique:owner_studio,owner_email'],
            'phone' => ['required', 'regex:/^(\+62|62|0)8[1-9][0-9]{6,11}$/'],
            'password' => ['required', 'string', 'min:5', 'max:12'],
            'password_confirmation' => ['required', 'same:password'],
            'studio_name' => ['required', 'string', 'max:255'],
            'studio_address' => ['required', 'string', 'max:255'],
            'studio_logo' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ], [
            'password.min' => 'Password minimal 5 karakter.',
            'password.max' => 'Password maksimal 12 karakter.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $owner = OwnerStudio::create([
                'owner_uuid' => \Illuminate\Support\Str::uuid(),
                'owner_nama' => $request->username,
                'owner_email' => $request->email,
                'owner_pass' => Hash::make($request->password),
                'owner_telp' => $request->phone,
                'owner_status' => true,
            ]);

            $studioLogoPath = $request->file('studio_logo')->store('studio_logos', 'public');
            StudioYoga::create([
                'studio_uuid' => \Illuminate\Support\Str::uuid(),
                'owner_uuid' => $owner->owner_uuid,
                'studio_nama' => $request->studio_name,
                'studio_lokasi' => $request->studio_address,
                'studio_desk' => null,
                'studio_logo' => $studioLogoPath,
            ]);

            return redirect()->route('home')->with('success', 'Owner dan Studio berhasil terdaftar!');
        } catch (QueryException $e) {
            return back()->with('error', 'Email sudah terdaftar. Silakan gunakan email lain.')->withInput();
        }
    }
}