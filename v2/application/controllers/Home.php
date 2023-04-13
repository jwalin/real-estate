<?php

class Home extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('checklists_defect_model');
        $this->load->model('Checklists_model');
    }

    public function index() {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $settings_analytics = $this->graph_model->get_settings_analytics();
        $time = "-30 day";
        if ($settings_analytics->time_period == 1) {
            $time = "-30 day";
        } else if ($settings_analytics->time_period == 2) {
            $time = "-60 day";
        } else if ($settings_analytics->time_period == 3) {
            $time = "-90 day";
        } else if ($settings_analytics->time_period == 4) {
            $time = "-180 day";
        } else if ($settings_analytics->time_period == 5) {
            $time = "-365 day";
        }
        $format = 'Y-m-d';
        $date = date($format);
        $start_date = date($format, strtotime($time . $date));
        $end_date = date("Y-m-d");
        $data['chart_type'] = $settings_analytics->chart_type;

        /* ------------------------------------------------------------------------------------------- */
        if ($this->session->userdata('type') == 4){
                $partner_id = $this->session->userdata('partner_id');
                $defect_count = $this->graph_model->get_defect_count_partner($start_date, $end_date, $partner_id);
                $lot_count = $this->graph_model->get_lot_count_partner($start_date, $end_date, $partner_id);
            }else{
                $defect_count = $this->graph_model->get_defect_count($start_date, $end_date);
                $lot_count = $this->graph_model->get_lot_count($start_date, $end_date);
            }
       
        $dcount = 0;
        $lcount = 0;
        $dcount = $defect_count->defect_count;
//        $lcount = $lot_count->lot_count;
        $lcount = count($lot_count);
        if ($lcount == 0) {
            $avg_defect_count_per_lot = 0;
        } else {
            $avg_defect_count_per_lot = $dcount / $lcount;
        }
        $data['avg_defect_count_per_lot'] = round($avg_defect_count_per_lot, 2);
        /* ------------------------------------------------------------------------------------------- */
        if ($this->session->userdata('type') == 4){
            $partner_id = $this->session->userdata('partner_id');
            $complete_defect = $this->graph_model->get_complete_defect_partner($start_date, $end_date, $partner_id);
        }else{
            $complete_defect = $this->graph_model->get_complete_defect($start_date, $end_date);
        }
        $lotcount = 0;
        $dayscount = 0;
        foreach ($complete_defect as $complete_defect) {
            if ($this->session->userdata('type') == 4){
                $partner_id = $this->session->userdata('partner_id');
                $lot_defect = $this->graph_model->get_incomplete_defect_by_lot_partner($complete_defect->lot_id, $partner_id);
            }else{
                $lot_defect = $this->graph_model->get_incomplete_defect_by_lot($complete_defect->lot_id);
            }
            
            $incomplete_count = $lot_defect->incomplete_count;
            if ($incomplete_count == 0) {

                if ($this->session->userdata('type') == 4){
                    $partner_id = $this->session->userdata('partner_id');
                    $diff_days = $this->graph_model->get_diff_days_partner($complete_defect->lot_id, $partner_id);
                }else{
                    $diff_days = $this->graph_model->get_diff_days($complete_defect->lot_id);
                }
                
                $dayscount = $dayscount + ( $diff_days->diff_days_count - $diff_days->weekend_days ) + 1;
                $lotcount++;
            }
        }
        if ($dayscount == 0) {
            $avg_days_list_completion = 0;
        } else {
            $avg_days_list_completion = $dayscount / $lotcount;
        }
        $data['avg_days_list_completion_count'] = round($avg_days_list_completion, 2);
        /* ------------------------------------------------------------------------------------------- */
        if ($settings_analytics->chart_type == 1) {
            // $p_graph = "";
            $p_graph = [];
            $get_partner = $this->graph_model->get_partner();
            foreach ($get_partner as $partner) {
                $partner_defect = $this->graph_model->get_defect_by_partner($partner->id);
                if ($partner_defect->partner_defct_count != 0) {
                if (@$lcount != 0) {
                    $partner_lot = @$partner_defect->partner_defct_count / @$lcount;
                    // $p_graph .= "['" . $partner->partner_name . "', " . $partner_lot . "],";
                    $p_graph[$partner->partner_name] = $partner_lot ;
                }
                }
            }

            if(!empty($p_graph))  {
                arsort($p_graph);
            }

            $data['partner_defect_graph'] = generateStringFromArray($p_graph);
        }
        /* ------------------------------------------------------------------------------------------- */
        if ($settings_analytics->chart_type == 2) {
            // $c_graph = "";
            $c_graph = [];
            $get_category = $this->graph_model->get_category();
            foreach ($get_category as $category) {
                $category_defect = $this->graph_model->get_defect_by_category($category->id);
                if ($category_defect->category_defct_count != 0) {
                    $category_lot = $category_defect->category_defct_count / $lcount;
                    // $c_graph .= "['" . $category->category_name . "', " . $category_lot . "],";
                    $c_graph[$category->category_name] =  $category_lot ;
                }
            }

            if(!empty($c_graph)) {
                arsort($c_graph);
            }

            $data['category_defect_graph'] = generateStringFromArray($c_graph);
        }
        /* ------------------------------------------------------------------------------------------- */
        if ($settings_analytics->chart_type == 3) {
            $t_graph = [];
            $get_tracts = $this->graph_model->get_tracts();
            foreach ($get_tracts as $tracts) {
                $tract_defect = $this->graph_model->get_defect_by_tracts($tracts->id);
                if ($tract_defect->tract_defct_count != 0) {
                    $tract_lot_count = $this->graph_model->get_lots_by_tracts($tracts->id);
                    $tract_lot = $tract_defect->tract_defct_count / $tract_lot_count->lot_count;
                    // $t_graph .= "['" . $tracts->name . "', " . $tract_lot . "],";
                    $t_graph[$tracts->name] = $tract_lot ;
                }
            }

            if(!empty($t_graph)) {
                arsort($t_graph);
            }

            $data['tracts_defect_graph'] = generateStringFromArray($t_graph);
        }
        /* ------------------------------------------------------------------------------------------- */
        if ($settings_analytics->chart_type == 4) {
            $get_complete_defect = $this->graph_model->get_complete_defect($start_date, $end_date);
            $completed_lot_no = array();
            foreach ($get_complete_defect as $complete_defect) {
//                $lot_comp_defect = $this->graph_model->get_lot_check_complete_defect($complete_defect->lot_id);
//                if (count($lot_comp_defect) == 0) {
                    $completed_lot_no[] = $complete_defect->lot_id;
//                }
            }
            $lot_complation_graph = [];
            $get_partners = $this->trade_partner_model->get_trade_partner();
            foreach ($get_partners as $get_partner) {
                $partner_lot = 0;
                $partner_complation_diff = 0;
                for ($p = 0; $p < count($completed_lot_no); $p++) {
                    $get_check_lot_partner = $this->graph_model->get_check_lot_partner($get_partner->id, $completed_lot_no[$p]);
                    if (count($get_check_lot_partner) > 0) {
                        $lot_comp_defect = $this->graph_model->get_lot_check_complete_defect($get_partner->id, $completed_lot_no[$p]);
                        if(count($lot_comp_defect) == 0){
                            $get_min_max_complation_date = $this->graph_model->get_min_max_complation_date($get_partner->id, $completed_lot_no[$p]);
                            $partner_lot++;
                            $partner_complation_diff = $partner_complation_diff + ( $get_min_max_complation_date->diff_days_count - $get_min_max_complation_date->weekend_days ) + 1;
                        }
                    }
                }
                if ($partner_lot > 0) {
                    $partner_complation_diff_per = $partner_complation_diff / $partner_lot;
                    if ($partner_complation_diff_per != 0) {
                        // $lot_complation_graph .= "['" . $get_partner->partner_name . "', " . $partner_complation_diff_per . "],";
                        $lot_complation_graph[$get_partner->partner_name] =  $partner_complation_diff_per ;
                    }
                }
            }
            
            if(!empty($lot_complation_graph)) {
                arsort($lot_complation_graph);
            }

            $data['lot_complation_graph'] = generateStringFromArray($lot_complation_graph);
        }
        /* ------------------------------------------------------------------------------------------- */
        $this->load->view('home', $data);
        $this->load->view('include/footer_new.php');
    }

    public function quick_add() {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $data['data'] = $this->tracts_model->get_tracts();
        $this->load->view('defect_list', $data);
        $this->load->view('include/footer_new.php');
    }

    public function quick_add_step_1() {
//        $id = base64_decode(base64_decode($id));
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
//        $data['data'] = $this->home_model->get_added_defect_data($id);
        $this->load->view('quick_add_step_1');
        $this->load->view('include/footer_new.php');
    }

    public function quick_add_step_2($id) {
//        $id = base64_decode(base64_decode($id));
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
//        $data['data'] = $this->home_model->get_added_defect_data($id);
        $data['data_defect_location'] = $this->defect_location_model->get_defect_location();
        $this->load->view('quick_add_step_2', $data);
        $this->load->view('include/footer_new.php');
    }

    public function review_complete_defect_list($id) {
        $id = base64_decode(base64_decode($id));
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $data['data'] = $this->home_model->get_defect_data_by_id($id);
        $data['data_defect_location'] = $this->defect_location_model->get_defect_location();
        $this->load->view('review_complete_defect_list', $data);
        $this->load->view('include/footer_new.php');
    }

    public function get_lots_by_tract_id() {
        $tract_id = $this->input->post('tract_id');
        $get_lots = $this->home_model->get_lots_by_tract_id($tract_id);
        if (!empty($get_lots)) {
            ?>
            <option value="">Select Lot</option>
            <?php foreach ($get_lots as $row_lots) {
                ?>
                <option value="<?= $row_lots->id; ?>"><?= $row_lots->lot_no; ?></option>
                <?php
            }
        } else {
            echo '<option value="">Select Lot</option>';
        }
    }

    public function insert_step_1() {
        $tract_id = $this->input->post('tract_id');
        $lot_id = $this->input->post('lot_id');
        $check = $this->home_model->get_lots_tract_check($tract_id, $lot_id);
        if ($check) {
            redirect('home/review_complete_defect_list/' . base64_encode(base64_encode($tract_id)) . '/' . base64_encode(base64_encode($lot_id)));
        } else {
            redirect('home/quick_add_step_1/' . base64_encode(base64_encode($tract_id)) . '/' . base64_encode(base64_encode($lot_id)));
        }
    }

    public function insert_step_2() {
        $tract_id = $this->input->post('tract_id');
        $lot_id = $this->input->post('lot_id');
        $scanner_url = $this->input->post('scanner_url');
        $get_check_temp = $this->home_model->get_check_code_temp($scanner_url);
        $get_check_ori = $this->home_model->get_check_code_ori($scanner_url);
        if ($get_check_temp) {
            redirect('home/review_complete_defect_list/' . $tract_id . '/' . $lot_id);
        } else if ($get_check_ori) {
            $this->session->set_flashdata('toastr_error', 'This QR code is already used.');
            redirect('home/quick_add_step_1/' . $tract_id . '/' . $lot_id);
        } else {
            redirect('home/quick_add_step_2/' . $tract_id . '/' . $lot_id . '/' . base64_encode(base64_encode($scanner_url)));
        }
    }

    public function insert_step_2_custom() {
        $tract_id = $this->uri->segment(3);
        $lot_id = $this->uri->segment(4);

        $get_code_temp = $this->home_model->get_zz_scanner_code_temp();
        $get_code_ori = $this->home_model->get_zz_scanner_code_ori();

        $ex_temp = explode('_', @$get_code_temp->scanner_code);
        $ex_ori = explode('_', @$get_code_ori->scanner_code);
        if (@$ex_ori[1] > @$ex_temp[1]) {
            $big_code = @$get_code_ori->scanner_code;
            $code = $this->sequenceNumber(3, @$ex_ori[1]);
            $scanner_url = 'ZZ_' . $code;
        } else if (@$ex_temp[1] > @$ex_ori[1]) {
            $big_code = @$get_code_temp->scanner_code;
            $code = $this->sequenceNumber(3, @$ex_temp[1]);
            $scanner_url = 'ZZ_' . $code;
        } else {
            $scanner_url = 'ZZ_001';
        }
        redirect('home/quick_add_step_2/' . $tract_id . '/' . $lot_id . '/' . base64_encode(base64_encode($scanner_url)));
    }

    public function sequenceNumber($length, $get_num) {
        return str_pad($get_num + 1, $length, 0, STR_PAD_LEFT);
    }

    public function ajax_trade_category_partner() {
        $total = $this->input->post('total');
        $tract_id = $this->input->post('tract_id');
        if ($tract_id) {
            $data_category = $this->home_model->get_defect_category($tract_id);
            // $data_partner = $this->home_model->get_defect_trade_partner($tract_id);
            $data_partner = $this->home_model->get_partner_all();
            ?>
            <div id="t_p<?php echo $total; ?>" style="margin-bottom: 15px;">
                <img src="<?php echo base_url(); ?>assets/images/remove.png" class="removeIcon<?php echo $total; ?>" style="float: right;margin: 10px 0;cursor: pointer;">
                <div class="form-group">
                    <select class="form-control cattrade" name="trade_category[]" required="" onchange="folloup_category_change(this.value, <?php echo $total; ?>)">
                        <option value="">Select Trade Category</option>
                        <?php foreach ($data_category as $row_data_category) { ?>
                            <option value="<?php echo $row_data_category->cat_id; ?>"><?php echo $row_data_category->category_name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mb-0">
                    <select class="form-control" name="trade_partner[]" required="" id="follow_up_trade_partner<?php echo $total; ?>">
                        <option value="">Select Trade Partner</option>
                        <?php foreach ($data_partner as $row_data_partner) { ?>
                            <option value="<?php echo $row_data_partner->id; ?>"><?php echo $row_data_partner->partner_name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <script>
                    $('.removeIcon<?php echo $total; ?>').on('click', function () {
                        $(this).closest("#t_p<?php echo $total; ?>").remove();
                    });
                </script>
            </div>
            <?php
        }
    }

    public function ajax_trade_category_partner_review() {
        $total = $this->input->post('total');
        $tract_id = $this->input->post('tract_id');
        if ($tract_id) {
            $data_category = $this->home_model->get_defect_category($tract_id);
            $data_partner = $this->home_model->get_defect_trade_partner($tract_id);
            ?>
            <div id="t_p<?php echo $total; ?>">
                <?php if ($total != 0) { ?>
                    <img src="<?php echo base_url(); ?>assets/images/remove.png" class="removeIcon<?php echo $total; ?>" style="float: right;margin: 10px 0;cursor: pointer;">
                <?php } ?>
                <li>
                    <div class="title">Trade Category:</div>
                    <div class="text">
                        <select class="form-control" name="trade_category[]" required="">
                            <option value="">Select Trade Category</option>
                            <?php
                            if ($tract_id) {
//                                $data_category = $this->home_model->get_defect_category(@$data->tract_id);
                                foreach ($data_category as $row_data_category) {
                                    ?>
                                    <option value="<?php echo $row_data_category->cat_id; ?>"><?php echo $row_data_category->category_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </li>
                <li>
                    <div class="title">Trade Partner:</div>
                    <div class="text">
                        <select class="form-control" name="trade_partner[]" required="">
                            <option value="">Select Trade Partner</option>
                            <?php
                            if ($tract_id) {
//                                $data_partner = $this->home_model->get_defect_trade_partner(@$data->tract_id);
                                foreach ($data_partner as $row_data_partner) {
                                    ?>
                                    <option value="<?php echo $row_data_partner->partner_uniq_id; ?>"><?php echo $row_data_partner->partner_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </li>
                <script>
                    $('.removeIcon<?php echo $total; ?>').on('click', function () {
                        $(this).closest("#t_p<?php echo $total; ?>").remove();
                    });
                </script>
            </div>
            <?php
        }
    }

    public function ajax_trade_category_partner_review_last() {
        $uniqid = $this->input->post('uniqid');
        $total = $this->input->post('total');
        $tract_id = $this->input->post('tract_id');
        if ($tract_id) {
            $data_category = $this->home_model->get_defect_category($tract_id);
            // $data_partner = $this->home_model->get_defect_trade_partner($tract_id);
            $data_partner = $this->home_model->get_partner_all();
            ?>
            <div id="t_p<?php echo $total; ?>">
                <?php if ($total != 0) { ?>
                    <img src="<?php echo base_url(); ?>assets/images/remove.png" class="removeIcon<?php echo $total; ?>" style="float: right;margin: 10px 0;cursor: pointer;">
                <?php } ?>
                <li>
                    <div class="title">Trade Category:</div>
                    <div class="text">
                        <select class="form-control" name="trade_category<?php echo $uniqid; ?>[]" required="" onchange="folloup_category_change(this.value, <?php echo $total; ?>)">
                            <option value="">Select Trade Category</option>
                            <?php
                            if ($tract_id) {
//                                $data_category = $this->home_model->get_defect_category(@$data->tract_id);
                                foreach ($data_category as $row_data_category) {
                                    ?>
                                    <option value="<?php echo $row_data_category->cat_id; ?>"><?php echo $row_data_category->category_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </li>
                <li>
                    <div class="title">Trade Partner:</div>
                    <div class="text">
                        <select class="form-control" name="trade_partner<?php echo $uniqid; ?>[]" required="" id="follow_up_trade_partner<?php echo $total; ?>">
                            <option value="">Select Trade Partner</option>
                            <?php
                            if ($tract_id) {
//                                $data_partner = $this->home_model->get_defect_trade_partner(@$data->tract_id);
                                foreach ($data_partner as $row_data_partner) {
                                    ?>
                                    <option value="<?php echo $row_data_partner->id; ?>"><?php echo $row_data_partner->partner_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </li>
                <script>
                    $('.removeIcon<?php echo $total; ?>').on('click', function () {
                        $(this).closest("#t_p<?php echo $total; ?>").remove();
                    });
                </script>
            </div>
            <?php
        }
    }

    public function insert_step_3() {
        $upload_img = "";
        if (!empty($_FILES['img'])) {
            $files = $_FILES;
            $cpt = count($_FILES['img']['name']);
            for ($i = 0; $i < $cpt; $i++) {
                $filename = $files['img']['name'][$i];
                if ($filename != "") {
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $fname = rand(100000, 999999);
                    $fullname = $fname . '.' . $ext;
                    $_FILES['img']['name'] = $files['img']['name'][$i];
                    $_FILES['img']['type'] = $files['img']['type'][$i];
                    $_FILES['img']['tmp_name'] = $files['img']['tmp_name'][$i];
                    $_FILES['img']['error'] = $files['img']['error'][$i];
                    $_FILES['img']['size'] = $files['img']['size'][$i];
                    $result = $this->do_multi_upload($fullname);
                    if ($result) {
                        $upload_img .= IMG_UPLOAD_PATH . 'defect_img/' . $fullname . ',';
                    }
                }
            }
        }
        $img = explode(',', rtrim($upload_img, ','));
        
        if($this->input->post('defect_type_input')){
            $datas = array(
                'company_id' => $this->company_id,
                'defect_type' => $this->input->post('defect_type_input'),
                'category_id' => $this->input->post('trade_category')[0],
                'closing_hold' => 1,
                'defect_location_ids' => $this->input->post('location'),
                'created_by' => $this->sess_id,
                'created_date' => $this->current_date()
            );
            $defect_type = $this->checklists_defect_model->insert_df_type($datas);
        }else{
            $defect_type = $this->input->post('defect_type');
        }

        $data = array(
            'company_id' => $this->company_id,
            'tract_id' => $this->input->post('tract_id'),
            'lot_id' => $this->input->post('lot_id'),
            'scanner_code' => $this->input->post('scanner_url'),
            'description' => $this->input->post('description'),
            'image' => json_encode($img),
            'trade_category' => json_encode($this->input->post('trade_category')),
            'trade_partner' => json_encode($this->input->post('trade_partner')),
            'defect_type' => $defect_type,
            'defect_location' => $this->input->post('location'),
            'created_by' => $this->sess_id,
            'created_date' => $this->current_date(),
            'is_save' => 1
        );
        $res = $this->home_model->insert_step_3_temp($data);
        if ($res) {
            $chk_ins = $this->Checklists_model->get_inspection_location($this->input->post('location'), $this->input->post('tract_id'), $this->input->post('lot_id'));
            if(count($chk_ins) == 0){
                $dataIns = array(
                    'tract_id' => $this->input->post('tract_id'),
                    'lot_id' => $this->input->post('lot_id'),
                    'location_id' => $this->input->post('location'),
                    'created_by' => $this->sess_id,
                );
                $res = $this->Checklists_model->insert_inspection_location($dataIns);
            }
//            $this->history_request();
            $this->session->set_flashdata('success', RECORD_ADDED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }

        $tract_id = $this->input->post('tract_id');
        $lot_id = $this->input->post('lot_id');

        if (!empty($_POST['submit'])) {
            redirect('home/quick_add_step_1/' . base64_encode(base64_encode($tract_id)) . '/' . base64_encode(base64_encode($lot_id)));
        }

        if (!empty($_POST['submit_review'])) {
            redirect('home/review_complete_defect_list/' . base64_encode(base64_encode($tract_id)) . '/' . base64_encode(base64_encode($lot_id)));
        }
    }

    public function do_multi_upload($filename) {
        $config['upload_path'] = 'upload/defect_img/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name'] = $filename;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('img')) {
            $error = array('error' => $this->upload->display_errors());
            return $this->upload->display_errors();
        } else {
            $data = array('upload_data' => $this->upload->data());
            return true;
        }
    }

    public function update_review_complete_defect() {
        $id = $this->input->post('id');
        $scanner_code = $this->input->post('scanner_code');
        $data = array(
            'description' => $this->input->post('description'),
            'trade_category' => json_encode($this->input->post('trade_category')),
            'trade_partner' => json_encode($this->input->post('trade_partner')),
            'defect_type' => $this->input->post('defect_type'),
            'defect_location' => $this->input->post('location'),
            'updated_by' => $this->sess_id,
            'updated_date' => $this->current_date()
        );
        $res = $this->home_model->update_review_complete_defect($data, $id);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_UPDATED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        if (!empty($_POST['submit_notify'])) {
            $im_prtnr = implode(',', $this->input->post('trade_partner'));
            $data_partner = array(
                'partner_ids' => rtrim($im_prtnr, ",")
            );
            $partner_email = $this->home_model->get_partner_users_email($data_partner);
            foreach ($partner_email as $row_email) {
                $email = $row_email->email;
                $url = base_url();
                $toRepArray = array('[!name!]', '[!code!]', '[!url!]', '[!img!]');
                $fromRepArray = array(
                    $row_email->name,
                    $scanner_code,
                    $url,
                    LOGO_IMG
                );
                $subject = "New defect notification arrived!";
                $message_templete = $this->load->view('email/notify_trades.html', '', true);
                $message = str_replace($toRepArray, $fromRepArray, $message_templete);
                $sent_mail = $this->send_email($email, $subject, $message);
            }
            redirect('home');
        }
        if (!empty($_POST['submit_not_notify'])) {
            redirect('home');
        }
    }

    public function ajax_category_to_defect_type1() {
        $cat_id = $this->input->post('cat_id');
        if ($cat_id) {
            $data_defect_type = $this->home_model->get_category_defect_types($cat_id);
            foreach ($data_defect_type as $row_data_defect_type) {
                ?>
                <option value="<?php echo $row_data_defect_type->id; ?>"><?php echo $row_data_defect_type->defect_type; ?></option>
                <?php
            }
        }
    }

    public function ajax_category_to_defect_type() {
        $cat_id = $this->input->post('cat_id');
        $tract_id = $this->input->post('tract_id');
        if ($cat_id) {
            $data_defect_type = $this->home_model->get_category_defect_types($cat_id);
            $defect = '<option value="">Select Defect Type</option>';
            foreach ($data_defect_type as $row_data_defect_type) {
                $defect .= '<option value="' . $row_data_defect_type->id . '">' . $row_data_defect_type->defect_type . '</option>';
            }
            $defect .= '<option value="Other">Custom Defect Type</option>';

            $data_partner = $this->home_model->get_category_partner($tract_id, $cat_id);
            $partner = '<option value="' . $data_partner->partner_id . '">' . $data_partner->partner_name . '</option>';

            $data_partner_all = $this->home_model->get_partner_all();
            $partner_all = "";
            foreach ($data_partner_all as $data_partner_all) {
                $sel = "";
                if ($data_partner->partner_id == $data_partner_all->id)
                    $sel = "selected";
                $partner_all .= '<option ' . $sel . ' value="' . $data_partner_all->id . '">' . $data_partner_all->partner_name . '</option>';
            }

            echo json_encode(array('defect' => $defect, 'partner' => $partner, 'partner_all' => $partner_all));
        }
    }
    
    public function ajax_category_loc_to_defect_type() {
        $cat_id = $this->input->post('cat_id');
        $tract_id = $this->input->post('tract_id');
        $loc_ids = $this->input->post('loc_ids');
        if ($cat_id) {
//            $data_defect_type = $this->home_model->get_category_defect_types($cat_id);
            $data_defect_type = $this->home_model->get_category_loc_defect_types($cat_id, $loc_ids);
            $query = $this->db->last_query();
            $defect = '<option value="">Select Defect Type</option>';
            foreach ($data_defect_type as $row_data_defect_type) {
                $defect .= '<option value="' . $row_data_defect_type->id . '">' . $row_data_defect_type->defect_type . '</option>';
            }
            $defect .= '<option value="Other">Custom Defect Type</option>';

            $data_partner = $this->home_model->get_category_partner($tract_id, $cat_id);
            $partner = '<option value="' . @$data_partner->partner_id . '">' . @$data_partner->partner_name . '</option>';

            $data_partner_all = $this->home_model->get_partner_all();
            $partner_all = "";
            foreach ($data_partner_all as $data_partner_all) {
                $sel = "";
                if (@$data_partner->partner_id == $data_partner_all->id)
                    $sel = "selected";
                $partner_all .= '<option ' . $sel . ' value="' . $data_partner_all->id . '">' . $data_partner_all->partner_name . '</option>';
            }

            echo json_encode(array('defect' => $defect, 'partner' => $partner, 'partner_all' => $partner_all, 'query' => $query));
        }
    }

    public function insert_review_complete_defect() {
		$notify = 1;
        if (!empty($_POST['submit_notify'])) {
            $notify = 1;
        }
        if (!empty($_POST['submit_not_notify'])) {
            $notify = 0;
        }

        $ids = $this->input->post('ids');
        $d = $this->input->post('d');
        $partner_array = array();
        for ($i = 0; $i < count($ids); $i++) {
            $ds = $d[$i];
            // if (!empty($_POST['submit_notify'])) {
                // $tract_id = base64_encode(base64_encode($this->input->post('tract_id')));
                // $lot_id = base64_encode(base64_encode($this->input->post('lot_id')));
                // $tract_name = $this->home_model->get_tract_name($tract_id);
                // $lot_name = $this->home_model->get_lot_name($lot_id);
                // $tract_no = $tract_name->tract_no;
                // $lot_no = $lot_name->lot_no;
                // $trd_prtnr = implode(',', $this->input->post('trade_partner' . $ds));
                // $get_partners = $this->home_model->get_partner_name_email($trd_prtnr);
                // $pname = '';
                // foreach ($get_partners as $get_partner) {
                    // $pname .= $get_partner->partner_name.', ';
                // }
                // $partner_name = rtrim($pname, ', ');
                // $get_email = $this->home_model->get_partner_user_email($trd_prtnr);
                // $sess_company = $this->info_model->get_company_data();
                // foreach ($get_email as $get_email) {
                    // $email = $get_email->email;
                    // if(in_array($email, $partner_array)){
                        
                    // }else{
                    // $partner_array[] = $get_email->email;
                    // $builder = $this->session->userdata('name');
                    // $url = base_url('search_defect/search_result/'.$this->input->post('tract_id').'-'.$this->input->post('lot_id'));
                    // $toRepArray = array('[!name!]', '[!c_name!]', '[!p_c_name!]', '[!code!]', '[!url!]', '[!builder!]', '[!tract!]', '[!lot!]', '[!img!]');
                    // $fromRepArray = array(
                        // $get_email->name,
                        // $sess_company->company_name,
                        // $partner_name,
                        // $this->input->post('scanner_code')[$i],
                        // $url,
                        // $builder,
                        // $tract_no,
                        // $lot_no,
                        // LOGO_IMG
                    // );
                    // $subject = "EZQC New Defect Notification";
                    // $message_templete = $this->load->view('email/notify_trades.html', '', true);
                    // $message = str_replace($toRepArray, $fromRepArray, $message_templete);
                    // $sent_mail = $this->send_email($email, $subject, $message);
                    // }
                // }
            // }
            $data[] = array(
                'company_id' => $this->company_id,
                'tract_id' => $this->input->post('tract_id'),
                'lot_id' => $this->input->post('lot_id'),
                'scanner_code' => $this->input->post('scanner_code')[$i],
                'image' => $this->input->post('image')[$i],
                'description' => $this->input->post('description')[$i],
                'trade_category' => json_encode($this->input->post('trade_category' . $ds)),
                'trade_partner' => json_encode($this->input->post('trade_partner' . $ds)),
                'defect_type' => $this->input->post('defect_type')[$i],
                'defect_location' => $this->input->post('location')[$i],
                'created_by' => $this->sess_id,
                'created_date' => $this->current_date(),
                'is_notify' => $notify
            );
            $data1[] = (object) array(
                'company_id' => $this->company_id,
                'tract_id' => $this->input->post('tract_id'),
                'lot_id' => $this->input->post('lot_id'),
                'scanner_code' => $this->input->post('scanner_code')[$i],
                'image' => $this->input->post('image')[$i],
                'description' => $this->input->post('description')[$i],
                'trade_category' => json_encode($this->input->post('trade_category' . $ds)),
                'trade_partner' => json_encode($this->input->post('trade_partner' . $ds)),
                'defect_type' => $this->input->post('defect_type')[$i],
                'defect_location' => $this->input->post('location')[$i],
                'created_by' => $this->sess_id,
                'created_date' => $this->current_date(),
                'is_notify' => $notify
            );
        }
        $res = $this->home_model->insert_defect_last($data);
      
        $getTractno = $this->db->query("SELECT tract_no FROM `tracts_tbl` where id=".$data1[0]->tract_id)->row();
            $getLotno = $this->db->query("SELECT lot_no FROM `lots_tbl` where id=".$data1[0]->lot_id)->row();
            $lot_n_tract_no = 'Lot '.$getLotno->lot_no.'/Tract '.$getTractno->tract_no;
        if ($res) {
//             $link = $this->export_pdf($data1, $lot_n_tract_no); 
//             if($link){
//             $dtsbuilders = $this->db->query('select name,email from user_tbl where company_id = '.$this->company_id.' and type != 4 and  status != 0')->result();
//             $message_builder = $this->load->view('email/notify_builder.html', '', true);
// 			foreach($dtsbuilders as $builder){
//                 $toRepArray = array('[!track!]', '[!name!]', '[!defecturl!]', '[!url!]','[!img!]');
//                     $fromRepArray = array(
//                         'Lot '.$getLotno->lot_no.'/Tract '.$getTractno->tract_no,
//                         $builder->name,
//                         base_url('search_defect/search_result/'.$data1[0]->tract_id.'-'.$data1[0]->lot_id),
//                         base_url('search_defect/search_result/'.$data1[0]->tract_id.'-'.$data1[0]->lot_id),
//                         LOGO_IMG
//                     );
//                 $message = str_replace($toRepArray, $fromRepArray, $message_builder);
            
//                 $this->send_email($builder->email, 'New EZQC Defect List', $message,$link);
//             }
//             }
            $this->home_model->temp_delete_defect($this->input->post('tract_id'), $this->input->post('lot_id'));
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_ADDED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('checklists/checklists_dashboard/'.$this->input->post('tract_id').'/'.$this->input->post('lot_id'));
    }
    public function export_pdf($data, $lot_n_tract_no =''){
       $record = array();
        foreach($data as $key => $value){
           //echo $value->trade_partner; exit;
            $record[] = $value;
            $prtnr = json_decode($value->trade_partner);
            $pd = "";
            for ($p = 0; $p < count($prtnr); $p++) {
                    $getPrtnr = $this->search_defect_model->get_partner_by_id($prtnr[$p]);
                    $pd .= @$getPrtnr->partner_name.', ';
            }
            if($value->defect_location != ''){
                $loc = $this->db->query("select * from defect_location_tbl where id = '".$value->defect_location."'")->row();
                $record[$key]->defect_location_name = $loc->defect_location;
            }else{
                $record[$key]->defect_location_name = '';
            }

            if($value->defect_type != ''){
                $dt = $this->db->query("select * from defect_type_tbl where id = '".$value->defect_type."'")->row();
                $record[$key]->defect_type_name = $dt->defect_type;
            }else{
                $record[$key]->defect_type_name = '';
            }
            $record[$key]->is_completed = 0;
            
            
            $record[$key]->partner_name = rtrim($pd, ', ');
        }
        $finalRecord = array();
        foreach ($record as $key => $part) {
            if($part->partner_name != ''){
              
            $pname = explode(', ',$part->partner_name);
            foreach($pname as $p){
                if($p!=''){
                    $getLableCode = $this->db->query("SELECT * FROM `label_tbl` where id= (SELECT label FROM `label_association_tbl` where status=1 and company_id = '".$part->company_id."' and category_id = (SELECT category_id FROM `tracts_category_partner_associations_tbl` where status=1 and tract_id = '".$part->tract_id."' and partner_id = (select id from trade_partner_tbl where partner_name='".$p."') limit 1))")->row();
                    //echo $this->db->last_query().'</hr>';
                    // $getLableCode->color_code
                    if(!empty($getLableCode)){
                        $part->labelColor = $getLableCode->color_code;
                    }else{
                        $part->labelColor = '';
                    }
                  //  $part->labelColor = '';
                    $part->labelQuery = $this->db->last_query();
                    //  echo $p.'<br/>';
                    if(array_key_exists(ucfirst($p),$finalRecord)){
                        $finalRecord[ucfirst($p)][] = $part;
                    }else{
                        $finalRecord[ucfirst($p)][] = $part;
                    }
                }else{
                    $part->labelColor = '';
                    $finalRecord[''][] = $part;
                }
               
            }
        }else{
            $part->labelColor = '';
            $finalRecord[''][] = $part;
        }
            
            $sort[$key]= ucfirst($part->partner_name);
        }
        ksort($finalRecord);
        $data['data'] = $finalRecord;

        // echo json_encode($finalRecord); exit;
        return $this->pdf_generate_new($data,  $lot_n_tract_no);
    }
    public function pdf_generate_new($data, $lot_n_tract_no = '') {
        $data['lot_n_tract_no'] = $lot_n_tract_no;
        $html = $this->load->view('defect_pdf_new', $data, true);
        // echo $html; exit;
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->SetTitle('Defect PDF');
        $pdfFilePath = time() . "_pdf.pdf";
        $this->m_pdf->pdf->WriteHTML($html);
//        $this->m_pdf->pdf->Output();
        $this->m_pdf->pdf->Output('upload/defects/'.$pdfFilePath, "F");
        return 'upload/defects/'.$pdfFilePath;
    }
    public function delete_temp_defect() {
        $delete_defect = $this->home_model->delete_temp_defect_review(@$this->uri->segment(5));
        if ($delete_defect) {
            $this->session->set_flashdata('success', RECORD_DELETED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('home/review_complete_defect_list/' . @$this->uri->segment(3) . '/' . @$this->uri->segment(4) . '/' . @$this->uri->segment(5));
    }

    public function ajax_category_to_partner_follow_up() {
        $cat_id = $this->input->post('cat_id');
        $tract_id = $this->input->post('tract_id');
        if ($cat_id) {
            $data_partner = $this->home_model->get_category_partner($tract_id, $cat_id);
            echo json_encode(array('partner_followup' => $data_partner->partner_id));
        } else {
            echo json_encode(array('partner_followup' => ''));
        }
    }

    public function edit_defect($id) {
        $id = base64_decode(base64_decode($id));
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $data['new_data'] = $this->home_model->get_defect_data_by_id($id);
        $data['data_defect_location'] = $this->defect_location_model->get_defect_location();
        $this->load->view('edit_defect', $data);
        $this->load->view('include/footer_new.php');
    }

    public function update_defect() {
        $url = $this->input->post('url');
        if (!empty($_POST['submit_notify'])) {
            $notify = 1;
        }
        if (!empty($_POST['submit_not_notify'])) {
            $notify = 0;
        }
        $id = $this->input->post('ids');
        $data = array(
            'company_id' => $this->company_id,
            'description' => $this->input->post('description'),
            'trade_category' => json_encode($this->input->post('trade_category')),
            'trade_partner' => json_encode($this->input->post('trade_partner')),
            'defect_type' => $this->input->post('defect_type'),
            'defect_location' => $this->input->post('location'),
            'updated_by' => $this->sess_id,
            'updated_date' => $this->current_date(),
            'is_notify' => $notify
        );
        $res = $this->home_model->update_defect($data, $id);
        if ($res) {
            $this->history_request();
            if (!empty($_POST['submit_notify'])) {
                $tract_id = base64_encode(base64_encode($this->input->post('tract_id')));
                $lot_id = base64_encode(base64_encode($this->input->post('lot_id')));
                $tract_name = $this->home_model->get_tract_name($tract_id);
                $lot_name = $this->home_model->get_lot_name($lot_id);
                $tract_no = $tract_name->tract_no;
                $lot_no = $lot_name->lot_no;
                $trd_prtnr = implode(',', $this->input->post('trade_partner'));
                $get_partners = $this->home_model->get_partner_name_email($trd_prtnr);
                $pname = '';
                foreach ($get_partners as $get_partner) {
                    $pname .= $get_partner->partner_name.', ';
                }
                $partner_name = rtrim($pname, ', ');
                
                $get_email = $this->home_model->get_partner_user_email($trd_prtnr);
                $sess_company = $this->info_model->get_company_data();
                foreach ($get_email as $get_email) {
//                    $partner_company = $this->info_model->get_company_data_by_id($get_email->company_id);
                    $email = $get_email->email;
                    $builder = $this->session->userdata('name');
                    $urls = base_url('search_defect/search_result/'.$this->input->post('tract_id').'-'.$this->input->post('lot_id'));
                    $toRepArray = array('[!name!]', '[!c_name!]', '[!p_c_name!]', '[!code!]', '[!url!]', '[!builder!]', '[!tract!]', '[!lot!]', '[!img!]');
                    $fromRepArray = array(
                        $get_email->name,
                        $sess_company->company_name,
                        $partner_name,
                        $this->input->post('scanner_code'),
                        $urls,
                        $builder,
                        $tract_no,
                        $lot_no,
                        LOGO_IMG
                    );
                    $subject = "EZQC Update Defect Notification";
                    $message_templete = $this->load->view('email/notify_trades_edit.html', '', true);
                    $message = str_replace($toRepArray, $fromRepArray, $message_templete);
                    $sent_mail = $this->send_email($email, $subject, $message);
                }
            }
            $this->session->set_flashdata('success', RECORD_UPDATED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect(base64_decode($url));
    }
	
	public function ajax_location_to_category() {
        $loc_id = $this->input->post('loc_id');
        if ($loc_id) {
			$dataloc = $this->defect_location_model->get_defect_location_by_id($loc_id);
			$res_cats = $this->defect_location_model->defectcat($dataloc->category_ids);
            foreach ($res_cats as $res_cat) {
                ?>
                <option value="<?php echo $res_cat->id; ?>"><?php echo $res_cat->category_name; ?></option>
                <?php
            }
        }
    }
	
	public function ajax_trade_category_partner_new() {
        $total = $this->input->post('total');
        $tract_id = $this->input->post('tract_id');
        $location = $this->input->post('location');
        if ($tract_id) {
            // $data_category = $this->home_model->get_defect_category($tract_id);
			
			$dataloc = $this->defect_location_model->get_defect_location_by_id($location);
			$data_category = $this->defect_location_model->defectcat($dataloc->category_ids);
			
			
            // $data_partner = $this->home_model->get_defect_trade_partner($tract_id);
            $data_partner = $this->home_model->get_partner_all();
            ?>
            <div id="t_p<?php echo $total; ?>" style="margin-bottom: 15px;">
                <img src="<?php echo base_url(); ?>assets/images/remove.png" class="removeIcon<?php echo $total; ?>" style="float: right;margin: 10px 0;cursor: pointer;">
                <div class="form-group">
                    <select class="form-control cattrade" name="trade_category[]" required="" onchange="folloup_category_change(this.value, <?php echo $total; ?>)">
                        <option value="">Select Trade Category</option>
                        <?php foreach ($data_category as $row_data_category) { ?>
                            <option value="<?php echo $row_data_category->id; ?>"><?php echo $row_data_category->category_name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mb-0">
                    <select class="form-control" name="trade_partner[]" required="" id="follow_up_trade_partner<?php echo $total; ?>">
                        <option value="">Select Trade Partner</option>
                        <?php foreach ($data_partner as $row_data_partner) { ?>
                            <option value="<?php echo $row_data_partner->id; ?>"><?php echo $row_data_partner->partner_name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <script>
                    $('.removeIcon<?php echo $total; ?>').on('click', function () {
                        $(this).closest("#t_p<?php echo $total; ?>").remove();
                    });
                </script>
            </div>
            <?php
        }
    }

}
?>