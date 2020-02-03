<?php

class Support extends My_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('login_model');
    }
	
	
	
	public function faq() {

        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $this->load->view('faq_view');
        $this->load->view('include/footer_new');
    }
	
	public function contact_support() {

        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $this->load->view('contact_support');
        $this->load->view('include/footer_new');
    }
	
	public function tutorial() {

        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $this->load->view('tutorial_view');
        $this->load->view('include/footer_new');
    }
	
	}
	?>
	

