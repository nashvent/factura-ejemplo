<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return view('clientes');
    }

    public function store(Request $request)
    {
        $ncliente=$request["cliente"];
        Cliente::create([
            'ruc' => $ncliente->ruc,
            'razon_social' => $ncliente->razon_social,
            'direccion'=>$ncliente->direccion,
            'contacto'=>$ncliente->contacto,
        ]);
    }


    public function update(Request $request)
    {
        $acliente=$request["acliente"];
        $ncliente=$request["ncliente"];
        Cliente::where("ruc",$acliente->ruc)->update($ncliente);
    }

    public function destroy($ruc)
    {
        Cliente::where("ruc",$ruc)->delete();
    }

    public function list()
    {
        $clientes=Cliente::get();
        return response()->json(['clientes' => $clientes]);
    }


}
