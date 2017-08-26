<?php
require("../../../application/models/DB/Db.class.php");
$db = new Db();
session_start();
$dbh = $db->getPurePodo();
include("../../../application/models/PHPAuth/Config.php");
include("../../../application/models/PHPAuth/Auth.php");

$config = new PHPAuth\Config($dbh);
$auth   = new PHPAuth\Auth($dbh, $config);

if (!$auth->isLogged()) {
    header('HTTP/1.0 403 Forbidden');

    echo "Forbidden";
    header('location: ../examples/sign-in.html');
    exit();
}
//print_r($_SESSION);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Home (change title)</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="../../plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="../../plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <!-- chamath -->

    <!--date time -->
    <link rel="stylesheet" href="../../../assets/DateTime/css/bootstrap-datetimepicker.min.css">

    <!-- select -->
    <link rel="stylesheet" href="../../../assets/Bselect/css/bootstrap-select.css">

    <!--data table CSS -->
    <link rel="stylesheet" href="../../../assets/dataTable/css/jquery.dataTables.css">

    <!-- Sweetalert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />


</head>

<body class="theme-purple">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-purple">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->


    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index2.php">Selikno Holdings</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">

                  <!-- User Info -->
                  <!-- Todo -->
                  <!-- <li>
                    <div class="user-info">
                        <div class="image">
                            <img src="images/user.png" width="48" height="48" alt="User" />
                        </div>
                        <div class="info-container">
                            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Chamath Silva(Todo)</div>
                            <div class="email">john.doe@example.com</div>
                        </div>
                    </div>
                  </li> -->
                  <!-- #User Info -->

                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->

                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy Doe</b> deleted account</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy</b> changed name</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> commented your post</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 4 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> updated status</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Settings updated</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Yesterday
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->

                    <!-- User Menu -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">keyboard_arrow_down</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </li>
                    <!-- #END# User Menu -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->


    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <!-- <div class="user-info">

            </div> -->
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu" >
                <ul class="list">
                    <!-- <li class="header">MAIN NAVIGATION</li> -->
                    <li class="active">
                        <a href="dashBoard.php" class="admin-pg">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="../../../application/views/admin/cardRegistration.php" class="admin-pg">
                            <i class="material-icons">layers</i>
                            <span>Card Registration</span>
                        </a>
                    </li>
                    <li>
                        <a href="manageStock.html" class="admin-pg">
                            <i class="material-icons">view_list</i>
                            <span>Manage Stock</span>
                        </a>
                    </li>

                    <li>
                        <a href="searchCard.php" class="admin-pg">
                            <i class="material-icons">search</i>
                            <span>Search Card</span>
                        </a>
                    </li>



                </ul>
            </div>
            <!-- #Menu -->


            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="javascript:void(0);"> Chamath Silva</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.4
                </div>
            </div>
            <!-- #Footer -->

        </aside>
        <!-- #END# Left Sidebar -->



    </section>

    <section class="content">
        <div class="container-fluid">
          <div id="page-wrapper" >
            <div class="block-header">
                <h2>BLANK PAGE</h2>
                <!-- Ajax load here -->
            </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="../../plugins/jquery-countto/jquery.countTo.js"></script>


    <!-- Sweet Alert Plugin Js -->
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="../../plugins/jquery-steps/jquery.steps.js"></script>

    <!-- Morris Plugin Js -->
    <script src="../../plugins/raphael/raphael.min.js"></script>
    <script src="../../plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="../../plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="../../plugins/flot-charts/jquery.flot.js"></script>
    <script src="../../plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="../../plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="../../plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="../../plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="../../plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>




    <script src="../../../assets/JS/jquery.form.min.js"></script>
    <script src="../../../assets/dataTable/js/jquery.dataTables.js"></script>
    <script src="../../../assets/JS/jquery.validate.min.js"></script>
    <script src="../../../assets/JS/additional-methods.min.js"></script>



    <!--Date time -->
    <script src="../../../assets/DateTime/js/bootstrap-datetimepicker.min.js"></script>

    <!--Date format -->
    <script src="../../../assets/dataformat/jquery-dateFormat.min.js"></script>


    <!--Select -->
    <script src="../../../assets/Bselect/js/bootstrap-select.js"></script>


    <script src="../../../assets/JS/validation.js"></script>
    <script src="../../../assets/JS/selecterList.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../../assets/JS/sb-admin-2.js"></script>
    <script src="../../../assets/JS/metisMenu.min.js"></script>

    <!--PDF -->
    <script src='../../../assets/pdf/pdfmake.min.js'></script>
    <script src='../../../assets/pdf/vfs_fonts.js'></script>

    <!--highChart -->

    <script src="../../../assets/graph/highcharts.js"></script>
    <script src="../../../assets/graph/data.js"></script>
    <script src="../../../assets/graph/drilldown.js"></script>


    <script>


        var branchId;
        var userId;

        $(document).ready(function() {

            branchId   =   <?php echo json_encode($_SESSION['branchID'])?>;
            userId      =   <?php echo json_encode($_SESSION['userID'])?>;


            var pageWrapper = $("#page-wrapper");
            $("a.admin-pg").on("click", function(e) {
                e.preventDefault();
                pageWrapper.empty();
                pageWrapper.prepend('<div class="loader"><div class="preloader"><div class="spinner-layer pl-purple"><div class="circle-clipper left"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div><p>Please wait...</p></div>');
                pageWrapper.load(this.href);
            });

            window.onload = pageWrapper.load('dashBoard.php');

        });

    </script>


</body>

</html>
