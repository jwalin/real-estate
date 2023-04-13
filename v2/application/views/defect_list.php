<div class="content container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success clearfix"><?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            <?php } if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger clearfix"><?php echo $this->session->flashdata('error'); ?></div>
            <?php } ?>
            <div class="card mb-0">
                <div class="card-body p-20 text-center">
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                    <div class="col-sm-6 pull-left">
                        <form action="<?php echo base_url('home/insert_step_1'); ?>" method="post">
                            <fieldset>
                                <h2 class="theme_color">Quick Add Defect(s)</h2><br><br>
                                <h4><u>Which Job?</u></h4>
                                <br>
                                <div class="form-group">
                                    <select class="form-control" id="tracts" name="tract_id" required="">
                                        <option value="">Select Tract</option>
                                        <?php foreach ($data as $row) { ?>
                                            <option value="<?php echo $row->id; ?>"><?php echo $row->tract_no; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="lots" name="lot_id" required="">
                                        <option value="">Select Lot</option>
                                    </select>
                                </div><br/>
                                <input type="submit" class="btn btn-primary" value="Next" />
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
<script>
    $('#tracts').on('change', function () {
        $.ajax({
            url: '<?= base_url() . 'home/get_lots_by_tract_id/' ?>',
            data: {tract_id: this.value},
            type: 'post',
            success: function (data) {
                $('#lots').html(data);
            }
        });
    });
</script>