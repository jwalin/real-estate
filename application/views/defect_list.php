<div class="content container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                <div class="card-body p-20 text-center">
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                    <div class="col-sm-6 pull-left">
                        <form action="#" method="post">
                            <fieldset>
                                <h2 class="theme_color">New Defect List - Step 1</h2><br><br>
                                <h4><u>Which Job?</u></h4>
                                <br>
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Job Address or Lot/Tract Here" class="form-control">
                                </div>
                                <a href="<?php echo base_url('home/defect_list_step_2'); ?>"><button type="button" class="btn btn-primary">&nbsp;Start&nbsp;</button></a>
                                <br><br>
                                <h3>-- or --</h3><br>
                                <div class="form-group">
                                    <select class="form-control">
                                        <option> Select by tract</option>
                                        <option>Admin</option>
                                        <option>Normal user</option>
                                        <option>Read only user</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control">
                                        <option> Select by lot</option>
                                        <option>Admin</option>
                                        <option>Normal user</option>
                                        <option>Read only user</option>
                                    </select>
                                </div><br/>
                                <a href="<?php echo base_url('home/defect_list_step_2'); ?>"><input type="button" class="btn btn-primary" value="Next" /></a>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>