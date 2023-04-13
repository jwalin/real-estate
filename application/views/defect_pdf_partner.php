<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Report PDF</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <style>
            @page {
                margin-top: 0cm;
                margin-bottom: 0cm;
                margin-right: 0.5cm;
                margin-left: 0.5cm;
            }
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
                border: 1px solid gainsboro;
            }
            td, th {
                text-align: left;
                padding: 12px;
                font-size: 13px;
                border-bottom: 1px solid gainsboro;
            }
            th{background: #25337A;color: gainsboro;}
            .table td{vertical-align: middle;}
            thead{border-top: 2px solid gainsboro;}
            .title_tbl{
                color: #4f4f4f;
                float: left;
                font-weight: 500;
                margin-right: 15px;
                width: 100px;
                font-size: 14px;
            }
            .text_tbl{
                float: left;
                color: #8e8e8e;
                font-size: 14px;
                margin-bottom: 5px;
            }
        </style>
    </head>
    <body>
        <div class="col-lg-12" style="padding: 20px 0;">
            <div class="col-lg-4" style="float: left;width: 33%;text-align: left;">
                <?php $sess_company_data = $this->info_model->get_company_data(); ?>
                <b style="color: #25337A;font-weight: bold;font-size: 15px;font-family: arial, sans-serif;float: left;"><?php echo @$sess_company_data->company_name; ?></b>
            </div>
            
            <?php if(@$code){ ?>
            <div class="col-lg-2" style="float: left;width: 14%;text-align: left;padding:left 10px;">
            <?php }else{ ?>
            <div class="col-lg-4" style="float: left;width: 33%;text-align: center;">
            <?php } ?>
            <?php 
            $code = false;
            if (@$this->uri->segment(3)) {
                $partner_dt = $this->search_defect_model->get_partner_name($this->uri->segment(3));
             if ($data_tract) {
                foreach ($data_tract as $row) {
                if(@$this->uri->segment(4) == $row->id){
                    $code = true;
            $colorCode1 = '#000000';
            $colorCode2 = '#000000';
            
            $getLableCode = $this->db->query("SELECT * FROM `label_tbl` where id= (SELECT label FROM `label_association_tbl` where status = 1 and company_id = '".$this->session->userdata('company_id')."' and category_id = (SELECT category_id FROM `tracts_category_partner_associations_tbl` where tract_id = '".$row->id."' and status=1 and partner_id = '".$partner_dt->id."' limit 1))")->row();
            
           
            //$code = explode(',',$data[0]->labelColor);
            if(!empty($getLableCode)){
            $code = explode(',', $getLableCode->color_code);
            if(count($code)==1){
                $colorCode1 = $getLableCode->color_code;
                $colorCode2 = $getLableCode->color_code;
            }elseif(count($code)==2){
                $colorCode1 = $code[0];
                $colorCode2 = $code[1];
            }
            }
        
            ?>
            <table style="border: none;width: 7%;margin: auto;margin-top: -5px;">

<tr>
<td style="width: 5px;height: 10px;padding: 10px 0px;border: 0px solid red;">
<div style="width: 5px;height: 10px;background: <?php echo $colorCode1; ?>;border: none;color:<?php echo $colorCode1; ?>">2</div>
</td>
<td style="width: 5px;padding: 10px 0px;height: 10px;border: 0px solid red">
<div style="width: 5px;height: 10px;background: <?php echo $colorCode2; ?>;border: none;color:<?php echo $colorCode1; ?>">1</div>
</td>
<?php if($code) { 
     if (@$this->uri->segment(3)) {
        $partner_dt = $this->search_defect_model->get_partner_name($this->uri->segment(3)); ?>
    <td style="padding: 0 12px; border: none;font-weight:bold;color: #25337A;font-size: 20px;font-family: arial, sans-serif;"><?php echo $partner_dt->partner_name; ?> </td>
<?php } } ?>

</tr>
</table>

            <?php
             } } } }
            
            ?>
            <?php if(!$code) { ?>
                <b style="color: #25337A;width: 100px;float:left;font-weight: bold;font-size: 20px;font-family: arial, sans-serif;text-align: center">
                    <?php
                    if (@$this->uri->segment(3)) {
                    $partner_dt = $this->search_defect_model->get_partner_name($this->uri->segment(3));
                    ?>
                   
                    <?php echo $partner_dt->partner_name; ?>
                    <?php } ?>
                </b>
                <?php } ?>
            </div>
            <div class="col-lg-4" style="float: left;width: 33%;text-align: right;">
                <?php
                    if ($data_tract) {
                    foreach ($data_tract as $row) {
                    if(@$this->uri->segment(4) == $row->id){
                ?>
                <b style="color: #25337A;font-weight: bold;font-size: 15px;font-family: arial, sans-serif;text-align: center"><?php echo $row->tract_no; ?></b>
                <?php } } } ?>
                
                <?php
                    if ($data_lot) {
                    foreach ($data_lot as $row_lot) {
                    if(@$this->uri->segment(5) == $row_lot->id){
                ?>
                <b style="color: #25337A;font-weight: bold;font-size: 15px;font-family: arial, sans-serif;text-align: center"> - <?php echo $row_lot->lot_no; ?></b>
                <?php } } } ?>
            </div>
            <div class="table-responsive" style="margin-top: 15px;clear: both;">          
                <table class="table" style="width: 100%;margin: auto;font-weight: 500;font-size: 10px;color: #000;">
                    <thead>
                        <tr>
                            <?php
                                $ex = explode('-', @$this->uri->segment(3));
                                $df = @$ex[2];
                                if($df != ""){
                                    $df_txt = "Incomplete Defects";
                                }else{
                                    $df_txt = "All Defects";
                                }
                            ?>
                            <th colspan="4"><?php echo $df_txt; ?></th>
                        </tr>
                    </thead>
                   <tbody>
                        <?php
                        if (count($data) == 0) {
                            echo "<tr><td colspan='4' style='color: red;'>" . RECORD_NOT_FOUND . "</td></tr>";
                        } else {
                            foreach ($data as $data) {
                                $tract_name = $this->home_model->get_tract_name(base64_encode(base64_encode($data->tract_id)));
                                $lot_name = $this->home_model->get_lot_name(base64_encode(base64_encode($data->lot_id)));
                            $ctgr = json_decode($data->trade_category);
                        ?>
                            <tr>
                                <td>
                                    <div class="title_tbl">Code: <span class="text_tbl"><?php echo $data->scanner_code; ?>&nbsp;</span></div>
                                    <br/>
                                    <div class="title_tbl">Tract/Lot: <span class="text_tbl"><?php echo $tract_name->tract_no; ?>/<?php echo $lot_name->lot_no; ?>&nbsp;</span></div>
                                    <br/>
                                    <div class="title_tbl">Category: <span class="text_tbl">
                                        <?php
                                            $cd = "";
                                            $cat = json_decode($data->trade_category);
                                            for ($i = 0; $i < count($cat); $i++) {
    //                                                        if ($i == 0) {
                                                    $getCat = $this->search_defect_model->get_category_by_id($cat[$i]);
                                                    $cd .= @$getCat->category_name.', ';
    //                                                        }
                                            }
                                            echo rtrim($cd, ', ');
                                        ?>
                                        &nbsp;
                                        </span>
                                    </div>
                                    <br/>
                                    <div class="title_tbl">Partner: <span class="text_tbl">
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
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="title_tbl">Location: <span class="text_tbl"><?php echo $data->defect_location_name; ?>&nbsp;</span></div>
                                    <br/>
                                    <div class="title_tbl">Type: <span class="text_tbl"><?php echo $data->defect_type_name; ?>&nbsp;</span></div>
                                </td>
                                <td>
									<div class="title_tbl">Description: <span class="text_tbl"><?php echo @$data->description; ?>&nbsp;</span></div>
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
                            </tr>
                            <?php
                        }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>