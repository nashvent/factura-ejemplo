<?php

use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            'codigo_barra' => '321',
            'nombre' => 'Lapicero',
            'precio_unidad' => 2.3,
            'medida' => 'caja',
            'tipo_medida' => 'gr',
        ]);
        DB::table('productos')->insert([
            'codigo_barra' => '123',
            'nombre' => 'Borrador',
            'precio_unidad' => 1.5,
            'medida' => 'paquete',
            'tipo_medida' => 'kg',
        ]);
        DB::table('productos')->insert([
            'codigo_barra' => '452',
            'nombre' => 'Tijera',
            'precio_unidad' => 4.5,
            'medida' => 'Caja',
            'tipo_medida' => 'kg',
        ]);
        DB::table('productos')->insert([
            'codigo_barra' => '765',
            'nombre' => 'Plumon',
            'precio_unidad' => 1.8,
            'medida' => 'Caja',
            'tipo_medida' => 'g',
        ]);
        DB::table('productos')->insert([
            'codigo_barra' => '724',
            'nombre' => 'Regla',
            'precio_unidad' => 1.1,
            'medida' => 'Caja',
            'tipo_medida' => 'g',
        ]);
    }
}
