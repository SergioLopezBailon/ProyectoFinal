@extends('layouts.app',['pageSlug'=>'ruleta'])
@section('content')  
<meta id="csrf" name="csrf-token" content="{{ csrf_token() }}">
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
<script type="text/javascript" src="js/Winwheel.min.js"></script> 

<canvas id='canvas' width="1000" height='500' class="mx-auto">
    Canvas not supported, use another browser.
</canvas>
<div id="statusPartida" class="float-right">
    
</div>

    <input type="number" placeholder="Cantidad" name="bet" id="bet" class="form-control" min="1" required> 
    <div class="row mt-4">
        <div class="col-lg-1 mx-auto">
            <div class="card" style="min-width:150px;">
                <label class="text-center">x2</label>
                <button id="apostarGris" style="background-color:gray; " onclick="apostar(1)">
                    <div class="card-header"></div></button>
                <div id="gray" class="card-body">
                    
                </div>
            </div>
        </div>
        <div class="col-lg-1 mx-auto">
            <div class="card" style="min-width:150px;">
                <label class="text-center">x3</label>
                <button id="apostarRojo" style="background-color: red;" onclick="apostar(2)">
                    <div class="card-header"></div></button>
                <div id="red" class="card-body">

                </div>
            </div>
        </div>
        <div class="col-lg-1 mx-auto">
            <div class="card" style="min-width:150px;">
                <label class="text-center">x5</label>
                <button id="apostarAzul" style="background-color: blue;" onclick="apostar(3)">
                    <div class="card-header"></div>
                </button>
                <div id="blue" class="card-body">

                </div>
            </div>
        </div>
        <div class="col-lg-1 mx-auto">
            <div class="card" style="min-width:150px;">
                <label class="text-center">x50</label>
                <button id="apostarAmarillo" style="background-color: gold;" onclick="apostar(4)">
                    <div class="card-header"></div>
                </button>
                <div id="gold" class="card-body">

                </div>
            </div>
        </div>
    </div>
