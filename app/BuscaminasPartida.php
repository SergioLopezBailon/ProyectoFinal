<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuscaminasPartida extends Model
{
    protected $fillable = ['idUser', 'idMode', 'multuplicator', 'quantity', 'status' ,'result' ,'map'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
