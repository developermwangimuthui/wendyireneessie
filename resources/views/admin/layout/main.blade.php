<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- <title>{{ $seo->seo_title }}</title> --}}
        <!--favicon-->
        <link rel="icon" href="/backend/assets/images/favicon.ico" type="image/x-icon">
        <!-- Vector CSS -->
        <link href="/backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
        <!-- simplebar CSS-->
        <link href="/backend/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
        <!-- Bootstrap core CSS-->
        <link href="/backend/assets/css/bootstrap.min.css" rel="stylesheet" />
        <!-- jquery steps CSS-->
        <link rel="stylesheet" type="text/css" href="/backend/assets/plugins/jquery.steps/css/jquery.steps.css">
        <!--Data Tables -->
        <link href="/backend/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet"
            type="text/css">
        <link href="/backend/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet"
            type="text/css">
        <link rel="stylesheet" type="text/css" href="/backend/assets/css/dataTables.material.min.css">
        <!-- animate CSS-->
        <link href="/backend/assets/css/animate.css" rel="stylesheet" type="text/css" />
        <!-- Icons CSS-->
        <link href="/backend/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <!-- Sidebar CSS-->
        <link href="/backend/assets/css/sidebar-menu.css" rel="stylesheet" />
        <!-- Custom Style-->
        <link href="/backend/assets/css/app-style.css" rel="stylesheet" />
        <link href="/backend/assets/css/preloader.css" rel="stylesheet" />
    
        <link rel="stylesheet" type="text/css" href="/backend/assets/css/gijgo.min.css">
        <!--Select Plugins-->
        <link href="/backend/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
        <!-- Dropzone css -->
        <link href="/backend/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css">
        <!-- notifications css -->
        <link rel="stylesheet" href="/backend/assets/plugins/notifications/css/lobibox.min.css" />
        {{-- ckeditor --}}
        <link rel="stylesheet" href="/backend/assets/plugins/summernote/dist/summernote-bs4.css"/>
    
    
        <!-- Bootstrap core JavaScript-->
        <script src="/backend/assets/js/jquery.min.js"></script>
        <script src="/backend/assets/js/ajax.js"></script>
        <script src="/backend/assets/js/popper.min.js"></script>
        <script src="/backend/assets/js/bootstrap.min.js"></script>
        <script src="/backend/assets/plugins/alerts-boxes/js/sweetalert.min.js "></script>
        <script src="/backend/assets/plugins/alerts-boxes/js/sweet-alert-script.js"></script>
        <script src="/backend/assets/js/moment.js"></script>
        <script src="/backend/assets/js/jquery-ui.min.js"></script>
        <script src="/backend/assets/js/jquery.preloader.min.js"></script>
        <!--Select Plugins Js-->
        <script src="/backend/assets/plugins/select2/js/select2.min.js"></script>
        <!--Inputtags Js-->
        <script src="/backend/assets/plugins/inputtags/js/bootstrap-tagsinput.js"></script>
        <script src="/backend/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
    
        <script src="/backend/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
        <script src="/backend/assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
        <script src="/backend/assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
        {{-- <script src="/backend/assets/plugins/bootstrap-datatable/js/dataTables.cellEdit.js"></script> --}}
    
    </head>
    

<body>
    {{-- @include('sweetalert::alert') --}}

    <!-- Start wrapper-->
    <div id="wrapper">

        <!--Start sidebar-wrapper-->
        @include('admin.layout.sidebar')
        <!--End sidebar-wrapper-->

        <!--Start topbar header-->
        @include('admin.layout.header')
        <!--End topbar header-->

        <div class="clearfix"></div>

        @yield('content')


        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->
        {{-- 
        @include('admin.layout.footer') --}}


    </div>
    <script>
        // $(document).ready(function() {
        //   $('#default-datatable').DataTable();
    
    
    
        //   var table = $('#example').DataTable( {
        //    lengthChange: false,
        //    buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
        //  } );
    
        // table.buttons().container()
        //    .appendTo( '#example_wrapper .col-md-6:eq(0)' );
         
        //  } );
    
    </script>
    <!--End wrapper-->


    <!-- simplebar js -->
    <script src="/backend/assets/plugins/simplebar/js/simplebar.js"></script>
    <!-- waves effect js -->
    <script src="/backend/assets/js/waves.js"></script>
    <!-- sidebar-menu js -->
    <script src="/backend/assets/js/sidebar-menu.js"></script>
    <!-- Custom scripts -->
    <script src="/backend/assets/js/app-script.js"></script>

    <!-- Vector map JavaScript -->
    <script src="/backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- Chart js -->
    <script src="/backend/assets/plugins/Chart.js/Chart.min.js"></script>
    <script src="/backend/assets/plugins/Chart.js/Chart.extension.js"></script>
    <!-- Index js -->
    <script src="/backend/assets/js/index.js"></script>

    <!--Data Tables js-->
    <script src="/backend/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
    <script src="/backend/assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
    <script src="/backend/assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
    <script src="/backend/assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
    {{-- <script src="/backend/assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script> --}}
    <script src="/backend/assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
    <script src="/backend/assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
    <script src="/backend/assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
    <script src="/backend/assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>

    <!--Form Wizard-->
    <script src="/backend/assets/plugins/jquery.steps/js/jquery.steps.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/backend/assets/plugins/jquery-validation/js/jquery.validate.min.js"></script>
    <!--wizard initialization-->
    <script src="/backend/assets/plugins/jquery.steps/js/jquery.wizard-init.js" type="text/javascript"></script>
    <script src="/backend/assets/plugins/jquery.steps/js/jquery.wizard-init for-form-edit.js" type="text/javascript"></script>


    <script src="/backend/assets/plugins/jquery-multi-select/jquery.multi-select.js"></script>
    <script src="/backend/assets/plugins/jquery-multi-select/jquery.quicksearch.js"></script>
    <!-- Dropzone JS  -->
    <script src="/backend/assets/plugins/dropzone/js/dropzone.js"></script>

    <!--notification js -->
    <script src="/backend/assets/plugins/notifications/js/lobibox.min.js"></script>
    <script src="/backend/assets/plugins/notifications/js/notifications.min.js"></script>
    <script src="/backend/assets/plugins/notifications/js/notification-custom-script.js"></script>
    

</body>


</html>