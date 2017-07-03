@extends('layouts.app')

@section('content')
<style type="text/css">
    .contenido{
        padding-left: 30px;
        padding-right: 30px;
    }
</style>
<div class="contenido">
    <div class="row">
        <form id="formMachine">
            <h3 align="center">Datos Generales de la Maquinaría</h3>
            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
            <input type="hidden" name="" id="machine_id" value="">
            <div id="alerta"></div>
            <div class="col-md-1">
                <div class="form-group" >
                    <label for="m_code">Codigo</label>
                    <input type="text" class="form-control" id="m_code" placeholder="Codigo">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="m_descripcion">Maquinaria</label>
                    <input type="text" class="form-control" id="m_descripcion" placeholder="Descripcion">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label for="m_potencia">Potencia</label>
                    <input type="text" class="form-control" id="m_potencia" placeholder="Potencia">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label for="m_capacidad">Capacidad</label>
                    <input type="text" class="form-control" id="m_capacidad" placeholder="Capacidad">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label for="m_peso">Peso (Kg)</label>
                    <input type="text" class="form-control" id="m_peso" placeholder="Peso">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="m_tipo">Tipo</label>
                    <select class="form-control" id="m_tipo">
                        <option selected disabled>Seleccionar</option>
                        <option value="1">Pesado</option>
                        <option value="2">Liviano</option>
                    </select>
                </div>
            </div>

            
            <div class="col-md-1">
                  <label></label><br>
                 <button type="submit" class="btn btn-warning" id="Registrar_datos_generales">Registrar</button>
            </div>
           
      </form>
    </div>
    <br>
    <div class="row">
        <table class="table">
            <thead>
                <th>#</th>
                <th>Codigo</th>
                <th>Descripcion de la maquinaria</th>
                <th>Potencia</th>
                <th>Capacidad</th>
                <th>Peso (Kg)</th>
                <th>Tipo</th>
                <th>Opciones</th>
            </thead>
          
            <tbody id="datos_machines"></tbody>
        </table>
    </div>
</div>
@endsection


@section('scripts_machine')
<script type="text/javascript">
    
    $(document).ready(function () {
        $('#Registrar_datos_generales').on('click', registerMachine);
        listar_machines();
    });

    function registerMachine (event) {
        event.preventDefault();
        var type = '';
        var token = $('#token').val();
        var route = "";
        $("#alerta").empty();

        if ($('#machine_id').val() ==="") {
            var sendDatos =
            {
                'code'          : $('#m_code').val(),
                'machine'       : $('#m_descripcion').val(),
                'potencia'      : $('#m_potencia').val(),
                'capacidad'     : $('#m_capacidad').val(),
                'peso'          : $('#m_peso').val(),
                'type_id'       : $('#m_tipo').val(),
                'image'       : $('#m_image').val(),
            };
            route = "http://localhost/hoapp/public/datos";
            type = 'POST';
        }else{
            var sendDatos =
            {
                'machine_id'    : $('#machine_id').val(),
                'code'          : $('#m_code').val(),
                'machine'       : $('#m_descripcion').val(),
                'potencia'      : $('#m_potencia').val(),
                'capacidad'     : $('#m_capacidad').val(),
                'peso'          : $('#m_peso').val(),
                'type_id'       : $('#m_tipo').val(),
            };

            route = "http://localhost/hoapp/public/datos/"+$('#machine_id').val()+"";
            type = 'PUT';
        }
        
        $.ajax({
            type        : type,
            headers     : {'X-CSRF-TOKEN': token},
            url         : route,
            data        : sendDatos, 
            dataType    : 'json', 
            success:function(result){
                document.getElementById("formMachine").reset();
                successHtml = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul><li>' + result.mensaje + '</li></ul></di>';
                $( '#alerta' ).html( successHtml ); 
                listar_machines();
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

    function editar_machine($id,$code,$description,$potencia,$capacidad,$peso,$tipo) {
        $('#machine_id').val($id);
        $('#m_code').val($code);
        $('#m_descripcion').val($description);
        $('#m_potencia').val($potencia);
        $('#m_capacidad').val($capacidad);
        $('#m_peso').val($peso);
        $('#m_tipo').val($tipo);

        $('#Registrar_datos_generales').text("Editar");
    }


    function listar_machines() {

        var route = "http://localhost/hoapp/public/datos_api";
        $('#datos_machines').empty();
        $.get(route, function(res){
            $(res).each(function(key,value){
                var html="";
                for (var i = 0; i < res.maquinarias.length ;  i++) {
                     html += '<tr>';
                        html += '<td>'+res.maquinarias[i].machine_id+'</td>';
                        html += '<td>'+res.maquinarias[i].code+'</td>';
                        html += '<td>'+res.maquinarias[i].machine+'</td>';
                        html += '<td>'+res.maquinarias[i].potencia+'</td>';
                        html += '<td>'+res.maquinarias[i].capacidad+'</td>';
                        html += '<td>'+res.maquinarias[i].peso+'</td>';
                        html += '<td>'+res.maquinarias[i].description+'</td>';
                        html += '<td> <button class="btn btn-info" onclick="editar_machine('+res.maquinarias[i].machine_id+','+"'"+res.maquinarias[i].code+"'"+','+"'"+res.maquinarias[i].machine+"'"+','+"'"+res.maquinarias[i].potencia+"'"+','+"'"+res.maquinarias[i].capacidad+"'"+','+"'"+res.maquinarias[i].peso+"'"+','+"'"+res.maquinarias[i].type_id+"'"+');">Editar</button> </td>';
                     html += '</tr>';

                }
                $('#datos_machines').append(html);
            });
        });
    }

</script>
@endsection