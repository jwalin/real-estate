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
        font-weight: 500;
        margin-right: 15px;
        font-size: 14px;
		float: left;
    }
    .text_tbl{
        color: #8e8e8e;
        font-size: 14px;
        margin-bottom: 5px;
		float: left;
    }
    .tract_select{width: 150px;float: right;margin: 0;margin-right: 5px;}
    .lot_select{width: 150px;float: right;margin: 0;}
    @media (max-width: 768px){
        .tract_select{width: 100%;margin: 0;}
        .lot_select{width: 100%;margin-bottom: 5px;}
		.add-btn {
			width: 100%;
			margin-bottom: 5px;
		}
		
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
.sec{
	 color: darkgray;
}
.adddefect{
	float: left; 
	margin: 0px; 
	margin-bottom: 15px;
	padding: 0px 10px;
	font-size: 20px !important;
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
							$ex6 = $this->uri->segment(6);
							$ex7 = $this->uri->segment(7);
							$tract_id = base64_encode(base64_encode($ex3));
							$lot_id = base64_encode(base64_encode($ex4));
							$tract_data = $this->home_model->get_tract_name($tract_id);
							$lot_data = $this->home_model->get_lot_name($lot_id);
					?>
						<h3 class="page-title" style="font-size: 20px !important;">Checklist Defects: <?php echo $tract_data->tract_no; ?> / <?php echo $lot_data->lot_no; ?></h3>
					<?php } ?>
					
				</div>
				<div class="col-auto float-right ml-auto">
					<a href="javascipt:;"><button type="submit" onclick="marke_as_complete()" class="btn add-btn"> Mark All Selected As Complete </button></a>
					<a href="<?php echo base_url('checklists/location_category_checklist/' . $ex3 . '/' . $ex4 . '/' . $ex5 . '/' . $ex6); ?>"><button type="submit" class="btn add-btn"> Loc-Cat Checklists </button></a>
					<a href="<?php echo base_url('checklists/trade_categories/'.$ex3.'/'.$ex4.'/'.$ex5); ?>"><button type="submit" class="btn add-btn"> Trade Categories </button></a>
					<a href="<?php echo base_url('checklists/checklists_dashboard/'.$ex3.'/'.$ex4); ?>"><button type="submit" class="btn add-btn"> Checklists Dashboard </button></a>
				</div>
			</div>
        </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                <div class="card-body p-20 text-center">

                    <div class="col-sm-12 clearfix">

                       
                        <div class="table-responsive">
						<?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success clearfix mt-3 text-left"><?php echo $this->session->flashdata('success'); ?>
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                            </div>
                        <?php } if ($this->session->flashdata('error')) { ?>
                            <div class="alert alert-danger clearfix mt-3 text-left"><?php echo $this->session->flashdata('error'); ?></div>
                        <?php } ?>
                            <table class="datatable table table-stripped mb-0">
                                <h4 style="font-weight: bold; font-size: 20px;width: 100%;text-align: left;color: #25337A"><?php echo $data->defect_location; ?> - <?php echo $val->category_name; ?></h4>
				<p style="text-align: left;color: grey;"><?php echo $defect_type->defect_type; ?></p>			
                                <a href="<?php echo base_url('checklists_defect/checklists_defect_step_2/'.base64_encode(base64_encode($ex3)).'/'.base64_encode(base64_encode($ex4)).'/'. base64_encode(base64_encode($ex5)).'/'.base64_encode(base64_encode($ex6)).'/'.base64_encode(base64_encode($ex7))); ?>"><button type="submit" class="btn add-btn adddefect"> Add New Defect </button></a>
                               
                                <tbody>
									<?php 
										foreach ($value as $value) {
									?>
									<tr>
										<td>
											<?php if ($value->is_completed != 1) { ?>
											<input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $value->id; ?>"/>
											<?php } ?>
										</td>  
										<td>
											<div class="col-lg-12 p-0">
												<div class="col-lg-4 float-left p-0"><span>Code:</span></div>
												<div class="col-lg-8 float-left p-0"><span class="sec"> <?php echo @$value->scanner_code; ?></span></div>
											</div>
											<div class="col-lg-12 p-0">
												<div class="col-lg-4 float-left p-0"><span>Partner:</span></div>
												<div class="col-lg-8 float-left p-0"><span class="sec">
													<?php
                                                    $pd = "";
                                                    $prtnr = json_decode($value->trade_partner);
                                                    for ($p = 0; $p < count($prtnr); $p++) {
                                                            $getPrtnr = $this->search_defect_model->get_partner_by_id($prtnr[$p]);
                                                            $pd .= @$getPrtnr->partner_name.', ';
                                                    }
													echo rtrim($pd, ', ');
                                                    ?>
                                                    &nbsp;
												</span></div>
											</div>
											<div class="col-lg-12 p-0">
												<div class="col-lg-4 float-left p-0"><span>Type:</span></div>
												<div class="col-lg-8 float-left p-0"><span class="sec"> <?php echo @$value->defect_type_name; ?></span></div>
											</div>
											
										
										</td>
										<td>
											<div class="col-lg-12 p-0">
												<div class="col-lg-5 float-left p-0"><span>Defect Description:</span></div>
												<div class="col-lg-7 float-left p-0"><span class="sec"> <?php echo @$value->description; ?></span></div>
											</div>
											
										</td>
										<td class="text-center">
                                                <?php if ($value->is_completed == 1) { ?>
                                                    <span style="color: green;">Complete</span><br/>
                                                <?php } else if ($value->is_completed == 2){ ?>
                                                    <span style="color: blue;">In Progress</span><br/>
                                                <?php }else{ ?>
                                                    <span style="color: red;">Incomplete</span><br/>
                                                <?php } ?>
                                            </td>
										<td class="text-center">
											<?php $details_link = base64_encode('checklists/checklist_defects/'.$ex3.'/'.$ex4.'/'.$ex5.'/'.$ex6.'/'.$ex7); ?>
											<a href="<?php echo base_url('search_label/defect_details/' . base64_encode(base64_encode(@$value->scanner_code)).'/'.$details_link.'/chk'); ?>" class="theme_color" style="font-size: 30px;"><i class="fa fa-arrow-circle-right"></i></a>
										</td>
									   
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
<!-- Start Modal -->
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
                            <label>Please confirm you want to mark all selected as complete?</label>
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
<script>
    function status_modal() {
        $('#confirm_modal_defects').modal('hide');
        setTimeout(function() {
            $('#status_modal').modal('show');
        }, 500);
    }
    function marke_as_complete() {
		var get_val = $("#compated").val();
		if(get_val != ""){
            $('#confirm_modal_defects').modal('show');
// 			$('#status_modal').modal('show');
		}else{
			alert('Please select atleast one defect.');
		}
           
    }
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
</script>
