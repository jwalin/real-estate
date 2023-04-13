
<div class="content container-fluid">


    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Trade Category</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Trade Category</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="<?php echo base_url('category/add'); ?>" class="btn add-btn"><i class="fa fa-plus"></i> Create Category</a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-12">
            <div class="card mb-0">
                <div class="nav-item">
                    <div class="top-nav-search">
                        <a href="javascript:void(0);" class="responsive-search">
                            <i class="fa fa-search"></i>
                        </a>
<!--                        <form action="#" method="post" class="mb-0">
                            <input class="form-control" type="text" placeholder="Search here">
                            <button class="btn" type="submit" style="margin-top: -10px;"><i class="fa fa-search"></i></button>
                        </form>-->
                    </div>
                </div>
                <div class="card-body pt-3">
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    <?php } if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="datatable table table-stripped mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(count($data) == 0){
                                    echo "<td colspan='2' class='text-danger'>". RECORD_NOT_FOUND ."</td>";
                                }else{
                                foreach ($data as $row){ ?>
                                <tr>
                                    <td><?php echo $row->category_name; ?></td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo base_url('category/edit/'.$row->id); ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="<?php echo base_url('category/delete/'.$row->id); ?>" onclick="return confirm('<?php echo CONFIRM_ALERT_DELETE; ?>');"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
