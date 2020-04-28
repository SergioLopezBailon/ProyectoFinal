<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoinflipPartida extends Model
{
    protected $fillable = ['idUser1', 'idUser2', 'winner', 'status', 'quantity', 'created_at'];

    public function user(){
        return $this->hasMany('App\User');
    }
}
