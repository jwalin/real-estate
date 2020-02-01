<div class="content container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Change Password</h4>
                </div>
                <div class="card-body">                       
                    <form action="<?php echo base_url('login/update_password'); ?>">
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Old Password</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" name="Tiger Nixon"><br>
                            </div>
                            
                             <label class="col-form-label col-md-2">New Password</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" name="Tiger Nixon"><br>
                            </div>
                             
                              <label class="col-form-label col-md-2">Confirm Password</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" name="Tiger Nixon"><br>
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