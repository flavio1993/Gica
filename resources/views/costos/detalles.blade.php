@extends('layouts.app')

@section('content')
<style type="text/css">
	.detalle{
		padding-left: 10px;
		padding-right: 20px;
	}
    .info_td{
        background: #FFAB26;
    }
	
</style>
<div class="container">
    <div class="row detalle">
    	<div >	

    		@foreach($cost as $co)
    			<a href="../calculo/{{$co->cost_id}}" class="btn btn-warning pull-right">Calcular Costo Horario</a>
    		@endforeach
            <div>
                <a href="../maquinaria/listar" class="btn btn-primary pull-right">volver a lista</a>
            </div>
            

    		<h2><strong>Detalles </strong></h2>
    		<table class="table">
    			<tbody>
    				<tr>
    					<td colspan="6" align="center"><strong>Datos Generales</strong></td>
    				</tr>
    				<tr>
    					<td colspan="3" class="info_td">Código :</td>
    					<td colspan="3">
    						{{$co->code}}
    					</td>
    				</tr>
    				<tr >
    					<td colspan="3" class="info_td">Descripción de la maquinaría :</td>
    					<td colspan="3">
    						{{$co->machine}}
    					</td>
    				</tr>
    				<tr>
    					<td class="info_td">Capacidad :</td>
    					<td>
    						{{$co->capacidad}}
    					</td>
    					<td class="info_td">Potencia :</td>
    					<td>
    						{{$co->potencia}}
    					</td>
    					<td class="info_td">Peso (Kg) :</td>
    					<td>
    						{{$co->peso}}
    					</td>
    				</tr>
    				<tr>
    					<td colspan="6"  align="center"><strong>Vida Económica</strong></td>
    				</tr>
    				<tr>
    					<td colspan="1" class="info_td">Vida económica (años) :</td>
    					<td colspan="2">
    						{{$co->vida_anios}}
    						
    					</td>
    					<td colspan="1" class="info_td">Vida económica (hora/año) :</td>
    					<td colspan="2">
    						{{$co->vida_horas}}
    				
    					</td>
    				</tr>
    				<tr>
    					<td colspan="6"  align="center"><strong>Mantenimiento y Reparaciones</strong></td>
    				</tr>
    				<tr>
    					<td colspan="3" class="info_td">MR % :</td>
    					<td colspan="3">
    						{{$co->mr}}
    					</td>   
    				</tr> 
    				<tr>
    					<td colspan="6"  align="center"><strong>Combustible</strong></td>
    				</tr>
    				<tr>
    					<td colspan="1" class="info_td">Tipo de combustible :</td>
    					<td colspan="2">
    						{{$co->tipo_combustible}}
    					</td>
    					<td colspan="1" class="info_td">Rendimiento (gl/hr) :</td>
    					<td colspan="2">
    						{{$co->comb_value}}
    					</td>
    				</tr>
    				<tr>
    					<td colspan="6"  align="center"><strong>Lubricantes</strong></td>
    				</tr>	
    				<tr>
    					<td class="info_td">Aceite (Motor) gl/hr :</td>
    					<td>
    						{{$co->aceitem}}
    					</td>
    					<td class="info_td">Aceite (Hidraúlico) gl/hr :</td>
    					<td>
    						{{$co->aceiteh}}
    					</td>
    					<td class="info_td">Aceite (Transmisición) gl/hr :</td>
    					<td>
    						{{$co->aceitet}}
    					</td>
    				</tr>
    				<tr>
    					<td colspan="6"  align="center"><strong>Grasas</strong></td>
    				</tr>
    				<tr>
    					<td colspan="3" class="info_td">Grasa lib/hr :</td>
    					<td colspan="3">
    						{{$co->grasa}}
    					</td>  
    				</tr>
    				<tr>
    					<td colspan="6" align="center"><strong>Neumáticos</strong></td>
    				</tr>	
    				<tr>
    					<td colspan="1" class="info_td">Vida útil (horas) :</td>
    					<td colspan="2">
    						{{$co->vida_util}}
    					</td>
    					<td colspan="1" class="info_td">Precio (S/.) :</td>
    					<td colspan="2">
                            @if($co->unidad_neum == 2)
    						  {{$co->precio}}
                            @else
                              {{$co->precio*$tipo}}
                            @endif
    					</td>
    				</tr>	
    				<tr>
    					<td colspan="6"  align="center"><strong>Condiciones Económicas</strong></td>
    				</tr>
    				<tr>
    					<td class="info_td">Valor maquinaria ($) :</td>
    					<td>
    						@if($co->costs_unidades == 1)
    							{{$co->value_machine}}
    						@else
    							{{$co->value_machine/$tipo}}
    						@endif
    					</td>
    					<td class="info_td">Valor maquinaria (S/.) :</td>
    					<td>
    						@if($co->costs_unidades == 1)
    							{{$co->value_machine*$tipo}}
    						@else
    							{{$co->value_machine}}
    						@endif
    					</td>
    					<td class="info_td">Coeficiente de rescate (%) :</td>
    					<td class="editar">
    						<p>{{$co->coef_rescate}}</p>
    					</td>
    				</tr>
    				<tr>
    					<td colspan="1" class="info_td">Tipo de maquinaría :</td>
    					<td colspan="2" class="editar">
    						<p>{{$co->description}}</p>
    					</td>
    					<td colspan="1" class="info_td">Costo HH de operador (hr) :</td>
    					<td colspan="2" class="editar">
    						<p>{{$co->value}}</p>
    					</td>
    				</tr>
                    <tr align="center">
                        <td colspan="6">
                            <br>
                            <img src="{{asset($co->image)}}" width="600px" height="400px"> 
                        </td>
                    </tr>
    			</tbody>
    		</table>
    	</div>
    	
    </div>
    
</div>
@endsection

@section('scripts_detalle')
<script type="text/javascript">
    
    $(document).ready(function () {
    	
    });

  
 
    

</script>
@endsection