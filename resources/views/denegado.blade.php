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
    <link rel="stylesheet" href="{{asset('css/alertify.css') }}">
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
                <h1>LO SIENTO NO TIENES ACCESO A ESTA WEB</h1>
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
      <script src="{{asset('js/alertify.js') }}"></script>
      <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!}
    </script>
    @stack('scripts')
    <script>
        alertify.defaults = {
            // dialogs defaults
            autoReset:true,
            basic:false,
            closable:true,
            closableByDimmer:true,
            frameless:false,
            maintainFocus:true, // <== global default not per instance, applies to all dialogs
            maximizable:true,
            modal:true,
            movable:true,
            moveBounded:false,
            overflow:true,
            padding: true,
            pinnable:true,
            pinned:true,
            preventBodyShift:false, // <== global default not per instance, applies to all dialogs
            resizable:true,
            startMaximized:false,
            transition:'pulse',
        
            // notifier defaults
            notifier:{
                // auto-dismiss wait time (in seconds)  
                delay:5,
                // default position
                position:'bottom-right',
                // adds a close button to notifier messages
                closeButton: false
            },
        
            // language resources 
            glossary:{
                // dialogs default title
                title:'Aviso!',
                // ok button text
                ok: 'OK',
                // cancel button text
                cancel: 'Cancelar'            
            },
        
            // theme settings
            theme:{
                // class name attached to prompt dialog input textbox.
                input:'ajs-input',
                // class name attached to ok button
                ok:'ajs-ok',
                // class name attached to cancel button 
                cancel:'ajs-cancel'
            }
        };
    </script>
</body>
</html>
