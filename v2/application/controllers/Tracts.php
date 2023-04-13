<?php

class Tracts extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data'] = $this->tracts_model->get_tracts();
        $this->load->view('tracts', $data);
        $this->load->view('include/footer_new');
    }

    public function add() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data_last_tracts'] = $this->tracts_model->get_last_tracts_data();
        $data['data_category'] = $this->category_model->get_category();
        $data['data_partner'] = $this->trade_partner_model->get_trade_partner();
        $this->load->view('tracts_add', $data);
        $this->load->view('include/footer_new');
    }

    public function edit($id) {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data'] = $this->tracts_model->get_tracts_by_id($id);
        $data['data_category_partner'] = $this->tracts_model->get_category_partner_by_id($id);
        $data['data_category'] = $this->category_model->get_category();
        $data['data_partner'] = $this->trade_partner_model->get_trade_partner();
        $this->load->view('tracts_edit', $data);
        $this->load->view('include/footer_new');
    }
    
    public function insert() {
        $data = array(
            'company_id' => $this->company_id,
            'name' => $this->input->post('name'),
            'tract_no' => $this->input->post('tract_no'),
            'created_by' => $this->sess_id,
            'created_date' => $this->current_date()
        );
        $last_id = $this->tracts_model->insert($data);
        $data_category_partner_associations = array();
        $count = count($this->input->post('category_id'));        
        for($i=0; $i<$count; $i++){
            
            if($this->input->post('category_id')[$i] != "" && $this->input->post('partner_id')[$i] != ""){
                $data_category_partner_associations[] = array(
                    'company_id' => $this->company_id,
                    'tract_id' => $last_id,
                    'category_id' => $this->input->post('category_id')[$i],
                    'partner_id' => $this->input->post('partner_id')[$i],
                    'created_by' => $this->sess_id,
                    'created_date' => $this->current_date()
                );
            }
        }
        if(!empty($data_category_partner_associations)){
            $res = $this->tracts_model->category_partner_associations_insert($data_category_partner_associations);
        }
        
        if ($last_id) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_ADDED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('tracts/');
    }
    
    public function update() {
        $id = $this->input->post('id');
        $data = array(
            'company_id' => $this->company_id,
            'name' => $this->input->post('name'),
            'tract_no' => $this->input->post('tract_no'),
            'updated_by' => $this->sess_id,
            'updated_date' => $this->current_date()
        );
        $res = $this->tracts_model->update($data, $id);
        
        $count = count($this->input->post('category_id'));
        for($i=0; $i<$count; $i++){
//            if($this->input->post('category_id')[$i] != "" && $this->input->post('partner_id')[$i] != ""){
            if($this->input->post('category_id')[$i] != ""){
            $data_check = $this->tracts_model->check_category_partner_associations($this->company_id, $id, $this->input->post('category_id')[$i]);
//            print_r($data_check);exit;
            if($data_check){
                $data_category_partner_associations = array(
                    'partner_id' => $this->input->post('partner_id')[$i],
                    'updated_by' => $this->sess_id,
                    'updated_date' => $this->current_date()
                );
                $res = $this->tracts_model->category_partner_associations_update($data_category_partner_associations, $id, $this->input->post('category_id')[$i]);
            } else{
                $data_category_partner_associations = array(
                    'company_id' => $this->company_id,
                    'tract_id' => $id,
                    'category_id' => $this->input->post('category_id')[$i],
                    'partner_id' => $this->input->post('partner_id')[$i],
                    'created_by' => $this->sess_id,
                    'created_date' => $this->current_date()
                );
                $res = $this->tracts_model->category_partner_associations_insert_edit($data_category_partner_associations);
            }
            }
        }
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_UPDATED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('tracts/');
    }
    
    public function delete($id) {
        $res = $this->tracts_model->delete($id);
        if ($res) {
            $this->history_request($id);
            $this->session->set_flashdata('success', RECORD_DELETED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('tracts/');
    }

}

?>
	