@extends('layouts.app')

@section('content')
<style type="text/css">
    .ocultar{
        display: none;
    }
</style>
<div class="">
    <div class="col-md-10">
        <form method="POST" >
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <h3 align="center"><strong>Registro de la Maquinaria</strong></h3>
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Ups!</strong> Hay problemas!!<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Éxito!</strong> <br><br>
                    <ul>
                        <li><h4>{{ Session::get('success') }}</h4></li>
                    </ul>
                </div>
            @endif
            <div class="panel panel-primary">
              <div class="panel-body">
                  <div class="col-md-6">
                    <label for="c_maquinaria">Maquinaria</label>

                    <select class="form-control" name="c_maquinaria">
                        <option disabled selected>Seleccionar</option>
                        @foreach($maquinarias as $maq)
                            @if( old('c_maquinaria') == $maq->machine_id)
                            <option value="{{$maq->machine_id}}" selected>{{$maq->code}} - {{$maq->machine}} - Pot:{{$maq->potencia}} - Cap:{{$maq->capacidad}}</option>
                            @else
                            <option value="{{$maq->machine_id}}">{{$maq->code}} - {{$maq->machine}} - Pot:{{$maq->potencia}} - Cap:{{$maq->capacidad}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <div>
                        <label > Valor de la maquinaria</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="c_valor_maq" placeholder="Introduzca el valor"  value="{{ old('c_valor_maq') }}" >
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="c_unid_valor_maq">
                            <option value="1">Dólares ($)</option>
                            <option value="2">Soles (S/.)</option>
                        </select>
                    </div>
                </div>
                <label></label>
                <div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="c_ve_anios">
                                    Vida económica (años)
                            </label>
                            <input type="text" class="form-control" name="c_ve_anios" placeholder="Introduzca vida económica anual" value="{{ old('c_ve_anios') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="c_ve_horas">Vida económica anual (horas)</label>
                            <input type="text" class="form-control" name="c_ve_horas" placeholder="Introduzca vida económica horas/año" value="{{ old('c_ve_horas') }}" >
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="c_mr">% MR</label>
                            <input type="text" class="form-control" name="c_mr" placeholder="MR" value="{{ old('c_mr') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="c_comb">Combustible (gl/hr)</label>
                            <input type="text" class="form-control" name="c_comb"  placeholder="Rend. combustible" value="{{ old('c_comb') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="c_tipo_comb"></label>
                            <select class="form-control" name="c_tipo_comb">
                                <option selected disabled>Tipo de Combustible</option>
                                <option >Petroleo</option>
                                <option >Gasolina</option>
                                <option >Gas</option>
                            </select>
                        </div>
                    </div>
                </div>

                <label></label>
                <div class="com_lub_gras">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="c_ace_m">Aceite (Motor) gl/hr</label>
                            <input type="text" class="form-control" name="c_ace_m" placeholder="Aceite motor"  value="{{ old('c_ace_m') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="c_ace_h">Aceite (hidraúlico) gl/hr</label>
                            <input type="text" class="form-control" name="c_ace_h" placeholder="Aceite hidráulico" value="{{ old('c_ace_h') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="c_ace_t">Aceite (Transmisión) gl/hr</label>
                            <input type="text" class="form-control" name="c_ace_t" placeholder="Aceite transmisión" value="{{ old('c_ace_t') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="c_grasa">Grasa lib/hr</label>
                            <input type="text" class="form-control" name="c_grasa" placeholder="Grasa" value="{{ old('c_grasa') }}">
                        </div>
                    </div>
                </div>
                <label></label>
                <div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="c_vu_neum">Neumáticos</label>
                            <input type="text" class="form-control" name="c_vu_neum" placeholder="Vida útil (horas)" value="{{ old('c_vu_neum') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="c_precio_neum"> <label></label></label>
                                <input type="text" class="form-control" name="c_precio_neum" placeholder="Precio" value="{{ old('c_precio_neum') }}">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="c_unid_precio_neum"> <label></label></label>
                            <select class="form-control" name="c_unid_precio_neum">
                                <option value="1">Dólares ($)</option>
                                <option value="2">Soles (S/.)</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="c_coef_rescate">Valor de Rescate (%)</label>
                            <input type="text" class="form-control" name="c_coef_rescate" placeholder="Introduzca el % de rescate" value="{{ old('c_coef_rescate') }}">                    
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="c_condiciones">Condicion</label>
                            <select class="form-control" name="c_condiciones">
                                <option disabled selected>Seleccionar</option>
                                <option value="1">Bajo</option>
                                <option value="2">Media</option>
                                <option value="3">Alta</option>
                            </select>                
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                  <label></label><br>
                 <button type="submit" class="btn btn-danger btn-md pull-right">Registrar</button>
                </div>
              </div>
            </div>
      </form>
    </div>

    <div class="col-md-2">      
        
        <h3>Consultar</h3>
        <div class="panel panel-primary">
            <div class="panel-body">
                <div>
                    <a class="btn btn-primary" target="_blank" href="{{asset('doc/ve.pdf')}}">Tablas Vidas Económicas</a>
                </div>
                <br>
                <div>
                    <a class="btn btn-primary" target="_blank" href="{{asset('doc/mr.pdf')}}">Tablas Mantenimiento y Reparación (%)</a>
                </div>
                <br>
                <div>
                    <a class="btn btn-primary" target="_blank" href="{{asset('doc/combustible.pdf')}}">Tablas Combustibles</a>
                </div>
                <br>
                <div>
                    <a class="btn btn-primary" target="_blank" href="{{asset('doc/neumaticos.pdf')}}">Tablas Neumáticos</a>
                </div>
            </div>
        </div>

    </div>
    
</div>
@endsection


@section('scripts_mac_register')
<script type="text/javascript">
    
    $(document).ready(function(){
      $('.venobox').venobox(); 
    });

    $('.venobox').venobox({
        framewidth: '1000px',        // default: ''
        frameheight: '700px',       // default: ''
        border: '1px',             // default: '0'
        bgcolor: '#5dff5e',         // default: '#fff'
        titleattr: 'data-title',    // default: 'title'
        numeratio: true,            // default: false
        infinigall: true            // default: false
    });

   
    

</script>
@endsection