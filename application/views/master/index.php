<!DOCTYPE>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $this->lang->line('label_title'); ?>! | Sale System</title>
        <?php
        if($this->session->userdata('site_lang') == 'khmer'){
        ?>
        <style type="text/css">
            @font-face {
                font-family:"KhmerOSBattambang-Regular";
                src: url("<?php echo base_url('fonts/KhmerOSBattambang-Regular.ttf');?>") /* TTF file for CSS3 browsers */
            }
            h1, h2, h3, h4, h5, h6, p, label, th, td, button, a, input, select, option, textarea, div{
                font-family:'KhmerOSBattambang-Regular' !important;
            }
        </style>
        <?php
        }elseif($this->session->userdata('site_lang') == 'khmer'){
        ?>
        <style type="text/css">
            @font-face {
                font-family:"KhmerOSBattambang-Regular";
                src: url("<?php echo base_url('fonts/KhmerOSBattambang-Regular.ttf');?>") /* TTF file for CSS3 browsers */
            }
            h1, h2, h3, h4, h5, h6, p, label, th, td, button, a, input, select, option, textarea, div{
                font-family:'KhmerOSBattambang-Regular' !important;
            }
        </style>
        <?php
        }
        ?>
        <!-- Bootstrap -->
        <link href="<?php echo base_url('vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url('vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo base_url('vendors/nprogress/nprogress.css'); ?>" rel="stylesheet">
        <!-- iCheck -->
        <link href="<?php echo base_url('vendors/iCheck/skins/flat/green.css'); ?>" rel="stylesheet">
        <!-- bootstrap-progressbar -->
        <link href="<?php echo base_url('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css'); ?>" rel="stylesheet">
        <!-- JQVMap -->
        <link href="<?php echo base_url('vendors/jqvmap/dist/jqvmap.min.css'); ?>" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="<?php echo base_url('vendors/bootstrap-daterangepicker/daterangepicker.css'); ?>" rel="stylesheet">
        <!-- bootstrap-dialog-master -->
        <link href="<?php echo base_url('vendors/bootstrap-dialog-master/dist/bootstrap-dialog.min.css'); ?>" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="<?php echo base_url('build/css/custom.min.css'); ?>" rel="stylesheet">

        <!-- load style -->
        <link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet">
        <!-- Custom Theme Scripts -->
        <script src="<?php echo base_url('build/js/custom.min.js'); ?>"></script>



    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="<?php echo base_url('images/img.jpg'); ?>" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span><?php echo $this->lang->line('das_welcome_user'); ?></span>
                                <h2><?php echo $user_info->merUseFullName; ?></h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3><?php echo $this->lang->line('das_menu_title'); ?></h3>
                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-home"></i> <?php echo $this->lang->line('das_menu_dashboard'); ?> <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?php echo base_url('dashboard'); ?>"> <?php echo $this->lang->line('das_menu_dashboard_home'); ?> </a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-edit"></i> <?php echo $this->lang->line('das_menu_stock'); ?> <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?php echo base_url('stock/add-new'); ?>"> <?php echo $this->lang->line('das_menu_stock_add'); ?> </a></li>
                                            <li><a href="<?php echo base_url('stock/view'); ?>"> <?php echo $this->lang->line('das_menu_stock_view'); ?> </a></li>
                                            <li><a href="<?php echo base_url('stock/import'); ?>"> <?php echo $this->lang->line('das_menu_stock_import'); ?> </a></li>
                                            <li><a href="<?php echo base_url('stock/export'); ?>"> <?php echo $this->lang->line('das_menu_stock_export'); ?> </a></li>
                                            <li><a href="<?php echo base_url('stock/adjust'); ?>"> <?php echo $this->lang->line('das_menu_stock_adjust'); ?> </a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-desktop"></i> <?php echo $this->lang->line('das_menu_customer'); ?> <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?php echo base_url('customer/add-new'); ?>"> <?php echo $this->lang->line('das_menu_customer_add'); ?> </a></li>
                                            <li><a href="<?php echo base_url('customer/view'); ?>"> <?php echo $this->lang->line('das_menu_customer_view'); ?> </a></li>
                                            <li><a href="<?php echo base_url('customer/import'); ?>"> <?php echo $this->lang->line('das_menu_customer_import'); ?> </a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-desktop"></i> <?php echo $this->lang->line('das_menu_supplier'); ?> <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?php echo base_url('supplier/add-new'); ?>"> <?php echo $this->lang->line('das_menu_supplier_add'); ?> </a></li>
                                            <li><a href="<?php echo base_url('supplier/view'); ?>"> <?php echo $this->lang->line('das_menu_supplier_view'); ?> </a></li>
                                            <li><a href="<?php echo base_url('supplier/import'); ?>"> <?php echo $this->lang->line('das_menu_supplier_import'); ?> </a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-table"></i> <?php echo $this->lang->line('das_menu_reminder'); ?> <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?php echo base_url('reminder/calendar'); ?>"> <?php echo $this->lang->line('das_menu_reminder_calendar'); ?> </a></li>
                                            <li><a href="<?php echo base_url('reminder/customer-payment'); ?>"> <?php echo $this->lang->line('das_menu_reminder_customer_payment'); ?> </a></li>
                                            <li><a href="<?php echo base_url('reminder/meeting'); ?>"> <?php echo $this->lang->line('das_menu_reminder_meeting'); ?> </a></li>
                                            <li><a href="<?php echo base_url('reminder/email'); ?>"> <?php echo $this->lang->line('das_menu_reminder_email'); ?> </a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-bar-chart-o"></i> <?php echo $this->lang->line('das_menu_sale'); ?> <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?php echo base_url('sale/pos'); ?>"> <?php echo $this->lang->line('das_menu_sale_pos'); ?> </a></li>
                                            <li><a href="<?php echo base_url('sale/add-new'); ?>"> <?php echo $this->lang->line('das_menu_sale_add'); ?> </a></li>
                                            <li><a href="<?php echo base_url('sale/view'); ?>"> <?php echo $this->lang->line('das_menu_sale_view'); ?> </a></li>
                                            <li><a href="<?php echo base_url('sale/adjust'); ?>"> <?php echo $this->lang->line('das_menu_sale_adjust'); ?> </a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-bar-chart-o"></i> <?php echo $this->lang->line('das_menu_report'); ?> <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?php echo base_url('report/sale'); ?>"> <?php echo $this->lang->line('das_menu_report_sale'); ?> </a></li>
                                            <li><a href="<?php echo base_url('report/stock'); ?>"> <?php echo $this->lang->line('das_menu_report_stock'); ?> </a></li>
                                            <li><a href="<?php echo base_url('report/income'); ?>"> <?php echo $this->lang->line('das_menu_report_income'); ?> </a></li>
                                            <li><a href="<?php echo base_url('report/expend'); ?>"> <?php echo $this->lang->line('das_menu_report_expend'); ?> </a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="menu_section">
                                <h3> <?php echo $this->lang->line('das_second_menu'); ?> </h3>
                                <ul class="nav side-menu">
                                    <li><a href="chartjs.html"> <?php echo $this->lang->line('das_second_menu_theme'); ?> </a></li>                 
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
                            <a data-toggle="tooltip" data-placement="top" title="Logout">
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
                            <!-- sitemap page -->
                            <div class="site-map">
                                <h3>Home</h3>
                            </div>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="<?php echo base_url('images/img.jpg'); ?>" alt=""><?php echo $user_info->merUseFullName; ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li>
                                            <?php
                                            if ($this->session->userdata('site_lang') == 'english') {
                                                ?>
                                                <a class="language-select" href="<?php echo base_url('language/switch-lang/khmer'); ?>">ខ្មែរ</a>
                                                <?php
                                            } else {
                                                ?>
                                                <a class="language-select" href="<?php echo base_url('language/switch-lang/english'); ?>">English</a>
                                                <?php
                                            }
                                            ?>
                                        </li>
                                        <li><a href="javascript:;"> <?php echo $this->lang->line('das_profile'); ?></a></li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="badge bg-red pull-right">50%</span>
                                                <span><?php echo $this->lang->line('das_setting'); ?></span>
                                            </a>
                                        </li>
                                        <li><a href="javascript:;"><?php echo $this->lang->line('das_help'); ?></a></li>
                                        <li><a href="<?php echo base_url('account/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> <?php echo $this->lang->line('das_logout'); ?></a></li>
                                    </ul>
                                </li>

                                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="badge bg-green">6</span>
                                    </a>
                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                        <li>
                                            <a>
                                                <span class="image"><img src="<?php echo base_url('images/img.jpg'); ?>" alt="Profile Image" /></span>
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
                                                <span class="image"><img src="<?php echo base_url('images/img.jpg'); ?>" alt="Profile Image" /></span>
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
                                                <span class="image"><img src="<?php echo base_url('images/img.jpg'); ?>" alt="Profile Image" /></span>
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
                                                <span class="image"><img src="<?php echo base_url('images/img.jpg'); ?>" alt="Profile Image" /></span>
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
                <!-- jQuery -->
                <script src="<?php echo base_url('vendors/jquery/dist/jquery.min.js'); ?>"></script>
                <!-- Bootstrap -->
                <script src="<?php echo base_url('vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
                <!-- FastClick -->
                <script src="<?php echo base_url('vendors/fastclick/lib/fastclick.js'); ?>"></script>
                <!-- NProgress -->
                <script src="<?php echo base_url('vendors/nprogress/nprogress.js'); ?>"></script>
                <!-- Chart.js -->
                <script src="<?php echo base_url('vendors/Chart.js/dist/Chart.min.js'); ?>"></script>

                <!-- gauge.js -->
                <script src="<?php echo base_url('vendors/gauge.js/dist/gauge.min.js'); ?>"></script>
                <!-- bootstrap-progressbar -->
                <script src="<?php echo base_url('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js'); ?>"></script>
                <!-- iCheck -->
                <script src="<?php echo base_url('vendors/iCheck/icheck.min.js'); ?>"></script>
                <!-- Skycons -->
                <script src="<?php echo base_url('vendors/skycons/skycons.js'); ?>"></script>
                <!-- Flot -->
                <!--
                <script src="../vendors/Flot/jquery.flot.js"></script>
                <script src="../vendors/Flot/jquery.flot.pie.js"></script>
                <script src="../vendors/Flot/jquery.flot.time.js"></script>
                <script src="../vendors/Flot/jquery.flot.stack.js"></script>
                <script src="../vendors/Flot/jquery.flot.resize.js"></script>
                -->
                <!-- Flot plugins -->
                <!--
                <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
                <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
                <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
                -->
                <!-- DateJS -->
                <script src="<?php echo base_url('vendors/DateJS/build/date.js'); ?>"></script>
                <!-- JQVMap -->
                <script src="<?php echo base_url('vendors/jqvmap/dist/jquery.vmap.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/jqvmap/dist/maps/jquery.vmap.world.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js'); ?>"></script>
                <!-- bootstrap-daterangepicker -->
                <script src="<?php echo base_url('vendors/moment/min/moment.min.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
                <!-- Datatables -->
                <script src="<?php echo base_url('vendors/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/datatables.net-buttons/js/dataTables.buttons.min.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/datatables.net-buttons/js/buttons.flash.min.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/datatables.net-buttons/js/buttons.html5.min.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/datatables.net-buttons/js/buttons.print.min.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/datatables.net-responsive/js/dataTables.responsive.min.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/datatables.net-scroller/js/datatables.scroller.min.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/jszip/dist/jszip.min.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/pdfmake/build/pdfmake.min.js'); ?>"></script>
                <script src="<?php echo base_url('vendors/pdfmake/build/vfs_fonts.js'); ?>"></script>
                <!-- bootstrap-dialog-master -->
                <script src="<?php echo base_url('vendors/bootstrap-dialog-master/dist/js/bootstrap-dialog.min.js'); ?>"></script>
                <script>
                    //set configuration set up
                    $(document).ready(function(){
                        //setting up bootstrap dialog type
                        BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_PRIMARY] = '<?php echo $this->lang->line('lab_confirmation'); ?>'; 
                        BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_DEFAULT] = '<?php echo $this->lang->line('lab_information'); ?>';
                        BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_INFO] = '<?php echo $this->lang->line('lab_information'); ?>';
                        BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_SUCCESS] = '<?php echo $this->lang->line('lab_success'); ?>';
                        BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_WARNING] = '<?php echo $this->lang->line('lab_warning'); ?>';
                        BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_DANGER] = '<?php echo $this->lang->line('lab_danger'); ?>';
                        BootstrapDialog.DEFAULT_TEXTS['OK'] = '<?php echo $this->lang->line('lab_button_ok'); ?>';
                        BootstrapDialog.DEFAULT_TEXTS['CANCEL'] = '<?php echo $this->lang->line('lab_button_cancel'); ?>';
                        BootstrapDialog.DEFAULT_TEXTS['CONFIRM'] = '<?php echo $this->lang->line('lab_button_confirm'); ?>';
                    });
                </script>
                <!-- Custom Theme Scripts -->
                <script src="<?php echo base_url('build/js/custom.min.js'); ?>"></script>

                <!-- Custom Scripts -->
                <script src="<?php echo base_url('js/script.js'); ?>"></script>

                <!-- Flot -->
                <!-- page content -->
                <div class="right_col" role="main">
                    <!-- load sub view -->
                    <?php
                    if ($this->session->flashdata('msg_success')) {
                        ?>
                        <div class="alert alert-success alert-dismissible fade in row col-md-12" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <?php echo $this->session->flashdata('msg_success'); ?>
                        </div>
                        <?php
                    }
                    if ($this->session->flashdata('msg_danger')) {
                        ?>
                        <div class="alert alert-danger alert-dismissible fade in row col-md-12" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <?php echo $this->session->flashdata('msg_danger'); ?>
                        </div>
                        <?php
                    }
                    if ($this->session->flashdata('msg_info')) {
                        ?>
                        <div class="alert alert-info alert-dismissible fade in row col-md-12" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <?php echo $this->session->flashdata('msg_info'); ?>
                        </div>
                        <?php
                    }
                    if ($this->session->flashdata('msg_warning')) {
                        ?>
                        <div class="alert alert-warning alert-dismissible fade in row col-md-12" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <?php echo $this->session->flashdata('msg_warning'); ?>
                        </div>
                        <?php
                    }
                    ?>

                    <?php //echo $this->session->userdata['user_info']; ?>
                    <?php
                    $segment_one = $this->uri->segment(1);
                    $segment_two = $this->uri->segment(2);
                    $this->load->view($segment_one . (($segment_two != NULL) ? '/' . str_replace('-', '_', $segment_two) : '/index'));
                    ?>
                </div>
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>


        <!--
        <script>
          $(document).ready(function() {
            var data1 = [
              [gd(2012, 1, 1), 17],
              [gd(2012, 1, 2), 74],
              [gd(2012, 1, 3), 6],
              [gd(2012, 1, 4), 39],
              [gd(2012, 1, 5), 20],
              [gd(2012, 1, 6), 85],
              [gd(2012, 1, 7), 7]
            ];
    
            var data2 = [
              [gd(2012, 1, 1), 82],
              [gd(2012, 1, 2), 23],
              [gd(2012, 1, 3), 66],
              [gd(2012, 1, 4), 9],
              [gd(2012, 1, 5), 119],
              [gd(2012, 1, 6), 6],
              [gd(2012, 1, 7), 9]
            ];
            $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
              data1, data2
            ], {
              series: {
                lines: {
                  show: false,
                  fill: true
                },
                splines: {
                  show: true,
                  tension: 0.4,
                  lineWidth: 1,
                  fill: 0.4
                },
                points: {
                  radius: 0,
                  show: true
                },
                shadowSize: 2
              },
              grid: {
                verticalLines: true,
                hoverable: true,
                clickable: true,
                tickColor: "#d5d5d5",
                borderWidth: 1,
                color: '#fff'
              },
              colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
              xaxis: {
                tickColor: "rgba(51, 51, 51, 0.06)",
                mode: "time",
                tickSize: [1, "day"],
                //tickLength: 10,
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10
              },
              yaxis: {
                ticks: 8,
                tickColor: "rgba(51, 51, 51, 0.06)",
              },
              tooltip: false
            });
    
            function gd(year, month, day) {
              return new Date(year, month - 1, day).getTime();
            }
          });
        </script>
        -->
        <!-- /Flot -->

        <!-- JQVMap -->
        <!--
        <script>
          $(document).ready(function(){
            $('#world-map-gdp').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#666666',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#E6F2F0', '#149B7E'],
                normalizeFunction: 'polynomial'
            });
          });
        </script>
        -->
        <!-- /JQVMap -->

        <!-- Skycons -->
        <!--
        <script>
          $(document).ready(function() {
            var icons = new Skycons({
                "color": "#73879C"
              }),
              list = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
              ],
              i;
    
            for (i = list.length; i--;)
              icons.set(list[i], list[i]);
    
            icons.play();
          });
        </script>
        -->
        <!-- /Skycons -->

        <!-- Doughnut Chart -->
        <!--
        <script>
          $(document).ready(function(){
            var options = {
              legend: false,
              responsive: false
            };
    
            new Chart(document.getElementById("canvas1"), {
              type: 'doughnut',
              tooltipFillColor: "rgba(51, 51, 51, 0.55)",
              data: {
                labels: [
                  "Symbian",
                  "Blackberry",
                  "Other",
                  "Android",
                  "IOS"
                ],
                datasets: [{
                  data: [15, 20, 30, 10, 30],
                  backgroundColor: [
                    "#BDC3C7",
                    "#9B59B6",
                    "#E74C3C",
                    "#26B99A",
                    "#3498DB"
                  ],
                  hoverBackgroundColor: [
                    "#CFD4D8",
                    "#B370CF",
                    "#E95E4F",
                    "#36CAAB",
                    "#49A9EA"
                  ]
                }]
              },
              options: options
            });
          });
        </script>
        -->
        <!-- /Doughnut Chart -->

        <!-- bootstrap-daterangepicker -->
        <script>
            $(document).ready(function () {

                var cb = function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                };

                var optionSet1 = {
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment(),
                    minDate: '01/01/2012',
                    maxDate: '12/31/2015',
                    dateLimit: {
                        days: 60
                    },
                    showDropdowns: true,
                    showWeekNumbers: true,
                    timePicker: false,
                    timePickerIncrement: 1,
                    timePicker12Hour: true,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    opens: 'left',
                    buttonClasses: ['btn btn-default'],
                    applyClass: 'btn-small btn-primary',
                    cancelClass: 'btn-small',
                    format: 'MM/DD/YYYY',
                    separator: ' to ',
                    locale: {
                        applyLabel: 'Submit',
                        cancelLabel: 'Clear',
                        fromLabel: 'From',
                        toLabel: 'To',
                        customRangeLabel: 'Custom',
                        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        firstDay: 1
                    }
                };
                $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
                $('#reportrange').daterangepicker(optionSet1, cb);
                $('#reportrange').on('show.daterangepicker', function () {
                    console.log("show event fired");
                });
                $('#reportrange').on('hide.daterangepicker', function () {
                    console.log("hide event fired");
                });
                $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                    console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
                });
                $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
                    console.log("cancel event fired");
                });
                $('#options1').click(function () {
                    $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
                });
                $('#options2').click(function () {
                    $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
                });
                $('#destroy').click(function () {
                    $('#reportrange').data('daterangepicker').remove();
                });
            });
        </script>
        <!-- /bootstrap-daterangepicker -->

        <!-- gauge.js -->
        <!--
        <script>
          var opts = {
              lines: 12,
              angle: 0,
              lineWidth: 0.4,
              pointer: {
                  length: 0.75,
                  strokeWidth: 0.042,
                  color: '#1D212A'
              },
              limitMax: 'false',
              colorStart: '#1ABC9C',
              colorStop: '#1ABC9C',
              strokeColor: '#F0F3F3',
              generateGradient: true
          };
          var target = document.getElementById('foo'),
              gauge = new Gauge(target).setOptions(opts);
    
          gauge.maxValue = 6000;
          gauge.animationSpeed = 32;
          gauge.set(3200);
          gauge.setTextField(document.getElementById("gauge-text"));
        </script>
        -->
        <!-- /gauge.js -->

        <!-- custom -->
        <script>
            $('.language-select').click(function () {
                var $url = $(this).attr('href');
                $.ajax({
                    method: "POST",
                    url: $url,
                    data: {ajax_request: ''}
                }).done(function (data) {
                    location.reload();
                });
            });
        </script>
        <?php
        //load custom javascript
        if ($segment_one != NULL) {
            ?>
            <script type="text/javascript" src="<?php echo base_url('js/' . str_replace('-', '_', $segment_one) . '/script.js'); ?>"></script>
            <?php
        }
        ?>
    </body>
</html>
