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
    .tract_select{width: 150px;float: right;margin: 0;margin-right: 5px;}
    .lot_select{width: 150px;float: right;margin: 0;}
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
                <?php
                if (@$this->uri->segment(3)) {
                    $partner_dt = $this->search_defect_model->get_partner_name($this->uri->segment(3));
                    ?>
                    <h3 class="page-title"><?php echo $partner_dt->partner_name; ?></h3>
                <?php } ?>
            </div>
           <!-- <div class="col-auto float-right ml-auto">
           <a href="</?= base_url('search_defect/search_result_partner'.@$uri3.@$uri4.@$uri5.'?defect_export=1') ?>" class="btn add-btn" style="border-radius: 5px;padding: 8px;margin-left: 5px;min-width: 0 !important;"> &nbsp;<i class="fa fa-download"></i></a>
            </div> -->
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                <div class="card-body p-20 text-center">

                    <div class="col-sm-12 clearfix">

                        <div class="col-lg-12 p-0">
                            <?php
                            $uri3 = "";
                            $uri4 = "";
                            $uri5 = "";
                            if(@$this->uri->segment(3)){
                                $uri3 = '/'.@$this->uri->segment(3);
                            }
                            if(@$this->uri->segment(4)){
                                $uri4 = '/'.@$this->uri->segment(4);
                            }
                            if(@$this->uri->segment(5)){
                                $uri5 = '/'.@$this->uri->segment(5);
                            }
                            ?>
                            <button type="submit" onclick="marke_as_complete()" class="btn add-btn" style="border-radius: 5px;padding: 8px;margin-left: 5px;min-width: 0 !important;"> Mark All Selected As Complete </button>
                            <a href="<?= base_url('search_defect/search_result_partner'.@$uri3.@$uri4.@$uri5.'?defect_export=1') ?>" class="btn add-btn" style="border-radius: 5px;padding: 8px;margin-left: 5px;min-width: 0 !important;"> &nbsp;<i class="fa fa-download"></i></a>
                            <div class="form-group lot_select">
                                <select class="select" id="lots" name="lot_id" onchange="lot_select(this.value)">
                                    <option value="">All Lot</option>
                                    <?php
                                    if ($data_lot) {
                                        foreach ($data_lot as $row_lot) {
                                            ?>
                                            <option value="<?php echo $row_lot->id; ?>"><?php echo $row_lot->lot_no; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <script> document.getElementById('lots').value = <?php echo @$this->uri->segment(5); ?>;</script>
                            </div>

                            <div class="form-group tract_select">
                                <select class="select" id="tracts" name="tract_id" onchange="tract_select(this.value)">
                                    <option value="">All Tract</option>
                                    <?php foreach ($data_tract as $row) { ?>
                                        <option value="<?php echo $row->id; ?>"><?php echo $row->tract_no; ?></option>
                                    <?php } ?>
                                </select>
                                <script> document.getElementById('tracts').value = <?php echo @$this->uri->segment(4); ?>;</script>
                            </div>
                            
                        </div>

                        <br/><br/>
                        <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success clearfix mt-3 text-left"><?php echo $this->session->flashdata('success'); ?>
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                            </div>
                        <?php } if ($this->session->flashdata('error')) { ?>
                            <div class="alert alert-danger clearfix mt-3 text-left"><?php echo $this->session->flashdata('error'); ?></div>
                        <?php } ?>
                        
                        <div class="table-responsive">
                            <table class="datatable table table-stripped mb-0">
                                <thead>
                                    <tr>
                                    <th style="width:2%;text-align: center;" align="center"><input  type="checkbox" id="select_all" value=""/></th>
                                        <th width="35%" class="theme_color" colspan="4">All Defects</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($data) == 0) {
                                        echo "<td colspan='4' class='text-danger'>" . RECORD_NOT_FOUND . "</td>";
                                    } else {
                                    foreach ($data as $data) {
                                        $tract_name = $this->home_model->get_tract_name(base64_encode(base64_encode($data->tract_id)));
                                        $lot_name = $this->home_model->get_lot_name(base64_encode(base64_encode($data->lot_id)));
                                        $prtnr = json_decode($data->trade_partner);
                                        if (in_array($this->uri->segment(3), $prtnr)) {
                                            ?>
                                            <tr>
                                            <td  style="width:2%" align="center">
                                        <?php if ($data->is_completed != 1) { ?>
                                        <input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $data->id; ?>"/>
                                        <?php } ?>
                                        </td>  
                                                <td>
                                                    <div class="title_tbl">Code:</div> <div class="text_tbl"><?php echo $data->scanner_code; ?>&nbsp;</div>
                                                    <div class="title_tbl">Tract/Lot:</div> <div class="text_tbl"><?php echo $tract_name->tract_no; ?>/<?php echo $lot_name->lot_no; ?>&nbsp;</div>
                                                    <div class="title_tbl">Category:</div> <div class="text_tbl">
                                                        <?php
														$cd = "";
                                                        $cat = json_decode($data->trade_category);
                                                        for ($i = 0; $i < count($cat); $i++) {
                                                            // if ($i == 0) {
                                                                $getCat = $this->search_defect_model->get_category_by_id($cat[$i]);
                                                                $cd .= @$getCat->category_name.', ';
                                                            // }
                                                        }
														echo rtrim($cd, ', ');
                                                        ?>
                                                        &nbsp;
                                                    </div>
                                                    <div class="title_tbl">Partner:</div> <div class="text_tbl">
                                                        <?php
														$pd = "";
														$prtnr = json_decode($data->trade_partner);
														for ($p = 0; $p < count($prtnr); $p++) {
															// if ($p == 0) {
																$getPrtnr = $this->search_defect_model->get_partner_by_id($prtnr[$p]);
																$pd .= @$getPrtnr->partner_name.', ';
															// }
														}
														echo rtrim($pd, ', ');
														?>
														&nbsp;
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="title_tbl">Location:</div> <div class="text_tbl"><?php echo $data->defect_location_name; ?>&nbsp;</div>
                                                    <div class="title_tbl">Type:</div> <div class="text_tbl"><?php echo $data->defect_type_name; ?>&nbsp;</div>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($data->is_completed == 1) { ?>
                                                        <span style="color: green;">Complete</span><br/>
                                                    <?php } else if ($data->is_completed == 2){ ?>
                                                        <span style="color: blue;">In Progress</span><br/>
                                                    <?php }else{ ?>
                                                        <span style="color: red;">Incomplete</span><br/>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?php echo base_url('search_label/defect_details/' . base64_encode(base64_encode($data->scanner_code)).'/'.$this->uri->segment(3).'/p'); ?>" class="theme_color" style="font-size: 30px;"><i class="fa fa-arrow-circle-right"></i></a>
<!--                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="<?php echo base_url('search_label/defect_details/' . base64_encode(base64_encode($data->scanner_code)).'/'.$this->uri->segment(3).'/p'); ?>"><i class="fa fa-info-circle m-r-5"></i> Detail</a>
                                                        </div>
                                                    </div>-->
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

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
                <form action="<?php echo base_url('search_label/status_all_complete'); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Date</label>
                                <input type="date" name="completion_date" class="form-control" required="">
                                <input type="hidden" name="ids" id="compated" value="" class="form-control" required="">
                                <input type="hidden" name="is_completed" value="1" class="form-control" required="">
                                <input type="hidden" name="url" value="<?php echo base64_encode(current_url()); ?>" class="form-control" required="">
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

<script>
function marke_as_complete() {
            var get_val = $("#compated").val();
            if(get_val != ""){
                $('#status_modal').modal('show');
            }else{
                alert('Please select atleast one defect.');
            }
           
    }
    $(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            var final ='';
            //var final= $("#compated").val();
            $('.checkbox').each(function(){
                this.checked = true;
                final += $(this).val()+',';
            });
            $("#compated").val( final.replace(/,+$/,''));
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
            $("#compated").val('');
        }
    });
	
    $('.checkbox').on('click',function(){
        var final_vl= $("#compated").val();
        var lv='';
        if(final_vl !=''){
            lv = $("#compated").val()+',';
        }
        if(this.checked){
            $("#compated").val(lv+$(this).val());
        }else{
            
            Pop($("#compated").val(), $(this).val());
        }
    });
});
function Pop(arra,val) {
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
    function tract_select(ele) {
        window.location.href = "<?php echo base_url('search_defect/search_result_partner/' . $this->uri->segment(3)); ?>/" + ele;
    }

    function lot_select(ele) {
        window.location.href = "<?php echo base_url('search_defect/search_result_partner/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)); ?>/" + ele;
    }

</script>