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

    <link href="/css/magic-check.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="/bower_components/gentelella/vendors/jquery/dist/jquery.min.js"></script>
    <script src="/bower_components/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="/bower_components/bootstrap-multiselect/dist//css/bootstrap-multiselect.css" />
    <script>
        $(document).ready(function() {
            $("select[multiple]").multiselect();
        });
    </script>


    <style>
        .red-error {
            color: #ff4b43;
        }
        body.nav-md .container.body .left_col {
            width: 160px !important;
            /*z-index: -10000000;*/
        }
        .nav-md .container.body .right_col {
            margin-left: 160px;
        }
        .nav_title {
            width: 160px !important;
        }
        .sidebar-footer {
            width: 160px !important;
        }
        .nav-md .container.body .right_col {
            padding: 0 0 0;
            margin-left: 160px;
        }
        .main_container .top_nav {
            margin-left: 160px;
        }
        @media (min-width: 992px) {
            footer {
                margin-left: 160px;
            }
        }
        body {
            color: #1e2b37;
        }
        div.title_left {
            padding-left: 15px;
        }
        div.last-created {
            margin-top: 5px;
        }
        div.last-updated {
            margin-top: 5px;
        }
        div.editing {
            margin-top: 5px;
        }
        div.last-students {
            margin-top: 10px;
        }
        ul.navbar-left {
            width: 75% !important;
        }
        ul.navbar-right {
            width: 15% !important;
        }
    </style>
    @yield('header-scripts')
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0; min-height: 100px; background: rgba(255, 255, 255, 0); text-align: left;">
                    <a href="/user" class="site_title" style="height: 100px; margin: 0; padding: 0;"><img src="/image/logobls.jpg"></a>
                </div>

                <div class="clearfix"></div>

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-users"></i> Students <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="/user">Students</a></li>
                                    <li><a href="/session">Add student</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-calendar"></i> Sessions <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="/session">Sessions</a></li>
                                    <li><a href="/session/create">Add session</a></li>
                                    <li><a href="/session/type">Types of sessions</a></li>
                                    <li><a href="/session/course">Types of courses</a></li>
                                </ul>
                            </li>
                            <li><a href="/exam"><i class="fa fa-check-square-o"></i> Exam </a>
                            </li>
                            <li><a><i class="fa fa-envelope-o"></i> Emails <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="/email">Email templates</a></li>
                                    <li><a href="/email/create">Add email template</a></li>
                                </ul>
                            </li>
                            <li><a href="/invoice"><i class="fa fa-paper-plane"></i> Invoices </a>
                            </li>
                        </ul>
                        <h3>Additional</h3>
                        <ul class="nav side-menu">
                            <li><a href="/txt/university"><i class="fa fa-file-text-o"></i> File for university </a>
                            <li><a href="/import/upload_excel"><i class="fa fa-file-text-o"></i> Import scores </a>
                            <li><a href="/manager"><i class="fa fa-user"></i> Users </a>
                            <li><a href="/settings"><i class="fa fa-file-text-o"></i> Settings </a>
                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="/logout">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-left">
                        <div class="last-students">
                        </div>
                        <div class="last-created">
                        </div>
                        <div class="last-updated">
                        </div>
                        <div class="editing">
                        </div>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->




                    @yield('content')



    </div>
</div>

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

<script>
    var s = ' Last file saved: <a href="">@time by...name</a>';

    $(document).ready(function() {
        setInterval(checkStudents, 10000);
        setInterval(function() {
            checkActivity('last-created', 'created');
        }, 10000);
        setInterval(function() {
            checkActivity('last-updated', 'updated');
        }, 10000);
    });
    function checkStudents()
    {
        var html = '';
        $.ajax({
            url: '/api/last-students',
            method : 'GET',
            success: function(data) {
                if(data.success == true) {
                    var str = [];
                    $.each(data.activity, function(key, value) {
                        str.push('<a href="' + value.link + '">@' + value.time + ' - ' + value.name + ' ' + value.surname + '</a>');
                    });
                    if(str.length) {
                        $('.last-students').html("Last student subscribed: " + str.join(' ,'));
                    }
                    else {
                        $('.last-students').html("");
                    }
                }
            }
        });
    }

    function checkActivity(htmlClass, type)
    {
        var apiMethod = '';
        var message = '';
        if(type == 'created') {
            apiMethod = 'last-created';
            message = "Last file saved: ";
        }
        else if(type == 'updated') {
            apiMethod = 'last-updated';
            message = "Last file updated: ";
        }
        else {
            return false;
        }
        var html = '';
        $.ajax({
            url: '/api/' + apiMethod,
            method : 'GET',
            success: function(data) {
                if(data.success == true) {
                    $('.' + htmlClass).html(message + '<a href="' + data.link + '">@' + data.time + ' by ' + data.name + '</a>');
                }
            }
        });
    }
</script>

</body>
</html>