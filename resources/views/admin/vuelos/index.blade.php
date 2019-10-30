@extends('layouts.app')

@section('content')
@include('admin.vuelos.createModal')
@include('admin.vuelos.editModal')

<h3 class="box-title">Listado de vuelos </h3>
      <input type="hidden" name="rol_user" value="{{auth()->user()->roles[0]->name}}">
      <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalVuelo">
        <i class="fa fa-plus"></i>Agregar Agregar Vuelo</button>

      
        <table id="vuelos-table" class="table table-striped table-bordered no-margin-bottom dt-responsive nowrap" ellspacing="0" width="98%">            
        </table>
        <input type="hidden" name="urlActual" value="{{url()->current()}}">

@endsection


@push('styles')
 
 
@endpush

@push('scripts')
  <script src="{{asset('js/vuelos/index.js')}}"></script>
  <script src="{{asset('js/vuelos/create.js')}}"></script>
  <script src="{{asset('js/vuelos/edit.js')}}"></script>
@endpush