<?php

namespace App\Http\Controllers;

use App\DetalleFactura;
use Illuminate\Http\Request;

class DetalleFacturaController extends Controller
{
    public function buscar($id_factura){
        $detalles=DetalleFactura::where('id_factura',$id_factura)->get();
        return response()->json(['detalles' => $detalles]);
    }

    public function store(Request $request){
        $ndetalle=$request["ndetalle"];
        try{
            DetalleFactura::create([
                'id_factura' => $ndetalle->id_factura,
                'cliente' => $ndetalle->item,
                'producto'=> $ndetalle->producto,
                'cantidad'=> $ndetalle->cantidad,
            ]);
            return 1;
        }catch(\Exception $e){
            return 0;
        }
    }

    public function update(Request $request){
        $adetalle=$request["adetalle"];
        $ndetalle=$request["ndetalle"];
        DetalleFactura::where("id_factura",$adetalle->numero_factura)
            ->where("item",$adetalle->item)
            ->where("producto",$adetalle->producto)->update($ndetalle);
    }

    public function destroy(Request $request){
        $ndetalle=$request["ndetalle"];
        DetalleFactura::where("id_factura",$ndetalle->id_factura)
                        ->where("item",$ndetalle->item)
                        ->where("producto",$ndetalle->producto)->delete();
    }



}
