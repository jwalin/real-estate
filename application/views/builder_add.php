<div class="content container-fluid">

    <!-- Page Header -->

    <!-- /Page Header -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Builder Add</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('builder'); ?>">
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="Tiger Nixon"><br>
                            </div>
                            <label class="col-form-label col-md-2">Email</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="TigerNixon@gmail.com"><br>
                            </div>
                            <label class="col-form-label col-md-2">Confirm Email</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="TigerNixon@gmail.com"><br>
                            </div>
                            <label class="col-form-label col-md-2">Password</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" name="password"><br>
                            </div>
                            <label class="col-form-label col-md-2">Confirm Password</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" name="password"><br>
                            </div>

                            <label class="col-form-label col-md-2">Type</label>
                            <div class="col-md-10">
                                <select class="form-control">
                                    <option>-- Select --</option>
                                    <option>Admin</option>
                                    <option>Normal user</option>
                                    <option>Read only user</option>
                                </select><br>
                            </div>

                        </div>
                        <div class="text-right">
                            <button type="reset" class="btn btn-primary" style="background-color: red; border-color: red;">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>