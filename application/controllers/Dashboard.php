<?php

class dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('dashboard_models');
    }

    public function index() {
//        for ($i = 1; $i <= 12; $i++) {
//            $datap = $this->dashboard_models->order_graph($i, $id);
//            $data['month'.$i] = $datap->order_count;
//        }
        
        $data['user'] = $this->dashboard_models->user_count();     
        
        $this->load->view('include/header.php');
        $this->load->view('include/sidebar.php');
        $this->load->view('dashboard', $data);
        $this->load->view('include/footer.php');
    }
    
//    public function restaurant_name(){
//        $id = $this->session->userdata('id');
//        $edit['rest_new'] = $this->dashboard_models->rest_name($id);
//        
//        $this->load->view('include/header', $edit);
//    }
    
}
?>