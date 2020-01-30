<html class="h-100" lang="en">



        <head>

            <meta charset="utf-8">

            <meta http-equiv="X-UA-Compatible" content="IE=edge">

            <meta name="viewport" content="width=device-width,initial-scale=1">

            <title>Slap | Login</title>

            <!-- Favicon icon -->

            <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/slap_logo.png">

            <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->

            <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">



        </head>



        <body class="h-100">



            <!--*******************

                Preloader start

            ********************-->

            <div id="preloader">

                <div class="loader">

                    <svg class="circular" viewBox="25 25 50 50">

                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />

                    </svg>

                </div>

            </div>
            <div class="login-form-bg h-100">

                <div class="container h-100">

                    <div class="row justify-content-center h-100">

                        <div class="col-xl-5">

                            <div class="form-input-content">

                                <div class="card login-form mb-0" style="background: #ffff;  border: 1px solid #EB5C47;">

                                    <div class="card-body pt-4" style="text-align: center;"> 

                                        <img src="<?php echo base_url() ?>assets/images/airplane_logo.png" style="width: 35%;" class="img-responsive">

                                        <h4 style=" margin-top: 15px;

                                            border-top: 1px solid #EB5C47;

                                            padding: 5px;

                                            color: #EB5C47;

                                            border-bottom: 1px solid #EB5C47;">Password Expired</h4>



                                        <form class="mt-5 mb-5 login-input" action="<?php echo base_url('Login'); ?>" method="post">

                                            <?php if ($this->session->flashdata('success')) { ?>

                                                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>

                                            <?php } if ($this->session->flashdata('error')) { ?>

                                                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>

                                            <?php } ?>

                                            <div class="form-group">

                                                <h3 style="color: #EE2324;">Your reset password link is expired.</h3>

                                            </div>
                                            <button type="submit" class="btn login-form__btn submit w-100" style="background: #EB5C47">Login</button>

                                        </form>


                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <script src="<?php echo base_url(); ?>assets/plugins/common/common.min.js"></script>

            <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>

            <script src="<?php echo base_url(); ?>assets/js/settings.js"></script>

            <script src="<?php echo base_url(); ?>assets/js/gleek.js"></script>

            <script src="<?php echo base_url(); ?>assets/js/styleSwitcher.js"></script>

        </body>

    </html>