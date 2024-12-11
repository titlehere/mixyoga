@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Om Swastiastu, {{ $user->member_nama }}</h1>
    <p>Selamat datang kembali {{ $user->member_nama }}, semoga sehat selalu.</p>
</div>
@endsection