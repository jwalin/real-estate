<?php

class Support extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function faq() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['datas'] = $this->support_model->get_faq();
        $this->load->view('faq_view', $data);
        $this->load->view('include/footer_new');
    }

    public function tutorial() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['datas'] = $this->support_model->get_tutorial();
        $this->load->view('tutorial_view', $data);
        $this->load->view('include/footer_new');
    }
    
    public function contact_support() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $this->load->view('contact_support');
        $this->load->view('include/footer_new');
    }
    
    public function send_contact_support() {
        $admin_email = $this->support_model->get_admin_data();
        $subjects = $this->input->post('subject');
        $messages = $this->input->post('message');
        $toRepArray = array('[!subject!]', '[!message!]', '[!img!]');
        $fromRepArray = array(
            $subjects,
            $messages,
            LOGO_IMG
        );
        $subject = "EZQC: Contact Support";
        $message_templete = $this->load->view('email/contact_support.html', '', true);
        $message = str_replace($toRepArray, $fromRepArray, $message_templete);
        $sentmail = $this->send_email($admin_email->email, $subject, $message);
        if ($sentmail) {
            $this->session->set_flashdata('success', 'Contact support mail has been sent.');
        } else {
            $this->session->set_flashdata('error', ERR_EMAIL_NOT_SENT);
        }
        redirect('support/contact_support');
    }

}
?>
	

