<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- <link href="/css/app.css" rel="stylesheet">-->
    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/yeti/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/venobox/1.8.1/venobox.min.css">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    {!! Charts::assets() !!}

    <style type="text/css">
        .color_navbar{
            background: #FFAB26;
        }
        
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top color_navbar">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}" style="color:black;">
                            <strong>Gica <small>Ingenieros</small></strong> <small>Demo Costo Horario</small>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    @if (!Auth::guest())
                    @if(Auth::user()->rol === 2)
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administrador
                                    <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                      <li><a href="{{ url('/datos') }}">Datos Generales</a></li>
                                      <li><a href="{{ url('/mercado') }}">Mercado</a></li>
                                  </ul>
                              </li>
                        </ul>
                    @endif
                    <ul class="nav navbar-nav">
                        &nbsp;
                         <li><a href="{{ url('/maquinaria') }}">Maquinaría</a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        &nbsp;
                         <li><a href="{{ url('/maquinaria/listar') }}">Listar</a></li>
                    </ul>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <!-- <li><a href="{{ url('/login') }}">Ingresar</a></li> -->
                            <!--<li><a href="{{ url('/register') }}">Register</a></li>-->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Salir
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')




    </div>

    <!-- Scripts -->
    <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--<script src="/js/app.js"></script>-->
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/venobox/1.8.1/venobox.min.js"></script>

    @section('scripts_machine')
    @show

    @section('scripts_mac_register')
    @show
    @section('scripts_detalle')
    @show
    @section('scripts_productividad')
    @show
    
    @section('scripts_mercado')
    @show

</body>
</html>
