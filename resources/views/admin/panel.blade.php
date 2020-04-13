@extends('layouts.app')
@section('content')
<div class="container">
  <h3 class="text-center"><b>Panel de Administraci&oacute;n</b></h3>
  <table class="table table-dark mt-3">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nombre</th>
        <th scope="col">Email</th>
        <th scope="col">Saldo</th>
        <th scope="col">Método de pago</th>
        <th scope="col">Rol</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <td>{{$user->id}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->balance}}</td>
          <td>{{$user->payment}}</td>
          <td>
            <form action="{{route('admin.update',$user)}}" method="post" onchange="this.submit()">
              @csrf
              @method('PUT')
              <select name="rol" id="rol" class="form-control form-inline">
                @foreach ($roles as $rol)
                  @if ($user->rol == $rol)
                    <option value="{{$rol}}" selected>{{$rol}}</option>    
                  @else
                    <option value="{{$rol}}">{{$rol}}</option>
                  @endif
                @endforeach
              </select>
            </form>
          </td>

          <td>
            <form class="form-inline" action="{{route('admin.delete',$user)}}" method="post">
              @csrf
              @method('DELETE')
              <input type="submit" class="btn btn-danger" value="Borrar">
            </form>
          </td>
        </tr>    
      @endforeach
      
    </tbody>
  </table>
</div>
@endsection