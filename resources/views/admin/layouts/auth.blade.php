<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Log in</title>
    <base href="{{ asset('') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="shortcut icon" href="{{ asset('static/img/user/minilogo.png') }}" type="image/png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('static/css/lib/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('static/css/lib/icheck-bootstrap.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('static/css/adminlte.css') }}">

</head>
<body class="hold-transition login-page" id="particles-js">
<div class="login-box">
  <div class="login-logo" style="color: #F96300">
      <b>Admin</b> Nitrotech Asia Inc</a>
  </div>
  <div class="card">
    @yield('content')
  </div>
</div>
<!-- jQuery -->
<script src="{{ asset('static/js/jquery.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('static/js/bootstrap.bundle.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('static/js/adminlte.js') }}"></script>
</body>
</html>
