<?php

class Search_label extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $this->load->view('search_label');
        $this->load->view('include/footer_new.php');
    }

    public function defect_details($label) {
        $label = base64_decode(base64_decode($label));
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $data['data'] = $this->search_defect_model->get_defect_detail_by_label($label);
        $this->load->view('defect_details', $data);
        $this->load->view('include/footer_new.php');
    }

    public function search_label_detail() {
        $label = $this->input->post('label');
        $data_check = $this->search_defect_model->get_label_check($label);
        if ($data_check) {
            redirect('search_label/defect_details/' . base64_encode(base64_encode($label)) . '/sl');
        } else {
            $this->session->set_flashdata('error', 'This defect code cannot be found.');
            redirect('search_label');
        }
    }
    
    public function delete_defect() {
        $id = base64_decode(base64_decode($this->uri->segment(3)));
        $url = base64_decode(base64_decode($this->uri->segment(4)));
        $data = array(
            'status' => 0
        );
        $res = $this->search_defect_model->update_status($data, $id);
        if ($res) {
            $this->session->set_flashdata('success', 'Defect successfully deleted.');
            redirect($url);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
            redirect($url);
        }
    }
    
    public function status_complete() {
        $completion_date = $this->input->post('completion_date');
        $id = $this->input->post('id');
        $status = $this->input->post('is_completed');
        $url = base64_decode($this->input->post('url'));
        $data = array(
            'is_completed' => $status,
            'completion_date' => date('Y-m-d', strtotime($completion_date)),
        );
        $res = $this->search_defect_model->update_status($data, $id);
        if ($res) {
            $this->session->set_flashdata('success', 'Defect status successfully changed.');
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect($url);
    }
    public function status_all_complete() {
        $completion_date = $this->input->post('completion_date');
        $id = $this->input->post('ids');
        $status = $this->input->post('is_completed');
        $url = base64_decode($this->input->post('url'));
        $ids = explode(',',$id);
        foreach($ids as $id_row){
            if($id_row != '' && is_numeric($id_row)){
                $data = array(
                    'is_completed' => $status,
                    'completion_date' => date('Y-m-d', strtotime($completion_date)),
                );
                $res = $this->search_defect_model->update_status($data, $id_row);
            }
        }
        
        if ($res) {
            $this->session->set_flashdata('success', 'Defect status successfully changed.');
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect($url);
    }

}

?>