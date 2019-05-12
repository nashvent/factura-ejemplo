<?php

use Illuminate\Database\Seeder;

class DetalleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detalle_facturas')->insert([
            'id_factura' => 1,
            'item' => 1,
            'producto' => '123',
            'cantidad' => 3,
        ]);
        DB::table('detalle_facturas')->insert([
            'id_factura' => 1,
            'item' => 2,
            'producto' => '321',
            'cantidad' => 2,
        ]);
    }
}
