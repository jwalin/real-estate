<div class="content container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Lot </h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('lots/update'); ?>" method="post">
                        <input type="hidden" class="form-control" name="id" value="<?php echo $data->id; ?>">
                        <div class="form-group row" style="margin-top: 20px;">
                            <label class="col-form-label col-md-2">Tract No.</label>
                            <div class="col-md-10">
                                <select class="form-control" name="tract_id" required="">
                                    <option value="">Select Tract No.</option>
                                    <?php foreach ($data_tract as $row_tract) { ?>
                                        <option value="<?php echo $row_tract->id; ?>" <?php if($row_tract->id == $data->tract_id){ echo 'selected'; } ?>><?php echo $row_tract->tract_no; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Lot No.</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="lot_no" value="<?php echo $data->lot_no; ?>" required="" onkeypress="return isNumberKey(event)">
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="<?php echo base_url('lots'); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

