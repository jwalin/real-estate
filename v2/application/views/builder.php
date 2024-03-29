
<div class="content container-fluid">
    
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Users</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="<?php echo base_url('builder/add'); ?>" class="btn add-btn"><i class="fa fa-plus"></i>Create User</a>
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                <div class="card-body pt-3">
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success clearfix"><?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    <?php } if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger clearfix"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="datatable table table-stripped mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(count($data) == 0){
                                    echo "<td colspan='5' class='text-danger'>". RECORD_NOT_FOUND ."</td>";
                                }else{
                                foreach ($data as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row->name; ?></td>
                                        <td><?php echo $row->email; ?></td>
                                        <td>
                                            <?php
                                            if ($row->type == 1) {
                                                echo 'Admin';
                                            } else if ($row->type == 2) {
                                                echo 'Normal user';
                                            } else if ($row->type == 3) {
                                                echo 'Read only user';
                                            }else{
                                                echo '';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row->status == 1) {
                                                echo '<span style="color: green;">Active</span>';
                                            } else {
                                                echo '<span style="color: red;">Inactive</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?php echo base_url('builder/edit/' . $row->id); ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <?php //if ($row->type != 1) { ?>
                                                    <?php if ($this->session->userdata('id')!=$row->id) { ?>
                                                    <a class="dropdown-item" href="<?php echo base_url('builder/delete/' . $row->id); ?>" onclick="return confirm('<?php echo CONFIRM_ALERT_DELETE; ?>');"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

<!-- Model start -->

<!--<div id="create_project" class="modal custom-modal fade" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> model end 
</div>-->


