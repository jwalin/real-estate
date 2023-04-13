<div class="content container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            <?php } if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
            <?php } ?>
            <div class="card mb-0">
                <div class="card-body p-20 text-center">
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                    <div class="col-sm-6 pull-left">
                        <form action="<?php echo base_url('search_defect/search_tract_lot_detail'); ?>" method="post">
                            <fieldset>
                                <h2 class="theme_color">Search Defect List</h2><br><br>
                                <h4><u>Search Defect Lists</u></h4>
                                <br/>
                                <!--<div class="form-group">
                                    <input type="text" name="tract_lot" placeholder="Enter Tract/Lot Here" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">&nbsp;Search&nbsp;</button>
                                <h3 class="m-3">-- or --</h3>-->
                                <div class="form-group">
                                    <select class="form-control" onchange="select_lot_tract(this.value)">
                                        <option>Search by Tract/Lot</option>
                                        <?php foreach ($tracts_lots as $tracts_lots) { ?>
                                            <option value="<?php echo $tracts_lots->id . '-' . $tracts_lots->lot_id; ?>"><?php echo $tracts_lots->tract_no; ?> - <?php echo $tracts_lots->lot_no; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
								<?php if($this->session->userdata('type') != 4){ ?>
                                <h3 class="m-3">-- or --</h3>
                                <div class="form-group">
                                    <select class="form-control" onchange="select_trade_partner(this.value)">
                                        <option>Search by Trade Partner</option>
                                        <?php foreach ($partner as $partner) { ?>
                                            <option value="<?php echo $partner->id; ?>"><?php echo $partner->partner_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
								<?php } ?>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function select_lot_tract(ele) {
        window.location.href = "<?php echo base_url('search_defect/search_result/'); ?>" + ele;
    }
    function select_trade_partner(ele) {
        window.location.href = "<?php echo base_url('search_defect/search_result_partner/'); ?>" + ele;
    }
</script>