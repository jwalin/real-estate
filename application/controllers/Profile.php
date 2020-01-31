<?php

class profile extends My_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('login_model');
    }
	
	public function index() {

        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $this->load->view('profile');
        $this->load->view('include/footer_new');
    }
	
	
	
	}
	?>
	