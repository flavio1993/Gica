@extends('layouts.app')

@section('content')
<style type="text/css">
    .contenido{
        padding-left: 30px;
        background-color: #FFAB26;
    }
    
    .imagen-cover{
      padding-left: 10px;
      padding-right: 40px;
      background-image: url('{{asset('img/landing.png')}}');
    }
    .fondo{
      background-image: url('{{asset('img/event.png')}}');
      height: 600px;
      widows: 100px;
    }
    #loginn{
        height: 500px;
        padding-right: 40px;
        background-color: #D2691E;
        color: white;
        font-size: 200%;        
    }
</style>
<div class="">
        @if (!Auth::check())
        <div class="row imagen-cover">

            <div class="col-xs-8 col-md-5 col-sm-5 col-lg-3 pull-right">
                <br>
                <div class="panel panel-warning ">          
                    <div class="panel-heading">INICIAR SESIÓN</div>
                    <div class="panel-body" id="loginn">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}
                            <br><br><br>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail dirección</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Ingresar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div> 
        <div class="container ">
            <br>
            <div>
                <table class="table table-responsive">
                    <thead>
                        <th><h5><strong>Gica Ingenieros</strong></h5></th>
                        <th><h5><strong>Director Ing. Robeth Castillo</strong></h5></th>
                        <th><h5><strong>Informes</strong></h5></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="justify" width="33%">Especialistas en capacitación contínua en modalidad presencial y virtual para profesionales en gestión de activos, proyectos, mantenimiento, confiabilidad, calidad y afines.</td>
                            <td align="justify" width="33%">Ingeniero Mecánico, Doctorando en Administración y Ciencias e Ingenieria.<br> Especialista en Gestión de Activos, Proyectos y Mantenimiento.<br> Sistemas Oleohidraulicos Aplicados en Maquinaria Pesada.</td>
                            <td align="justify" width="33%">Lic. Marita Castillo<br>
                                <strong><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>Fijo:</strong> +51 44 623 114<br>
                                <strong><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>Movistar:</strong> +51 942848064 / <strong><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>Claro:</strong> +51 955708050<br>
                                <strong><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Email:</strong> <a href="www.maquinariapesada@gicaingenieros.com"> maquinariapesada@gicaingenieros.com</a></td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>
        @else
        <div class="" >
            <div class="fondo">
                 
            </div>
        </div>
        
        @endif
        
    
</div>
@endsection
