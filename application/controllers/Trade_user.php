<?php

class Trade_user extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $id = @$this->uri->segment(3);
        if($id == ""){
            $id = "All";
        }
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data_partner'] = $this->trade_partner_model->get_trade_partner();
        $data['data'] = $this->trade_user_model->get_trade_user($id);
        $this->load->view('trade_user', $data);
        $this->load->view('include/footer_new');
    }

    public function add() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data'] = $this->trade_partner_model->get_trade_partner();
        $this->load->view('trade_user_add', $data);
        $this->load->view('include/footer_new');
    }

    public function edit($id) {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data'] = $this->trade_partner_model->get_trade_partner();
        $data['data_row'] = $this->trade_user_model->get_trade_user_by_id($id);
        $this->load->view('trade_user_edit', $data);
        $this->load->view('include/footer_new');
    }
    
    public function insert() {
        $data = array(
            'partner_id' => $this->input->post('partner_id'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'status' => $this->input->post('status'),
            'type' => 4,
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
        redirect('trade_user/');
    }
    
    public function update() {
        $id = $this->input->post('id');
        $data = array(
            'partner_id' => $this->input->post('partner_id'),
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
        redirect('trade_user/');
    }
    
    public function delete($id) {
        $res = $this->trade_user_model->delete($id);
        if ($res) {
            $this->history_request($id);
            $this->session->set_flashdata('success', RECORD_DELETED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('trade_user/');
    }

}
?>

