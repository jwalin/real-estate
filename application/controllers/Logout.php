<?php



class logout extends CI_Controller {



    public function __construct() {

        parent::__construct();

//        $this->is_validCheck();

//        $this->load->model('Order_models');

//        $this->load->library('upload');

//        $this->load->library('image_lib');

    }



  



    public function index() { 

        redirect('login/logout');

    }

}

?>