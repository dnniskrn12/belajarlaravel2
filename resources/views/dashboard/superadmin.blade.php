@extends('layouts.purple')

@section('content')
<div class="container">
    <h1>Dashboard Superadmin</h1>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>
</div>
@endsection
