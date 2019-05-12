<?php

namespace App\Http\Controllers;

use App\CabeceraFactura;
use App\Cliente;
use App\DetalleFactura;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    public function index()
    {
        return view('facturas');
    }

    public function list()
    {
        //$facturas=CabeceraFactura::get();
        $facturas=DB::table('cabecera_facturas')
            ->leftJoin('clientes', 'cabecera_facturas.cliente', '=', 'clientes.ruc')
            ->get();
        return response()->json(['facturas' => $facturas]);
    }

    public function detalle($detalle=null)
    {
        if($detalle==null){
            $id=0;
        }
        else
            $id=$detalle;
        return view('nfactura')->with('id',$id);
    }

    public function store(Request $request){
        $cliente=$request["clisel"];
        $lproductos=$request['lproductos'];
        $factura=CabeceraFactura::where('cliente',$cliente['ruc'])->orderBy('numero_factura','desc')->first();
        error_log("ENTRONDOO");
        error_log($request["id_factura"]);
        $id_factura=$request["id_factura"];
        if($id_factura==0){
            $factura=CabeceraFactura::create([
                'numero_factura' => $factura->numero_factura+1,
                'cliente' => $cliente['ruc'],
                'fecha'=> Carbon::now()->toDateString(),
            ]);
            error_log($factura);
            foreach ($lproductos as $key=>$lproducto){
                $this->storeDetalle($lproducto,$factura->id,$key+1);
            }
        }
        else{
            DetalleFactura::where('id_factura',$id_factura)->delete();
            error_log("estoy pasandoo");
            foreach ($lproductos as $key=>$lproducto){
                $this->storeDetalle($lproducto,$id_factura,$key+1);
            }

        }


    }

    public function update(Request $request,$id){
        $ncabecera=$request["ncabecera"];
        CabeceraFactura::where("id",$id)->update($ncabecera);
    }

    public function destroy($id){
        CabeceraFactura::where("id",$id)->delete();
    }

    public function storeDetalle($detalle,$id_factura,$item){
        DetalleFactura::create([
            'id_factura' => $id_factura,
            'item'=>$item,
            'producto'=> $detalle['selprod']['codigo_barra'],
            'cantidad'=> $detalle['cantidad'],
        ]);
    }
    public function getDataFactura($id){
        $factura=CabeceraFactura::find($id);
        $cliente=Cliente::where('ruc',$factura->cliente)->first();
        //$detalle=DetalleFactura::where('id_factura',$factura->id)->leftjoin('producto', 'users.id', '=', 'contacts.user_id')->get();
        $detalle=DB::table('detalle_facturas')
            ->leftJoin('productos', 'detalle_facturas.producto', '=', 'productos.codigo_barra')->where('id_factura',$id)
            ->get();
        return response()->json(['cliente' => $cliente,'detalle' => $detalle]);
    }
}
