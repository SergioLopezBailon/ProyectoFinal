<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApuestasRuleta extends Model
{
    protected $fillable = ['idUser','idGame','quantity','result','color'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
