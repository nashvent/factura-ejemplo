<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCabeceraFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabecera_facturas', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("numero_factura")->unsigned();
            $table->string("cliente");
            $table->date("fecha");
            //$table->primary(["numero_factura","cliente"]);
            $table->unique(['numero_factura', 'cliente']);

            $table->foreign('cliente')->references('ruc')->on('clientes')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cabecera_facturas');
    }
}
