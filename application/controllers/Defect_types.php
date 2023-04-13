<?php

class Defect_types extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data'] = $this->defect_types_model->get_defect_types();
        $this->load->view('defect_types', $data);
        $this->load->view('include/footer_new');
    }

    public function add() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data_category'] = $this->category_model->get_category();
        $this->load->view('defect_types_add', $data);
        $this->load->view('include/footer_new');
    }

    public function edit($id) {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data'] = $this->defect_types_model->get_defect_type_by_id($id);
        $data['data_category'] = $this->category_model->get_category();
        $this->load->view('defect_types_edit', $data);
        $this->load->view('include/footer_new');
    }
    
    public function insert() {
        $data = array(
            'company_id' => $this->company_id,
            'defect_type' => $this->input->post('defect_type'),
            'category_id' => $this->input->post('category_id'),
            'created_by' => $this->sess_id,
            'created_date' => $this->current_date()
        );
        $res = $this->defect_types_model->insert($data);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_ADDED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('defect_types/');
    }

    public function update() {
        $id = $this->input->post('id');
        $data = array(
            'company_id' => $this->company_id,
            'defect_type' => $this->input->post('defect_type'),
            'category_id' => $this->input->post('category_id'),
            'updated_by' => $this->sess_id,
            'updated_date' => $this->current_date()
        );
        $res = $this->defect_types_model->update($data, $id);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_UPDATED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('defect_types/');
    }
    
    public function delete($id) {
        $res = $this->defect_types_model->delete($id);
        if ($res) {
            $this->history_request($id);
            $this->session->set_flashdata('success', RECORD_DELETED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('defect_types/');
    }

}
?>