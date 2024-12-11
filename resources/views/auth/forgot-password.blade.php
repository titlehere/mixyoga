@extends('layouts.main')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <!-- Forgot Password Text -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold">Reset Password</h1>
        <p class="text-gray-600">Enter your email address and we'll send you a link to reset your password.</p>
    </div>

    <!-- Forgot Password Form -->
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <input type="email" name="email" class="w-full border p-2 mb-4" placeholder="Email Address" required>
        <button type="submit" class="bg-blue-500 text-white w-full py-2 rounded">Send Reset Link</button>
    </form>

    <!-- Back to Login -->
    <div class="mt-4 text-center">
        <span>Remember your password? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Log In</a></span>
    </div>
</div>
@endsection