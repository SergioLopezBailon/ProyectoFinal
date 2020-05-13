<?php

namespace App\Http\Controllers;

use App\Coinflip;
use App\CoinflipPartida;
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
        $bet = $request->bet;
        $side = $request->lado;
        
        $coinflipPartida = new CoinflipPartida();
        $coinflipPartida->idUser1 = Auth::user()->id;
        $coinflipPartida->status = "Espera";
        $coinflipPartida->quantity = $bet;
        $coinflipPartida->user1Side = $side;

        $coinflipPartida->save();

        return redirect()->route('coinflip.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coinflip  $coinflip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CoinflipPartida $coinflip)
    {
        $lado = $request->side;
        $id = Auth::user()->id;
        $coinflip->idUser2 = $id;
        $coinflip->user2Side = $lado;
        $coinflip->status = "Jugando";

        $coinflip->save();
        return redirect()->route('coinflip.index');

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
