<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="/bower_components/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/bower_components/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/bower_components/gentelella/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/bower_components/gentelella/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="/bower_components/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_components/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_components/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_components/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_components/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/bower_components/gentelella/build/css/custom.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="/bower_components/gentelella/vendors/switchery/dist/switchery.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="/bower_components/gentelella/vendors/jquery/dist/jquery.min.js"></script>
    <script src="/bower_components/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="/bower_components/bootstrap-multiselect/dist//css/bootstrap-multiselect.css" />

    <!-- Signature pad -->
    <!--<link rel="stylesheet" href="/assets/signature_pad/css/signature-pad.css?v=1.3">-->

    <script src="/assets/signature_pad/js/signature_pad.js"></script>


    <script>
        $(document).ready(function() {
            $("select[multiple]").multiselect();
        });
    </script>

    <style>
        .red-error {
            color: #ff4b43;
        }
         body {
             background: #ffffff !important;
             color: #34495e;
         }
    </style>
</head>

<body>



        @yield('content')


<!-- Bootstrap -->
<script src="/bower_components/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/bower_components/gentelella/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="/bower_components/gentelella/vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="/bower_components/gentelella/vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="/bower_components/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="/bower_components/gentelella/vendors/jszip/dist/jszip.min.js"></script>
<script src="/bower_components/gentelella/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="/bower_components/gentelella/vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- Custom Theme Scripts -->
<script src="/bower_components/gentelella/build/js/custom.min.js"></script>
<!-- Switchery -->
<script src="/bower_components/gentelella/vendors/switchery/dist/switchery.min.js"></script>

<!-- Signature PAD -->

<!--<script src="/assets/signature_pad/js/app.js?v=1.1"></script>-->

</body>
</html>-