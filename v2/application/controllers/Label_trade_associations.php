<?php

class Label_trade_associations extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data'] = $this->label_trade_associations_model->get_labels();
        $this->load->view('label_trade_associations', $data);
        $this->load->view('include/footer_new');
    }

    public function add() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data_label'] = $this->label_trade_associations_model->get_labels_only();
        $data['data_category'] = $this->category_model->get_category();
        $this->load->view('label_trade_associations_add', $data);
        $this->load->view('include/footer_new');
    }

    public function edit($id) {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data_label'] = $this->label_trade_associations_model->get_labels_only();
        $data['data'] = $this->label_trade_associations_model->get_label_by_id($id);
        $data['data_category'] = $this->category_model->get_category();
        $this->load->view('label_trade_associations_edit', $data);
        $this->load->view('include/footer_new');
    }

    public function insert() {
        $data = array(
            'company_id' => $this->company_id,
            'label' => $this->input->post('label'),
            'category_id' => $this->input->post('category_id'),
            'created_by' => $this->sess_id,
            'created_date' => $this->current_date()
        );
        $res = $this->label_trade_associations_model->insert($data);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_ADDED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('label_trade_associations/');
    }

    public function update() {
        $id = $this->input->post('id');
        $data = array(
            'company_id' => $this->company_id,
            'label' => $this->input->post('label'),
            'category_id' => $this->input->post('category_id'),
            'updated_by' => $this->sess_id,
            'updated_date' => $this->current_date()
        );
        $res = $this->label_trade_associations_model->update($data, $id);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_UPDATED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('label_trade_associations/');
    }

    public function delete($id) {
        $res = $this->label_trade_associations_model->delete($id);
        if ($res) {
            $this->history_request($id);
            $this->session->set_flashdata('success', RECORD_DELETED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('label_trade_associations/');
    }

}

?>	