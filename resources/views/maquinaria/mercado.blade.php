@extends('layouts.app')

@section('content')
<style type="text/css">
    .value_prices{
        display: none;
    }
    .btn_price_save{
        display: none;
    }
</style>
<div class="container">
    <div class="row">
        <div>
            <div class="col-md-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalPrices" id="btn_price">
                  Modificar
                </button>
                <table class="table table-hover table-striped">
                    <thead>
                        <th></th>
                        <th>Precios en el mercado (S/.)</th>
                    </thead>
                    <tbody id="datos_precios">
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalCaracteristicas">
                  Modificar
                </button>
                <table class="table table-hover table-striped">
                    <thead>
                        <th>Descripción</th>
                        <th>valor(S/.)</th>
                    </thead>
                    <tbody id="datos_caracteristicas">
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalOperador">
                  Modificar
                </button>
                <table class="table table-hover table-striped">
                    <thead>
                        <th class="editar_p">Descripción</th>
                        <th>valor(S/.)</th>
                    </thead>
                    <tbody id="datos_operador">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
         <!-- Modal Precios -->
         <div class="modal fade" id="myModalPrices" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Precios en el mercado</h4>
                    </div>
                    <form id="formPrice">
                        <input type="hidden" name="_token" id="token_price" value="{{csrf_token()}}">
                        <div id="alerta_price"></div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="selectPrices">Precio</label>
                                <select class="form-control" id="selectPrices">
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="priceValue">Valor</label>
                                <input type="text" class="form-control" id="priceValue" placeholder="Ingrese el nuevo valor (S/.)">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="save_price">Guardar Cambios</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>   


        <!-- Modal Caracteristicas-->
         <div class="modal fade" id="myModalCaracteristicas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Características</h4>
                    </div>
                    <form id="formCharacteristic">
                        <input type="hidden" name="_token" id="token_caract" value="{{csrf_token()}}">
                        <div id="alert_caract"></div>
                        <div class="modal-body">
                            <div class="form-group">
                            <label for="selectCaract">Característica</label>
                                <select class="form-control" id="selectCaract">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="caractValue">Valor</label>
                                <input type="text" class="form-control" id="caractValue" placeholder="Ingrese el nuevo valor (S/.)">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="save_characteristic">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 




        <!-- Modal Operador-->
         <div class="modal fade" id="myModalOperador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Costo de HH operador</h4>
                    </div>
                    <form id="formOperator">
                        <input type="hidden" name="_token" id="token_operador" value="{{csrf_token()}}">
                        <div id="alert_operador"></div>
                        <div class="modal-body">
                            <div class="form-group">
                            <label for="selectOperador">Operador</label>
                                <select class="form-control" id="selectOperador">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="operadorValue">Valor</label>
                                <input type="text" class="form-control" id="operadorValue" placeholder="Ingrese el nuevo valor (S/.)">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="save_operador">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>     
    </div>
</div>
@endsection


