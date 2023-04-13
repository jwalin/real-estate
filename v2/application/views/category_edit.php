<div class="content container-fluid">

    <!-- Page Header -->

    <!-- /Page Header -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Category </h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('category/update'); ?>" method="post">
                        <input type="hidden" class="form-control" name="id" value="<?php echo $data->id; ?>">
                        <div class="form-group row" style="margin-top: 20px;">
                            <label class="col-form-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="category_name" value="<?php echo $data->category_name; ?>" required="">
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="<?php echo base_url('category'); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>