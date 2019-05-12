<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_facturas', function (Blueprint $table) {
            $table->integer("id_factura")->unsigned();
            $table->integer("item")->unsigned();
            $table->string("producto");
            $table->integer("cantidad")->unsigned();

            $table->foreign('producto')->references('codigo_barra')->on('productos')->onDelete('cascade');;
            $table->foreign('id_factura')->references('id')->on('cabecera_facturas')->onDelete('cascade');;

            $table->primary(['id_factura', 'item','producto']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_facturas');
    }
}
