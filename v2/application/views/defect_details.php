<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox.min.css">
<script src="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox.min.js"></script>
<style>
    .profile-basic{margin-left: 40px !important;}
    .personal-info{margin-left: 0;}
    ul.personal-info li{clear: both;}
    .image_view_lg{
        width: 100px;
        height: 100px;
        /*object-fit: cover;*/
        border: 2px solid gainsboro;
        margin-right: 5px;
        margin-bottom: 5px;
    }
    .back_btn{width: 100px;margin-left: 45px;}
    .crst{position: absolute;left: -25px;top: -27px;}
    .change_sts{
        width: 170px;float: right;margin-top: -54px;
    }
    @media (max-width: 768px){
        .profile-basic{margin-left: 0 !important;}
        .title{width: 100% !important;}
        .text{width: 100% !important;}
        .back_btn{margin-left: 15px;}
        .crst{left: 0;top: 15px;}
        .change_sts{
            margin-top: 10px !important;
        }
        .profile-view{padding: 0 !important;}
    }
</style>
<div class="content container-fluid">
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success clearfix"><?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    <?php } if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger clearfix"><?php echo $this->session->flashdata('error'); ?></div>
    <?php } ?>
    <div class="card mb-0">
        <div class="card-header">
            <?php
            $uri3 = "";
            $uri4 = "";
            $uri5 = "";
            if (@$this->uri->segment(3)) {
                $uri3 = '/' . $this->uri->segment(3);
            }
            if (@$this->uri->segment(4)) {
                $uri4 = '/' . $this->uri->segment(4);
            }
            if (@$this->uri->segment(5)) {
                $uri5 = '/' . $this->uri->segment(5);
            }

            $url_change = "";
            if ($this->uri->segment(4) == "sl") {
                $url_change = base_url('search_label');
            } else if ($this->uri->segment(5) == "tl") {
                $url_change = base_url('search_defect/search_result/' . $this->uri->segment(4));
            } else if ($this->uri->segment(5) == "p") {
                $url_change = base_url('search_defect/search_result_partner/' . $this->uri->segment(4));
            } else if ($this->uri->segment(5) == "chk") {
                $url_change = base_url(base64_decode($this->uri->segment(4)));
            }
            ?>
			<?php if(@$this->uri->segment(4) != ""){ ?>
            <a href="<?php echo $url_change; ?>" class="btn btn-primary">&nbsp;<i class="fa fa-angle-double-left"></i> Back&nbsp;</a>
            <?php if ($this->session->userdata('type') == 1) { ?>
                <a href="<?php echo base_url('home/edit_defect/' . base64_encode(base64_encode($data->id)) . $uri3 . $uri4 . $uri5.'/'.base64_encode(current_url())); ?>" class="btn btn-info">&nbsp;<i class="fa fa-edit"></i> Edit</a>
                <a href="<?php echo base_url('search_label/delete_defect/' . base64_encode(base64_encode($data->id)) .'/'. base64_encode(base64_encode($url_change))); ?>" onclick="return confirm('Are you sure you want to delete this defect?');" class="btn btn-danger">&nbsp;<i class="fa fa-trash-o"></i> Delete</a>
            <?php } }else{ ?>
                <a class="btn">&nbsp;&nbsp;</a>
            <?php } ?>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if ($data->is_completed == 1) {
                        $status = "Complete - ".date('F d, Y', strtotime($data->completion_date));
                        $color_status = "green";
                    } else if ($data->is_completed == 2) {
                        $status = "In Progress";
                        $color_status = "blue";
                    } else {
                        $status = "Incomplete";
                        $color_status = "red";
                    }
                    if ($this->session->userdata('type') != 3) {
                        ?>
                        <div class="col-lg-4 float-right">
                            <div class="form-group change_sts">
                                <select class="select" id="status" onchange="status_change(this.value)">
                                    <option value="none">Change Status</option>
                                    <option value="0">Incomplete</option>
                                    <option value="2">In Progress</option>
                                    <option value="1">Complete</option>
                                </select>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="profile-view" style="clear: both;">
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-7">
                                    <!--<h2 class="theme_color">Defect Detail - <span style="color: ;"><?php echo $data->scanner_code; ?></span></h2><br>-->
                                    <h3 class="theme_color">Defect Detail - <span style="color: <?php echo $color_status; ?>;"><?php echo $status; ?></span></h3><br>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Code:</div>
                                            <div class="text"><?php echo $data->scanner_code; ?>&nbsp;</div>
                                        </li>
                                        <?php
                                        $tract_id = base64_encode(base64_encode($data->tract_id));
                                        $lot_id = base64_encode(base64_encode($data->lot_id));
                                        $tract_data = $this->home_model->get_tract_name($tract_id);
                                        $lot_data = $this->home_model->get_lot_name($lot_id);
                                        ?>
                                        <li>
                                            <div class="title">Tract No:</div>
                                            <div class="text"><?php echo $tract_data->tract_no; ?>&nbsp;</div>
                                        </li>

                                        <li>
                                            <div class="title">Lot No:</div>
                                            <div class="text"><?php echo $lot_data->lot_no; ?>&nbsp;</div>
                                        </li>

                                        <li>
                                            <div class="title">Trade Category:</div>
                                            <div class="text">
                                                <?php
                                                $cat = json_decode($data->trade_category);
                                                for ($i = 0; $i < count($cat); $i++) {
                                                    if ($i == 0) {
                                                        $getCat = $this->search_defect_model->get_category_by_id($cat[$i]);
                                                        echo $getCat->category_name;
                                                    }
                                                }
                                                ?>
                                                &nbsp;
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">Trade Partner:</div>
                                            <div class="text">
                                                <?php
                                                $prtnr = json_decode($data->trade_partner);
                                                for ($p = 0; $p < count($prtnr); $p++) {
                                                    if ($p == 0) {
                                                        $getPrtnr = $this->search_defect_model->get_partner_by_id($prtnr[$p]);
                                                        echo $getPrtnr->partner_name;
                                                    }
                                                }
                                                ?>
                                                &nbsp;
                                            </div>
                                        </li>

                                        <?php
                                        $cat = json_decode($data->trade_category);
                                        $prtnr = json_decode($data->trade_partner);
                                        for ($i = 0; $i < count($cat); $i++) {
                                            if ($i != 0) {
                                                ?>
                                                <li>
                                                    <div class="title" style="color: green;">Follow-up Category:</div>
                                                    <div class="text">
                                                        <?php
                                                        $getCat = $this->search_defect_model->get_category_by_id($cat[$i]);
                                                        echo $getCat->category_name;
                                                        ?>
                                                        &nbsp;
                                                    </div>
                                                </li>
                                                <?php if (@$prtnr[$i] != "") { ?>
                                                    <li>
                                                        <div class="title" style="color: green;">Follow-up Partner:</div>
                                                        <div class="text">
                                                            <?php
                                                            $getPrtnr = $this->search_defect_model->get_partner_by_id($prtnr[$i]);
                                                            echo $getPrtnr->partner_name;
                                                            ?>
                                                            &nbsp;
                                                        </div>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>

                                        <li>
                                            <div class="title">Defect Description:</div>
                                            <div class="text"><?php echo $data->description; ?>&nbsp;</div>
                                        </li>
                                        <li>
                                            <div class="title">Defect Type:</div>
                                            <div class="text"><?php echo $data->defect_type_name; ?>&nbsp;</div>
                                        </li>
                                        <li>
                                            <div class="title">Defect Location:</div>
                                            <div class="text"><?php echo $data->defect_location_name; ?>&nbsp;</div>
                                        </li>
                                        <!--<li>
                                            <div class="title">Label Image(s):</div>
                                            <div class="text img_fancy">
                                        <?php
// $image = json_decode($data->image);
// for($img=0; $img<count($image); $img++){
// echo '<a href="'.$image[$img].'"><img src="'.$image[$img].'" class="image_view_lg" style="height: 120px;width: 140px;object-fit: cover;"></a>';
// }
                                        ?>
                                                                                                &nbsp;
                                                                                        </div>
                                        </li>-->
                                    </ul>
                                </div>
                                <div class="col-md-5">
                                    <?php
                                    $image = json_decode($data->image);
                                    if ($image[0]) {
                                        ?>
                                        <h4>Label Image(s):</h4>
                                        <div class="text img_fancy">
                                            <?php
                                            for ($img = 0; $img < count($image); $img++) {
                                                echo '<a href="' . $image[$img] . '"><img src="' . $image[$img] . '" class="image_view_lg" style="height: 120px;width: 140px;object-fit: cover;"></a>';
                                            }
                                            ?>
                                            &nbsp;
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
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
                <form action="<?php echo base_url('search_label/status_complete'); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Date</label>
                                <input type="date" name="completion_date" class="form-control" required="">
                                <input type="hidden" name="id" value="<?php echo $data->id; ?>" class="form-control" required="">
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

    function status_change(ele) {
        if(ele == 1){
            $('#status_modal').modal('show');
        }else{
            if (ele != "") {
                var check = confirm("Are you sure you want to change status?");
                if (check == true) {
                    window.location.href = "<?php echo base_url('incomplete_defects/defect_status_change/' . $data->id . '/' . @$this->uri->segment(3) . '/' . @$this->uri->segment(4) . '/' . @$this->uri->segment(5)); ?>/" + ele;
                } else {
                    // document.getElementById("status").value = "none";
                }
            }
        }
    }
    
    $(document).ready(function () {
        $(".img_fancy a").attr("data-fancybox", "mygallery");
        $(".img_fancy a").fancybox();
    });
</script>