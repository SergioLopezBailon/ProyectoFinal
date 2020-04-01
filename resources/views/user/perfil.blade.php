@extends('layouts.app')
@section('content')
    
        @if (admin(session('rol')))
            {{home()}}
        @endif
            
    <div class="container">
        <h3>Hola {{session('rol')}}</h3>
    </div>
@endsection