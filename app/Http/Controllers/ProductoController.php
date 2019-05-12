<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        return view('productos');
    }

    public function store(Request $request)
    {
        $nproducto=$request["producto"];
        Producto::create([
            'codigo_barra' => $nproducto->codigo_barra,
            'nombre' => $nproducto->nombre,
            'precio_unidad'=>$nproducto->precio_unidad,
            'medida'=>$nproducto->medida,
            'tipo_medida'=>$nproducto->tipo_medida
        ]);
    }


    public function update(Request $request,$codigo_barra)
    {
        $nproducto=$request["nproducto"];
        Producto::where("codigo_barra",$codigo_barra)->update($nproducto);
    }

    public function destroy($codigo_barra)
    {
        Producto::where("codigo_barra",$codigo_barra)->delete();
    }
    public function list()
    {
        $productos=Producto::get();
        return response()->json(['productos' => $productos]);
    }
}
