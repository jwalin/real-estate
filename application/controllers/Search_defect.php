<?php
class Search_defect extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('dashboard_models');
    }

    public function index() {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $this->load->view('search_defect_list');
        $this->load->view('include/footer_new.php');
    }
    
    public function search_result() {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $this->load->view('search_result');
        $this->load->view('include/footer_new.php');
    }
    
}
?>