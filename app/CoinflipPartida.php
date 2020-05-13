<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoinflipPartida extends Model
{
    protected $fillable = ['idUser1', 'idUser2', 'winner', 'status', 'quantity', 'created_at'];

    public function users(){
        return $this->belongsToMany('App\User')->withPivot('name');
    }
}
