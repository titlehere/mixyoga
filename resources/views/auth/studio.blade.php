@extends('layouts.main')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <!-- Form Data Studio -->
    <h1 class="text-2xl font-bold mb-4 text-center">Isi Data Studio</h1>
    <form action="{{ route('register.studio.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="studio_name" class="w-full border p-2 mb-4" placeholder="Nama Studio" required>
        <input type="text" name="studio_address" class="w-full border p-2 mb-4" placeholder="Alamat (ex: Jl. ABC No.1, Bulak, Surabaya, Jawa Timur 60124)" required>
        <input type="file" name="studio_logo" class="w-full border p-2 mb-4" accept="image/png, image/jpeg, image/jpg" required>
        <button type="submit" class="bg-blue-500 text-white w-full py-2 rounded">Sign Up</button>
    </form>
    <div class="mt-4 text-center">
        <span>Already registered? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Log In</a></span>
    </div>
</div>
@endsection
