<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">-->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<style>
    #toast-container>div{opacity: 1 !important;}

    .image_view_lg{
        width: 80px;
        height: 80px;
        border: 2px solid gainsboro;
    }
    .table td{vertical-align: middle;}
    thead{border-top: none !important;}
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
        .add-btn {
            width: 100%;
            margin-bottom: 5px;
        }

    }

    .container {
        margin: 10px 0px;
        display: block;
        position: relative;
        cursor: pointer;
        display: inline-block;
    }
    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }
    .checkmark {
        position: absolute;
        top: 0;
        left: -15;
        height: 25px;
        width: 25px;
        background-color: #fff;
        border: 1px solid #25337A;
    }
    .container:hover input ~ .checkmark {
        background-color: #fff;
    }
    .container input:checked ~ .checkmark {
        background-color: #25337A;
    }
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }
    .container input:checked ~ .checkmark:after {
        display: block;
    }
    .container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .btn{
        border-radius: 5px;
        font-size: 14px;
        margin-left: 5px;
    }
    .table thead th{
        color: #25337A; 
        font-weight: bold; 
        font-size: 18px;
    }
    .table td, .table th {
        padding: 0px;
    }
    .table th {
        border: none !important
    }   
    .addCat{
        float: left;
        padding: 0px 35px 0px 35px;
        font-size: 18px;
        margin: 0px;
    }
    .chkred{
        font-weight: bold;
        font-size: 20px;
        display:none;
        color: red;
    }
    .chkgreen{
        font-weight: bold;
        font-size: 20px;
        display:none;
        color: green;
    }
