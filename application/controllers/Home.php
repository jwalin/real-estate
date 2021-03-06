<?php
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('dashboard_models');
    }

    public function index() {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $this->load->view('home');
        $this->load->view('include/footer_new.php');
    }
    
    public function defect_list() {    
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $this->load->view('defect_list');
        $this->load->view('include/footer_new.php');
    }
    
    public function defect_list_step_2() {    
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $this->load->view('defect_list_step_2');
        $this->load->view('include/footer_new.php');
    }
    
    public function defect_list_step_3() {    
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $this->load->view('defect_list_step_3');
        $this->load->view('include/footer_new.php');
    }
    
    public function review_complete_defect_list() {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $this->load->view('review_complete_defect_list');
        $this->load->view('include/footer_new.php');
    }
    
}
?>