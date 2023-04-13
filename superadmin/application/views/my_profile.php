<style>
    #e_msg
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
                    <h4 class="card-title mb-0">Profile</h4>
                </div>
                <div class="card-body mt-3">    
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    <?php } if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php } ?>
                    <form action="<?php echo base_url('login/update_profile'); ?>" method="post" onsubmit="return validateform()">
                        <input type="hidden" name="sess_id" value="<?php echo $this->session->userdata('id'); ?>">
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" value="<?php echo $data->name; ?>" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Email</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $data->email; ?>" required="">
                            </div>
                        </div>
						<div class="form-group row">
                            <label class="col-form-label col-md-2">Confirm Email</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" name="c_email" id="c_email" value="" required="">
								<p id="e_msg">Email and confirm email not match.</p>
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
	var email = $('#email').val();
	var c_email = $('#c_email').val();

	if (email == c_email)
	{
		document.getElementById('e_msg').style.display = "none";
	} else
	{
		document.getElementById('e_msg').style.display = "block";
		return false;
	}
}
</script>