@extends('layouts.app')

@section('content')
@include('admin.hoteles.createModal')
@include('admin.hoteles.editModal')

<h3 class="box-title">Listado de hoteles</h3>
      <input type="hidden" name="rol_user" value="{{auth()->user()->roles[0]->name}}">
      <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalHotel">
        <i class="fa fa-plus"></i>Agregar Agregar Hotel</button>

      
        <table id="hoteles-table" class="table table-striped table-bordered no-margin-bottom dt-responsive nowrap" ellspacing="0" width="98%">            
        </table>
        <input type="hidden" name="urlActual" value="{{url()->current()}}">

@endsection


@push('styles')
 
 
@endpush

@push('scripts')
  <script src="{{asset('js/hoteles/index.js')}}"></script>
  <script src="{{asset('js/hoteles/create.js')}}"></script>
  <script src="{{asset('js/hoteles/edit.js')}}"></script>
@endpush