</style>
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <?php
                if (@$this->uri->segment(3)) {
                    $ex3 = $this->uri->segment(3);
                    $ex4 = $this->uri->segment(4);
                    $ex5 = $this->uri->segment(5);
                    $tract_id = base64_encode(base64_encode($ex3));
                    $lot_id = base64_encode(base64_encode($ex4));
                    $tract_data = $this->home_model->get_tract_name($tract_id);
                    $lot_data = $this->home_model->get_lot_name($lot_id);
                    ?>
                    <h3 class="page-title" style="font-size: 19px !important;">Location-Category Checklist: <?php echo $tract_data->tract_no; ?> / <?php echo $lot_data->lot_no; ?></h3>
                <?php } ?>
            </div>
            <div class="col-auto float-right ml-auto">
                <!--<a href="javascript:;"><button type="submit" onclick="marke_as_complete()" class="btn add-btn"> Mark All Defects As Complete </button></a>-->
                <a href="javascript:;"><button type="submit" onclick="checklists_confirm_modal()" class="btn add-btn"> Mark All Checklists As Complete </button></a>
                <a href="<?php echo base_url('checklists/trade_categories/' . $ex3 . '/' . $ex4 . '/' . $ex5); ?>"><button type="submit" class="btn add-btn"> Trade Categories </button></a>
                <a href="<?php echo base_url('checklists/checklists_dashboard/' . $ex3 . '/' . $ex4); ?>"><button type="submit" class="btn add-btn"> Checklists Dashboard </button></a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0 pt-3">
                <div class="card-body text-center">
                    <div class="table-responsive">
                        <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success clearfix mt-3 text-left"><?php echo $this->session->flashdata('success'); ?>
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                            </div>
                        <?php } if ($this->session->flashdata('error')) { ?>
                            <div class="alert alert-danger clearfix mt-3 text-left"><?php echo $this->session->flashdata('error'); ?></div>
                        <?php } ?>
                        <table class="datatable table table-stripped mb-0 " style="margin-top: 0 !important;">
                            <thead>
                                <tr>
                                    <th><h4 style="font-weight: bold; font-size: 20px; margin-bottom: 20px;"></h4>
                                        <h4 style="font-weight: bold"><?php echo $data_loc->defect_location.' - '.$data_cat->category_name; ?></h4></th>
                                    <th style="text-align: center;"></th>
                                    <th style="text-align: right;">&nbsp;
                                        <h4 class="chkred">CHECKLIST INSPECTIONS INCOMPLETE</h4>
                                        <h4 class="chkgreen">ALL CHECKLIST INSPECTIONS COMPLETE</h4>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $marks_ins = '';
                                $marks = '';
                                $chk_ins = 0;
                                foreach ($data as $row_data) {      
                                    $total_def = $this->Checklists_model->get_search_defect_data_last(@$this->uri->segment(3), @$this->uri->segment(4), '', @$this->uri->segment(6), @$this->uri->segment(5), $row_data->id);
                                    $total_incomplete_def = $this->Checklists_model->get_search_defect_data_last_incomplete(@$this->uri->segment(3), @$this->uri->segment(4), '', @$this->uri->segment(6), @$this->uri->segment(5), $row_data->id);
                                    $res_cklist = $this->Checklists_model->check_location_category_defect_checklist(@$this->uri->segment(5), @$this->uri->segment(3), @$this->uri->segment(4), @$this->uri->segment(6), $row_data->id);
//                                    echo $this->db->last_query();exit;
//                                    print_r($res_cklist);exit;
                                    $res_inspection_category = $this->Checklists_model->get_inspection_location_category(@$this->uri->segment(5), @$this->uri->segment(3), @$this->uri->segment(4), @$this->uri->segment(6), $row_data->id);
                                    if ($res_inspection_category) {
                                        $ckeds = "checked";
                                        $chk_ins += 1;
                                    } else {
                                        $ckeds = "";
                                        $marks_ins .= $row_data->id . ',';
                                    }
                                    if ($res_cklist->defect_count == 0) {
                                    } else {
                                        $marks .= $row_data->id . ',';
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <label class="container" style="margin-left: 20px;">
                                                <?= ($row_data->closing_hold == 1) ? '<span style="color: red;font-size: 14px;">*CH Defect</span>'  : '<span style="visibility: hidden;font-size: 14px;">*CH Defect</span>'; ?>&nbsp;&nbsp;&nbsp; <?php echo $row_data->defect_type; ?> 
                                                <input type="checkbox" id="chk<?php echo $row_data->id; ?>" class="chk" name="checked_id[]" value="<?php echo $row_data->id; ?>" <?php echo $ckeds; ?>>
                                                <span class="checkmark" onclick="inspection_check(<?php echo $row_data->id; ?>)"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div>
                                                <span style='color: #25337A'><?= (count($total_def)) ? count($total_def) : 0; ?> Total Defects </span>
                                                <span style='color: #C0C0C0'> / </span>
                                                <span style='color: <?=(count($total_incomplete_def) > 0) ? 'red' : 'green'; ?>'><?= (count($total_incomplete_def)) ? count($total_incomplete_def) : 0; ?> Defects Incomplete</span>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <?php
                                            $ex3 = @$this->uri->segment(3);
                                            $ex4 = @$this->uri->segment(4);
                                            $ex5 = @$this->uri->segment(5);
                                            $ex6 = @$this->uri->segment(6);
                                            ?>
                                            <a href="<?php echo base_url('checklists_defect/checklists_defect_step_2/'.base64_encode(base64_encode($ex3)).'/'.base64_encode(base64_encode($ex4)).'/'. base64_encode(base64_encode($ex5)).'/'.base64_encode(base64_encode($ex6)).'/'.base64_encode(base64_encode($row_data->id))); ?>"><i class="fa fa-plus-circle" style="color: #25337A;margin-right: 5px;font-size: 30px;"></i></a>
                                            <a href="<?php echo base_url('checklists/checklist_defects/' . $ex3 . '/' . $ex4 . '/' . $ex5 . '/' . $ex6 . '/' . $row_data->id); ?>"><i class="fa fa-arrow-circle-right" style="color: #25337A; margin-right: 40px;font-size: 30px;"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                $marks_all_ins = rtrim($marks_ins, ',');
                                $marks_all = rtrim($marks, ',');
                                ?>
                                <script>
                                    if (<?php echo $chk_ins; ?> == <?php echo count($data); ?>) {
                                        $('.chkgreen').show();
                                    } else {
                                        $('.chkred').show();
                                    }
                                </script>
                            </tbody>
                        </table>                        
                        <a href="javascript:;"><button type="button" onclick="add_cat_model()" class="btn add-btn addCat"> Add Defect Type </button></a><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Modal -->
<div id="status_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Completion Date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('checklists/status_all_complete_by_category_location'); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Date</label>
                                <input type="date" name="completion_date" class="form-control" required="">
                                <input type="hidden" name="ids" id="compated" value="<?php echo @$marks_all; ?>" class="form-control allids" required="">
                                <input type="hidden" name="is_completed" value="1" class="form-control" required="">
                                <input type="hidden" name="url" value="<?php echo base64_encode(current_url()); ?>" class="form-control" required="">
                                <input type="hidden" name="tract_id" value="<?php echo @$this->uri->segment(3); ?>" class="form-control" required="">
                                <input type="hidden" name="lot_id" value="<?php echo @$this->uri->segment(4); ?>" class="form-control" required="">
                                <input type="hidden" name="defect_location" value="<?php echo @$this->uri->segment(5); ?>" class="form-control" required="">
                                <input type="hidden" name="catid" value="<?php echo @$this->uri->segment(6); ?>" class="form-control" required="">
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
<!-- Start Modal -->
<div id="cat_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Defect Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('defect_types/insert'); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Defect</label>
                                <input type="text" name="defect_type" class="form-control" required="">
                                <input type="hidden" name="url" value="<?php echo base64_encode(current_url()); ?>" class="form-control" required="">
                                <input type="hidden" name="location" value="<?php echo @$this->uri->segment(5); ?>" class="form-control" required="">
                                <input type="hidden" name="category_id" value="<?php echo @$this->uri->segment(6); ?>" class="form-control" required="">
                            </div>
                            <div class="form-group row">
                            <label class="col-form-label col-md-4">Closing Hold?</label>
                            <div class="col-lg-8" style="margin-top: 7px;">
                                <div class="form-check form-check-inline pr-4">
                                    <input class="form-check-input" type="radio" name="closing_hold" id="status_1" value="1" required=""><br>
                                    <label class="form-check-label" for="status_1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="closing_hold" id="status_2" value="2" required="">
                                    <label class="form-check-label" for="status_2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
<!-- Start Modal -->
<div id="confirm_modal_checklists" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <label>Please confirm you want to mark all checklists as complete?</label>
                        </div>
                    </div>
                </div>
                <div class="submit-section mt-3">
                    <button type="button" class="btn btn-success" onclick="inspection_check_all()">Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
<div id="loadingb" style="position: fixed;display: none;
     top: 0;
     left: 0;
     right: 0;
     bottom: 0;
     text-align: center;
     background-color: rgba(0,0,0,0.7);
     height: 100%;
     width: 100%;
     z-index: 9999;">
    <span  align="center" style="color: #fff;
           position: absolute;
           top: 40%;
           left: 0;
           right: 0;
           bottom: 0;
           display: inline-table;
           width: 100%;
           font-size: 17px;
           font-weight: bold;">
        &nbsp;
        Please wait..
    </span>
</div>
<script>
    function marke_as_complete() {
        var get_val = $("#compated").val();
        if (get_val != "") {
            $('#status_modal').modal('show');
        } else {
            alert('Please should be incomplete atleast one defect.');
        }
    }
    $('.chk').on('click', function () {
        var final_vl = $("#compated").val();
        var lv = '';
        if (final_vl != '') {
            lv = $("#compated").val() + ',';
        }
        if (this.checked) {
            $("#compated").val(lv + $(this).val());
        } else {
            Pop($("#compated").val(), $(this).val());
        }
    });

    function Pop(arra, val) {
        var number = val;
        var str = arra;
        var strArray = str.split(',');
        for (var i = 0; i < strArray.length; i++) {
            if (strArray[i] === number) {
                strArray.splice(i, 1);
            }
        }
        $("#compated").val(strArray);
    }

    function add_cat_model() {
        $('#cat_modal').modal('show');
    }

    function inspection_check(dfid) {
        var l = document.getElementById('chk' + dfid);
        if (l.checked == true) {
            var ck = 1;
        } else {
            var ck = 2;
        }
        $('#loadingb').show();
        $.ajax({
            url: '<?= base_url() . 'checklists/inspection_category_location/' ?>',
            data: {tract_id: <?php echo $this->uri->segment(3); ?>, lot_id: <?php echo $this->uri->segment(4); ?>, locid: <?php echo $this->uri->segment(5); ?>, defect_type_id: dfid, type: ck, catid: <?php echo $this->uri->segment(6); ?>},
            type: 'post',
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    window.location.href = "";
                } else {
                    toastr.remove();
                    toastr.error('Something went wrong.', {timeOut: 5000});
                }
                $('#loadingb').hide();
            }
        });
    }
    
    function checklists_confirm_modal() {
        $('#confirm_modal_checklists').modal('show');
    }

    function inspection_check_all() {
        $('#loadingb').show();
        $.ajax({
            url: '<?= base_url() . 'checklists/inspection_location_category_all/' ?>',
            data: {tract_id: <?php echo $this->uri->segment(3); ?>, lot_id: <?php echo $this->uri->segment(4); ?>, locid: <?php echo $this->uri->segment(5); ?>, catid: <?php echo $this->uri->segment(6); ?>, defect_type_id: '<?php echo @$marks_all_ins; ?>'},
            type: 'post',
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    window.location.href = "";
                } else {
                    toastr.remove();
                    toastr.error('Something went wrong.', {timeOut: 5000});
                }
                $('#loadingb').hide();
            }
        });
    }

<?php if ($this->session->userdata('success-ins')) : ?>
        $(function () {
            toastr.remove();
            toastr.success("<?php echo $this->session->userdata('success-ins'); ?>");
        });
<?php endif; ?>
<?php if ($this->session->userdata('error-ins')) : ?>
        $(function () {
            toastr.remove();
            toastr.error("<?php echo $this->session->userdata('error-ins'); ?>");
        });
<?php endif; ?>
</script>