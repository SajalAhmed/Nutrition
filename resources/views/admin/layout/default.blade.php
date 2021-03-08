<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>@yield('title_area') | Nutrition Training</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset("admin")}}/images/favicon.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Plugins css-->
    <link href="{{asset("admin")}}/vendors/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin")}}/vendors/notifications/notification.css" rel="stylesheet" />
    <link href="{{asset("admin")}}/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="{{asset("admin")}}/vendors/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset("admin")}}/vendors/dropify-master/dist/css/dropify.min.css">
    <!-- Table datatable css -->
    <link href="{{asset("admin")}}/vendors/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin")}}/vendors/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin")}}/vendors/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset("admin")}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{asset("admin")}}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin")}}/css/helper.css" rel="stylesheet" type="text/css" id="app-stylesheet" />
    <link href="{{asset("admin")}}/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />
    <link href="{{asset("admin")}}/css/custom.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

    <!-- Vendor js -->
    <script src="{{asset("admin")}}/js/vendor.min.js"></script>

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        @include('admin.layout.header')
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->

        @include('admin.layout.sidebar')
        <!-- Left Sidebar End -->
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
           @yield('main_section')
            <!-- content -->

            @include('admin.layout.footer')

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->
    <!-- App js -->
    <script src="{{asset("admin")}}/js/app.min.js"></script>
    <script src="{{asset("admin")}}/js/bootstrap-select.min.js"></script>

    <script src="{{asset("admin/vendors")}}/notifications/notify.min.js"></script>
    <script src="{{asset("admin/vendors")}}/notifications/notify-metro.js"></script>
    <script src="{{asset("admin/vendors")}}/notifications/notifications.js"></script>
    <script src="{{asset("admin")}}/vendors/dropify-master/dist/js/dropify.min.js"></script>
    <!-- custom script -->
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(':file').dropify({
                messages: {
                    'default': 'Click to Upload File',
                    'replace': 'Click to Replace File'
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
