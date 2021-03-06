<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','balance','rol','payment'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //Relaciones
    public function apuestas_crash(){
        return $this->hasMany('App\ApuestasCrash');
    }
    public function apuestas_ruleta(){
        return $this->hasMany('App\ApuestasRuleta');
    }
    public function buscaminas_partidas(){
        return $this->hasMany('App\BuscaminasPartidas');
    }
    public function coinflip_partidas(){
        return $this->hasMany('App\CoinflipPartidas');
    }

}
