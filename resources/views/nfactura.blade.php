@extends('layouts.app')

@section('content')

    <div class="container" id="nfactura">
        <br>
        <div class="row">
            <div class="col-12">
                <form>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Cliente</label>
                        <div class="col-sm-8">
                            <!--<input type="text" class="form-control" placeholder="Buscador de clientes">-->

                            <select v-if="idfactura==0" class="form-control" v-model="clisel">
                                <option v-for="item in clientes" v-bind:value="item">
                                    @{{ item.razon_social }}
                                </option>
                            </select>
                            <input v-else type="text" class="form-control" v-bind:value="clisel.razon_social" readonly >
                        </div>
                        <button type="button" v-on:click="ncmodal()" class="col-sm-2 btn btn-primary">Nuevo</button>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Ruc</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" v-bind:value="clisel.ruc" readonly >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Razon Social</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" v-bind:value="clisel.razon_social" readonly >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Direccion</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" readonly v-bind:value="clisel.direccion">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12">
                <hr>
                <button type="button" class="col-sm-2 btn btn-success" v-on:click="nitem()">Agregar Item</button>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Nombre</th>
                        <th>Precio U.</th>
                        <th>Cantidad</th>
                        <th>Precio T.</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item,index) in lproductos">
                            <td>@{{ index+1}}</td>
                            <td>@{{ item.selprod.nombre }}</td>
                            <td>@{{ item.selprod.precio_unidad }}</td>
                            <td>@{{ item.cantidad }}</td>
                            <td>@{{ item.total }}</td>
                            <td class="col-2">
                                <button type="button" class="btn btn-secondary" v-on:click="editarDetalle(item)">Editar</button>
                                <button type="button" class="btn btn-danger" v-on:click="eliminarDetalle(index)">Borrar</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">TOTAL</td>
                            <td>@{{ getTotalLProductos() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="modal fade" role="document" id="modalNuevoItem" >
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Producto</label>
                                <select class="form-control" v-model="modalpro.selprod">
                                    <option v-for="item in productos" v-bind:value="item">
                                        @{{ item.nombre }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="form-group col-md-4">
                                <label for="inputCity">Cantidad</label>
                                <input type="number" class="form-control" v-model="modalpro.cantidad" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">Precio Unit</label>
                                <input type="text" readonly class="form-control" v-model="modalpro.selprod.precio_unidad">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">Precio Total</label>
                                <input type="text" readonly class="form-control" v-model="modalpro.selprod.precio_unidad * modalpro.cantidad">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">Medida</label>
                                <input type="text" class="form-control" readonly v-model="modalpro.selprod.medida">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCity">tipo Medida</label>
                                <input type="text" class="form-control" readonly v-model="modalpro.selprod.tipo_medida">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" v-on:click="agregarItem()">Agregar</button>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" v-on:click="guardarFactura()" class="col-sm-12 btn btn-primary">Guardar Factura</button>

    </div>
    <div class="modal fade" role="document" id="modalNuevoCliente" >
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var idfactura={{$id}};
    </script>


@endsection