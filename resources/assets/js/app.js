var Vue = require('vue');
import axios from 'axios';
import 'bootstrap'
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import { Spanish } from "flatpickr/dist/l10n/es.js";

if(document.getElementById("facturas")){
    new Vue({
        el:'#facturas',
        created:function(){
            this.constructor();
        },
        data:{
            facturas:[],
            buscar:'',
            modal:{
                id:'',
                titulo:'',
                muestra:'',
                hora:'',
                cantidad:'',
                detalle:'',
            },
            config: {
                altFormat: 'D M Y',
                dateFormat: 'd-m-Y',
                locale:Spanish,
            },
        },
        components: {
            flatPickr,
        },
        methods:{
            constructor:function(){
                /*let fechaTemp=new Date();
                var mesActual=("00" + (fechaTemp.getMonth()+1)).slice(-2);
                var diaActual=("00" + (fechaTemp.getDate())).slice(-2);
                this.fecha=diaActual+"-"+mesActual+"-"+fechaTemp.getFullYear();
                */
                this.getFacturas();
            },

            fechaChange:function(){

            },


            getFacturas:function(){
                var url='/factura/list';
                axios.get(url).then(response=>{
                    this.facturas=response.data.facturas;
                });
            },
            eleminarFactura:function(id){
                var url='/factura/eliminar/'+id;
                axios.get(url).then(response=>{
                    this.getFacturas();
                });
            },
            buscarFactura:function () {
                let filtro=this.buscar;
                let facturasTemp=this.facturas;
                return facturasTemp.filter(function (factura) {
                    if(filtro===''){
                        return factura;
                    }
                    else{
                        var res = factura.razon_social.toLowerCase();
                        var res1 = factura.numero_factura.toString().toLowerCase();
                        var filtroLower=filtro.toLowerCase();
                        if(res.includes(filtroLower) || res1.includes(filtroLower) )
                            return factura;
                    }
                });
            }
        }

    });
}

if(document.getElementById("nfactura")){
    new Vue({
        el:'#nfactura',
        created:function(){
            this.constructor();
            console.log("Nueva factura");
        },
        data:{
            facturas:[],
            clientes:[],
            productos:[],
            clisel:{

            },
            idfactura:idfactura,
            modalpro:{
                index:-1,
                selprod:'',
                item:1,
                cantidad:1,
            },
            config: {
                altFormat: 'D M Y',
                dateFormat: 'd-m-Y',
                locale:Spanish,
            },
            lproductos:[],
        },
        components: {
            flatPickr,
        },
        methods:{
            constructor:function(){
                this.getClientes();
                this.getProd();
                console.log("factura",idfactura);
                if(idfactura!=0){
                    this.getData(idfactura);
                }
            },

            getData(id_f){
                var url='/factura/ver/'+id_f;
                axios.get(url).then(response=>{
                    this.clisel=response.data.cliente;
                    for (let entry of response.data.detalle) {
                        let tprod={
                            codigo_barra:entry.codigo_barra,
                            nombre:entry.nombre,
                            precio_unidad:entry.precio_unidad,
                            medida:entry.medida,
                            tipo_medida:entry.tipo_medida
                        };
                        let tmod={selprod:tprod,item:entry.item,cantidad:entry.cantidad,total:entry.cantidad*tprod.precio_unidad};
                        this.lproductos.push(tmod);
                    }
                });
            },

            getFacturas:function(){
                var url='/factura/list';
                axios.get(url).then(response=>{
                    this.facturas=response.data.facturas;
                });
            },
            ncmodal:function () {
                console.log("Hol mundo");
                $('#modalNuevoCliente').modal('show');
            },
            nitem:function () {
                console.log("Item");
                $('#modalNuevoItem').modal('show');
            },

            getClientes:function () {
                var url='/clientes/list';
                axios.get(url).then(response=>{
                    this.clientes=response.data.clientes;
                });
            },
            getProd:function () {
                var url='/productos/list';
                axios.get(url).then(response=>{
                    this.productos=response.data.productos;
                });
            },
            agregarItem:function () {
                console.log("Agregar Item");
                //this.modalpro.item=this.lproductos.length+1;
                this.modalpro.total=this.modalpro.selprod.precio_unidad * this.modalpro.cantidad;

                this.lproductos.push(this.modalpro);
                this.modalpro={selprod:'',item:'',cantidad:1};
                $('#modalNuevoItem').modal('hide');
            },

            getTotalLProductos:function(){
                let total=0;
                for (let entry of this.lproductos) {
                    total+=entry.total;
                }
                return total;
            },
            editarDetalle:function (item) {
                this.modalpro=item;
                $('#modalNuevoItem').modal('show');
            },
            eliminarDetalle:function (index) {
                this.lproductos.splice(index, 1);
            },
            guardarFactura:function () {
                let url="/factura/guardar";
                axios.post(url,{
                    id_factura:idfactura,
                    clisel:this.clisel,
                    lproductos:this.lproductos
                }).then(response=>{
                    window.location.href = "/";
                    console.log("Guardadooo");
                });

            },

        },

    });
}
