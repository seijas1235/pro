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
  <title>SAH</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.css') }}">
  <link rel="stylesheet" href="{{asset('css/sebas.css') }}">
  <link rel="stylesheet" href="{{asset('css/clean-blog.min.css') }}">
  <link rel="stylesheet" href="{{asset('css/alertify.css') }}">
  <link rel="stylesheet" href="{{asset('css/css-loader-master/dist/css-loader.css') }}">
  @stack('styles')
</head>
 
<body>

@yield('contenido')

<script src="{{asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{asset('js/bootstrap/bootstrap.bundle.js') }}"></script>
<script src="{{asset('js/bootstrap/bootstrap.js') }}"></script>
<script src="{{asset('js/clean-blog.min.js') }}"></script>
<script src="{{asset('js/alertify.js') }}"></script>
<script src="{{asset('js/jquery.validate.js') }}"></script>

@stack('scripts')
</body>
</html>
