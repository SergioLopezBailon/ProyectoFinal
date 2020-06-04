@extends('layouts.app',["pageSlug"=>"buscaminas"])
@section('content')
    <div class="container text-center">
        <h1>Buscaminas</h1>
        @if (isset($partida) && $partida->status == "Jugando")
        <div class="card">
            <div class="card-header">
                <form action="{{route('buscaminas.update',$partida)}}" method="POST" id="form" class="form-inline" onsubmit="return addContador()">
                    @csrf
                    @method('PUT')
                    <label> Cantidad Apostada:<input type="text" value="{{$partida->quantity}}" class="form-control" readonly></label>&nbsp;&nbsp;
                    <label> Multiplicador:<input type="text" value="x{{$partida->multiplicator}}" class="form-control" readonly></label>&nbsp;&nbsp;
                    <label> Modo:<input type="text" value="{{$partida->idMode}} bomba(s)" class="form-control" readonly></label>
                    <input type="hidden" name="victoria" id="victoria">
                    <input type="hidden" name="contador" id="contador">
                    <input type="submit" value="Retirar" class="btn btn-primary ml-auto" id="retirar" disabled>
               </form>
            </div>
            <div class="card-body">
                <div class="ml-auto mr-auto">
                    <div>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="0" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="1" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="2" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="3" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="4" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                    </div>
                    <div>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="5" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="6" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="7" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="8" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="9" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                    </div>
                    <div>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="10" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="11" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="12" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="13" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="14" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                    </div>
                    <div>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="15" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="16" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="17" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="18" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="19" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                    </div>
                    <div>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="20" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="21" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="22" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="23" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="24" onclick="comprobar(this)"><i class="fas fa-question"></i></span>
                    </div>
                </div>
                <br/>
                <p class="text-muted">Nota: en el modo Buscaminas, es necesario hacer click por lo menos 7 veces con 1 bombas, 5 veces con 3 bombas, 3 veces con 5 bombas o una vez con 24 bombas para recibir cantidad apostada.</p>
            </div>
        </div>
        <script>
            window.contador=0;
            let map = {!! json_encode($partida->map) !!};
            let mapa = map.split("");
            
            let mapaArreglado = arreglo(mapa);
            
            añadirBombas(mapaArreglado);

            function arreglo (array){
                for (let index = 0; index < array.length; index++) {
                    if(array[index] == "\[" || array[index] == "\]" || array[index] == ","){
                        array.splice(index,1)
                        
                    }
                }
                return array;
                
            }
            
            function añadirBombas(mapa){
                for (let index = 0; index < mapa.length; index++) {
                    document.getElementById(index.toString()).setAttribute('value',mapa[index]);
                }
            }
            
            function comprobar(e){
                contador++;
                if(e.getAttribute("value")=="1"){
                    alert("Has perdido.");
                    document.getElementById("victoria").setAttribute("value","false");
                    document.getElementById("form").submit();
                    e.firstChild.classList.remove('fas');
                    e.firstChild.classList.remove('fa-question');
                    e.firstChild.classList.add('fa');
                    e.firstChild.classList.add('fa-bomb');
                }else{
                    e.firstChild.classList.remove('fas');
                    e.firstChild.classList.remove('fa-question');
                    e.firstChild.classList.add('fas');
                    e.firstChild.classList.add('fa-coins');
                    e.firstChild.classList.add('textoamarillo');
                }
                comprobarContador();
                e.style.pointerEvents = "none";
                console.log(e);
                
                
            }

            function comprobarContador(){
                let mode = {{$partida->idMode}}; 
                let submit = document.getElementById("retirar");
                
                if(mode == 1){
                    if(contador == 7){
                        submit.disabled = false;
                        document.getElementById("victoria").setAttribute("value","true");
                    }   
                }else if(mode == 5){
                    if(contador == 5){
                        submit.disabled = false;
                        document.getElementById("victoria").setAttribute("value","true");
                    }
                }else if(mode == 7){
                    if(contador == 3){
                        submit.disabled = false;
                        document.getElementById("victoria").setAttribute("value","true");
                    }
                }else if(mode == 24){
                    if(contador == 1){
                        submit.disabled = false;
                        document.getElementById("victoria").setAttribute("value","true");
                    }
                }
            }

            function addContador(){
                document.getElementById("contador").setAttribute("value",contador.toString());
                return true;
            }

        </script>
        @else
    
        <div class="card">
            <div class="card-header">
                <form action="{{route('buscaminas.store')}}" method="POST" class="form-inline" onsubmit="return validar()">
                    @csrf
                    @method('POST')
                    <input type="number" min="1" step="0.01" name="bet" id="bet" placeholder="Cantidad" class="form-control" required> 
                    <div class="ml-auto">
                        <input type="radio" name="mode" value="1" required><label class="form-control">1</label>
                        <input type="radio"  name="mode" value="5" required><label class="form-control">5</label>
                        <input type="radio"  name="mode" value="7" required><label class="form-control">7</label>
                        <input type="radio"  name="mode" value="24" required><label class="form-control">24</label>
                    </div>
                    <input type="submit" value="Jugar" class="btn form-control ml-auto">
                </form>
            </div>
            <div class="card-body">
                <div class="ml-auto mr-auto">
                    <div>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="0"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="1"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="2"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="3"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="4"><i class="fas fa-question"></i></span>
                    </div>
                    <div>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="5"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="6"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="7"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="8"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="9"><i class="fas fa-question"></i></span>
                    </div>
                    <div>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="10"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="11"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="12"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="13"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="14"><i class="fas fa-question"></i></span>
                    </div>
                    <div>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="15"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="16"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="17"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="18"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="19"><i class="fas fa-question"></i></span>
                    </div>
                    <div>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="20"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="21"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="22"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="23"><i class="fas fa-question"></i></span>
                        <span class="border border-white mr-2 mt-2 p-1 bombas"  id="24"><i class="fas fa-question"></i></span>
                    </div>
                </div>
                <br/>
                <p class="text-muted">Nota: en el modo Buscaminas, es necesario hacer click por lo menos 7 veces con 1 bombas, 5 veces con 3 bombas, 3 veces con 5 bombas o una vez con 24 bombas para recibir cantidad apostada.</p>
            </div>
        </div>
        @endif
    </div>
    <script>        
        function validar(){
            let coinsUser = {{auth()->user()->balance}};
            let bet = document.getElementById('bet');
            if(bet.value>coinsUser){
                alert("No puedes apostar más del dinero que tienes.")
                return false;
            }
            return true;
            
        }
    </script>
@endsection