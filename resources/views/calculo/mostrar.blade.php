@extends('layouts.app')

@section('content')
<style type="text/css">
    .holaa{
        background: #FFAB26;
    }
</style>

<div >
    <div class="row">
        <div class="container" >
            <div class="col-md-8">
                <h4><strong>Cálculo del costo horario</strong></h4>
            </div>
            <div class="col-md-4">
                <a href="../maquinaria/listar" class="btn btn-primary pull-right">volver a lista</a>
            </div>
        </div>
        <div class="col-md-3" >
            <br><br><br>
            <div class="col-md-8 col-md-offset-2 holaa">
                <hr>
                <table class="table table-hover">
                    <thead>
                        <th></th>
                        <th>Precio en el mercado (S/.)</th>
                    </thead>
                    <tbody>
                        @foreach($prices as $pr)
                        <tr>
                            <td width="50%">{{$pr->description}}</td>
                            <td>{{$pr->value}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr>
                <h4><strong></strong></h4>
                <table class="table table-hover">
                    <thead>
                        <th></th>
                        <th>Mercado</th>
                    </thead>
                    <tbody>
                        @foreach($caracteristicas as $ca)
                            <tr>
                                <td width="50%">{{$ca->description}}</td>
                                <td>{{$ca->value}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <h4><strong></strong></h4>
                <table class="table table-hover">
                    <thead>
                        <th></th>
                        <th>Costo HH de Operador (S/.)</th>
                    </thead>
                    <tbody>
                        @foreach($operador as $op)
                            <tr>
                                <td width="50%">{{$op->description}}</td>
                                <td>{{$op->value}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-2">
            <h3>Costos de Posesión</h3>
            <table class="table">
                <thead>
                    <th>Descripción</th>
                    <th width="50%">Valor (S/.)</th>
                </thead>
                <tfoot>
                    <tr>
                    <td><strong>Total sin operar</strong></td>
                    <td><strong>{{$total_sin_operar}}</strong></td>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>Depreciación</td>
                        <td>{{$depreciacion_cal}}</td>
                    </tr>
                    <tr>
                        <td>Intereses</td>
                        <td>{{$interes_cal}}</td>
                    </tr>
                    <tr>
                        <td>Seguros</td>
                        <td>{{$seguros_cal}}</td>
                    </tr>
                </tbody>
            </table>
            <br><br>
            <h3>Costos de operación</h3>      
            <table class="table">
                <thead>
                    <th>Descripción</th>
                    <th width="50%">Valor (S/.)</th>
                </thead>
                <tfoot>
                    <tr>
                    <td><strong>Total sin operar</strong></td>
                    <td><strong>{{$total_operar}}</strong></td>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>Costo mantenimiento y reparacion</td>
                        <td>{{$costo_mano_obra_rep}}</td>
                    </tr>
                    <tr>
                        <td>Combustible</td>
                        <td>{{$comb}}</td>
                    </tr>
                    <tr>
                        <td>Filtros</td>
                        <td>{{$filtros}}</td>
                    </tr>
                    <tr>
                        <td>Lubricantes</td>
                        <td>{{$lubricantes}}</td>
                    </tr>
                    <tr>
                        <td>Grasas</td>
                        <td>{{$gras}}</td>
                    </tr>
                    <tr>
                        <td>Neumáticos</td>
                        <td>{{$neumaticos}}</td>
                    </tr>
                    <tr>
                        <td>Costo de hh de operador</td>
                        <td>{{$costo_hh}}</td>
                    </tr>
                </tbody>
            </table> 
            <br><br>
            <h3>Costo Horario:</h3>    
            <h3><strong>{{$costo_horario}}</strong></h3> 
        </div>
        <div class="col-md-4">
            <center>
                {!! $chats_posesion->render() !!}
            </center>
            <center>
                {!! $chats_operacion->render() !!}
            </center>
            <center>
                {!! $chats_horario->render() !!}
            </center>
        </div>        
    </div>
    
</div>
@endsection

