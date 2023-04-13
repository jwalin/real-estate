<html>
    <head>
        <title>EZQC | Forgot Password</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo base_url(); ?>assets/images/logo.jpg" type="image/x-icon" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    </head>
    <body>
        <!-- Main Wrapper -->
        <div class="main-wrapper">

            <div class="account-content">

                <div class="container">

                    <!-- Account Logo -->
                    <div class="account-logo" style="margin-top: 8%;">
                        <img src="<?php echo base_url(); ?>assets/images/logo.jpg" alt="Logo">
                    </div>
                    <!-- /Account Logo -->

                    <div class="account-box">
                        <div class="account-wrapper">
                            <h3 class="account-title">Forgot Password?</h3>
                            <p class="account-subtitle">Enter your email to get a password reset link</p>

                            <?php if ($this->session->flashdata('success')) { ?>
                                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?>
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                </div>
                            <?php } if ($this->session->flashdata('error')) { ?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                            <?php } ?>
                            <!-- Account Form -->
                            <form action="<?php echo base_url('login/forgot_password_process'); ?>" method="post" id="form_id_dis">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="form-control" type="email" name="email" required="">
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary account-btn" type="submit" id="save_id_dis">Submit</button>
                                </div>
                                <div class="account-footer">
                                    <p>Remember your password? <a href="<?php echo base_url('login'); ?>">Login</a></p>
                                </div>
                            </form>
                            <!-- /Account Form -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Main Wrapper -->

        <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/summernote-bs4.min.js"></script>
        <script>
            $("form#form_id_dis").submit(function () {
                $("#save_id_dis").attr('disabled', true);
            });
        </script>

    </body>
</html>