@section('scripts_mercado')
<script type="text/javascript">
    $(document).ready(function () {
        listar_precios();
        listar_caracteristicas();
        listar_operador();
        $('#save_price').on('click', save_price);
        $('#save_characteristic').on('click', save_characteristic);
        $('#save_operador').on('click', save_operator);

    });



    function listar_precios() {
        var route = "http://localhost/hoapp/public/listar_precios";
        $('#datos_precios').empty();
        $.get(route, function(res){
            //console.log(res);
            $(res).each(function(key,value){
                var html="";
                var htlmSelect="";
                htlmSelect += "<option selected disabled>Seleccione</option>";
                for (var i = 0; i < res.prices.length ;  i++) {
                     //console.log(res.prices[i].price_id);
                     html += '<tr>';
                        html += '<td width="40%" >'+res.prices[i].description+'</td>';
                        html += '<td >'+'<p class="value_display">'+res.prices[i].value+'</p>'+'</td>';
                     html += '</tr>';

                     htlmSelect += '<option value="'+res.prices[i].price_id+'">'+res.prices[i].description+'</option>';
                }
                $('#datos_precios').append(html);
                $('#selectPrices').append(htlmSelect);
            });
        });
    }


    function listar_caracteristicas() {

        var route = "http://localhost/hoapp/public/listar_caracteristicas";
        $('#datos_caracteristicas').empty();
        $.get(route, function(res){
            $(res).each(function(key,value){
                var html="";
                var htlmSelect="";
                htlmSelect += "<option selected disabled>Seleccione</option>";

                for (var i = 0; i < res.caracteristicas.length ;  i++) {
                     html += '<tr>';
                        html += '<td width="40%">'+res.caracteristicas[i].description+'</td>';
                        html += '<td>'+res.caracteristicas[i].value+'</td>';
                     html += '</tr>';

                     htlmSelect += '<option value="'+res.caracteristicas[i].characteristic_id+'">'+res.caracteristicas[i].description+'</option>';
                }
                $('#datos_caracteristicas').append(html);
                $('#selectCaract').append(htlmSelect);
            });
        });
    }

    function listar_operador() {
        var route = "http://localhost/hoapp/public/listar_operador";
        $('#datos_operador').empty();
        $.get(route, function(res){
            $(res).each(function(key,value){
                console.log(res);
                var html="";
                 var htlmSelect="";
                 htlmSelect += "<option selected disabled>Seleccione</option>";
                for (var i = 0; i < res.operador.length ;  i++) {
                     html += '<tr>';
                        html += '<td width="40%">'+res.operador[i].description+'</td>';
                        html += '<td>'+res.operador[i].value+'</td>';
                     html += '</tr>';

                     htlmSelect += '<option value="'+res.operador[i].operator_id+'">'+res.operador[i].description+'</option>';
                }
                $('#datos_operador').append(html);
                 $('#selectOperador').append(htlmSelect);
            });
        });
    }


    $("#selectPrices").change(function(){
        var route = "http://localhost/hoapp/public/price/"+$(this).val()+"";
        $("#alerta_price").empty();
        $.get(route, function(res){
            console.log(res.price[0].value);
            $('#priceValue').val(res.price[0].value);
        });
    });


    $("#selectCaract").change(function(){
        var route = "http://localhost/hoapp/public/characteristic/"+$(this).val()+"";
        $("#alert_caract").empty();
        $.get(route, function(res){
            console.log(res);
            $('#caractValue').val(res.characteristic[0].value);
        });
    });

    $("#selectOperador").change(function(){
        var route = "http://localhost/hoapp/public/operator/"+$(this).val()+"";
        $("#alert_operador").empty();
        $.get(route, function(res){
            console.log(res);
            $('#operadorValue').val(res.operador[0].value);
        });
    });
    


    function save_price (event) {
        if ($('#selectPrices').val() === null) {
          var errorSelect = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul>';
          errorSelect += '<li>Seleccione</li>';
          errorSelect += '</ul></di>';
          $( '#alerta_price' ).html( errorSelect );
          }else{
              var sendDatos =
              {
                'value'        : $('#priceValue').val()
            };

            var token = $('#token_price').val();
            var route = "http://localhost/hoapp/public/price/"+$('#selectPrices').val()+"";
            $("#alerta_price").empty();
            $.ajax({
                type        : 'PUT',
                headers     : {'X-CSRF-TOKEN': token},
                url         : route,
                data        : sendDatos, 
                dataType    : 'json', 
                success:function(result){
                  document.getElementById("formPrice").reset();
                  successHtml = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul><li>' + result.mensaje + '</li></ul></di>';
                  $( '#alerta_price' ).html( successHtml ); 
                  listar_precios();
              },
              error : function(jqXhr) {
                  var errors = jqXhr.responseJSON; 
                  errorsHtml = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul>';
                  $.each( errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                  errorsHtml += '</ul></di>';
                  $( '#alerta_price' ).html( errorsHtml );
              }
          });
        };
    }

    function save_characteristic (event) {
        if ($('#selectCaract').val() === null) {
          var errorSelect = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul>';
          errorSelect += '<li>Seleccione</li>';
          errorSelect += '</ul></di>';
          $( '#alert_caract' ).html( errorSelect );
          }else{
              var sendDatos =
              {
                'value'        : $('#caractValue').val()
            };

            var token = $('#token_caract').val();
            var route = "http://localhost/hoapp/public/characteristic/"+$('#selectCaract').val()+"";
            $("#alert_caract").empty();
            $.ajax({
                type        : 'PUT',
                headers     : {'X-CSRF-TOKEN': token},
                url         : route,
                data        : sendDatos, 
                dataType    : 'json', 
                success:function(result){
                  document.getElementById("formCharacteristic").reset();
                  successHtml = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul><li>' + result.mensaje + '</li></ul></di>';
                  $( '#alert_caract' ).html( successHtml ); 
                  listar_caracteristicas();
              },
              error : function(jqXhr) {
                  var errors = jqXhr.responseJSON; 
                  errorsHtml = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul>';
                  $.each( errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                  errorsHtml += '</ul></di>';
                  $( '#alert_caract' ).html( errorsHtml );
              }
          });
        };
    }


    function save_operator (event) {
        if ($('#selectOperador').val() === null) {
          var errorSelect = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul>';
          errorSelect += '<li>Seleccione</li>';
          errorSelect += '</ul></di>';
          $( '#alert_operador' ).html( errorSelect );
          }else{
              var sendDatos =
              {
                'value'        : $('#operadorValue').val()
            };

            var token = $('#token_operador').val();
            var route = "http://localhost/hoapp/public/operator/"+$('#selectOperador').val()+"";
            $("#alert_operador").empty();
            $.ajax({
                type        : 'PUT',
                headers     : {'X-CSRF-TOKEN': token},
                url         : route,
                data        : sendDatos, 
                dataType    : 'json', 
                success:function(result){
                  document.getElementById("formOperator").reset();
                  successHtml = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul><li>' + result.mensaje + '</li></ul></di>';
                  $( '#alert_operador' ).html( successHtml ); 
                  listar_operador();
              },
              error : function(jqXhr) {
                  var errors = jqXhr.responseJSON; 
                  errorsHtml = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul>';
                  $.each( errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                  errorsHtml += '</ul></di>';
                  $( '#alert_operador' ).html( errorsHtml );
              }
          });
        };
    }

</script>

@endsection