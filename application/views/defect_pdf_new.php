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
                color: #111;
                float: left;
                font-weight: 500;
                margin-right: 15px;
                width: 100px;
                font-size: 14px;
            }
            .text_tbl{
                float: left;
                color: #111;
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
            <div class="col-lg-4" style="float: left;width: 33%;text-align: center;">
                <b style="color: #25337A;font-weight: bold;font-size: 20px;font-family: arial, sans-serif;text-align: center">
                    <?php
                    if (@$this->uri->segment(3)) {
                        $ex = explode('-', @$this->uri->segment(3));
                        $tract_id = base64_encode(base64_encode($ex[0]));
                        $lot_id = base64_encode(base64_encode($ex[1]));
                        $tract_data = $this->home_model->get_tract_name($tract_id);
                        $lot_data = $this->home_model->get_lot_name($lot_id);
                        ?>
                        <?php echo $tract_data->tract_no; ?> / <?php echo $lot_data->lot_no; ?>
                    <?php } ?>
                </b>
            </div>
            <div class="col-lg-4" style="float: left;width: 33%;text-align: right;">
                <?php
                if (!empty($data_cat)) {
                foreach ($data_cat as $row_cat) {
                    if(@$this->uri->segment(4) == $row_cat->id){
                ?>
                <b style="color: #25337A;font-weight: bold;font-size: 15px;font-family: arial, sans-serif;text-align: center"><?php echo $row_cat->category_name; ?></b>
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
                            <th colspan="1"><?php echo $df_txt; ?></th>
                            <th colspan="3"><?php if(@$lot_n_tract_no!=''){ echo $lot_n_tract_no; } ?></th>
                        </tr>
                    </thead>
                   <tbody>
                        <?php
                        if (count($data) == 0) {
                            echo "<tr><td colspan='4' style='color: red;'>" . RECORD_NOT_FOUND . "</td></tr>";
                        } else {
                            foreach ($data as $keyname => $data) {
                                $colorCode1 = '#000000';
                                $colorCode2 = '#000000';
                                
                                $getLableCode = $this->db->query("SELECT * FROM `label_tbl` where id= (SELECT label FROM `label_association_tbl` where status = 1 and company_id = '".$data[0]->company_id."' and category_id = (SELECT category_id FROM `tracts_category_partner_associations_tbl` where tract_id = '".$data[0]->tract_id."' and status=1 and partner_id = (select id from trade_partner_tbl where partner_name='".$keyname."' OR partner_name='".lcfirst($keyname)."') limit 1))")->row();
                                
                               
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
                                
                    //             if($keyname !=''){
                    //             $getLableCode = $this->db->query("SELECT * FROM `label_tbl` where id= (SELECT label FROM `label_association_tbl` where company_id = '".$data->company_id."' and category_id = (SELECT category_id FROM `tracts_category_partner_associations_tbl` where tract_id = '".$data->tract_id."' and partner_id = (select id from trade_partner_tbl where partner_name='".$keyname."')))")->row();
                    //                 echo $this->db->last_query();
                    // $colorCode =  $getLableCode->color_code;
                   
                    //             }
                                ?>
                        <tr>    
                                
                                <td colspan="4" style="font-weight:bold;font-size: 15px;">
                                <table style="border: none;">

                                <tr>
                                <td style="width: 5px;height: 5px;padding: 2px 4px;background: <?php echo $colorCode1; ?>;border: none;">&nbsp;</td>
                                <td style="width: 5px;padding: 5px 4px;height: 5px;background: <?php echo $colorCode2; ?>;border: none;">&nbsp;</td>
                                <td style="padding: 0 12px; border: none;"><?php if($keyname !='') echo  $keyname; else echo '-';  ?> </td>
                                </tr>
                                </table>
                                <!-- <p style="border:0px solid red;height:auto;width:auto;display:inline-table;float:left;margin-right:10px;">
                                    <span style="padding:0 10px;margin-right:0 !important;background: </?php echo $colorCode1; ?>;height: 20px;float:left">A</span>
                                    <span style="padding:0 10px;margin-right:0 !important;background: </?php echo $colorCode2; ?>;height: 20px;float:left">B</span>
                                </p>
                                <div style="display:inline-table"></?php if($keyname !='') echo  $keyname; else echo '-';  ?></div></td> -->
                                </tr>
                                <?php foreach($data as $data){
                            $ctgr = json_decode($data->trade_category);
                        ?>
                            <tr>
                                <td>
                                    <div class="title_tbl">Code: <span class="text_tbl"><?php echo $data->scanner_code; ?>&nbsp;</span></div>
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
                         } }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>