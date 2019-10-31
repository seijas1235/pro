@extends('layouts.app')
@section('content')

@include('admin.paquetes.createModal')
@include('admin.paquetes.editModal') 
<div class="loader loader-double is-active"></div>
<input type="hidden" name="rol_user" value="{{auth()->user()->roles[0]->name}}">

      <h3 class="box-title">Listado paquetes</h3>
      <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalPaquete">
        <i class="fa fa-plus"></i>Agregar Paquete
      </button>

        <table id="paquetes-table" class="table table-striped table-bordered no-margin-bottom dt-responsive nowrap" ellspacing="0" width="98%">            
        </table>
        <input type="hidden" name="urlActual" value="{{url()->current()}}">

@endsection


@push('scripts')
  <script src="{{asset('js/paquetes/index.js')}}"></script>
  <script src="{{asset('js/paquetes/create.js')}}"></script>
  <script src="{{asset('js/paquetes/edit.js')}}"></script>
@endpush