        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label><h4 class="card-title">User Management</h4></label>
<!--                                           <a class="btn btn-info btn-lg pull-right" href="<?php echo base_url('holiday_detail/holiday_add'); ?>" class="mr-2" >
                                              Add New</a>-->
                                        </div>
                                        <?php if ($this->session->flashdata('success')) { ?>
                                            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                                        <?php } if ($this->session->flashdata('error')) { ?>
                                            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                                        <?php } ?>

                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th data-sortable="false">No</th>
                                                <th>Social Id</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Point</th>
                                                <th>Created</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                         $i=1;
                                            foreach($view as $row) 
                                                { ?>
                                            <tr>
                                                
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row->social_id ?></td>
                                        <td><?php echo $row->email ?></td>
                                        <td><?php echo $row->username ?></td>
                                        <td><?php echo $row->point ?></td>
                                        <td class="text-center"><?php echo date("M j, Y", strtotime($row->created)) . '<br> at ' . date("g:i A", strtotime($row->created)) ?></td>
                                                                               
                                       
                                                <?php $i++; ?>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

   
