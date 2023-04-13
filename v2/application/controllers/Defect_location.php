<?php

class Defect_location extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data'] = $this->defect_location_model->get_defect_location();
        $this->load->view('defect_location', $data);
        $this->load->view('include/footer_new');
    }

    public function add() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
		$data['data_category'] = $this->category_model->get_category();
        $this->load->view('defect_location_add', $data);
        $this->load->view('include/footer_new');
    }

    public function edit($id) {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data'] = $this->defect_location_model->get_defect_location_by_id($id);
		$data['data_category'] = $this->category_model->get_category();
        $this->load->view('defect_location_edit', $data);
        $this->load->view('include/footer_new');
    }

    public function insert() {
        $data = array(
            'company_id' => $this->company_id,
            'defect_location' => $this->input->post('defect_location'),
            'category_ids' =>  implode(',', $this->input->post('category')),
            'created_by' => $this->sess_id,
            'created_date' => $this->current_date()
        );
        $res = $this->defect_location_model->insert($data);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_ADDED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('defect_location/');
    }

    public function update() {
        $id = $this->input->post('id');
        $data = array(
            'company_id' => $this->company_id,
            'defect_location' => $this->input->post('defect_location'),
            'category_ids' =>  implode(',', $this->input->post('category')),
            'updated_by' => $this->sess_id,
            'updated_date' => $this->current_date()
        );
        $res = $this->defect_location_model->update($data, $id);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_UPDATED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('defect_location/');
    }
    
    public function delete($id) {
        $res = $this->defect_location_model->delete($id);
        if ($res) {
            $this->history_request($id);
            $this->session->set_flashdata('success', RECORD_DELETED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('defect_location/');
    }
    
}
?>

