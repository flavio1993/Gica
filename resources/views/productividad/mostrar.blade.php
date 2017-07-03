@extends('layouts.app')

@section('content')
<style type="text/css">
    .btn_actualizar{
        display: none;
    }
</style>
<div class="container">
    <div class="row">
        @foreach($machine as $m)
        @endforeach
     

    	<h3><strong>Cálculo de la productividad</strong> <small>({{$m->code}}) {{$m->machine}}</small></h3> 
        <div>
            <a href="../maquinaria/listar" class="btn btn-primary pull-right">volver a lista</a>
        </div>       
        
        <div class="col-md-4">
            <button type="button" class="btn btn-default active" data-toggle="modal" data-target="#myModal">
              Parámetros
           </button>

            <h3>Datos</h3>
            
            <table class="table">
                <thead>
                    <th>Parámetro</th>
                    <th>Valor</th>
                    <th>Unidad</th>
                </thead>
                <tbody id="datos_parametros">
                </tbody>
            </table>
        </div>
        <div class="col-md-8">
            <h3>Cálculo de la Productividad Nominal</h3>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <td></td>
                        <td><strong>Cálculo</strong></td>
                        <td width="10%"><strong>Unidades</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Producción por Ciclo</td>
                        <td>{{$produccion_ciclo}}</td>
                        <td>m3/ciclo</td>
                    </tr>
                    <tr>
                        <td>Ciclos por Hora</td>
                        <td>{{$ciclos_hora}}</td>
                        <td>ciclo/hr</td>
                    </tr>
                    <tr>
                        <td>Producción por Hora</td>
                        <td>{{$produccion_hora}}</td>
                        <td>m3/hr</td>
                    </tr>
                    <tr>
                        <td>Material Esponjado</td>
                        <td>{{$material_esponjado}}</td>
                        <td>m3/hr</td>
                    </tr>
                    <tr>
                        <td>Material In Situ</td>
                        <td>{{$material_insitu}}</td>
                        <td>m3/hr</td>
                    </tr>
                    <tr>
                        <td>Tonelaje por Hora</td>
                        <td>{{$tonelaje_hora}}</td>
                        <td>Tm/hr</td>
                    </tr>
                    <tr>
                        <td>Costo por Hora</td>
                        <td>{{$costo_hora}}</td>
                        <td>S/hr</td>
                    </tr>
                    <tr>
                        <td><strong>PRODUCCTIVIDAD</strong></td>
                        <td><strong>{{$productividad}}</strong></td>
                        <td><strong>S/Tm</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel"><strong>Registro de Parámetros</strong></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formProd">
                            <div class="modal-body">
                                <input type="hidden" id="p_code" value="{{$m->code}}">
                                <input type="hidden" id="p_cost" value="{{$cost_id}}">
                                <input type="hidden" id="p_pmachine" >
                                <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                                <div id="alerta"></div>
                                <div class="form-group">
                                    <label for="">Capcidad (m3)</label>
                                    <input type="text" class="form-control" id="p_cc"  >
                                </div>
                                <div class="form-group">
                                    <label for="">Tiempo de ciclo (seg)</label>
                                    <input type="text" class="form-control" id="p_tc" >
                                </div>
                                <div class="form-group">
                                    <label for="">Factor de llenado (%)</label>
                                    <input type="text" class="form-control" id="p_fl"  >
                                </div>
                                <div class="form-group">
                                    <label for="">Eficiencia (%)</label>
                                    <input type="text" class="form-control" id="p_ef"  >
                                </div>
                                <div class="form-group">
                                    <label for="">Densidad In Situ (tm/m3)</label>
                                    <input type="text" class="form-control" id="p_di" >
                                </div>
                                <div class="form-group">
                                    <label for="">Factor de esponjamiento (%)</label>
                                    <input type="text" class="form-control" id="p_fe" >
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" id="param_productividad">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        
        
    </div>
</div>
@endsection

