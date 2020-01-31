<?php

class login extends My_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('login_model');
    }

    public function index() {

        $this->load->view('login');
    }

    public function loginprocess() {



        $email = $this->input->post('Email');



        $pass = $this->input->post('Password');

//         

        if ($email != "" && $pass != "") {

            $result = $this->login_model->loginprocess($email, $pass);



            if ($result) {



                //sess_array = array();

                $sess_array = array(
                    'id' => $result['id'],
                    'email' => $result['email'],
                    'validated' => true
                );

                $this->session->set_userdata($sess_array);

                redirect('content_management');
            } else {

                $this->session->set_flashdata('error', 'Incorrect email or password.');

                redirect('login');
            }
        } else {

            $this->session->set_flashdata('error', 'All field are required.');

            redirect('login');
        }
    }

    public function logout() {

        $this->session->sess_destroy();

        $this->session->set_flashdata('success', 'Logout successfully.');

        redirect('login');
    }
    
    public function register() {
        $this->load->view('signup');
    }
    public function update_password() {

        $this->load->view('include/header.php');

        $this->load->view('include/sidebar.php');

        $this->load->view('change_password');

        $this->load->view('include/footer.php');
    }

    
    public function forgot_password() {

        $this->load->view('forgot_password');
    }
	
	public function profile(){
		
		$this->load->view('include/header_new');
		$this->load->view('include/sidebar_new');
		$this->load->view('profile');
		$this->load->view('include/footer_new');
	}
        
        public function category(){
            $this->load->view('include/header_new');
		$this->load->view('include/sidebar_new');
		$this->load->view('category');
		$this->load->view('include/footer_new');
        }
   
    public function reset_password() {

        $this->load->view('reset_password');
    }

    
    public function reset_password_expire() {

        $this->load->view('password_expire');
    }

}

?>
