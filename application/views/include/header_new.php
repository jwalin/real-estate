<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link rel="icon" href="<?php echo base_url(); ?>assets/images/logo.jpg" type="image/x-icon" />
        
        <?php $sess_company_data = $this->info_model->get_company_data(); ?>
        <title>EZQC | <?php echo @$sess_company_data->company_name; ?></title>

        <!-- Bootstrap CSS -->
        <!--<link rel="stylesheet" href="https://dreamguys.co.in/smarthr/orange/assets/css/bootstrap.min.css">-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">

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

        <!-- Datatable CSS -->
        <!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap4.min.css">-->

        <!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
        <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
        <style>
            .theme_color{color: #25337A !important;}
            .clearfix{clear: both !important;}
            .logo_img_middle{width: 25%;margin-top: 10px;}
            @media (min-width: 769px) and (max-width: 991px){
                .logo_img_middle{width: 42px !important;}
                .moibile_pro_menu .user-img{
                    margin-top: 15px;
                }
            }
            @media (max-width: 768px){
                .logo_img_middle{width: 42px !important;}
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
            thead{border-top: 2px solid #dee2e6;}
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
                    <h3 style="color: #25337A;">
                        <?php
                        $sess_company_data = $this->info_model->get_company_data();
                        echo @$sess_company_data->company_name;
                        ?>
                    </h3>
                </div>
                <!-- /Header Title -->

                <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

                <!-- Header Menu -->
                <ul class="nav user-menu">
                    <li class="nav-item dropdown moibile_not_menu" style="display: none;">
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
                    <?php 
//                    $company_data = $this->info_model->get_company_data($this->company_id);
                    $user_data = $this->info_model->get_user_data(@$this->sess_id);
//                    print_r($company_data);exit;
                    ?>
                    <li class="nav-item dropdown has-arrow main-drop moibile_pro_menu">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span class="user-img">
                                <!--<img src="</?=($company_data->company_logo) ? $company_data->company_logo : base_url().'assets/images/profile/avatar.png'; ?>" alt="">-->
                                <img src="<?php echo base_url().'assets/images/profile/avatar.png'; ?>" alt="">
                                <span class="status online"></span>
                            </span>
                            <span><?php echo @$user_data->name; ?></span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo base_url('login/change_password'); ?>">Change Password</a>
                            <a class="dropdown-item" href="<?php echo base_url('login/logout'); ?>">Logout</a>
                        </div>
                    </li>
                </ul>
                <!-- /Header Menu -->

                <!-- Mobile Menu -->
                <div class="dropdown mobile-user-menu">
                    <!--<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>-->
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?php echo base_url('login/change_password'); ?>">Change Password</a>
                        <a class="dropdown-item" href="<?php echo base_url('login/logout'); ?>">Logout</a>
                    </div>
                </div>
                <!-- /Mobile Menu -->

            </div>
            <div class="page-wrapper">