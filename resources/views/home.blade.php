@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Session::has('mensaje'))
                <p class="alert alert-info">{{Session('mensaje')}}</p>
            @endif
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                        <p/>
                    <a href={{route('user.perfil')}} class="btn btn-info" title="Perfil">Perfil</a>
                    <a href={{route('admin.panel')}} class="btn btn-info" title="Panel de Admin">Panel de Admin</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection