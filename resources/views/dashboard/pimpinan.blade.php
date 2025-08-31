@extends('layouts.purple')

@section('content')
<div class="container">
    <h1>Dashboard Pimpinan</h1>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>
</div>
@endsection
