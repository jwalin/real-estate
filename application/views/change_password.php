<div class="content-body">       <!-- row -->    <div class="container-fluid">        <div class="row">            <div class="col-lg-12">                <div class="card">                    <div class="card-body">                        <h4 class="card-title">Change password</h4>                        <form action="<?php echo base_url("login/change_Password"); ?>" method="post">                            <div class="col-lg-6">                                <div class="basic-form">                                    <?php if (validation_errors() != "") { ?>                                        <div class="alert alert-danger">                                                <?php echo validation_errors(); ?>                                            </div>                                                                                                                       <?php } ?>                                                                          <?php if($this->session->flashdata('success')){ ?>                    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>                    <?php } if($this->session->flashdata('error')){ ?>                    <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>                    <?php } ?>                                    <div class="form-group">                                        <label>Old Password</label>                                        <input type="password" name="o_password" value="" class="form-control input-default" placeholder="Old Password" required="">                                    </div>                                    <div class="form-group">                                        <label>New Password</label>                                        <input type="password" name="n_password" value="" class="form-control input-default" placeholder="New Password" required="">                                    </div>                                    <div class="form-group">                                        <label>Confirm Password</label>                                        <input type="password" name="c_password" value="" class="form-control input-default" placeholder="Confirm Password" required="">                                    </div>                                    <div class="form-group">                                          <button type="submit" class="btn btn-info btn-lg">Update</button>                                    </div>                                </div>                            </div>                        </form>                    </div>                </div>            </div>        </div>        <!-- #/ container -->    </div>    <!--**********************************        Content body end    ***********************************--></div><!--**********************************    Main wrapper end***********************************--></body></html>