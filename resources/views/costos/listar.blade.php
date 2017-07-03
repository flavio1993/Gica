@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
    	<h3><strong>Lista de Maquinarias</strong></h3>
        <a href="../maquinaria" class="btn btn-primary pull-right">Registrar una nueva maquinaría</a>
        <br>
        <table class="table table-hover table-bordered">
            <br>
            <thead>
            <tr class="" align="center">
                    <td><strong>#</strong></td>
                    <td><strong>Código</strong></td>
                    <td><strong>Maquinaría</strong></td>
                    <td><strong>Potencia</strong></td>
                    <td><strong>Capacidad</strong></td>
                    <td><strong>Peso</strong></td>
                    <td><strong>Opciones</strong></td>
                </tr>
                
            </thead>
            <tbody>
            	@foreach($costs as $index => $c)
            	<tr>
            		<td>{{$index+1}}</td>
            		<td>{{$c->code}}</td>
            		<td>{{$c->machine}}</td>
            		<td>{{$c->potencia}}</td>
            		<td>{{$c->capacidad}}</td>
            		<td>{{$c->peso}}</td>
            		<td width="33%">
            			<a class="btn btn-warning" href="{{$c->cost_id}}">Ver detalles</a>
            			<a class="btn btn-primary" href="../calculo/{{$c->cost_id}}">Costo Horario</a>
            			<a class="btn btn-primary active" href="../productividad/{{$c->cost_id}}-{{$c->code}}">Productividad</a>
            		</td>
            	</tr>
            	@endforeach
            </tbody>
        </table>
    </div>
    
</div>
@endsection

