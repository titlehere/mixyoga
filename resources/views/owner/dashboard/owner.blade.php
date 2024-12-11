@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Om Swastiastu, {{ $user->owner_nama }}</h1>
    <p>Selamat datang kembali {{ $user->owner_nama }}, semoga sehat selalu.</p>
</div>
@endsection