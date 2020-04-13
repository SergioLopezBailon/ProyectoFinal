@extends('layouts.app')
@section('content')
    
        @if (admin(session('rol')))
         @endif
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="text-center"><h2>Perfil</h2></div>
                        <div class="card">
                            <div class="card-header text-center"><h4>{{ucwords(Auth::user()->name)}}</h4></div>
                            <div class="card-body">
                                <p><b>Nombre:</b> {{ucwords(Auth::user()->name)}}</p>
                                <p><b>E-mail:</b> {{Auth::user()->email}}</p>
                                <p><b>Saldo:</b> {{Auth::user()->balance}}</p>
                                <p><b>Rol:</b> {{Auth::user()->rol}}</p>
                                <p><b>Método de pago:</b> {{Auth::user()->payment}}</p>
                                <form action="{{route('user.delete',Auth::user())}}" class="form-inline" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Borrar">
                                    <a href="{{route('user.edit',Auth::user())}}" class="btn btn-warning ml-3">Editar</a>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection