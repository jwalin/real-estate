<div class="content container-fluid">

    <!-- Page Header -->

    <!-- /Page Header -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Defect Type </h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('defect_types/update'); ?>" method="post">
                        <input type="hidden" class="form-control" name="id" value="<?php echo $data->id; ?>">
                        <div class="form-group row" style="margin-top: 20px;">
                            <label class="col-form-label col-md-2">Name of type</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="defect_type" value="<?php echo $data->defect_type; ?>" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Trade Category</label>
                            <div class="col-md-10">
                                <select class="form-control" name="category_id" required="">
                                    <option value="">Select Category</option>
                                    <?php foreach ($data_category as $row_category){ ?>
                                    <option value="<?php echo $row_category->id; ?>" <?php if($data->category_id == $row_category->id){ echo 'selected'; } ?>><?php echo $row_category->category_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="<?php echo base_url('defect_types'); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>