<?php
class Incomplete_defects extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $id = @$this->uri->segment(3);
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $data['data_tract'] = $this->tracts_model->get_tracts();
        $data['data'] = $this->incomplete_defects_model->get_incomplete_defects_data($id);
        $this->load->view('incomplete_defect', $data);
        $this->load->view('include/footer_new.php');
    }
    
    public function incomplete_defect_detail() {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $this->load->view('incomplete_defect_detail');
        $this->load->view('include/footer_new.php');
    }
    
    public function defect_status_change() {
        $id = $this->uri->segment(3);
        $url = $this->uri->segment(4);
        $url_set = $this->uri->segment(5);
        $url_set1 = $this->uri->segment(6);
        $status = $this->uri->segment(7);
		if($status == ""){
			$status = $this->uri->segment(6);
		}
        $res = $this->incomplete_defects_model->defect_status_change($id, $status);
        if ($res) {
            $this->session->set_flashdata('success', 'Defect status successfully changed.');
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('search_label/defect_details/'.$url.'/'.$url_set.'/'.$url_set1);
    }
    
}
?>