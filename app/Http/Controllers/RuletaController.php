<?php

namespace App\Http\Controllers;

use App\ApuestasRuleta;
use App\RuletaPartida;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RuletaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ruleta = RuletaPartida::latest()->first();
        return view('ruleta.index',compact('ruleta'));
    }


    public function storeRuleta(){
        $ruleta = new RuletaPartida();
        $ruleta->status = "Apuestas";
        $ruleta->timeRuleta = time();
        $ruleta->timeBets = time() + 10;
        $ruleta->timeEnd = time() + 25;
        $premios = $this->generarColores();
        $ruleta->winner = rand(0,count($premios));


        $ruleta->save();
        return $ruleta;
    }

    public function generarColores(){
        $premios = ['gold'];
        for ($i=0; $i < 4; $i++) { 
            $a = ['blue','gray','red','gray','red','gray','red','gray','blue','gray'];
            $premios = array_merge($premios,$a);
        }
        array_pop($premios);
        return $premios;
    }
    /**
     * Devuelve los valores de la ruleta activa y si no existe la crea.
     *
     * @return array valores de la ruleta activa.
     */
    public function preguntaStatus(){
        $ruleta = RuletaPartida::latest()->first();
        if(!isset($ruleta)){
            
            $ruleta = $this->storeRuleta();
        }
        $ruleta = $this->actualizarStatus($ruleta);
        if($ruleta->status == "Finalizado"){
            $ruleta = $this->storeRuleta();
        }
        $array = $this->datosParaUsuario($ruleta);
            
        return response()->json($array);
        
    }

    public function datosParaUsuario(RuletaPartida $ruleta){


            $array = [
                "id" => $ruleta->id,
                "status"=>$ruleta->status,
                "timeRuleta"=>$ruleta->timeRuleta,
                "timeBet"=>$ruleta->timeBets,
                "timeEnd"=>$ruleta->timeEnd,
            ];
            return $array;
    }


    public function actualizarStatus(RuletaPartida $ruleta){

        if(time()>$ruleta->timeBets){
            $ruleta->status = "Jugando";
        }
        if(time()>$ruleta->timeEnd){
            $ruleta->status = "Finalizado";
        }
        $ruleta->save();
        return $ruleta;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ruleta  $ruleta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RuletaPartida $ruletum)
    {
        if($request->status == "apuesta"){
            $ruletum->status = "Jugando";
        }
        
        $ruletum->save();
        return redirect()->route('ruleta.index');
    }

    public function jugar(RuletaPartida $ruletum)
    {
        $ruletum->status = "Finalizado";
        $ruletum->save();
        return redirect()->route('ruleta.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ruleta  $ruleta
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApuestasRuleta $ruleta)
    {
        //
    }

    public function storeApuestas(Request $request){
        $datos = json_decode($request->datos);
        $balance = null;
        try{
            if(time()<$datos->timeBet){
                if(Auth::user()->balance >= $datos->bet){
                    $apuesta = new ApuestasRuleta();
                    $apuesta->idUser = $datos->idUser;
                    $apuesta->idGame = $datos->idGame;
                    $apuesta->quantity = $datos->bet;
                    $apuesta->color = $datos->color;
                    $apuesta->save();
                    Auth::user()->balance -= $datos->bet;
                    $balance = Auth::user()->balance;
                    Auth::user()->save();
                    $estado = true;
                    $mensaje = "Apuesta aceptada.";
                }else{
                    $mensaje = "Tu saldo es menor que la apuesta.";
                    $estado = false;
                }
            }else{
                $estado = false;
                $mensaje = "Apuestas cerradas, no ha sido posible.";
            }
            
            $respuesta = [
                "apuesta" => $apuesta,
                "estado" => $estado,
                "mensaje" => $mensaje,
                "balance" => $balance,
            ];
    
        }catch(Exception $e){
            $respuesta = $e->getMessage();
        }
        

        return response()->json($respuesta);
    }


    public function devolverApuestas($id){
        try{
            $todasApuestas = ApuestasRuleta::where('idGame',$id)->get();
            $array = [];
            foreach ($todasApuestas as $key ) {
                $array[] = $key;
            }
        }catch(Exception $e){
            $array = $e->getMessage();
        }
        return response()->json($array);
    }

    public function ganador($id){
        try{
            $ruleta = RuletaPartida::where('id',$id)->first();
            $ganador = $ruleta->winner;
        }catch(Exception $e){
            $ganador = $e->getMessage();
        }
        
        return response()->json($ganador);
    }

    public function actualizarBalance($id){
        try{
            $apuestas = ApuestasRuleta::where('idGame',$id)->where('idUser',Auth::user()->id)->get();
            $premios = $this->generarColores();
            $ganador = RuletaPartida::where('id',$id)->first()->winner;
            foreach ($apuestas as $key) {
                if($key->color == $premios[$ganador]){
                    switch ($premios[$ganador]) {
                        case 'gray':
                            Auth::user()->balance += $key->quantity*2;
                            Auth::user()->save();
                            break;
                        case 'red':
                            Auth::user()->balance += $key->quantity*3;
                            Auth::user()->save();
                            break;
                        case 'blue':
                            Auth::user()->balance += $key->quantity*5;
                            Auth::user()->save();
                            break; 
                        case 'gold':
                            Auth::user()->balance += $key->quantity*50;
                            Auth::user()->save();
                            break;           
                    }
                }
            }
        $balance = Auth::user()->balance;
        }catch(Exception $e){
            //$balance = $e->getMessage();
        }
        
        return response()->json($balance);
    }
}
