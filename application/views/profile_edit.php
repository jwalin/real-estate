<div class="content container-fluid">

    <!-- Page Header -->

    <!-- /Page Header -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Profile Edit</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('profile'); ?>">
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="Tiger Nixon" value="John Doe"><br>
                            </div>
                            <label class="col-form-label col-md-2">Email</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="Tiger Nixon" value="johndoe@example.com"><br>
                            </div>
                            <label class="col-form-label col-md-2">Phone</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="Tiger Nixon" value="9999999999"><br>
                            </div>
                            <label class="col-form-label col-md-2">Address</label>
                            <div class="col-md-10">
                                <textarea name="address" class="form-control">1861 Bayonne Ave, Manchester Township, NJ, 08759</textarea><br>
                            </div>
                            <label class="col-form-label col-md-2">Gender</label>
                                
                                <div class="col-lg-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_male" value="option1" checked=""><br>
                                        <label class="form-check-label" for="gender_male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_female" value="option2">
                                        <label class="form-check-label" for="gender_female">
                                            Female
                                        </label>
                                    </div>
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