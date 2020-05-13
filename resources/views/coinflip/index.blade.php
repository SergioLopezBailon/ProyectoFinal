@extends('layouts.app',["pageSlug"=>"coinflip"])
@section('content')
    <div class="container text-center">
        <h1>Coinflip</h1>

        <div>
            <h6 class="text-left">Crear Partida</h6>
            <form action="{{route('coinflip.store')}}" class="form-inline mt-3 mb-3" method="POST" onsubmit="return validacion()">
                @method('POST')
                @csrf
                <input class="form-control" type="radio" name="lado" value="cara" required>
                <label class="form-control">Cara</label>
                <input class="form-control" type="radio" name="lado" value="cruz" required>
                <label class="form-control">Cruz</label>
                <input type="number" name="bet" id="bet" class="form-control ml-3" placeholder="Cantidad" min="0" required>
                
                <input type="submit" class="btn btn-info ml-auto" value="Crear">
            </form> 
        </div>
        <div class="row">
            @foreach ($bots as $partida)
                @if ($partida->status == "Espera")
                    <div class="card col-lg-4">
                        <div class="card-header">
                            <h2>{{$partida->quantity}}<i class="tim-icons icon-coins"></i></h2>
                            
                        </div>
                        <div class="card-body">
                            <h3>{{$partida->idUser1}}</h3>
                            <form action="{{route('coinflip.update',$partida)}}" method="POST" onsubmit="return jugar({{$partida->idUser1}})"> 
                                @csrf
                                @method('PUT')
                                @if ($partida->user1Side == "Cara")
                                    <input type="hidden" name="side" value="Cruz">
                                @else
                                    <input type="hidden" name="side" value="Cara">
                                @endif
                                <input type="submit" class="btn form-control" value="Jugar">
                            </form>
                        </div>
                    </div>
                @elseif($partida->status == "Jugando")
                <div class="card col-lg-4">
                    <div class="card-header">
                        <h2>{{$partida->quantity}}<i class="tim-icons icon-coins"></i></h2>
                    </div>
                    <div class="card-body">
                        <h3>{{$partida->idUser1}} VS {{$partida->idUser2}}</h3>
                        <form action="{{route('coinflip.jugar',$partida)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="submit" value="Calcular" class="btn form-control">
                        </form>
                    </div>
                </div>
                @else
                <div class="card col-lg-4">
                    <div class="card-header">
                        <h2>{{$partida->quantity}}<i class="tim-icons icon-coins"></i></h2>
                    </div>
                    <div class="card-body">
                        <h3>Ganador: {{$partida->winner}}</h3>
                    </div>
                </div>
                @endif        
            @endforeach
        </div>
    </div>
    <script>
        function validacion(){
            let bet=document.getElementById('bet');
            
            if(bet.value>{{Auth::user()->balance}}){
                alert('No puedes crear una partida con más monedas de las que ya tienes.');
                return false;
            }
                return true;
        }

        function jugar(id){
            if(id=={{Auth::user()->id}}){
                alert('No puedes jugar a una partida que tu mismo creaste.');
                return false;
            }
            return true;
        }
    </script>
@endsection