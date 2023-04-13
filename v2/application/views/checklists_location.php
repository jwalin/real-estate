<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">-->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/select2.min.css">
<style>
    .select2-container--default .select2-selection--multiple{
        background: #fff !important;
        border: 1px solid #ced4da !important;
        min-height: 45px;
    }
    .select2-search__field{
        width: 100% !important;
    }
</style>
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
            <div class="col">
                <?php
                if (@$this->uri->segment(3)) {
                    $ex3 = $this->uri->segment(3);
                    $ex4 = $this->uri->segment(4);
                    $tract_id = base64_encode(base64_encode($ex3));
                    $lot_id = base64_encode(base64_encode($ex4));
                    $tract_data = $this->home_model->get_tract_name($tract_id);
                    $lot_data = $this->home_model->get_lot_name($lot_id);
                    ?>
                    <h3 class="page-title" style="font-size: 19px !important;">Trade Categories: <?php echo $tract_data->tract_no; ?> / <?php echo $lot_data->lot_no; ?></h3>
                <?php } ?>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="javascript:;"><button type="submit" onclick="marke_as_complete()" class="btn add-btn"> Mark All Defects As Complete </button></a>
                <a href="javascript:;"><button type="button" onclick="checklists_confirm_modal()" class="btn add-btn"> Mark All Categories As Complete </button></a>
                <!--<a href="javascript:;"><button type="submit" onclick="inspection_check_all()" class="btn add-btn"> Mark All Categories As Complete </button></a>-->
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
                                    <th><h4 style="font-weight: bold; font-size: 20px;"><?php echo $data->defect_location; ?></h4>
                                        <!--<h4 style="font-weight: bold">Inspection Complete?</h4>-->
                                    </th>
                                    <!--<th style="text-align: center;"></th>-->
                                    <th style="text-align: right;" colspan="2">&nbsp;
                                        <h4 class="chkred">CHECKLIST INSPECTIONS INCOMPLETE</h4>
                                        <h4 class="chkgreen">ALL CHECKLIST INSPECTIONS COMPLETE</h4>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sm = 0;
                                $cklist_ins = 0;
                                $marks = '';
                                $marks_ins = '';
                                $pls_ins = 0;
                                $res_cats = $this->defect_location_model->defectcat($data->category_ids);
                                foreach ($res_cats as $res_cat) {
                                    $marks_ins .= $res_cat->id . ',';
                                    $res_inspection_def = $this->Checklists_model->get_inspection_def_check(@$this->uri->segment(5), @$this->uri->segment(3), @$this->uri->segment(4), $res_cat->id);
                                    $defect_ins = $this->Checklists_model->get_location_category_defect_type($res_cat->id, @$this->uri->segment(5));
                                    if (@$defect_ins) {
                                        $def_ins_count = count(@$defect_ins);
                                    } else {
                                        $def_ins_count = 0;
                                    }
                                    $def_chked_ins = $def_ins_count - $res_inspection_def->checked_def_count;
                                    $pls_ins += $def_chked_ins;
                                    $res_cklist = $this->Checklists_model->checklocationdefect_checklist(@$this->uri->segment(5), @$this->uri->segment(3), @$this->uri->segment(4), $res_cat->id);
                                    $res_inspection_category = $this->Checklists_model->get_inspection_category(@$this->uri->segment(5), @$this->uri->segment(3), @$this->uri->segment(4), $res_cat->id);
                                    $total_defect = $this->Checklists_model->get_search_defect_data(@$this->uri->segment(3), @$this->uri->segment(4), '', $res_cat->id, @$this->uri->segment(5));
                                    $res_total_ch_defect_cat = $this->Checklists_model->checklocationdefectall_ch_category($res_cat->id, @$this->uri->segment(5), @$this->uri->segment(3), @$this->uri->segment(4));
                                    $incomplete_defect = $this->Checklists_model->get_search_defect_data(@$this->uri->segment(3), @$this->uri->segment(4), 1, $res_cat->id, @$this->uri->segment(5));
                                    $total_defect_count = 0;
                                    if (@$total_defect) {
                                        $total_defect_count = count(@$total_defect);
                                    }
                                    $incomplete_defect_count = 0;
                                    $clrl = "green";
                                    if (@$incomplete_defect) {
                                        $incomplete_defect_count = count(@$incomplete_defect);
                                        $clrl = "red";
                                    }
                                    // echo $this->db->last_query();exit;
                                    $sm += $res_cklist->defect_count;
                                    
                                    if(count(@$res_total_ch_defect_cat)){
                                        $ckdfins_ch_cat = count(@$res_total_ch_defect_cat);
                                    }else{
                                        $ckdfins_ch_cat = 0;
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            if ($res_cklist->defect_count == 0) {
                                                $cked = "checked";
                                                // $clrs = "green";
                                                $clrs = "#25337A";
                                            } else {
                                                $marks .= $res_cat->id . ',';
                                                $cked = "";
                                                // $clrs = "red";
                                                $clrs = "#25337A";
                                            }

                                            if ($res_inspection_category) {
                                                $ckeds = "checked";
                                                $cklist_ins++;
                                            } else {
                                                $ckeds = "";
//                                                $marks_ins .= $res_cat->id . ',';
                                            }
                                            ?>
                                            <label class="container" style="margin-left: 0px;padding-left: 0;color: <?php echo $clrs; ?>;">
                                                <?php echo $res_cat->category_name; ?> 
                                                <!--<input type="checkbox" id="chk<?php echo $res_cat->id; ?>" class="chk" name="checked_id[]" value="<?php echo $res_cat->id; ?>" <?php echo $ckeds; ?>>
                                                <span class="checkmark" onclick="inspection_check(<?php echo $res_cat->id; ?>)"></span>-->
                                            </label>
                                        </td>	
                                        <!--<td class="text-center"><?php echo $total_defect_count; ?></td>-->
                                        <td>
                                            <div>
                                                <span style='color: <?=($def_chked_ins > 0) ? 'red' : 'green'; ?>'><?=($def_chked_ins > 0) ? $def_chked_ins : 0; ?> Checklist Inspections Incomplete</span>
                                                <span style='color: #C0C0C0'> / </span>
                                                <span style='color: #25337A'><?php echo $total_defect_count; ?> Total Defects </span>
                                                <span style='color: #C0C0C0'> / </span>
                                                <span style='color: <?=($ckdfins_ch_cat > 0) ? 'red' : '#25337A'; ?>'><?=($ckdfins_ch_cat > 0) ? $ckdfins_ch_cat : 0; ?> CH Defects </span>
                                                <span style='color: #C0C0C0'> / </span>
                                                <span style='color: <?php echo $clrl; ?>'><?php echo $incomplete_defect_count; ?> Defects Incomplete</span>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <?php
                                            $ex3 = @$this->uri->segment(3);
                                            $ex4 = @$this->uri->segment(4);
                                            $ex5 = @$this->uri->segment(5);
                                            ?>
                                            <a href="<?php echo base_url('checklists/location_category_checklist/' . $ex3 . '/' . $ex4 . '/' . $ex5 . '/' . $res_cat->id); ?>"><i class="fa fa-arrow-circle-right" style="color: #25337A; margin-right: 40px;font-size: 30px;"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                $marks_all = rtrim($marks, ',');
                                $marks_all_ins = rtrim($marks_ins, ',');
                                ?>
                            <script>
                                // var sm = <?php echo $sm; ?>;
                                // if(sm){
                                if (<?php echo $pls_ins; ?> <= 0) {
                                    $('.chkgreen').show();
                                } else {
                                    $('.chkred').show();
                                }
                            </script>
                            </tbody>
                        </table>
                        <a href="javascript:;"><button type="submit" onclick="add_cat_model()" class="btn add-btn addCat"> Add Category </button></a><br><br>
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
                <form action="<?php echo base_url('checklists/status_all_complete_by_category'); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Date</label>
                                <input type="date" name="completion_date" class="form-control" required="">
                                <input type="hidden" name="ids" id="compated" value="<?php echo $marks_all; ?>" class="form-control allids" required="">
                                <input type="hidden" name="is_completed" value="1" class="form-control" required="">
                                <input type="hidden" name="url" value="<?php echo base64_encode(current_url()); ?>" class="form-control" required="">
                                <input type="hidden" name="tract_id" value="<?php echo @$this->uri->segment(3); ?>" class="form-control" required="">
                                <input type="hidden" name="lot_id" value="<?php echo @$this->uri->segment(4); ?>" class="form-control" required="">
                                <input type="hidden" name="defect_location" value="<?php echo @$this->uri->segment(5); ?>" class="form-control" required="">
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
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('checklists/insert'); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <!--<input type="text" name="category_name" class="form-control" required="">-->
                                
                                <select class="form-control basic" multiple="" name="category_name[]" required="" data-placeholder="Select Category" style="width: 100%;">
                                    <?php foreach ($data_category as $row_category) { ?>
                                        <option value="<?php echo $row_category->id; ?>"><?php echo $row_category->category_name; ?></option>
                                    <?php } ?>
                                </select>
                                
                                <?php if ($data->category_ids != "") { ?>
                                    <?php foreach (explode(',', $data->category_ids) as $id) { ?>
                                        <script>
                                            $('.basic option[value="<?php echo $id; ?>"]').prop("selected", true);
                                        </script>
                                    <?php }
                                } ?>
                                
                                <input type="hidden" name="url" value="<?php echo base64_encode(current_url()); ?>" class="form-control" required="">
                                <input type="hidden" name="defect_location" value="<?php echo @$this->uri->segment(5); ?>" class="form-control" required="">
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
<div id="confirm_modal_defects" class="modal custom-modal fade" role="dialog">
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
                            <label>Please confirm you want to mark all defects as complete?</label>
                        </div>
                    </div>
                </div>
                <div class="submit-section mt-3">
                    <button type="button" class="btn btn-success" onclick="status_modal()">Yes</button>
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
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<script>
$(".basic").select2();
</script>
<script>
    function status_modal() {
        $('#confirm_modal_defects').modal('hide');
        setTimeout(function() {
            $('#status_modal').modal('show');
        }, 500);
    }
    function marke_as_complete() {
        var get_val = $("#compated").val();
        if (get_val != "") {
            $('#confirm_modal_defects').modal('show');
            // $('#status_modal').modal('show');
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

    function inspection_check(catid) {
        var l = document.getElementById('chk' + catid);
        if (l.checked == true) {
            var ck = 1;
        } else {
            var ck = 2;
        }
        $('#loadingb').show();
        $.ajax({
            url: '<?= base_url() . 'checklists/inspection_category/' ?>',
            data: {tract_id: <?php echo $this->uri->segment(3); ?>, lot_id: <?php echo $this->uri->segment(4); ?>, locid: <?php echo $this->uri->segment(5); ?>, catid: catid, type: ck},
            type: 'post',
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    window.location.href = "";
                    // if(ck == 1){
                    // toastr.remove();
                    // toastr.success('Unchecked your location successfully.', {timeOut: 5000});
                    // }else{
                    // toastr.remove();
                    // toastr.success('Checked your location successfully.', {timeOut: 5000});
                    // }
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
            url: '<?= base_url() . 'checklists/inspection_category_all_defect_checklist/' ?>',
            data: {tract_id: <?php echo $this->uri->segment(3); ?>, lot_id: <?php echo $this->uri->segment(4); ?>, locid: <?php echo $this->uri->segment(5); ?>, catid: '<?php echo $marks_all_ins; ?>'},
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