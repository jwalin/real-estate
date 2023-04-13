<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Contact Support</h3>
<!--                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Contact Support</li>
                </ul>-->
            </div>
        </div>
    </div>

    <div class="row" style="background-color: #fff; margin-top: 20px;">
        <div class="col-lg-8">
            <div class="card" style="border: 0px solid; box-shadow: 0 0px 0px 0;">
                <div class="card-body">
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    <?php } if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php } ?>
                    <form action="<?php echo base_url('support/send_contact_support'); ?>" method="post">
                        <div class="form-group row mt-3">
                            <label class="col-form-label col-md-3">Subject</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="subject" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">Message</label>
                            <div class="col-md-9">
                                <textarea name="message" rows="4" class="form-control" required=""></textarea>
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