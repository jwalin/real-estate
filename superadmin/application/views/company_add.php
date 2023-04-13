<style>
    #p_msg, #e_msg, #email_err
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
<div class="content container-fluid">

    <!-- Page Header -->

    <!-- /Page Header -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Company </h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('company/insert'); ?>" method="post" onsubmit="return validateform()" enctype="multipart/form-data" autocomplete="off">
                        <div class="form-group row" style="margin-top: 20px;">
                            <label class="col-form-label col-md-2">Company Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="company_name" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Company Logo</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control" name="company_logo" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Email</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" name="email" id="email" required="">
                                <p id="email_err">Email already exists.</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Confirm Email</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" name="c_email" id="c_email" required="">
                                <p id="e_msg">Email and confirm email not match.</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Password</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" name="password" id="password" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Confirm Password</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" name="c_password" id="c_password" required="">
                                <p id="p_msg">Password and confirm password not match.</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Status</label>
                            <div class="col-lg-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_1" value="1" required=""><br>
                                    <label class="form-check-label" for="status_1">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_2" value="2" required="">
                                    <label class="form-check-label" for="status_2">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="<?php echo base_url('company'); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                            <button type="submit" class="btn btn-primary" id="save_id_dis">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
    $("#email").on('keyup blur', function () {
        var email = $('#email').val();
        $.ajax({
            url: '<?= base_url() . 'company/check_user_email/' ?>',
            data: {email: email},
            type: 'post',
            success: function (data) {
                if (data == 1) {
                    $('#email_err').show();
                } else {
                    $('#email_err').hide();
                }
            }
        });
    });

    function validateform() {
        var password = $('#password').val();
        var confirm_password = $('#c_password').val();
        var email = $('#email').val();
        var c_email = $('#c_email').val();

        if (email == c_email)
        {
            document.getElementById('e_msg').style.display = "none";
            $("#save_id_dis").attr('disabled', true);
        } else
        {
            document.getElementById('e_msg').style.display = "block";
            $("#save_id_dis").attr('disabled', false);
            return false;
        }

        if (password == confirm_password)
        {
            document.getElementById('p_msg').style.display = "none";
            $("#save_id_dis").attr('disabled', true);
        } else
        {
            document.getElementById('p_msg').style.display = "block";
            $("#save_id_dis").attr('disabled', false);
            return false;
        }

        if (document.getElementById('email_err').style.display == "block") {
            $("#save_id_dis").attr('disabled', false);
            return false;
        } else {
            $("#save_id_dis").attr('disabled', true);
            return true;
        }
    }
</script>