<script>
    
    let datosRuleta ;
    
    let mensaje = document.getElementById("statusPartida");
    
    let theWheel ;

    let apuestas =[];

    let winner;

    let ruleta;

    let idPartidaGirando ;
        

        theWheel = new Winwheel({
                'lineWidth':0,
                'numSegments':80,
                'innerRadius':240,
                'pointerAngle':180,
                'rotationAngle':178,
                'segments':[
                    {'fillStyle' : '#FFFF00','strokeStyle' : '','name':'gold'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#0000FF','strokeStyle' : '','name':'blue'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#FF0000','strokeStyle' : '','name':'red'},{'fillStyle' : '','strokeStyle' : ''},
                    {'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#FF0000','strokeStyle' : '','name':'red'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#FF0000','strokeStyle' : '','name':'red'},{'fillStyle' : '','strokeStyle' : ''},
                    {'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#0000FF','strokeStyle' : '','name':'blue'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#0000FF','strokeStyle' : '','name':'blue'},{'fillStyle' : '','strokeStyle' : ''},
                    {'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#FF0000','strokeStyle' : '','name':'red'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#FF0000','strokeStyle' : '','name':'red'},{'fillStyle' : '','strokeStyle' : ''},
                    {'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#FF0000','strokeStyle' : '','name':'red'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#0000FF','strokeStyle' : '','name':'blue'},{'fillStyle' : '','strokeStyle' : ''},
                    {'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#0000FF','strokeStyle' : '','name':'blue'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#FF0000','strokeStyle' : '','name':'red'},{'fillStyle' : '','strokeStyle' : ''},
                    {'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#FF0000','strokeStyle' : '','name':'red'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#FF0000','strokeStyle' : '','name':'red'},{'fillStyle' : '','strokeStyle' : ''},
                    {'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#0000FF','strokeStyle' : '','name':'blue'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#0000FF','strokeStyle' : '','name':'blue'},{'fillStyle' : '','strokeStyle' : ''},
                    {'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#FF0000','strokeStyle' : '','name':'red'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#FF0000','strokeStyle' : '','name':'red'},{'fillStyle' : '','strokeStyle' : ''},
                    {'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#FF0000','strokeStyle' : '','name':'red'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#808080','strokeStyle' : '','name':'gray'},{'fillStyle' : '','strokeStyle' : ''},{'fillStyle' : '#0000FF','strokeStyle' : '','name':'blue'},{'fillStyle' : '','strokeStyle' : ''},
                ],
                'animation' :           // Specify the animation to use.
                {
                    'type'     : 'spinToStop',
                    'duration' : 10,    // Duration in seconds.
                    'spins'    : 3,     // Default number of complete spins.
                    'callbackAfter' : drawImage,
                    'callbackFinished' : alertPrize,
                    //'callbackSound'    : playSound,   // Function to call when the tick sound is to be triggered.
                    'soundTrigger'     : 'pin'        // Specify pins are to trigger the sound, the other option is 'segment'.
                },
                'pins' :				// Turn pins on.
                {
                    'visible'    : false,
                    'number'     : 40,
                    'fillStyle'  : 'silver',
                    'outerRadius': 4,
                },
            });

            let wheelSpinning = false;

            function alertPrize(indicatedSegment)
            {
                demo.showNotification('top','center',2,'Ha ganado '+indicatedSegment.name);
                reset();
                drawImage();
                ajaxGet('{{url('/ruleta/balance')}}/'+datosRuleta.id,ganador);
                wheelSpinning = false;
                limpiarApuestas();
            }

            let imagen =new Image();
            
            imagen.onload = function()
            {
                let canvas = document.getElementById('canvas');
                let ctx = canvas.getContext('2d');

                if(ctx){
                    ctx.save();
                    ctx.translate(450,-50);
                    ctx.translate(8,450);
                    ctx.drawImage(imagen,30,30);
                    ctx.restore();
                }
            };
            
            imagen.src= 'http://localhost/proyecto/black/img/triangulo.png';
            function drawImage(){
                
                let ctx1;
                ctx1 = theWheel.ctx;

                ctx1.save();
                ctx1.translate(450,-50);
                ctx1.translate(8,450);
                ctx1.drawImage(imagen,30,30);
                ctx1.restore();
            }

            if(typeof winner != "undefined"){
                startSpin(winner);
                
            }

            function startSpin(winner)
            {

                if (wheelSpinning == false) {

                    theWheel.animation.stopAngle = theWheel.getRandomForSegment((winner*2)+1);
                    theWheel.startAnimation();

                    wheelSpinning = true;
                    
                }
         }

            function reset(){
                theWheel.stopAnimation(false);  
                theWheel.rotationAngle = 178;     
                theWheel.draw();  
            }
    
    
  




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
     
    function recogerDatos(datos) {

        datosRuleta = datos;
        
        if(typeof(datosRuleta) === "object"){
            refrescarInterfaz();
        }
        
    }
    


    ajaxGet("http://localhost/proyecto/ruleta/pregunta",recogerDatos);


    function refrescarInterfaz(){
        switch (datosRuleta.status) {
            case "Jugando":
                mensaje.setAttribute('value',"Jugando");
                mensaje.innerHTML = "Jugando";
                desactivarBotones();
                break;
            case "Finalizado":
                mensaje.setAttribute('value',"Finalizado");
                mensaje.innerHTML = "Finalizado";
                desactivarBotones();
                break;
            case "Apuestas":
                mensaje.setAttribute('value',"Apuestas");
                mensaje.innerHTML = "Apuestas";
                activarBotones();
                break;
        }
        
    }

    function desactivarBotones(){

        document.getElementById('apostarGris').disabled = true;
        document.getElementById('apostarRojo').disabled = true;
        document.getElementById('apostarAzul').disabled = true;
        document.getElementById('apostarAmarillo').disabled = true;

    }


    function activarBotones(){

        document.getElementById('apostarGris').disabled = false;
        document.getElementById('apostarRojo').disabled = false;
        document.getElementById('apostarAzul').disabled = false;
        document.getElementById('apostarAmarillo').disabled = false;
        
    }


    function apostar(num){
        let bet = document.getElementById('bet');
        let color;
        let datos;
        
        switch (num) {
            case 1:
                color = "gray";
                bet = bet.value;
                break;
            case 2:
                color = "red";
                bet = bet.value;
                break;
            case 3:
                color = "blue";
                bet = bet.value;
                break;
            case 4:
                color = "gold";
                bet = bet.value;
                break;
        }
        datos = {
            "bet":bet,
            "color":color,
            "idUser":{{Auth()->user()->id}},
            "idGame":datosRuleta.id,
            "timeBet":datosRuleta.timeBet,
        };

        var data = new FormData();
        data.append('datos', JSON.stringify(datos));
            
        ajaxPost('{{url('ruleta/storeApuestas')}}',data,pintarApuesta);
    }

    function pintarApuesta(datos){        
        if(datos.estado){
            pintarApuestas([datos.apuesta]);
        }else{
            alert(datos.mensaje);
        }
        if(datos.balance != null){
            document.getElementById('balance').innerHTML = datos.balance;
        }
        
        
    }

    function pintarApuestas(datos){        
        for (const key in datos) {
                if(!existeEnArray(datos[key])){                
                    let p = document.createElement('p');
                    document.getElementById(datos[key].color).appendChild(p);
                    p.innerHTML = datos[key].idUser+ " "+ datos[key].quantity;   
                }
        }
        clonar(datos);
    }

    function existeEnArray(dato){
        for(let i = 0; i<apuestas.length;i++){
            if(apuestas[i].id == dato.id){
                return true;
            }
        }
        return false;
    }


    function clonar(datos){
        for (const key in datos) {

            if(!existeEnArray(datos))
                apuestas.push(datos[key]);
        }
        
    }

    function validar(balance){
        let bet = document.getElementById('bet');
        if(bet.value>balance){
            alert("No puedes apostar más dinero del que tienes.");
        }
    }

    setInterval(function(){
        ajaxGet('{{url('/ruleta/todasApuestas')}}/'+datosRuleta.id,pintarApuestas);
        ajaxGet('{{url('/ruleta/pregunta')}}',recogerDatos);    
    },2500);

    jugar = setInterval(function(){
        if((document.getElementById('statusPartida').innerHTML == "Jugando" && wheelSpinning == false) && idPartidaGirando != datosRuleta.id){
            ajaxGet('{{url('/ruleta/ganador')}}/'+datosRuleta.id,startSpin);
            idPartidaGirando = datosRuleta.id;
        }
            
    },1000);
    

    function ganador(balance){
        document.getElementById('balance').innerHTML = balance;
        
    }

    function limpiarApuestas(){
        document.getElementById("gray").innerHTML = "";
        document.getElementById("red").innerHTML = "";
        document.getElementById("blue").innerHTML = "";
        document.getElementById("gold").innerHTML = "";
        document.getElementById('bet').value = "";
    }

</script>

@endsection

    


