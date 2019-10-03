<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SAH</title>
    <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('css/estilos.css') }}">   
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script> 
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/buttons.dataTables.min.css') }}">

    <link rel="stylesheet" href="{{asset('fonts/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{asset('fonts/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{asset('datepicker/datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('css/css-loader-master/dist/css-loader.css') }}">
</head>
<body>
        <nav class="navbar navbar-default">
                <div class="container">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Administrador</a>
                  </div>
                  <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                      <li class="{{request()->is('home*')? 'active': ''}}"><a href="/home">Panel de Control</a></li>
                      <li class="{{request()->is('publicidad*')? 'active': ''}}"><a href="/publicidad">Publicidad</a></li>
                      <li class="{{request()->is('compra*')? 'active': ''}}"><a href="/compra">Compra de boletos</a></li>
                      <li class="{{request()->is('pago*')? 'active': ''}}"><a href="/pago">Pago</a></li>
                      <li class="{{request()->is('paquetes*')? 'active': ''}}"><a href="/paquetes">Paquetes</a></li>
                      <li class="{{request()->is('users*')? 'active': ''}}"><a href="/users">Usuarios</a></li>
                      
                      <li><a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}<i class="fas fa-sign-out pull-right"></i>

                        </a>
                        
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                          
                        </li>
                    </ul>
                  </div><!--/.nav-collapse -->
                </div>
              </nav>

        <div class="right_col" role="main">
                @yield('content')
            </div> 
            <script type="text/javascript"> 
                // Always provide paths that start with a slash character ("/").
                CKEDITOR.replace( 'editor1', {
                        
                } );
                
                </script>
                
                
                
                
                
                    <!-- Bootstrap core JavaScript
                    ================================================== -->
                    <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      
      <script src="{{asset('js/bootstrap.min.js') }}"></script>
      <script src="{{asset('js/datatable/jquery.dataTables.min.js') }}"></script>
      <script src="{{asset('js/datatable/dataTables.bootstrap.min.js') }}"></script>
      <script src="{{asset('js/datatable/dataTables.buttons.min.js') }}"></script>
      <script src="{{asset('js/datatable/dataTables.responsive.min.js') }}"></script>
      <script src="{{asset('js/datatable/buttons.html5.min.js') }}"></script>
      <script src="{{asset('js/datatable/jszip.min.js') }}"></script>
      <script src="{{asset('js/datatable/pdfmake.min.js') }}"></script>
      <script src="{{asset('js/jquery.validate.js') }}"></script>
      <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!}
    </script>
    @stack('scripts')
</body>
</html>
