<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Contact Support</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Contact Support</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="row" style="background-color: #fff; margin-top: 20px;">
        <div class="col-lg-8">
            <div class="card" style="border: 0px solid; box-shadow: 0 0px 0px 0;">
                <div class="card-body">
                    <form action="<?php echo base_url('support/contact_support'); ?>">
                        <div class="form-group row" style="margin-top: 20px;">
                            <label class="col-form-label col-md-3">Subject</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="Tiger Nixon"><br>
                            </div>
                            <label class="col-form-label col-md-3">Message</label>
                            <div class="col-md-9">
                                <textarea name="message" class="form-control"></textarea>
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

