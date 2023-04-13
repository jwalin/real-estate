<div class="content container-fluid">

    <!-- Page Header -->

    <!-- /Page Header -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit User </h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('builder/update'); ?>" method="post">
                        <input type="hidden" class="form-control" name="id" value="<?php echo $data_row->id; ?>">
                        <div class="form-group row" style="margin-top: 20px;">
                            <label class="col-form-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" required="" value="<?php echo $data_row->name; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Email</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" name="email" id="email" disabled=""  value="<?php echo $data_row->email; ?>">
                            </div>
                        </div>
                        <?php
                            if($data_row->type == 1){
                                $disabled = 'disabled';
                                echo '<input type="hidden" class="form-control" name="type" value="'.$data_row->type.'"> <input type="hidden" class="form-control" name="status" value="'.$data_row->status.'">';
                            }else{
                                $disabled = '';
                            }
                        ?>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Type</label>
                            <div class="col-md-10">
                                <select class="form-control" name="type" required="" id="user_type" <?php echo $disabled; ?>>
                                    <option value="">Select Type</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Normal user</option>
                                    <option value="3">Read only user</option>
                                </select>
                                <script>document.getElementById('user_type').value = <?php echo $data_row->type; ?>;</script>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Status</label>
                            <div class="col-lg-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_1" value="1" required="" <?php if($data_row->status == 1){ echo 'checked'; } ?> <?php echo $disabled; ?>><br>
                                    <label class="form-check-label" for="status_1">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_2" value="2" required="" <?php if($data_row->status == 2){ echo 'checked'; } ?> <?php echo $disabled; ?>>
                                    <label class="form-check-label" for="status_2">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="<?php echo base_url('builder'); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>