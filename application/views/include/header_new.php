<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link rel="icon" href="<?php echo base_url(); ?>assets/images/logo.jpg" type="image/x-icon" />
        <title>EZQC | De Young Properties</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://dreamguys.co.in/smarthr/orange/assets/css/bootstrap.min.css">

        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">

        <!-- Lineawesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/line-awesome.min.css">

        <!-- Select2 CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.min.css">

        <!-- Datetimepicker CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css">

        <!-- Tagsinput CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/summernote-bs4.css">
        <!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
        <style>
            .logo_img_middle{width: 25%;}
            @media (max-width: 768px){
                .logo_img_middle{width: 14% !important;}
                .nav.user-menu{ 
                    display: block !important;
                    margin: 0;
                    margin-top: 5px;
                }
                .user-menu.nav > li > a > i {
                    line-height: 65px;
                }
                .moibile_not_menu{
                    float: left;
                }
                .moibile_pro_menu{
                    float: right;
                }
                .mobile-user-menu > a {
                    color: #212E6E !important;
                }
                .moibile_pro_menu .user-img{
                    margin-top: 15px;
                }
            }
            .user-menu.nav > li > a {
                line-height: 70px;
                height: 70px;
            }
            .user-menu.nav > li > a > i {
                line-height: 75px;
            }
            .user-menu.nav > li > a .badge {
                top: 14px;
            }
        </style>
    </head>
    <body>
        <!-- Main Wrapper -->
        <div class="main-wrapper">

            <div class="header" style="background-color: #fff !important; ">

                <!-- Logo -->
                <div class="header-left" style="margin-top: 0px;">
                    <a href="<?php echo base_url('home'); ?>" class="logo">
                        <img src="<?php echo base_url(); ?>assets/images/logo.jpg" class="logo_img_middle" alt="">
                    </a>
                </div>
                <!-- /Logo -->

                <a id="toggle_btn" href="javascript:void(0);" style="margin-top: 27px;">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>

                <!-- Header Title -->
                <div class="page-title-box">
                    <h3 style="color: #25337A;">De Young Properties</h3>
                </div>
                <!-- /Header Title -->

                <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

                <!-- Header Menu -->
                <ul class="nav user-menu">
                    <li class="nav-item dropdown moibile_not_menu">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i> <span class="badge badge-pill">3</span>
                        </a>
                        <div class="dropdown-menu notifications">
                            <div class="topnav-dropdown-header">
                                <span class="notification-title">Notifications</span>
                                <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                            </div>
                            <div class="noti-content">
                                <ul class="notification-list">
                                    <li class="notification-message">
                                        <a href="#">
                                            <div class="media">
                                                <span class="avatar">
                                                    <img alt="" src="<?php echo base_url(); ?>assets/images/profile/not-1.jpg">
                                                </span>
                                                <div class="media-body">
                                                    <p class="noti-details"><span class="noti-title">Tarah Shropshire</span> added new task <span class="noti-title">Patient appointment booking</span></p>
                                                    <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="notification-message">
                                        <a href="#">
                                            <div class="media">
                                                <span class="avatar">
                                                    <img alt="" src="<?php echo base_url(); ?>assets/images/profile/not-2.jpg">
                                                </span>
                                                <div class="media-body">
                                                    <p class="noti-details"><span class="noti-title">Misty Tison</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
                                                    <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="notification-message">
                                        <a href="#">
                                            <div class="media">
                                                <span class="avatar">
                                                    <img alt="" src="<?php echo base_url(); ?>assets/images/profile/not-3.jpg">
                                                </span>
                                                <div class="media-body">
                                                    <p class="noti-details"><span class="noti-title">John Doe</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
                                                    <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>
                            <div class="topnav-dropdown-footer">
                                <a href="#">View all Notifications</a>
                            </div>
                        </div>
                    </li>
                    <!-- Message Notifications -->
                    
                    <!-- /Message Notifications -->

                    <li class="nav-item dropdown has-arrow main-drop moibile_pro_menu">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span class="user-img"><img src="<?php echo base_url(); ?>assets/images/profile/avatar-21.jpg" alt="">
                                <span class="status online"></span></span>
                            <span>Admin</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo base_url('login/update_password'); ?>">Change Password</a>
                            <a class="dropdown-item" href="<?php echo base_url('login'); ?>">Logout</a>
                        </div>
                    </li>
                </ul>
                <!-- /Header Menu -->

                <!-- Mobile Menu -->
                <div class="dropdown mobile-user-menu">
                    <!--<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>-->
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?php echo base_url('login/update_password'); ?>">Change Password</a>
                        <a class="dropdown-item" href="<?php echo base_url('login'); ?>">Logout</a>
                    </div>
                </div>
                <!-- /Mobile Menu -->

            </div>
            <div class="page-wrapper">