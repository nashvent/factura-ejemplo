<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //protected $table = 'clientes';
    protected $fillable = ['ruc','razon_social','direccion','contacto'];
    public $timestamps = false;
}
