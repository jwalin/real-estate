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
<div class="content container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Change Password</h4>
                </div>
                <div class="card-body mt-3">    
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    <?php } if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php } ?>
                    <form action="<?php echo base_url('login/update_change_password'); ?>" method="post" onsubmit="return validateform()">
                        <input type="hidden" name="sess_id" value="<?php echo $this->session->userdata('id'); ?>">
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Old Password</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" name="o_password" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">New Password</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" id="password" name="n_password" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Confirm Password</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" id="confirm_password" name="c_password" required="">
                                <p id="p_msg">Password and confirm password not match.</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
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