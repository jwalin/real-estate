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

    public function change_Password() {

        $id = 1;

        $this->form_validation->set_rules('o_password', 'Old Password', 'required');

        $this->form_validation->set_rules('n_password', 'New Password', 'required');

        $this->form_validation->set_rules('c_password', 'Confirm password', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('include/header.php');

            $this->load->view('include/sidebar.php');

            $this->load->view('change_password');

            $this->load->view('include/footer.php');
        } else {



            $pass = $this->input->post('o_password');

            $npass = $this->input->post('n_password');

            $rpass = $this->input->post('c_password');

            if ($npass != $rpass) {



                $this->session->set_flashdata('error', 'Confirm password not macth.');

                redirect('login/update_password');
            } else {

                $qr = $this->db->query("select * from admin where id = " . $id)->row();

                if (md5($pass) == $qr->password) {



                    $array = array(
                        'password' => md5($npass)
                    );

                    $result = $this->login_model->update_Password($array, $id);

                    if ($result) {

                        $this->session->set_flashdata('success', 'Password has been successfully updated.');

                        redirect('login/update_password');
                    } else {

                        $this->session->set_flashdata('error', 'Data processing error.');

                        redirect('login/update_password');
                    }
                } else {

                    $this->session->set_flashdata('error', 'Old password is wrong.');

                    redirect('login/update_password');
                }
            }
        }
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

    public function generateRandomString($val) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $val; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function forgotprocess() {
        $email = $this->input->post('email');
        if ($email == "") {
            $this->session->set_flashdata('error', 'Enter your Email Address.');
        } else {
            $result = $this->login_model->email_check($email);
            if ($result == FALSE) {
                $this->session->set_flashdata('error', 'Your email is not exists.');
            } else {
                $lst = $this->generateRandomString(5);
                $rst = $this->generateRandomString(5);
                $curTime = base64_encode(date('Y-m-d h:i:s'));
                $userId = $result[0]->id;
                $encodeuser = $lst . base64_encode($userId) . $rst;
                $url = base_url() . 'login/reset_password/' . $encodeuser . "/" . $curTime;
                $toRepArray = array('[!email!]', '[!url!]');
                $fromRepArray = array(
                    $this->input->post('email'),
                    $url
                );
                $subject = "Forgotten password reset";
                $message_templete = $this->load->view('email/forgot_password.html', '', true);
                $message = str_replace($toRepArray, $fromRepArray, $message_templete);
                $sentmail = $this->send_email($this->input->post('email'), $subject, $message);
                $this->session->set_flashdata('success', 'Password reset link send to your mail.');
//                if ($sentmail) {
//                    $this->session->set_flashdata('success', 'Password reset link send to your mail.');
//                } else {
//                    $this->session->set_flashdata('error', 'Mail not sent.');
//                }
            }
        }
        redirect('login/forgot_password');
    }

    public function reset_password() {

        $this->load->view('reset_password');
    }

    public function resetprocess() {
        $UserID = $this->input->post('id');
        $Password = $this->input->post('new_password');
        $ConfirmPassword = $this->input->post('confirm_password');

        if ($Password == $ConfirmPassword) {
            $dt = array(
                'password' => md5($Password)
            );
            $result = $this->login_model->update_reset_password($dt, $UserID);
            $this->session->set_flashdata('success', 'Reset password successfully changed.');
            redirect('login');
        } else {
            $this->session->set_flashdata('error', 'Password and confirm password not match.');
            redirect('login/reset_password');
        }
    }

    public function reset_password_expire() {

        $this->load->view('password_expire');
    }

}

?>
