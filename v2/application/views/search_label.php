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
                        <form action="<?php echo base_url('search_label/search_label_detail'); ?>" method="post">
                            <fieldset>
                                <h2 class="theme_color">Search by Defect Code</h2><br><br>
                                <!-- <h4><u>Search by Defect Code</u></h4> 
                                <br/>-->
                                <div class="form-group">
                                    <input type="text" name="label" placeholder="Search by Defect Code" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">&nbsp;Search&nbsp;</button>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>