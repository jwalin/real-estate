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
        width: 100px;
        font-size: 14px;
    }
    .text_tbl{
        color: #8e8e8e;
        font-size: 14px;
        margin-bottom: 5px;
    }
    .tract_select{width: 150px;float: right;margin: 0;margin-right: 5px;}
    .lot_select{width: 200px;float: right;margin: 0;}
    @media (max-width: 768px){
        .tract_select{width: 100%;margin: 0;}
        .lot_select{width: 100%;margin-bottom: 5px;}
    }
</style>
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">6180 / 42</h3>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn"><i class="fa fa-lock"></i>Unlock to Edit</a>

            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                <div class="card-body p-20 text-center">

                    <div class="col-sm-12 clearfix">

                        <div class="col-lg-12 p-0">
                            <div class="form-group lot_select">
                                <select class="select">
                                    <option value="">All Trade Categories</option>
                                    <option value="">Category 1</option>
                                    <option value="">Category 2</option>
                                    <option value="">Category 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="datatable table table-stripped mb-0">
                                <thead>
                                    <tr>
                                        <th width="35%" class="theme_color" colspan="4">Tile Defects</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="title_tbl">Code:</div> <div class="text_tbl">AA0001</div>
                                            <div class="title_tbl">Category:</div> <div class="text_tbl">Category</div>
                                            <div class="title_tbl">Trade Partner:</div> <div class="text_tbl">Partner 1</div>
                                        </td>
                                        <td>
                                            <div class="title_tbl">Location:</div> <div class="text_tbl">Building Axx - 103</div>
                                            <div class="title_tbl">Type:</div> <div class="text_tbl">Type</div>
                                        </td>
                                        <td class="text-center">
                                            <span style="color: red;">Scheduled</span><br/>
                                            <span>6/30/19</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?php echo base_url('search_label/defect_details'); ?>"><i class="fa fa-info-circle m-r-5"></i> Detail</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="title_tbl">Code:</div> <div class="text_tbl">AA0002</div>
                                            <div class="title_tbl">Category:</div> <div class="text_tbl">Category</div>
                                            <div class="title_tbl">Trade Partner:</div> <div class="text_tbl">Partner 1</div>
                                        </td>
                                        <td>
                                            <div class="title_tbl">Location:</div> <div class="text_tbl">Building Axx - 104</div>
                                            <div class="title_tbl">Type:</div> <div class="text_tbl">Type</div>
                                        </td>
                                        <td class="text-center">
                                            <span style="color: red;">Scheduled</span><br/>
                                            <span>6/20/19</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?php echo base_url('search_label/defect_details'); ?>"><i class="fa fa-info-circle m-r-5"></i> Detail</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <table class="datatable table table-stripped mb-0">
                                <thead>
                                    <tr>
                                        <th width="35%" class="theme_color" colspan="4">Paint Defects</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="title_tbl">Code:</div> <div class="text_tbl">AA0003</div>
                                            <div class="title_tbl">Category:</div> <div class="text_tbl">Category</div>
                                            <div class="title_tbl">Trade Partner:</div> <div class="text_tbl">Partner 2</div>
                                        </td>
                                        <td>
                                            <div class="title_tbl">Location:</div> <div class="text_tbl">Building Axx - 105</div>
                                            <div class="title_tbl">Type:</div> <div class="text_tbl">Type</div>
                                        </td>
                                        <td class="text-center">
                                            <span style="color: red;">Scheduled</span><br/>
                                            <span>6/10/19</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?php echo base_url('search_label/defect_details'); ?>"><i class="fa fa-info-circle m-r-5"></i> Detail</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="title_tbl">Code:</div> <div class="text_tbl">AA0004</div>
                                            <div class="title_tbl">Category:</div> <div class="text_tbl">Category</div>
                                            <div class="title_tbl">Trade Partner:</div> <div class="text_tbl">Partner 2</div>
                                        </td>
                                        <td>
                                            <div class="title_tbl">Location:</div> <div class="text_tbl">Building Axx - 106</div>
                                            <div class="title_tbl">Type:</div> <div class="text_tbl">Type</div>
                                        </td>
                                        <td class="text-center">
                                            <span style="color: red;">Scheduled</span><br/>
                                            <span>6/01/19</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?php echo base_url('search_label/defect_details'); ?>"><i class="fa fa-info-circle m-r-5"></i> Detail</a>
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