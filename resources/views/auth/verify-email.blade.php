@extends('layouts.main')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <!-- Verify Email Text -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold">Verify Your Email</h1>
        <p class="text-gray-600">
            A verification link has been sent to your email address. Please check your inbox.
        </p>
    </div>

    <!-- Resend Email Verification Link -->
    <form action="{{ route('verification.send') }}" method="POST" class="text-center">
        @csrf
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Resend Verification Email</button>
    </form>

    <!-- Back to Login -->
    <div class="mt-4 text-center">
        <span>Already verified? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Log In</a></span>
    </div>
</div>
@endsection
