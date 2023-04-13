<style>
    .profile-basic{margin-left: 40px !important;}
    .personal-info{margin-left: 0;}
    ul.personal-info li{clear: both;}
    .image_view_lg{
        width: 100px;
        height: 100px;
        object-fit: cover;
        border: 2px solid gainsboro;
    }
    @media (max-width: 768px){
        .profile-basic{margin-left: 0 !important;}
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
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="profile-basic" style="margin-left: 0px !important;padding-right: 0;">
                            <div class="row">
                                <form action="<?php echo base_url('home/insert_review_complete_defect'); ?>" method="post" enctype="multipart/form-data" onsubmit="return validate_form()" style="width: 100%;">
                                    <div class="col-md-12">
                                        <?php
                                        if (@$this->uri->segment(3) && @$this->uri->segment(4)) {
                                            $tract_data = $this->home_model->get_tract_name(@$this->uri->segment(3));
                                            $lot_data = $this->home_model->get_lot_name(@$this->uri->segment(4));
                                        }
                                        ?>
                                        <input type="hidden" name="tract_id" id="tract_id" value="<?php echo @$tract_data->id; ?>">
                                        <input type="hidden" name="lot_id" value="<?php echo @$lot_data->id; ?>">

                                        <h2 class="theme_color">New Defect List - Step 3</h2><br>
                                        <?php
                                        if (@$this->uri->segment(3) && @$this->uri->segment(4)) {
                                            ?>
                                            <h4><?php echo $tract_data->tract_no; ?> - <?php echo $lot_data->lot_no; ?></h4><br>
                                        <?php } ?>
                                        <h4 class="mb-3"><u>Review & Complete Defect List</u></h4><br>

                                        <?php
                                        $tract_lot_temp_data = $this->home_model->get_tract_lot_temp_data(@$tract_data->id, @$lot_data->id);
                                        $d = 1;
                                        foreach ($tract_lot_temp_data as $row_datas) {
                                            ?>
                                            <input type="hidden" name="ids[]" value="<?php echo $row_datas->id; ?>">
                                            <input type="hidden" name="d[]" value="<?php echo $d; ?>">
                                            <input type="hidden" name="scanner_code[]" value="<?php echo $row_datas->scanner_code; ?>">
                                            <input type="hidden" name="image[]" value='<?php echo $row_datas->image; ?>'>
                                            <div class="col-md-12" style="border-top: 2px solid gray;padding: 15px;clear: both;">
                                                <ul class="personal-info">

                                                    <div class="col-md-6 pull-left">
                                                        <li>
                                                            <div class="title">Code:</div>
                                                            <div class="text"><?php echo $row_datas->scanner_code; ?></div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Defect Image(s):</div>
                                                            <div class="text">
                                                                <?php
                                                                $img_url = base_url() . "assets/images/no_image.png";
                                                                if ($row_datas->image) {
                                                                    $img = json_decode($row_datas->image);
                                                                    for ($i = 0; $i < count($img); $i++) {
                                                                        $j = $i + 1;
                                                                        if ($img[$i]) {
                                                                            $img_url = $img[$i];
                                                                        }
                                                                        ?>
                                                                        <img src="<?php echo @$img_url; ?>" class="image_view_lg">
                                                                        <?php
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <img src="<?php echo @$img_url; ?>" class="image_view_lg">
                                                                <?php } ?>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Defect Description:</div>
                                                            <div class="text">
                                                                <textarea rows="7" class="form-control" name="description[]"><?php echo $row_datas->description; ?></textarea>
                                                            </div>
                                                        </li>
                                                    </div>
                                                    <div class="col-md-6 pull-left">
                                                        <div id="add_more_data<?php echo $d; ?>" class="block">
                                                            <?php
                                                            $trade_category = json_decode($row_datas->trade_category);
                                                            $trade_partner = json_decode($row_datas->trade_partner);
                                                            ?>
                                                            <input type="hidden" id="add_cnt<?php echo $d; ?>" value="<?php echo count(@$trade_category); ?>">
                                                            <?php
                                                            for ($t = 0; $t < count($trade_category); $t++) {
                                                                ?>
                                                                <?php if ($t == 0) { ?>
                                                                    <script>
                                                                        $(document).ready(function () {
                                                                            category_to_defect_onload('<?php echo $trade_category[$t]; ?>', '<?php echo $d; ?>', '<?php echo $row_datas->defect_type; ?>');
                                                                        });
                                                                    </script>
                                                                    <li>
                                                                        <div class="title">Trade Category:</div>
                                                                        <div class="text">
                                                                            <select class="form-control" name="trade_category<?php echo $d; ?>[]" id="cat" required="" onchange="category_to_defect(this.value, <?php echo $d; ?>)">
                                                                                <!--<option value="">Select Trade Category</option>-->
                                                                                <?php
                                                                                $cat_ids = '';
                                                                                if ($row_datas->tract_id) {
                                                                                    $data_category = $this->home_model->get_defect_category($row_datas->tract_id);
                                                                                    foreach ($data_category as $row_data_category) {
                                                                                        ?>
                                                                                        <option value="<?php echo $row_data_category->cat_id; ?>" <?php
                                                                                        if ($row_data_category->cat_id == $trade_category[$t]) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                        ?>><?php echo $row_data_category->category_name; ?></option>
                                                                                                <?php
                                                                                                $cat_ids .= $row_data_category->cat_id . ',';
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                            </select>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="title">Trade Partner:</div>
                                                                        <div class="text">
                                                                            <select class="form-control" name="trade_partner<?php echo $d; ?>[]" id="trade_partner<?php echo $d; ?>" required="">
                                                                                <!--<option value="">Select Trade Partner</option>-->
                                                                                <?php
                                                                                if ($row_datas->tract_id) {
                                                                                    $data_partner = $this->home_model->get_defect_trade_partner($row_datas->tract_id);
                                                                                    foreach ($data_partner as $row_data_partner) {
                                                                                        ?>
                                                                                        <option value="<?php echo $row_data_partner->partner_uniq_id; ?>" <?php
                                                                                        if ($row_data_partner->partner_uniq_id == $trade_partner[$t]) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                        ?>><?php echo $row_data_partner->partner_name; ?></option>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                            </select>
                                                                        </div>
                                                                    </li>
                                                                <?php } else { ?>

                                                                    <div id="t_p<?php echo $t; ?>">
                                                                        <?php if ($t != 0) { ?>
                                                                            <img src="<?php echo base_url(); ?>assets/images/remove.png" class="removeIcon<?php echo $t; ?>" style="float: right;margin: 10px 0;cursor: pointer;">
                                                                        <?php } ?>
                                                                        <li>
                                                                            <div class="title">Trade Category:</div>
                                                                            <div class="text">
                                                                                <select class="form-control" name="trade_category<?php echo $d; ?>[]" required="">
                                                                                    <option value="">Select Trade Category</option>
                                                                                    <?php
//                                                                            $cat_ids = '';
                                                                                    if ($row_datas->tract_id) {
                                                                                        $data_category = $this->home_model->get_defect_category($row_datas->tract_id);
                                                                                        foreach ($data_category as $row_data_category) {
                                                                                            ?>
                                                                                            <option value="<?php echo $row_data_category->cat_id; ?>" <?php
                                                                                            if ($row_data_category->cat_id == $trade_category[$t]) {
                                                                                                echo 'selected';
                                                                                            }
                                                                                            ?>><?php echo $row_data_category->category_name; ?></option>
                                                                                                    <?php
//                                                                                            $cat_ids .= $row_data_category->cat_id . ',';
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                </select>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="title">Trade Partner:</div>
                                                                            <div class="text">
                                                                                <select class="form-control" name="trade_partner<?php echo $d; ?>[]" required="">
                                                                                    <option value="">Select Trade Partner</option>
                                                                                    <?php
                                                                                    if ($row_datas->tract_id) {
                                                                                        $data_partner = $this->home_model->get_defect_trade_partner($row_datas->tract_id);
                                                                                        foreach ($data_partner as $row_data_partner) {
                                                                                            ?>
                                                                                            <option value="<?php echo $row_data_partner->partner_uniq_id; ?>" <?php
                                                                                            if ($row_data_partner->partner_uniq_id == $trade_partner[$t]) {
                                                                                                echo 'selected';
                                                                                            }
                                                                                            ?>><?php echo $row_data_partner->partner_name; ?></option>
                                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                </select>
                                                                            </div>
                                                                        </li>
                                                                        <script>
                                                                            $('.removeIcon<?php echo $t; ?>').on('click', function () {
                                                                                $(this).closest("#t_p<?php echo $t; ?>").remove();
                                                                            });
                                                                        </script>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                        <li>
                                                            <div class="title">&nbsp;</div>
                                                            <div class="text">
                                                                <p class="add" onclick="add_box('<?php echo $d; ?>')" style="margin: 0;color: green;cursor: pointer;font-size: 13px;">Add a follow-up Trade Category and Trade Partner?</p>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="title">Defect Type:</div>
                                                            <div class="text">
                                                                <select class="form-control" id="defect_type<?php echo $d; ?>" name="defect_type[]">
                                                                    <option value="">Select Defect Type</option>
                                                                </select>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Location:</div>
                                                            <div class="text">
                                                                <select class="form-control" id="location" name="location[]">
                                                                    <option value="">Select Location</option>
                                                                    <?php foreach ($data_defect_location as $row_data_defect_location) { ?>
                                                                        <option value="<?php echo $row_data_defect_location->id; ?>" <?php
                                                                        if ($row_data_defect_location->id == $row_datas->defect_location) {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>><?php echo $row_data_defect_location->defect_location; ?></option>
                                                                            <?php } ?>
                                                                </select>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="title">&nbsp;</div>
                                                            <div class="text">
                                                                <a href="<?php echo base_url('home/delete_temp_defect/' . @$this->uri->segment(3) . '/' . @$this->uri->segment(4). '/' . @$row_datas->id); ?>" onclick="return confirm('<?php echo CONFIRM_ALERT_DELETE; ?>');" class="btn btn-danger mt-3" style="color: #fff;" />Remove</a>
                                                            </div>
                                                        </li>
                                                    </div>
                                                </ul>
                                            </div>
                                            <?php
                                            $d++;
                                        }
                                        ?>

                                    </div>
                                    <?php if (count($tract_lot_temp_data) != 0) { ?>
                                        <div class="col-md-12" style="clear: both;">
                                            <div class="col-md-12" style="border-top: 2px solid gray;clear: both;">
                                                <a href="<?php echo base_url('home/defect_list_step_2/' . @$this->uri->segment(3) . '/' . @$this->uri->segment(4)); ?>" class="btn btn-primary mt-3" style="color: #fff;" />Add New Defect</a>
                                                <input type="submit" name="submit_notify" class="btn btn-primary mt-3" value="Save Defect List, Notify Trades" />
                                                <input type="submit" name="submit_not_notify" class="btn btn-primary mt-3" value="Save Defect List, Do Not Notify Trades" />
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-md-12" style="clear: both;">
                                            <div class="col-md-12" style="border-top: 2px solid gray;clear: both;">
                                                <a href="<?php echo base_url('home/defect_list_step_2/' . @$this->uri->segment(3) . '/' . @$this->uri->segment(4)); ?>" class="btn btn-primary mt-3" style="color: #fff;" />Add New Defect</a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
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
    function validate_form() {
        $('#loadingb').show();
        $("input[name=submit_notify]").attr('readonly', true);
        $("input[name=submit_not_notify]").attr('readonly', true);
    }

//    $('.add').click(function () {
    function add_box(d) {
        var add_cnt = parseInt($('#add_cnt' + d).val());
        var total = add_cnt + 1;
        $('#add_cnt' + d).val(total);
        var tract_id = <?php echo $row_datas->tract_id; ?>;
        $.ajax({
            url: '<?= base_url() . 'home/ajax_trade_category_partner_review_last/' ?>',
            data: {tract_id: tract_id, total: total, uniqid: d},
            type: 'post',
            success: function (data) {
                $('#add_more_data' + d + ':last').append(data);
            }
        });
    }
//    });


//    category_to_defect(cat);
    function category_to_defect(ele, d) {

        var tract_id = <?php echo $row_datas->tract_id; ?>;
        $.ajax({
            url: '<?= base_url() . 'home/ajax_category_to_defect_type/' ?>',
            data: {cat_id: ele, tract_id: <?php echo $row_datas->tract_id; ?>},
            type: 'post',
            success: function (data) {
                var datas = JSON.parse(data);
                $('#defect_type' + d).html(datas.defect);
                $('#trade_partner' + d).html(datas.partner_all);
//                category_to_defect_type_select(d);
//                document.getElementById('defect_type'+d).value = '</?php echo $row_datas->defect_type; ?>';
            }
        });
    }

    function category_to_defect_onload(ele, d, df) {

        var tract_id = <?php echo $row_datas->tract_id; ?>;
        $.ajax({
            url: '<?= base_url() . 'home/ajax_category_to_defect_type/' ?>',
            data: {cat_id: ele, tract_id: <?php echo $row_datas->tract_id; ?>},
            type: 'post',
            success: function (data) {
                var datas = JSON.parse(data);
                $('#defect_type' + d).html(datas.defect);
                $('#trade_partner' + d).html(datas.partner_all);
//                category_to_defect_type_select(d);
                document.getElementById('defect_type' + d).value = df;
            }
        });
    }
</script>