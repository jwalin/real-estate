<?php

class builder extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data'] = $this->trade_user_model->get_builder_user();
        $this->load->view('builder', $data);
        $this->load->view('include/footer_new');
    }

    public function add() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $this->load->view('builder_add');
        $this->load->view('include/footer_new');
    }

    public function edit($id) {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data_row'] = $this->trade_user_model->get_trade_user_by_id($id);
        $this->load->view('builder_edit', $data);
        $this->load->view('include/footer_new');
    }
    
    public function insert() {
        $data = array(
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'status' => $this->input->post('status'),
            'parent_id' => $this->sess_id,
            'created_by' => $this->sess_id,
            'company_id' => $this->company_id,
            'created_date' => $this->current_date()
        );
        $res = $this->trade_user_model->insert($data);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_ADDED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('builder/');
    }
    
    public function update() {
        $id = $this->input->post('id');
        $data = array(
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'status' => $this->input->post('status'),
            'updated_by' => $this->sess_id,
            'company_id' => $this->company_id,
            'updated_date' => $this->current_date()
        );
        $res = $this->trade_user_model->update($data, $id);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_UPDATED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('builder/');
    }
    
    public function delete($id) {
        $res = $this->trade_user_model->delete($id);
        if ($res) {
            $this->history_request($id);
            $this->session->set_flashdata('success', RECORD_DELETED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('builder/');
    }
    
    public function check_user_email() {
        $email = $this->input->post('email');
        echo $this->trade_user_model->check_user_email($email);
    }
    
    public function check_trade_user_email() {
        $email = $this->input->post('email');
        echo $this->trade_user_model->check_trade_user_email($email);
    }

}
?>