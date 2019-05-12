<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    protected $fillable = ['id_factura','item','producto','cantidad'];
    public $timestamps = false;
}
