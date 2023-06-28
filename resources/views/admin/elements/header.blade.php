<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ env('APP_NAME') }} Admin</title>
  <base href="{{ asset('') }}">
    <!--====== Favicon Icon ======-->
  <link rel="shortcut icon" href="{{ asset('static/img/user/minilogo.png') }}" type="image/png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('static/css/lib/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('static/css/adminlte.css') }}">

  @stack('styles')
</head>
