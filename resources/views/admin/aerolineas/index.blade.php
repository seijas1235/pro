@extends('layouts.app')

@section('content')
@include('admin.aerolineas.createModal')
@include('admin.aerolineas.editModal')

<h3 class="box-title">Listado de aerolineas</h3>
      <input type="hidden" name="rol_user" value="{{auth()->user()->roles[0]->name}}">
      <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalAerolinea">
        <i class="fa fa-plus"></i>Agregar Agregar Aerolinea</button>

      
        <table id="aerolineas-table" class="table table-striped table-bordered no-margin-bottom dt-responsive nowrap" ellspacing="0" width="98%">            
        </table>
        <input type="hidden" name="urlActual" value="{{url()->current()}}">

@endsection


@push('styles')
 
 
@endpush

@push('scripts')
  <script src="{{asset('js/aerolineas/index.js')}}"></script>
  <script src="{{asset('js/aerolineas/create.js')}}"></script>
  <script src="{{asset('js/aerolineas/edit.js')}}"></script>
@endpush