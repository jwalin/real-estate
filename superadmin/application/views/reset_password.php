<?php
$id = $this->uri->segment(3);
$makeId = substr($id, 5, -5);
$userId = base64_decode($makeId);
$curdatetime = date('Y-m-d H:i:s');
$time = base64_decode($this->uri->segment(4));
$endTime = date('Y-m-d H:i:s', strtotime('+60 minutes', strtotime($time)));

if ($this->uri->segment(3) == "" || $this->uri->segment(4) == "") {
    redirect('login/reset_password_expire/');
} else if ($curdatetime > $endTime) {
    redirect('login/reset_password_expire/');
} else {
    ?>
    <html>
        <head>
            <title>EZQC | Reset Password</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" href="<?php echo base_url(); ?>assets/images/logo.jpg" type="image/x-icon" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
            <style>
                #p_msg
                {
                    display: none;
                    clear: both;
                    text-align: left;
                    width: 100%;
                    color: #ff0000;
                    font-size: 11px;
                    letter-spacing: 0.5px;
                    margin-bottom: 0;
                }
            </style>
        </head>
        <body>
            <!-- Main Wrapper -->
            <div class="main-wrapper">

                <div class="account-content">

                    <div class="container">

                        <div class="account-logo" style="margin-top: 8%;">
                            <img src="<?php echo base_url(); ?>assets/images/logo.jpg" alt="Logo">
                        </div>

                        <div class="account-box">
                            <div class="account-wrapper">
                                <h3 class="account-title">Reset Password</h3>
                                <p class="account-subtitle">Reset your password</p>

                                <form action="<?php echo base_url('login/resetprocess'); ?>" method="post" onsubmit="return validateform()">
                                    <input type="hidden" name="id" value="<?php echo $userId; ?>">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input class="form-control" type="password" id="password" name="new_password" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input class="form-control" type="password" id="confirm_password" name="confirm_password" required="">
                                        <p id="p_msg">Password and confirm password not match.</p>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary account-btn" type="submit">Submit</button>
                                    </div>
                                    <div class="account-footer">
                                        <p>Remember your password? <a href="<?php echo base_url('login'); ?>">Login</a></p>
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

            <script>
                                        function validateform() {
                                            var password = $('#password').val();
                                            var confirm_password = $('#confirm_password').val();

                                            if (password == confirm_password)
                                            {
                                                document.getElementById('p_msg').style.display = "none";
                                            } else
                                            {
                                                document.getElementById('p_msg').style.display = "block";
                                                return false;
                                            }
                                        }
            </script>
        </body>
    </html>
<?php } ?>