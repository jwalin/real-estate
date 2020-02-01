<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Real Estate</title>

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

    </head>
    <body>
        <!-- Main Wrapper -->
        <div class="main-wrapper">

            <div class="header" style="background-color: #fff !important; ">

                <!-- Logo -->
                <div class="header-left" style="margin-top: 10px;">
                    <a href="index.html" class="logo">
                        <img src="<?php echo base_url(); ?>assets/images/logo.jpg" width="60" height="50" alt="">
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
                    <h3 style="color: #25337A;">Real Estate</h3>
                </div>
                <!-- /Header Title -->

                <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

                <!-- Header Menu -->
                <ul class="nav user-menu">

                    <!-- Search -->
                   
                    <!-- /Search -->

                    <!-- Flag -->
                    <!--                    <li class="nav-item dropdown has-arrow flag-nav">
                                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                                                <img src="<//?php echo base_url(); ?>assets/images/flags/us.png" alt="" height="20"> <span>English</span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <img src="assets/img/flags/us.png" alt="" height="16"> English
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <img src="assets/img/flags/fr.png" alt="" height="16"> French
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <img src="assets/img/flags/es.png" alt="" height="16"> Spanish
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <img src="assets/img/flags/de.png" alt="" height="16"> German
                                                </a>
                                            </div>
                                        </li>-->
                    <!-- /Flag -->

                    <!-- Notifications -->

                    <!-- /Notifications -->
                    <li class="nav-item dropdown">
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
                                        <a href="activities.html">
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
                                        <a href="activities.html">
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
                                        <a href="activities.html">
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
                                <a href="activities.html">View all Notifications</a>
                            </div>
                        </div>
                    </li>
                    <!-- Message Notifications -->

                    <!-- /Message Notifications -->

                    <li class="nav-item dropdown has-arrow main-drop">
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
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?php echo base_url('login/update_password'); ?>">Change Password</a>
                        <a class="dropdown-item" href="<?php echo base_url('login'); ?>">Logout</a>
                    </div>
                </div>
                <!-- /Mobile Menu -->

            </div>
            <div class="page-wrapper">