<?php

class Checklists_defect extends My_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('checklists_defect_model');
    }

    public function checklists_defect_step_2() {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $this->load->view('checklists_defect_step_2');
        $this->load->view('include/footer_new.php');
    }

    public function checklists_defect_step_3() {
        $ex5 = base64_decode(base64_decode($this->uri->segment(6)));
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $data['data_defect_location'] = $this->checklists_defect_model->get_defect_location($ex5);
        $data['data_cat'] = $res_cats = $this->defect_location_model->defectcat($data['data_defect_location']->category_ids);
        $this->load->view('checklists_defect_step_3', $data);
        $this->load->view('include/footer_new.php');
    }
	
	public function insert_step_2() {
        $tract_id = $this->input->post('tract_id');
        $lot_id = $this->input->post('lot_id');
        $location = $this->input->post('location');
        $category = $this->input->post('category');
        $scanner_url = $this->input->post('scanner_url');
        $defect_type = $this->input->post('defect_type');
		
        $get_check_ori = $this->home_model->get_check_code_ori($scanner_url);
        if ($get_check_ori) {
            $this->session->set_flashdata('toastr_error', 'This QR code is already used.');
            redirect('checklists_defect/checklists_defect_step_2/' . $tract_id . '/' . $lot_id.'/'. $location.'/'. $category);
        } else {
            redirect('checklists_defect/checklists_defect_step_3/' . $tract_id . '/' . $lot_id.'/'. base64_encode(base64_encode($scanner_url)).'/'. $location.'/'. $category.'/'.$defect_type);
        }
    }
	
	public function defect_step_2_custom() {
        $ex3 = $this->uri->segment(3);
        $ex4 = $this->uri->segment(4);
        $ex5 = $this->uri->segment(5);
        $ex6 = $this->uri->segment(6);
        $ex7 = $this->uri->segment(7);
		
        $get_code_ori = $this->home_model->get_zz_scanner_code_ori();

        $ex_ori = explode('_', @$get_code_ori->scanner_code);
        if (@$ex_ori[1]) {
            $big_code = @$get_code_ori->scanner_code;
            $code = $this->sequenceNumber(3, @$ex_ori[1]);
            $scanner_url = 'ZZ_' . $code;
        }else {
            $scanner_url = 'ZZ_001';
        }
        redirect('checklists_defect/checklists_defect_step_3/'.$ex3.'/'. $ex4.'/'. base64_encode(base64_encode($scanner_url)).'/'. $ex5.'/'. $ex6.'/'. $ex7);
    }
	
	public function sequenceNumber($length, $get_num) {
        return str_pad($get_num + 1, $length, 0, STR_PAD_LEFT);
    }
	
	public function ajax_trade_category_partner() {
        $total = $this->input->post('total');
        $tract_id = $this->input->post('tract_id');
        $locationid = base64_decode(base64_decode($this->input->post('locationid')));
        if ($tract_id) {
            // $data_category = $this->home_model->get_defect_category($tract_id);
			
			
			$data_l = $this->checklists_defect_model->get_defect_location($locationid);
			$data_category = $res_cats = $this->defect_location_model->defectcat($data_l->category_ids);
			
            $data_partner = $this->home_model->get_partner_all();
            ?>
            <div id="t_p<?php echo $total; ?>" style="margin-bottom: 15px;">
                <img src="<?php echo base_url(); ?>assets/images/remove.png" class="removeIcon<?php echo $total; ?>" style="float: right;margin: 10px 0;cursor: pointer;">
                <div class="form-group">
                    <select class="form-control" name="trade_category[]" required="" onchange="folloup_category_change(this.value, <?php echo $total; ?>)">
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
            'created_date' => $this->current_date()
        );
        $res = $this->checklists_defect_model->insert_defect($data);
        if ($res) {
            $this->session->set_flashdata('success', RECORD_ADDED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }

        $tract_id = $this->input->post('tract_id');
        $lot_id = $this->input->post('lot_id');
        $locationid = $this->input->post('locationid');
        $catid = $this->input->post('catid');
//        $defect_type = $this->input->post('defect_type');

        if (!empty($_POST['submit'])) {
            redirect('checklists_defect/checklists_defect_step_2/' . base64_encode(base64_encode($tract_id)) . '/' . base64_encode(base64_encode($lot_id)) . '/' . $locationid . '/' . $catid . '/'. base64_encode(base64_encode($defect_type)));
        }

        // if (!empty($_POST['submit_review'])) {
        //     redirect('checklists/checklist_defects/' . $tract_id . '/' . $lot_id . '/' . base64_decode(base64_decode($locationid)) . '/' . base64_decode(base64_decode($catid)) . '/' . $defect_type);
        // }
        
        if (!empty($_POST['submit_trade_categories'])) {
            redirect('checklists/trade_categories/' . $tract_id . '/' . $lot_id . '/' . base64_decode(base64_decode($locationid)));
        }
        
        if (!empty($_POST['submit_location_categories'])) {
            redirect('checklists/location_category_checklist/' . $tract_id . '/' . $lot_id . '/' . base64_decode(base64_decode($locationid)) . '/' . base64_decode(base64_decode($catid)));
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

}
?>