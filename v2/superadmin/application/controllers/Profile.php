<?php

class profile extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $sess_id = $this->session->userdata('id');
        $data['data'] = $this->profile_model->get_profile($sess_id);
        $this->load->view('profile', $data);
        $this->load->view('include/footer_new');
    }

    public function edit() {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $sess_id = $this->session->userdata('id');
        $data['data'] = $this->profile_model->get_profile($sess_id);
        $this->load->view('profile_edit', $data);
        $this->load->view('include/footer_new.php');
    }

    public function update_profile() {
        $id = $this->session->userdata('id');
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $dt = array(
            'name' => $name,
            'phone' => $phone
        );
        
        $res = $this->login_model->update_reset_password($dt, $id);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_UPDATED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('profile/edit');
    }

}

?>
	