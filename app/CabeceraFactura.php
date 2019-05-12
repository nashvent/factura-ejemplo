<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CabeceraFactura extends Model
{
    protected $fillable = ['id','numero_factura','cliente','fecha'];
    public $timestamps = false;
}
