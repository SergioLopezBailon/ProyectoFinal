<?php

namespace App\Http\Controllers;

use App\Coinflip;
use App\CoinflipPartida;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoinflipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bots = CoinflipPartida::all();
        return view('coinflip.index',compact('bots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $datos = json_decode($request->datos);
            if(Auth::user()->balance>$datos->bet){
                
                $bet = $datos->bet;
                $side = $datos->side;
                
                $coinflipPartida = new CoinflipPartida();
                $coinflipPartida->idUser1 = Auth::user()->id;
                $coinflipPartida->status = "Espera";
                $coinflipPartida->quantity = $bet;
                $coinflipPartida->user1Side = $side;

                $coinflipPartida->save();

                $estado = true;
                $mensaje = "Partida creada correctamente";
            }else{
                $estado = false;
                $mensaje = "No dispones de suficiente dinero";
            }

            $array = [
                "estado" => $estado,
                "mensaje" =>$mensaje,
                "coinflip"=>$coinflipPartida,
            ];
        }catch(Exception $e){
            $array = $e->getMessage();
        }

        return response()->json($array);
    }

    public function entrar($id){
        try{
            $coinflip = CoinflipPartida::where('id',$id)->first();
            $idUser2 = Auth::user()->id;
            $coinflip->idUser2 = $idUser2;
            $coinflip->status = "Jugando";
            if($coinflip->user1Side == "Cara"){
                $coinflip->user2Side = "Cruz";
            }else{
                $coinflip->user2Side = "Cara";
            }
        $coinflip->save();
        
        }catch(Exception $e){
            $coinflip = $e->getMessage();
        }
        

        return response()->json($coinflip);
    }

    public function jugar(CoinflipPartida $coinflip){

        $ganador = rand(1,100);
        if($ganador <= 50 ){
            $winner = "Cara";
        }else{
            $winner = "Cruz";
        }
        if($winner == $coinflip->user1Side){
            $coinflip->winner = $coinflip->idUser1;
        }else{
            $coinflip->winner = $coinflip->idUser2;
        }
        $coinflip->status="Finalizado";

        $coinflip->save();
        return redirect()->route('coinflip.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coinflip  $coinflip
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoinflipPartida $coinflip)
    {
        //
    }
}
