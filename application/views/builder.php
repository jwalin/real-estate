
<div class="content container-fluid">
    
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Builders</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Builders</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="<?php echo base_url('builder/add'); ?>" class="btn add-btn"><i class="fa fa-plus"></i>Create Builder</a>
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
<!--                <div class="nav-item">
            <div class="top-nav-search">
                            <a href="javascript:void(0);" class="responsive-search">
                                <i class="fa fa-search"></i>
                            </a>
                            <form action="search.html">
                                <input class="form-control" type="text" placeholder="Search here">
                                <button class="btn" type="submit" style="margin-top: -10px;"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                </div>-->
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="datatable table table-stripped mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Smith</td>
                                    <td>JohnSmith@gmail.com</td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo base_url('builder/edit'); ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Lesley Grauer</td>
                                    <td>LesleyGrauer@gmail.com</td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo base_url('builder/edit'); ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Jeffrey Warden</td>
                                    <td>JeffreyWarden@gmail.com</td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo base_url('builder/edit'); ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

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


