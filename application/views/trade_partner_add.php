<div class="content container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Partner</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('trade_partner/insert'); ?>" method="post">
                        <div class="form-group row" style="margin-top: 20px;">
                            <label class="col-form-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="partner_name">
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="<?php echo base_url('trade_partner'); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
