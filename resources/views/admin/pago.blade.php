@extends('layouts.app')

@section('content')
<div class="container">
    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1> <span class="glyphicon glyphicon-cog" aria hidden="true"></span> Panel de Control  <small> Pagos</small></h1>
          </div>

          <div class="col-md-2">
            <div class="dropdown Crear">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Crear Contenido
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li><a type="button" data-toggle="modal" data-target="#agregarPagina">Agregar pagina</a></li>
    <li><a href="#">Agregar Paquete</a></li>
    <li><a href="#">Agregar Usuario</a></li>
    
  </ul>
        </div>
        </div>
      </div>
    </header>



    <section id="breadcrumb">

      <div class="container">
        <ol class="breadcrumb">
         <li class="active"> Panel de Control / Pagos </li>
        </ol>
      </div>
      
    </section>


    <section id="main">
      
      <div class="container">
        
      <div class="row">
        <div class="col-md-3">
      <div class="list-group">



          <a href="#" class="list group-item active color-principal">

  <a href="anel de control.html" class="list-group-item"><span class="glyphicon glyphicon-cog" aria hidden="true"></span> Panel de  Control</a>
  <a href="publicidad.html" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria hidden="true"></span></span> Publicidad <span class="badge">40 </span>  </a>
  <a href="compra de boletos.html" class="list-group-item"><span class="glyphicon glyphicon-plane" aria hidden="true"></span> Compra de Boletos <span class="badge">30</span></a>
  <a href="pagos.html" class="list-group-item"><span class="glyphicon glyphicon-usd" aria hidden="true"></span> Pagos <span class="badge">20 </span></a>
  <a href="paquetes.html" class="list-group-item"><span class="glyphicon glyphicon-book" aria hidden="true"></span> Paquetes <span class="badge">12 </span></a>
  <a href="usuarios.html" class="list-group-item"><span class="glyphicon glyphicon-user" aria hidden="true"></span> Usuarios <span class="badge">22 </span></a>

        </div>  

       <div class="well">
       <h4> Espacio en Disco</h4>
       <div class="progress">
         <div class="barra-progreso" role="progressbar" aria-valuenow="60" aria-valuemin="o" aria-valuemax="100" style="width: 40%;">40%</div>
       
       </div>
       <h4> Ancho de banda</h4>
       <div class="progress">
         <div class="barra-progreso" role="progressbar" aria-valuenow="75" aria-valuemin="o" aria-valuemax="100" style="width: 75%;">75%</div>

       </div>

        </div>
        </div>


        <div class="col-md-9">



         <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Ultimas compras</h3>
  </div>
  <div class="panel-body">

    <div class="row">
      <div class="col-md-12">
        <input type="text" class="form-control" placeholder="Filtrar publicidad">

      </div>
    </div>

    <br>
    

  </div>
</div>
    


         </div>
        </div>

      </div>

    </section>
    

   <footer id="footer">
     <p>Copyright AppAdmin, &copy; 2019</p>

   </footer>


<!-- Modal -->
<div class="modal fade" id="agregarPagina" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form>

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar pagina</h4>
      </div>
      <div class="modal-body">

        <div class="form-group">
    <label>Titulo de la pagina</label>
    <input type="text" class="form-control" placeholder="Titulo de la pagina">
  </div>
  <div class="form-group">
    <label>Informacion de la pagina</label>
    <textarea  name="editor1" class="form-control"placeholder="Informacion de la pagina">>
      </textarea>

  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox">publicado

    </label>
  
  </div>

<div class="form-group">
    <label>Palabras Clave </label>
    <input type="text" class="form-control" placeholder="Agregar algunas palabras">
  </div>

  <div class="form-group">
    <label>Meta descripcion </label>
    <input type="text" class="form-control" placeholder="Agregar alguna descripcion">
  </div>


      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
