<style>
    #p_msg, #e_msg
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
                    <h4 class="card-title mb-0">Edit Trade User </h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('trade_user/update'); ?>" method="post" onsubmit="return validateform()">
                        <input type="hidden" class="form-control" name="id" value="<?php echo $data_row->id; ?>">
                        <div class="form-group row" style="margin-top: 20px;">
                            <label class="col-form-label col-md-2">Trade Partner</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="partner_id" required="">
                                    <option value="">Select Partner</option>
                                    <?php foreach ($data as $row) { ?>
                                        <option value="<?php echo $row->id; ?>" <?php if($data_row->partner_id == $row->id){ echo 'selected'; } ?>><?php echo $row->partner_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" required="" value="<?php echo $data_row->name; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Email</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $data_row->email; ?>" disabled="">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Status</label>
                            <div class="col-lg-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_1" value="1" required="" <?php if($data_row->status == 1){ echo 'checked'; } ?>><br>
                                    <label class="form-check-label" for="status_1">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_2" value="2" required="" <?php if($data_row->status == 2){ echo 'checked'; } ?>>
                                    <label class="form-check-label" for="status_2">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            <a href="<?php echo base_url('trade_user'); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
