@extends('layouts.main')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <!-- Reset Password Text -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold">Reset Your Password</h1>
        <p class="text-gray-600">Enter your new password below to reset it.</p>
    </div>

    <!-- Reset Password Form -->
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <input type="email" name="email" class="w-full border p-2 mb-4" placeholder="Email Address" value="{{ old('email') }}" required>
        <input type="password" name="password" class="w-full border p-2 mb-4" placeholder="New Password" required>
        <input type="password" name="password_confirmation" class="w-full border p-2 mb-4" placeholder="Confirm Password" required>
        <button type="submit" class="bg-blue-500 text-white w-full py-2 rounded">Reset Password</button>
    </form>

    <!-- Back to Login -->
    <div class="mt-4 text-center">
        <span>Remember your password? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Log In</a></span>
    </div>
</div>
@endsection