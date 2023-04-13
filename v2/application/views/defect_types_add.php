<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/select2.min.css">
<style>
    .select2-container--default .select2-selection--multiple{
        background: #fff !important;
        border: 1px solid #ced4da !important;
        min-height: 45px;
    }
</style>
<div class="content container-fluid">

    <!-- Page Header -->

    <!-- /Page Header -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Defect Type </h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('defect_types/insert'); ?>" method="post">
                        <div class="form-group row" style="margin-top: 20px;">
                            <label class="col-form-label col-md-2">Defect</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="defect_type" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Trade Category</label>
                            <div class="col-md-10">
                                <select class="form-control" name="category_id" required="">
                                    <option value="">Select Category</option>
                                    <?php foreach ($data_category as $row_category){ ?>
                                    <option value="<?php echo $row_category->id; ?>"><?php echo $row_category->category_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Defect Location</label>
                            <div class="col-md-10">
                                <select class="form-control" name="location" required="" data-placeholder="Select Location">
                                    <option value="">Select Location</option>
                                    <?php foreach ($data_location as $row_location) { ?>
                                        <option value="<?php echo $row_location->id; ?>"><?php echo $row_location->defect_location; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
<!--                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Defect Location</label>
                            <div class="col-md-10">
                                <select class="form-control basic" multiple="" name="location[]" required="" data-placeholder="Select Location">
                                    <?php foreach ($data_location as $row_location) { ?>
                                        <option value="<?php echo $row_location->id; ?>"><?php echo $row_location->defect_location; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>-->
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Closing Hold?</label>
                            <div class="col-lg-10" style="margin-top: 7px;">
                                <div class="form-check form-check-inline pr-4">
                                    <input class="form-check-input" type="radio" name="closing_hold" id="status_1" value="1" required=""><br>
                                    <label class="form-check-label" for="status_1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="closing_hold" id="status_2" value="2" required="">
                                    <label class="form-check-label" for="status_2">
                                        No
                                    </label>
                                </div>
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
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<script>
    $(".basic").select2();
</script>