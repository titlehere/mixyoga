@extends('layouts.main')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <!-- Confirm Password Text -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold">Confirm Your Password</h1>
        <p class="text-gray-600">
            For your security, please confirm your password before continuing.
        </p>
    </div>

    <!-- Confirm Password Form -->
    <form action="{{ route('password.confirm') }}" method="POST">
        @csrf
        <input type="password" name="password" class="w-full border p-2 mb-4" placeholder="Password" required>
        <button type="submit" class="bg-blue-500 text-white w-full py-2 rounded">Confirm Password</button>
    </form>

    <!-- Back to Login -->
    <div class="mt-4 text-center">
        <span>Forgot your password? <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">Reset Password</a></span>
    </div>
</div>
@endsection