@section('scripts_productividad')
<script type="text/javascript">
    $(document).ready(function () {
        $('#param_productividad').on('click', registrar);
        listar_parametros();
        $('#btn_actualizar').hide();
    });

    function registrar(event) {
        event.preventDefault();
        var type = '';
        var token = $('#token').val();
        var route = "";

        if ($('#p_pmachine').val() ==="0") {
            var sendDatos =
            {
                'cost_id'            : $('#p_cost').val(),
                'machine_id'         : $('#p_code').val(),
                'capacidad'          : $('#p_cc').val(),
                'tiempo_ciclo'       : $('#p_tc').val(),
                'factor_llenado'     : $('#p_fl').val(),
                'eficiencia'         : $('#p_ef').val(),
                'densidad_insitu'    : $('#p_di').val(),
                'factor_esponj'      : $('#p_fe').val(),
            };
            route = "http://localhost/hoapp/public/productividad";
            type = 'POST';
        }else{
            var sendDatos =
            {
                'pmachine_id'        : $('#p_pmachine').val(),
                'cost_id'            : $('#p_cost').val(),
                'machine_id'         : $('#p_code').val(),
                'capacidad'          : $('#p_cc').val(),
                'tiempo_ciclo'       : $('#p_tc').val(),
                'factor_llenado'     : $('#p_fl').val(),
                'eficiencia'         : $('#p_ef').val(),
                'densidad_insitu'    : $('#p_di').val(),
                'factor_esponj'      : $('#p_fe').val(),
            };
            route = "http://localhost/hoapp/public/productividad/"+$('#p_pmachine').val()+"";
            type = 'PUT';
        }

        $.ajax({
            type        : type,
            headers     : {'X-CSRF-TOKEN': token},
            url         : route,
            data        : sendDatos, 
            dataType    : 'json', 
            success:function(result){
                document.getElementById("formProd").reset();
                successHtml = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul><li>' + result.mensaje + '</li></ul></di>';
                $( '#alerta' ).html( successHtml ); 
                listar_parametros();
                $('#myModal').modal('hide');
                location.reload();
            },
            error : function(jqXhr) {
                var errors = jqXhr.responseJSON; 
                errorsHtml = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul>';
                $.each( errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                errorsHtml += '</ul></di>';
                $( '#alerta' ).html( errorsHtml );
            }
        });
    }



    function listar_parametros() {
        //var tablaDatos = $("#datosProductos");
        var datos = $('#p_code').val() + '-' + $('#p_cost').val();
        console.log(datos);
        var route = "http://localhost/hoapp/public/parametros/"+datos;


        $.get(route, function(res){
            //console.log(res);
            $('#datos_parametros').empty();
            var html = "";
            if (res.parametros.length === 0) {
                html+= '<tr>';
                html+= '   <td>Capacidad <small>cuchara</small></td>';
                html+= '    <td>0</td>';
                html+= '    <td>n3</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '    <td>Tiempo de Ciclo</td>';
                html+= '    <td>0</td>';
                html+= '    <td>seg.</td>';
                html+= '</tr>';
                html+= ' <tr>';
                html+= '    <td>Factor de Llenado</td>';
                html+= '    <td>0</td>';
                html+= '    <td>%</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '    <td>Eficiencia</td>';
                html+= '    <td>0</td>';
                html+= '    <td>%</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '    <td>Densidad In Situ</td>';
                html+= '    <td>0</td>';
                html+= '    <td>tm/m3</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '    <td>Factor de Esponjamiento</td>';
                html+= '    <td>0</td>';
                html+= '    <td>%</td>';
                html+= '</tr>';
                 $('#p_pmachine').val(0);
                 $('#p_cc').val(0);
                 $('#p_tc').val(0);
                 $('#p_fl').val(0);
                 $('#p_ef').val(0);
                 $('#p_di').val(0);
                 $('#p_fe').val(0);
            }else{
                 html+= '<tr>';
                 html+= '   <td>Capacidad <small>cuchara</small></td>';
                 html+= '    <td>'+res.parametros[0].capacidad+'</td>';
                 html+= '    <td>n3</td>';
                 html+= '</tr>';
                 html+= '<tr>';
                 html+= '    <td>Tiempo de Ciclo</td>';
                 html+= '    <td>'+res.parametros[0].tiempo_ciclo+'</td>';
                 html+= '    <td>seg.</td>';
                 html+= '</tr>';
                 html+= ' <tr>';
                 html+= '    <td>Factor de Llenado</td>';
                 html+= '    <td>'+res.parametros[0].factor_llenado+'</td>';
                 html+= '    <td>%</td>';
                 html+= '</tr>';
                 html+= '<tr>';
                 html+= '    <td>Eficiencia</td>';
                 html+= '    <td>'+res.parametros[0].eficiencia+'</td>';
                 html+= '    <td>%</td>';
                 html+= '</tr>';
                 html+= '<tr>';
                 html+= '    <td>Densidad In Situ</td>';
                 html+= '    <td>'+res.parametros[0].densidad_insitu+'</td>';
                 html+= '    <td>tm/m3</td>';
                 html+= '</tr>';
                 html+= '<tr>';
                 html+= '    <td>Factor de Esponjamiento</td>';
                 html+= '    <td>'+res.parametros[0].factor_esponj+'</td>';
                 html+= '    <td>%</td>';
                 html+= '</tr>';

                 $('#p_pmachine').val(res.parametros[0].pmachine_id);
                 $('#p_cost').val(res.parametros[0].cost_id);
                 $('#p_code').val(res.parametros[0].machine_id);
                 $('#p_cc').val(res.parametros[0].capacidad);
                 $('#p_tc').val(res.parametros[0].tiempo_ciclo);
                 $('#p_fl').val(res.parametros[0].factor_llenado);
                 $('#p_ef').val(res.parametros[0].eficiencia);
                 $('#p_di').val(res.parametros[0].densidad_insitu);
                 $('#p_fe').val(res.parametros[0].factor_esponj);
            }
            $('#datos_parametros').append(html);
            
        });
    }


    

</script>
@endsection


