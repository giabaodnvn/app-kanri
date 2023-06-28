
@include('admin.elements.header')
<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        @include('admin.elements.navbar')
        @include('admin.elements.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('admin.elements.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @stack('scripts')
    <!-- AdminLTE App -->
    <script src="{{ asset('static/js/adminlte.js') }}"></script>
    @include('admin.common.flash')
    </body>
    </html>
