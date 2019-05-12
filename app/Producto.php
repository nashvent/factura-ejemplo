<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['codigo_barra','nombre','precio_unidad','medida','tipo_medida'];
    public $timestamps = false;
}
