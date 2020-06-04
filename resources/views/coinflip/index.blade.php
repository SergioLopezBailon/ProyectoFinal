@extends('layouts.app',["pageSlug"=>"coinflip"])
@section('content')
    <script src="{{ asset('black') }}/js/core/jquery.min.js"></script>
    <meta id="csrf" name="csrf-token" content="{{ csrf_token() }}">
    <div class="container text-center">
        <h1>Coinflip</h1>
        <h6 class="text-left">Crear Partida</h6>
        <div class="form-inline">
            
            <input class="form-control" type="radio" name="lado" value="cara" id="cara" required>
            <label class="form-control">Cara</label>
            <input class="form-control" type="radio" name="lado" value="cruz" id="cruz" required>
            <label class="form-control">Cruz</label>
            <input type="number" name="bet" id="bet" class="form-control ml-3" placeholder="Cantidad" min="0" required>
            <button class="btn btn-primary ml-auto" onclick="crear()">Crear</button>
        </div>
        <div id="partidas" class="row">
            @foreach ($bots as $partida)
                @if ($partida->status == "Espera")
                <div class="card col-lg-4">
                        <div class="card-header">
                            <h2>{{$partida->quantity}}<i class="tim-icons icon-coins"></i></h2>
                            
                        </div>
                        <div class="card-body">
                            <h3 id="{{$partida->id}}">{{$partida->idUser1}}</h3>
                            <input type="hidden" value="{{$partida->id}}" name="idPartida">
                            <button class="btn form-control" onclick="jugar({{$partida->id}},{{$partida->idUser1}})">Jugar</button>
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
        let partidas = [];
     function ajaxGet(url,callback) {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var myArr = JSON.parse(this.responseText);                
                callback(myArr);
            }
        };
        
        xmlhttp.open("GET", url, true);
        xmlhttp.setRequestHeader("X-CSRF-TOKEN", document.getElementById('csrf').getAttribute('content'));
        xmlhttp.send();
    }

    function ajaxPost(url,datos,callback) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var myArr = JSON.parse(this.responseText);
                callback(myArr);
            }
        };
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("X-CSRF-TOKEN", document.getElementById('csrf').getAttribute('content'));
        xmlhttp.send(datos);
    }
        
        
        
        function jugar(idPartida,idUser){
            let bet=document.getElementById('bet');
            if(idUser=={{Auth::user()->id}}){
                alert('No puedes jugar a una partida que tu mismo creaste.');
            }else{
                ajaxGet('{{url('coinflip/entrarpartida')}}/'+idPartida,actualizarPartida);
            }
               
        }


        function pintarPartida(datos){
            
            if(datos.estado){
                pintarPartidas([datos.coinflip]);
            }
            alert(datos.mensaje);
        }

        function pintarPartidas(datos){
            console.log(datos);
            
            for (const key in datos) {
                console.log(datos[key]);
                
                if(!existeEnArray(datos[key])){
                    let div = document.createElement('div');
                    div.classList.add("card");
                    div.classList.add('col-lg-4');
                    document.getElementById('partidas').append(div);
                    let divHeader = document.createElement('div');
                    div.classList.add("card-header");
                    div.appendChild(divHeader);
                    let h2 = document.createElement('h2');
                    h2.innerHTML = datos[key].quantity;
                    divHeader.appendChild(h2);
                    let icon = document.createElement('i');
                    icon.classList.add('tim-icons');
                    icon.classList.add('icon-coins');
                    h2.appendChild(icon);
                    let divBody = document.createElement('div');
                    divBody.classList.add('card-body');
                    div.appendChild(divBody);
                    let h3 = document.createElement('h3');
                    h3.innerHTML = datos[key].idUser1;
                    let input = document.createElement('input');
                    input.setAttribute('type','hidden');
                    input.setAttribute('value',datos[key].id);
                    let button = document.createElement('button');
                    button.classList.add('btn');
                    button.classList.add('form-control');
                    button.addEventListener('click',validacion());
                    button.innerHTML = "Jugar";
                    divBody.appendChild(h3);
                    divBody.appendChild(input);
                    divBody.appendChild(button);
                    
                }
            } 
            clonar(datos);
        }

        
        function existeEnArray(dato){
            for(let i = 0; i<partidas.length;i++){
                if(partidas[i].id == dato.id){
                    return true;
                }
            }
            return false;
        }

        function clonar(datos){
        for (const key in datos) {

            if(!existeEnArray(datos))
                partidas.push(datos[key]);
        }
        
    }

        function crear(){
            let bet=document.getElementById('bet');
            if(bet.value>{{Auth::user()->balance}}){
                alert('No puedes crear una partida con más monedas de las que ya tienes.');
            }else{
                let side = document.getElementById('cara');
                if(side.checked){
                    lado = "Cara";
                }else{
                    lado = "Cruz";
                }
                datos = {
                    "bet":bet.value,
                    "side":lado,
                }
                var data = new FormData();
                data.append('datos',JSON.stringify(datos));
                ajaxPost('{{route('coinflip.store')}}',data,pintarPartida)
            }
        }

        function actualizarPartida(datos){
            
            let h3 = document.getElementById(JSON.stringify(datos.id));
            h3.innerHTML += " VS "+datos.idUser2;
            h3.nextElementSibling.nextElementSibling.remove();
            
            console.log(datos.status);
            
        }
    </script>
@endsection