<?php
class Trade_partner extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data'] = $this->trade_partner_model->get_trade_partner();
        $this->load->view('trade_partner', $data);
        $this->load->view('include/footer_new');
    }

    public function add() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $this->load->view('trade_partner_add');
        $this->load->view('include/footer_new');
    }

    public function edit($id) {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data'] = $this->trade_partner_model->get_trade_partner_by_id($id);
        $this->load->view('trade_partner_edit', $data);
        $this->load->view('include/footer_new');
    }

    public function insert() {
        $data = array(
            'company_id' => $this->company_id,
            'partner_name' => $this->input->post('partner_name'),
            'created_by' => $this->sess_id,
            'created_date' => $this->current_date()
        );
        $res = $this->trade_partner_model->insert($data);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_ADDED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('trade_partner/');
    }

    public function update() {
        $id = $this->input->post('id');
        $data = array(
            'company_id' => $this->company_id,
            'partner_name' => $this->input->post('partner_name'),
            'updated_by' => $this->sess_id,
            'updated_date' => $this->current_date()
        );
        $res = $this->trade_partner_model->update($data, $id);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_UPDATED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('trade_partner/');
    }
    
    public function delete($id) {
        $res = $this->trade_partner_model->delete($id);
        if ($res) {
            $this->history_request($id);
            $this->session->set_flashdata('success', RECORD_DELETED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('trade_partner/');
    }

}
?>
	