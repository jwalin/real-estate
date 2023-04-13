<div class="content container-fluid">

    <!-- Page Header -->

    <!-- /Page Header -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Profile</h4>
                </div>
                <div class="card-body mt-3">
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    <?php } if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php } ?>
                    <form action="<?php echo base_url('profile/update_profile'); ?>" method="post">
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" value="<?php echo $data->name; ?>" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Email</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" name="email" value="<?php echo $data->email; ?>" disabled="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Phone</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="phone" value="<?php echo $data->phone; ?>" required="">
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="<?php echo base_url('profile'); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>