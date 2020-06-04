@extends('layouts.app',["ocultarBarra" => 'true'])
@section('content')
<div class="container mt-5 text-center">
    <h1>Bienvenido</h1>
    <a href="{{route('login') }}" class="btn btn-outline-light btn-lg">Login</a>
    @if (Route::has('register'))
        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Register</a>
    @endif
</div>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <p>Si continuas navegando por esta página web aceptas nuestras cookies y que eres mayor de edad.</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">x</span>
    </button>
</div>

@endsection
    