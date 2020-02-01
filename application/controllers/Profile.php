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
	
	public function edit() {

        $this->load->view('include/header_new.php');

        $this->load->view('include/sidebar_new.php');

        $this->load->view('profile_edit');

        $this->load->view('include/footer_new.php');
    }
	
	}
	?>
	