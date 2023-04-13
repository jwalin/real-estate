<html>
    <head>
        <title>EZQC | Login</title>
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

                    <div class="account-logo" style="margin-top: 2%;">
                        <img src="<?php echo base_url(); ?>assets/images/logo.jpg" alt="Logo">
                    </div>

                    <div class="account-box">
                        <div class="account-wrapper">
                            <h3 class="account-title">Login</h3>
                            <p class="account-subtitle">Access to our dashboard</p>

                            <?php if ($this->session->flashdata('success')) { ?>
                                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?>
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                </div>
                            <?php } if ($this->session->flashdata('error')) { ?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                            <?php } ?>

                            <form action="<?php echo base_url('login/loginprocess'); ?>" method="post"><!--class="was-validated"-->
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="form-control" type="email" name="email" required="">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label>Password</label>
                                        </div>
                                        <div class="col-auto">
                                            <a class="text-muted" href="<?php echo base_url('login/forgot_password'); ?>">
                                                Forgot password?
                                            </a>
                                        </div>
                                    </div>
                                    <input class="form-control" type="password" name="password" required="">
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary account-btn" type="submit">Login</button>
                                </div>
                            </form>

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
    </body>
</html>