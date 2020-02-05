<style>
    .image_view_lg{
        width: 80px;
        height: 80px;
        border: 2px solid gainsboro;
    }
    .table td{vertical-align: middle;}
    thead{border-top: 2px solid #dee2e6;}
    .title_tbl{
        color: #4f4f4f;
        float: left;
        font-weight: 500;
        margin-right: 15px;
        width: 85px;
        font-size: 14px;
    }
    .text_tbl{
        color: #8e8e8e;
        font-size: 14px;
        margin-bottom: 5px;
    }
</style>
<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Home</h3>
                <ul class="breadcrumb">
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                <div class="card-body p-20 text-center">
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                    <div class="col-sm-6 pull-left">
                        <img src="<?php echo base_url(); ?>assets/images/logo-home.png" class="img-responsive" width="50%"><br><br>
                        <a href="<?php echo base_url('home/defect_list'); ?>"><button class="btn btn-primary mb-3" style="width: 160px;">New Defect List</button></a>
                        <a href="<?php echo base_url('search_defect/'); ?>"><button class="btn btn-primary mb-3" style="width: 160px;">Search Defect List</button></a>
                        <!--<textarea rows="8" class="form-control"></textarea>-->
                    </div>
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                    <div class="col-sm-12 clearfix">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped mb-0">
                                <thead>
                                    <tr>
                                        <th>Defect Info</th>
                                        <th class="text-center">Defect Image</th>
                                        <th>Trade Partner</th>
                                        <th>Location</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="title_tbl">Tile:</div> <div class="text_tbl">Defects</div>
                                            <div class="title_tbl">Code:</div> <div class="text_tbl">AA0001</div>
                                            <div class="title_tbl">Category:</div> <div class="text_tbl">Category</div>
                                            <div class="title_tbl">Type:</div> <div class="text_tbl">Type</div>
                                        </td>
                                        <td class="text-center"><img src="<?php echo base_url(); ?>assets/images/logo.jpg" class="image_view_lg"></td>
                                        <td>Trade Partner</td>
                                        <td>Location</td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#"><i class="fa fa-info-circle m-r-5"></i> Detail</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="title_tbl">Tile:</div> <div class="text_tbl">Defects</div>
                                            <div class="title_tbl">Code:</div> <div class="text_tbl">AA0001</div>
                                            <div class="title_tbl">Category:</div> <div class="text_tbl">Category</div>
                                            <div class="title_tbl">Type:</div> <div class="text_tbl">Type</div>
                                        </td>
                                        <td class="text-center"><img src="<?php echo base_url(); ?>assets/images/logo.jpg" class="image_view_lg"></td>
                                        <td>Trade Partner</td>
                                        <td>Location</td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#"><i class="fa fa-info-circle m-r-5"></i> Detail</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="title_tbl">Tile:</div> <div class="text_tbl">Defects</div>
                                            <div class="title_tbl">Code:</div> <div class="text_tbl">AA0001</div>
                                            <div class="title_tbl">Category:</div> <div class="text_tbl">Category</div>
                                            <div class="title_tbl">Type:</div> <div class="text_tbl">Type</div>
                                        </td>
                                        <td class="text-center"><img src="<?php echo base_url(); ?>assets/images/logo.jpg" class="image_view_lg"></td>
                                        <td>Trade Partner</td>
                                        <td>Location</td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#"><i class="fa fa-info-circle m-r-5"></i> Detail</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="title_tbl">Tile:</div> <div class="text_tbl">Defects</div>
                                            <div class="title_tbl">Code:</div> <div class="text_tbl">AA0001</div>
                                            <div class="title_tbl">Category:</div> <div class="text_tbl">Category</div>
                                            <div class="title_tbl">Type:</div> <div class="text_tbl">Type</div>
                                        </td>
                                        <td class="text-center"><img src="<?php echo base_url(); ?>assets/images/logo.jpg" class="image_view_lg"></td>
                                        <td>Trade Partner</td>
                                        <td>Location</td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#"><i class="fa fa-info-circle m-r-5"></i> Detail</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="title_tbl">Tile:</div> <div class="text_tbl">Defects</div>
                                            <div class="title_tbl">Code:</div> <div class="text_tbl">AA0001</div>
                                            <div class="title_tbl">Category:</div> <div class="text_tbl">Category</div>
                                            <div class="title_tbl">Type:</div> <div class="text_tbl">Type</div>
                                        </td>
                                        <td class="text-center"><img src="<?php echo base_url(); ?>assets/images/logo.jpg" class="image_view_lg"></td>
                                        <td>Trade Partner</td>
                                        <td>Location</td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#"><i class="fa fa-info-circle m-r-5"></i> Detail</a>
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
</div>