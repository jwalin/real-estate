<div class="content container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Tract </h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('tracts/insert'); ?>" method="post">
                        <div class="form-group row" style="margin-top: 20px;">
                            <label class="col-form-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Tract No.</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="tract_no" required="" onkeypress="return isNumberKey(event)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-12 theme_color">Trade Category - Trade Partner Associations</label>
                        </div>
                        
                        <?php foreach ($data_category as $row_category){ ?>
                        
                        <div class="form-group row">
                            <input type="hidden" name="category_id[]" value="<?php echo $row_category->id; ?>">
                            <label class="col-form-label col-md-2"><?php echo $row_category->category_name; ?></label>
                            <div class="col-md-10">
                                <select class="form-control" name="partner_id[]">
                                    <option value="">Select Partner</option>
                                    <?php foreach ($data_partner as $row_partner){ ?>
                                    <option value="<?php echo $row_partner->id; ?>"><?php echo $row_partner->partner_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <?php } ?>
                        
                        <div class="text-right">
                            <a href="<?php echo base_url('tracts'); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>