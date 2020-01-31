<?php

class builder extends My_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('login_model');
    }
	
	public function index() {

        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $this->load->view('builder');
        $this->load->view('include/footer_new');
    }
	
	public function add() {

        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $this->load->view('builder_add');
        $this->load->view('include/footer_new');
    }
	
	public function edit() {

        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $this->load->view('builder_edit');
        $this->load->view('include/footer_new');
    }
	
	}
	?>
	