<?php

use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            'ruc' => '87654321',
            'razon_social' => 'Empresa nueva',
            'direccion' => 'av. siempre viva 123',
            'contacto' => 'anibalventura123@gmail.com',
        ]);
        DB::table('clientes')->insert([
            'ruc' => '12345678',
            'razon_social' => 'Empresa 2',
            'direccion' => 'av. union 123',
            'contacto' => 'emepresa2@gmail.com',
        ]);
    }
}
