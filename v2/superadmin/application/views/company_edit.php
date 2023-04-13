<div class="content container-fluid">

    <!-- Page Header -->

    <!-- /Page Header -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Company </h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('company/update'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="id" value="<?php echo $data_row->id; ?>">
                        <input type="hidden" class="form-control" name="company_id" value="<?php echo $data_row->company_id; ?>">
                        <div class="form-group row" style="margin-top: 20px;">
                            <label class="col-form-label col-md-2">Company Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="company_name" required="" value="<?php echo $data_row->company_name; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Company Logo</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control" name="company_logo">
                                <input type="hidden" class="form-control" name="company_logo_old" value="<?php echo $data_row->company_logo; ?>">
                                <img src="<?php echo $data_row->company_logo; ?>" class="img-thumbnail mt-3" width="150px">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" required="" value="<?php echo $data_row->name; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Email</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" name="email" id="email" disabled=""  value="<?php echo $data_row->email; ?>">
                            </div>
                        </div>
						<div class="form-group row">
                            <label class="col-form-label col-md-2">Status</label>
                            <div class="col-lg-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_1" value="1" required="" <?php if($data_row->company_status == 1){ echo 'checked'; } ?>><br>
                                    <label class="form-check-label" for="status_1">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_2" value="2" required="" <?php if($data_row->company_status == 2){ echo 'checked'; } ?>>
                                    <label class="form-check-label" for="status_2">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="<?php echo base_url('company'); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>