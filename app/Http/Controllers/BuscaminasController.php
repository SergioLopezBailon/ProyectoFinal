<?php

namespace App\Http\Controllers;

use App\Buscaminas;
use App\BuscaminasPartida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuscaminasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partida=BuscaminasPartida::where('idUser',auth()->user()->id)->orderBy('status','desc')->first();
        return view('buscaminas.index',compact('partida'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    
    public function store(Request $request)
    {
        $buscaminas = new BuscaminasPartida();
        $buscaminas->idUser = Auth()->user()->id;
        $buscaminas->idMode = $request->mode;
        $buscaminas->status = "Jugando";
        $mapa = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];

        if($request->mode == "1"){
            $buscaminas->multiplicator = "0.1";
            //Mapa del buscaminas
            $num = rand(0,24);
            $mapa[$num] = 1;
            $buscaminas->map = json_encode($mapa);

        }elseif ($request->mode == "5") {
            for ($i=0; $i < 5; $i++) { 
                $num = rand(0,24);
                if($mapa[$num] != 1){
                    $mapa[$num] = 1;
                }else{
                    $i--;
                }
            }
            $buscaminas->multiplicator = "0.25";
            $buscaminas->map = json_encode($mapa);
        }elseif ($request->mode == "7") {
            for ($i=0; $i < 7; $i++) { 
                $num = rand(0,24);
                if($mapa[$num] != 1){
                    $mapa[$num] = 1;
                }else{
                    $i--;
                }
            }
            $buscaminas->multiplicator = "0.5";
            $buscaminas->map = json_encode($mapa);
        }else{
            for ($i=0; $i < 24; $i++) { 
                $num = rand(0,24);
                if($mapa[$num] != 1){
                    $mapa[$num] = 1;
                }else{
                    $i--;
                }
            }
            $buscaminas->multiplicator = "15";
            $buscaminas->map = json_encode($mapa);
        }
        $buscaminas->quantity = $request->bet;
        
        
        
        $buscaminas->save();

        Auth()->user()->balance -= $request->bet;
        Auth()->user()->save();
        return redirect()->route('buscaminas.index');
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buscaminas  $buscamina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BuscaminasPartida $buscamina)
    {
        $victoria = $request->victoria;
        $total = $request->contador;
        $buscamina->status = "Finalizado";
        if ($victoria == "true"){

            $buscamina->result = ($buscamina->multiplicator * $buscamina->quantity)*$total;
        }else{
            $buscamina->result = 0;
        }
        $buscamina->save();

        Auth()->user()->balance += $buscamina->result;
        Auth()->user()->save();
        return redirect()->route('buscaminas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buscaminas  $buscamina
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuscaminasPartida $buscamina)
    {
        //
    }
}
