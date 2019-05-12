@extends('layouts.app')

@section('content')

    <div class="container">
        <br>
        <h1 >Lista de Facturas</h1>

        <!-- Search form -->
        <a type="button" class="btn btn-primary pull-right" href="{{url('/factura/detalle/')}}" >Nueva factura</a>
        <div id="facturas">
            <input class="form-control" type="text" placeholder="Buscarr" aria-label="Buscar" v-model="buscar">

            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Numero</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Fecha</th>
                    <th scope="col"> Opciones</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="(item,index) in buscarFactura()">
                    <th scope="row">@{{index+1}}</th>
                    <td>@{{ item.numero_factura }}</td>
                    <td>@{{ item.razon_social }}</td>
                    <td>@{{ item.fecha }}</td>
                    <td>
                        <a type="button" class="btn btn-secondary" v-bind:href="'/factura/detalle/'+item.id" >Editar</a>
                        <button type="button" class="btn btn-danger" v-on:click="eleminarFactura(item.id)" >Borrar</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>


    </div>

@endsection