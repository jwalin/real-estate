<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Slap</title>

    <!-- Favicon icon -->

    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/slap_logo.png">

    <!-- Pignose Calender -->

    <link href="<?php echo base_url(); ?>assets/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">

    <!-- Chartist -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/chartist/css/chartist.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">

    <!-- Custom Stylesheet -->

    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">



<link href="<?php echo base_url(); ?>assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">

<style>

   .btn-primary, .btn-info{

    color: #fff;

    background-color: #EB5C47 !important;

    border-color: #EB5C47 !important;

} 

 a i{

    color: #EB5C47 !important;

}



.page-item.active .page-link{

    background: #EB5C47 !important;

}

.paging_simple_numbers .pagination .paginate_button a{

    color: #EB5C47 !important;

}

.paging_simple_numbers .pagination .paginate_button.active a{

    color: #fff !important;

} 

.badge-primary{

    background: #EB5C47 !important;

}

.nk-sidebar .metismenu > li.active > a{

    background: #EB5C47 !important;

    color: #fff !important;

}

.nk-sidebar .metismenu a:hover, .nk-sidebar .metismenu a:active, .nk-sidebar .metismenu a.active {

    text-decoration: none;

    background-color: #EB5C47 !important;

}

.nk-sidebar .metismenu > li > a {

    transition: none;

    border-bottom: 1px solid silver;

}

.nk-sidebar .metismenu > li ul li.active a{color: #fff !important;    background-color: #EB5C47 !important;}

.card-title{padding-left: 15px !important}

.nk-sidebar .metismenu > li:hover span, .nk-sidebar .metismenu > li:focus span, .nk-sidebar .metismenu > li.active span{color: #fff !important}

.nk-sidebar .metismenu > li:hover i, .nk-sidebar .metismenu > li:focus i, .nk-sidebar .metismenu > li.active i{color:#fff !important}

.cust_theme_a a:hover{
    color: #EB5C47 !important;
}
</style>

</head>



<body>



    <!--*******************

        Preloader start

    ********************-->

<!--    <div id="preloader">

        <div class="loader">

            <svg class="circular" viewBox="25 25 50 50">

                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />

            </svg>

        </div>

    </div>-->

    <!--*******************

        Preloader end

    ********************-->



    

    <!--**********************************

        Main wrapper start

    ***********************************-->

    <div id="main-wrapper">



        <!--**********************************

            Nav header start

        ***********************************-->

        <div class="nav-header" style="background-color: #fff;">

            <div class="brand-logo">

                <a href="dashboard">

                    <b class="logo-abbr"><img src="<?php echo base_url(); ?>assets/images/slap_logo.png" alt=""> </b>

                    <span class="logo-compact"><img src="<?php echo base_url(); ?>assets/images/slap_logo.png" alt=""></span>

                    <span class="brand-title">

                        <img src="<?php echo base_url(); ?>assets/images/slap_logo.png" style="width: 90%;right: -10px;position: relative;top: -20px;" alt="">

                    </span>

                </a>

            </div>

        </div>

        <!--**********************************

            Nav header end

        ***********************************-->



        <!--**********************************

            Header start

        ***********************************-->

        <div class="header">    

            <div class="header-content clearfix">

                

                <div class="header-left" style="margin-left: 0;">

                    <div style="border: 1px solid #EB5C47;

    border-radius: 10pc;

    padding: 5px 45px;

    font-size: 20px;

    font-weight: bold;

    color: #EB5C47;

    margin-top: 20px;">Admin Control Panel</div>

                </div>

                

                <div class="header-right">

                    <ul class="clearfix">

                        

                       

                        <li class="icons dropdown">

                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">

                                <span class="activity active"></span>

                                <img src="<?php echo base_url(); ?>assets/images/slap_logo.png" height="40" width="40" alt="">

                            </div>

                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">

                                <div class="dropdown-content-body cust_theme_a">

                                    <ul>

                                        

                                        <li>

                                            <a href="<?php echo base_url('index.php/login/update_password') ?>"><i class="icon-lock"></i> <span>Change password</span></a>

                                        </li>

                                        <li><a href="<?php echo base_url('index.php/login/logout') ?>"><i class="icon-key"></i> <span>Logout</span></a></li>

                                    </ul>

                                </div>

                            </div>

                        </li>

                    </ul>

                </div>

            </div>

        </div>