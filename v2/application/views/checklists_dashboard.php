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
    thead{ border: none !important}
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
        margin: 10px 20px;
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
        font-size: 15px;
        margin-left: 5px;
    }
    .table thead th{
        color: #25337A; 
        font-weight: bold; 
        font-size: 17px;
    }
    .table th {
        border: none !important
    } 
    .table td{
        padding: 0px 10px;
    }
    .table tbody+tbody {
        border-top: 0px solid #dee2e6 !important;
    }
</style>
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <?php
            if (@$this->uri->segment(3)) {
                $ex3 = $this->uri->segment(3);
                $ex4 = $this->uri->segment(4);
                $tract_id = base64_encode(base64_encode($ex3));
                $lot_id = base64_encode(base64_encode($ex4));
                $tract_data = $this->home_model->get_tract_name($tract_id);
                $lot_data = $this->home_model->get_lot_name($lot_id);
                ?>
                <h3 class="page-title" style="font-size: 20px !important;margin-left: 20px;">Checklists Dashboard: <?php echo $tract_data->tract_no; ?> / <?php echo $lot_data->lot_no; ?></h3>
            <?php } ?>

            <div class="col-lg-12 btn">
                <a href="javascript:;"><button type="submit" onclick="marke_as_complete()" class="btn add-btn"> Mark All Defects As Complete </button></a>
                <!--<a href="javascript:;"><button type="submit" onclick="checklists_confirm_modal()" class="btn add-btn inscheck"> Mark All Checklists As Complete </button></a>-->
                <a href="javascript:;"><button onclick="send_checklists_report()" type="button" class="btn add-btn"> Send Defect List to Builder </button></a>
                <!--<a href="<?php echo base_url('home/quick_add_step_1/' . base64_encode(base64_encode($ex3)) . '/' . base64_encode(base64_encode($ex4))); ?>"><button type="submit" class="btn add-btn"> Quick Add Defect(s) </button></a>-->
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
                        <table class="datatable table table-stripped mb-0 " style="margin-top: 0 !important;margin-bottom: 0 !important;">
                            <thead>
                                <tr>
                                    <th>Total Defects: <span id="ckindefect_total">0</span></th>
                                    <th>Total CH Defects: <span id="ckindefect_ch">0</span></th>
                                    <th>Total Incomplete Defects: <span id="ckindefect_total_indfct">0</span></th>
                                    <th>Total Incomplete Checklist Inspections: <span id="ckindefect">0</span><span id="ckindefect_complete" style="display: none;">0</span></th>
                                </tr>
                            </thead>
                        </table>
                            <table class="datatable table table-stripped mb-0 " style="margin-top: 0 !important;">
                            <tbody>
                                <?php
                                $cklist = 0;
                                $cklist_ins = 0;
                                $marks = '';
                                $marks_ins = '';
                                $locids = '';
                                $inschecktop = 0;
                                $inschecktop_complete = 0;
                                $inschecktop_ch = 0;
                                $inschecktop_total = 0;
                                $inschecktop_total_indfct = 0;
                                foreach ($val as $value) {
                                    $res_df = $this->Checklists_model->get_dash_defect_type($value->id, $value->category_ids);
                                    $res_df_ins = $this->Checklists_model->get_inspection_location_category_dash($value->id, @$this->uri->segment(3), @$this->uri->segment(4));
                                    $res_emp = $this->Checklists_model->checklocationdefect($value->id, @$this->uri->segment(3), @$this->uri->segment(4));
                                    $res_total_defect = $this->Checklists_model->checklocationdefectall($value->id, @$this->uri->segment(3), @$this->uri->segment(4));
                                    $res_total_ch_defect = $this->Checklists_model->checklocationdefectall_ch($value->id, @$this->uri->segment(3), @$this->uri->segment(4));
                                    $res_inspection_location = $this->Checklists_model->get_inspection_location($value->id, @$this->uri->segment(3), @$this->uri->segment(4));

                                    if ($res_inspection_location) {
                                        $marks_ins .= $value->id . ',';
                                        $res_chcked_cat = $this->Checklists_model->get_inspection_category_check($value->id, @$this->uri->segment(3), @$this->uri->segment(4));
                                        $cat_ids = explode(',', $value->category_ids);
                                        $ckcount = 0;
                                        for ($c = 0; $c < count($cat_ids); $c++) {
                                            $res_cklist = $this->Checklists_model->checklocationdefect_checklist($value->id, @$this->uri->segment(3), @$this->uri->segment(4), $cat_ids[$c]);
                                            if ($res_cklist->defect_count != 0) {
                                                $ckcount++;
                                            }
                                        }
                                        $cklist += $ckcount;
                                        $locids .= $value->id . ',';
                                        // print(count($cat_ids));exit;
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                if (@$ckcount) {
                                                    $cked = "";
                                                    // $colors = "#C0C0C0";
                                                    $marks .= $value->id . ',';
                                                } else {
                                                    $cked = "checked";
                                                    // $colors = "#25337A";
                                                }

                                                if ($res_inspection_location) {
                                                    $ckeds = "checked";
                                                    $cklist_ins++;
                                                    $colors = "#25337A";
                                                    $display = "style='display: block;'";
//                                                    $marks_ins .= $value->id . ',';
                                                } else {
                                                    $ckeds = "";
//                                                     $marks_ins .= $value->id . ',';
                                                    $colors = "#C0C0C0";
                                                    $display = "style='display: none;'";
                                                }
                                                ?>
                                                <div class="container" style='color: <?php echo $colors; ?>;width: auto;' onclick="inspection_check(<?php echo $value->id; ?>)">
                                                    <?php echo $value->defect_location; ?>
                                                    <input type="checkbox" id="chk<?php echo $value->id; ?>" class="chk" name="checked_id[]" value="<?php echo $value->id; ?>" <?php echo $ckeds; ?>>
                                                    <span class="checkmark"></span><!--onclick="inspection_check(</?php echo $value->id; ?>)"-->
                                                </div>
                                            </td>

                                            <td>
                                                <div <?php echo $display; ?>>
                                                    <?php
                                                    if (@$cat_ids) {
                                                        $cked_ins_count = count(@$cat_ids);
                                                    } else {
                                                        $cked_ins_count = 0;
                                                    }
                                                    // if(@$ckcount){
                                                    if ($res_chcked_cat->checked_cat_count == $cked_ins_count) {
                                                        $clrs = "green";
                                                    } else {
                                                        $clrs = "red";
                                                    }
                                                    $chked_ins = $cked_ins_count - $res_chcked_cat->checked_cat_count;
//                                                    $inschecktop += $chked_ins;
                                                    if(count(@$res_df)){
                                                        $ckdfins = count(@$res_df) - count(@$res_df_ins);
                                                    }else{
                                                        $ckdfins = 0;
                                                    }
                                                    $inschecktop += $ckdfins;
                                                    $inschecktop_complete += count(@$res_df_ins);
                                                    
                                                    if(count(@$res_total_ch_defect)){
                                                        $ckdfins_ch = count(@$res_total_ch_defect);
                                                    }else{
                                                        $ckdfins_ch = 0;
                                                    }
                                                    $inschecktop_ch += $ckdfins_ch;
                                                    
                                                    if(@$res_total_defect->defect_count){
                                                        $ckdfins_total = @$res_total_defect->defect_count;
                                                    }else{
                                                        $ckdfins_total = 0;
                                                    }
                                                    $inschecktop_total += $ckdfins_total;
                                                    
                                                    if(@$res_emp->defect_count){
                                                        $ckdfins_total_indfct = @$res_emp->defect_count;
                                                    }else{
                                                        $ckdfins_total_indfct = 0;
                                                    }
                                                    $inschecktop_total_indfct += $ckdfins_total_indfct;
                                                    ?>
                                                    <span style='color: <?=($ckdfins > 0) ? 'red' : 'green'; ?>'><?=($ckdfins > 0) ? $ckdfins : 0; ?> Checklist Inspections Incomplete</span>
                                                    <span style='color: #C0C0C0'> / </span>
                                                    <span style='color: #25337A'><?= (@$res_total_defect->defect_count) ? @$res_total_defect->defect_count : 0; ?> Total Defects </span>
                                                    <span style='color: #C0C0C0'> / </span>
                                                    <span style='color: <?=($ckdfins_ch > 0) ? 'red' : '#25337A'; ?>'><?=($ckdfins_ch > 0) ? $ckdfins_ch : 0; ?> CH Defects </span>
                                                    <span style='color: #C0C0C0'> / </span>
                                                    <?php
                                                    if (@$res_emp->defect_count) {
                                                        $clr = "red";
                                                    } else {
                                                        $clr = "green";
                                                    }
                                                    ?>
                                                    <span style='color: <?=(@$res_emp->defect_count > 0) ? 'red' : 'green'; ?>'><?= (@$res_emp->defect_count) ? @$res_emp->defect_count : 0; ?> Defects Incomplete</span>
                                                </div>
                                            </td>

                                            <td class="text-right">
                                                <div <?php echo $display; ?>>
                                                    <?php
                                                    $ex3 = @$this->uri->segment(3);
                                                    $ex4 = @$this->uri->segment(4);
                                                    ?>
                                                    <a href="<?php echo base_url('checklists/trade_categories/' . $ex3 . '/' . $ex4 . '/' . $value->id); ?>"><i class="fa fa-arrow-circle-right" style="color: #25337A; margin-right: 35px;font-size: 30px;"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                $marks_all = rtrim($marks, ',');
                                $marks_all_ins = rtrim($marks_ins, ',');
                                $locids_all = rtrim($locids, ',');
                                if ($cklist_ins == count($val)) {
                                    ?>
    <!--<script>$('.inscheck').attr('disabled', true);</script>-->
                                <?php } ?>
                            <script>
                                $('#ckindefect_complete').html('<?=($inschecktop_complete > 0) ? $inschecktop_complete : 0; ?>');
                                $('#ckindefect').html('<?=($inschecktop > 0) ? $inschecktop : 0; ?>');
                                $('#ckindefect_ch').html('<?=($inschecktop_ch > 0) ? $inschecktop_ch : 0; ?>');
                                $('#ckindefect_total').html('<?=($inschecktop_total > 0) ? $inschecktop_total : 0; ?>');
                                $('#ckindefect_total_indfct').html('<?=($inschecktop_total_indfct > 0) ? $inschecktop_total_indfct : 0; ?>');
                            </script>
                            </tbody>
                            <tbody>
                                <?php
                                foreach ($val as $value) {
                                    $res_inspection_location = $this->Checklists_model->get_inspection_location($value->id, @$this->uri->segment(3), @$this->uri->segment(4));
                                    if ($res_inspection_location == "") {
//                                        $marks_ins .= $value->id . ',';
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                if ($res_inspection_location) {
                                                    $ckeds = "checked";
                                                    $colors = "#25337A";
                                                } else {
                                                    $ckeds = "";
                                                    $colors = "#C0C0C0";
                                                }
                                                ?>
                                                <div class="container" style='color: <?php echo $colors; ?>;width: auto;' onclick="inspection_check(<?php echo $value->id; ?>)">
                                                    <?php echo $value->defect_location; ?>
                                                    <input type="checkbox" id="chk<?php echo $value->id; ?>" class="chk" name="checked_id[]" value="<?php echo $value->id; ?>" <?php echo $ckeds; ?>>
                                                    <span class="checkmark"></span><!--onclick="inspection_check(</?php echo $value->id; ?>)"-->
                                                </div>
                                            </td>
                                            <td>
                                            </td>
                                            <td class="text-right">
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
//                                $marks_all_ins = rtrim($marks_ins, ',');
                                ?>
                            </tbody>
                        </table>

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
                <form action="<?php echo base_url('checklists/status_all_complete'); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Date</label>
                                <input type="date" name="completion_date" class="form-control" required="">
                                <input type="hidden" name="ids" id="compated" value="<?php echo $marks_all; ?>" class="form-control" required="">
                                <input type="hidden" name="is_completed" value="1" class="form-control" required="">
                                <input type="hidden" name="url" value="<?php echo base64_encode(current_url()); ?>" class="form-control" required="">
                                <input type="hidden" name="tract_id" value="<?php echo @$this->uri->segment(3); ?>" class="form-control" required="">
                                <input type="hidden" name="lot_id" value="<?php echo @$this->uri->segment(4); ?>" class="form-control" required="">
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

    function send_checklists_report() {
        $('#loadingb').show();
        // var ckindefect = $('#ckindefect').html();
        var ckindefect = $('#ckindefect_complete').html();
        $.ajax({
            url: '<?= base_url() . 'checklists/send_checklists_report/' ?>',
            data: {tract: <?php echo $this->uri->segment(3); ?>, lot: <?php echo $this->uri->segment(4); ?>, loc_ids: '<?php echo @$locids_all; ?>', all_checklist_ins: ckindefect},
            type: 'post',
            success: function (data) {
                 console.log(data);
                if(data == 1){
                toastr.remove();
                toastr.success('Checklists report mail has been sent.', {timeOut: 5000});
                }else{
                toastr.remove();
                toastr.error('You have not any defect so checklists report mail has been not sent.', {timeOut: 5000});
                }
                $('#loadingb').hide();
            }
        });
    }

    // function send_checklists_report(){
    // $('#loadingb').show();
    // $.ajax({
    // url: '<?= base_url() . 'checklists/send_checklists_report/' ?>',
    // data: {tract: <?php echo $tract_data->tract_no; ?>, lot: <?php echo $lot_data->lot_no; ?>, total_defect: <?php echo @$defect_count->defect_count; ?>, total_in_defect: <?php echo @$incomplete_defect_count->defect_count; ?>, ckindefect: $('#ckindefect').html()},
    // type: 'post',
    // success: function (data) {
    // console.log(data);
    // if(data == 1){
    // toastr.remove();
    // toastr.success('Checklists report mail has been sent.', {timeOut: 5000});
    // }else{
    // toastr.remove();
    // toastr.error('Checklists report mail has been not sent.', {timeOut: 5000});
    // }
    // $('#loadingb').hide();
    // }
    // });
    // }

    function inspection_check(locid) {
        var l = document.getElementById('chk' + locid);
        if (l.checked == true) {
            var ck = 1;
        } else {
            var ck = 2;
        }
        $('#loadingb').show();
        $.ajax({
            url: '<?= base_url() . 'checklists/inspection_location/' ?>',
            data: {tract_id: <?php echo $this->uri->segment(3); ?>, lot_id: <?php echo $this->uri->segment(4); ?>, locid: locid, type: ck},
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
            url: '<?= base_url() . 'checklists/inspection_location_category_all_defect_checklist/' ?>',
            data: {tract_id: <?php echo $this->uri->segment(3); ?>, lot_id: <?php echo $this->uri->segment(4); ?>, locid: '<?php echo $marks_all_ins; ?>'},
            type: 'post',
            success: function (data) {
//                console.log(data);
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

//    function inspection_check_all() {
//        $('#loadingb').show();
//        $.ajax({
//            url: '<?= base_url() . 'checklists/inspection_location_all/' ?>',
//            data: {tract_id: <?php echo $this->uri->segment(3); ?>, lot_id: <?php echo $this->uri->segment(4); ?>, locid: '<?php echo $marks_all_ins; ?>'},
//            type: 'post',
//            success: function (data) {
//                if (data == 1) {
//                    window.location.href = "";
//                } else {
//                    toastr.remove();
//                    toastr.error('Something went wrong.', {timeOut: 5000});
//                }
//                $('#loadingb').hide();
//            }
//        });
//    }

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

