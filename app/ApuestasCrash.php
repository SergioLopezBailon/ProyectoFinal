<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApuestasCrash extends Model
{
    protected $fillable=['idUser','idGame','quantity','withdraw' , 'result'];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
