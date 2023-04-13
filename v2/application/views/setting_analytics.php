<div class="content container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Analytics</h4>
                </div>
                <div class="card-body pt-3">
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success clearfix"><?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    <?php } if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger clearfix"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php } ?>
                    <div class="col-sm-6 pull-left">
                        <form action="<?php echo base_url('setting_analytics/update'); ?>" method="post">
                        <input type="hidden" class="form-control" name="id" value="<?php echo $data->id; ?>">
                            
                            <?php if ($this->session->userdata('type') != 4){ ?>
                            <p class="mt-3">Select the chart type to display on your Home page:</p>
                            <div class="form-group">
                                <select class="form-control" id="chart_type"  name="chart_type" required="">
                                    <option value="1">Trade Partners w/ Most Defects Per Lot</option>
                                    <option value="2">Trade Categories w/ Most Defects Per Lot</option>
                                    <option value="3">Tracts w/ the Most Defects Per Lot</option>
                                    <option value="4">Trade Partners w/ the Most Days to List Completion</option>
                                </select>
                                <script>document.getElementById('chart_type').value = <?php echo $data->chart_type; ?>;</script>
                            </div>
                            <?php }else{ ?>
                                <input type="hidden" class="form-control" name="chart_type" value="<?php echo $data->chart_type; ?>">
                            <?php } ?>
                            <p class="mt-3">Select the time period for historical Analytics data to be pulled from:</p>
                            <div class="form-group">
                                <select class="form-control" id="time_period"  name="time_period" required="">
                                    <option value="1">30 days</option>
                                    <option value="2">60 days</option>
                                    <option value="3">90 days</option>
                                    <option value="4">6 months</option>
                                    <option value="5">12 months</option>
                                </select>
                                <script>document.getElementById('time_period').value = <?php echo $data->time_period; ?>;</script>
                            </div>
                            <input type="submit"class="btn btn-primary mt-3" value="Save" />
                        </form>
                    </div>
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>