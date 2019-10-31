@extends('layouts.app')
@section('content')

@include('admin.publicidad.createModal')
@include('admin.publicidad.editModal') 
<div class="loader loader-double is-active"></div>
<input type="hidden" name="rol_user" value="{{auth()->user()->roles[0]->name}}">

      <h3 class="box-title">Listado publicidad</h3>
      <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalPublicidad">
        <i class="fa fa-plus"></i>Agregar Publicidad
      </button>

        <table id="publicidad-table" class="table table-striped table-bordered no-margin-bottom dt-responsive nowrap" ellspacing="0" width="98%">            
        </table>
        <input type="hidden" name="urlActual" value="{{url()->current()}}">

@endsection


@push('scripts')
  <script src="{{asset('js/publicidad/index.js')}}"></script>
  <script src="{{asset('js/publicidad/create.js')}}"></script>
  <script src="{{asset('js/publicidad/edit.js')}}"></script>
@endpush