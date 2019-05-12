<?php

use Illuminate\Database\Seeder;

class CabeceraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cabecera_facturas')->insert([
            'numero_factura' => 1,
            'cliente' => '12345678',
            'fecha' => \Carbon\Carbon::now()->toDateString(),
        ]);
        DB::table('cabecera_facturas')->insert([
            'numero_factura' => 1,
            'cliente' => '87654321',
            'fecha' => \Carbon\Carbon::now()->toDateString(),
        ]);
    }
}
