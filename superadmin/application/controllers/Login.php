<?php

class login extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('login');
    }

    public function loginprocess() {
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        if ($email != "" && $pass != "") {
            $result = $this->login_model->loginprocess($email, $pass);
            if ($result) {
                $sess_array = array(
                    'id' => $result['id'],
                    'name' => $result['name'],
                    'email' => $result['email'],
                    'validated' => true
                );
                $this->session->set_userdata($sess_array);
                $this->history_request();
                redirect('company');
            } else {
                $this->session->set_flashdata('error', NOT_LOGIN);
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('error', ERR_ALL_FIELD_REQUIRED);
            redirect('login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function forgot_password() {
        $this->load->view('forgot_password');
    }

    public function forgot_password_process() {
        $email = $this->input->post('email');
        $result = $this->login_model->check_email($email);
        if ($result == TRUE) {
            $lst = $this->generateRandomString(5);
            $rst = $this->generateRandomString(5);
            $curTime = base64_encode(date('Y-m-d H:i:s'));
            $userId = $result->id;
            $encodeuser = $lst . base64_encode($userId) . $rst;
            $url = base_url() . 'login/reset_password/' . $encodeuser . "/" . $curTime;
            $toRepArray = array('[!email!]', '[!url!]', '[!img!]');
            $fromRepArray = array(
                $email,
                $url,
                LOGO_IMG
            );
            $subject = "Forgotten password reset";
            $message_templete = $this->load->view('email/forgot_password.html', '', true);
            $message = str_replace($toRepArray, $fromRepArray, $message_templete);
            $sentmail = $this->send_email($email, $subject, $message);
            if ($sentmail) {
                $this->history_request();
                $this->session->set_flashdata('success', FORGOT_MAIL_SENT);
            } else {
                $this->session->set_flashdata('error', ERR_EMAIL_NOT_SENT);
            }
        } else {
            $this->session->set_flashdata('error', ERR_EMAIL_NOT_EXIST);
        }
        redirect('login/forgot_password');
    }

    public function reset_password() {
        $this->load->view('reset_password');
    }

    public function reset_password_expire() {
        $this->load->view('reset_password_expire');
    }

    public function resetprocess() {
        $UserID = $this->input->post('id');
        $Password = $this->input->post('new_password');
        $ConfirmPassword = $this->input->post('confirm_password');
        if ($Password == $ConfirmPassword) {
            $dt = array(
                'password' => md5($Password)
            );
            $this->login_model->update_reset_password($dt, $UserID);
            $this->history_request();
            $this->session->set_flashdata('success', PASSWORD_CHANGED);
            redirect('login');
        } else {
            $this->session->set_flashdata('error', PASSWORD_NOT_MATCH);
            redirect('login/reset_password_expire');
        }
    }

    public function change_password() {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $this->load->view('change_password');
        $this->load->view('include/footer_new.php');
    }

    public function update_change_password() {
        $id = $this->input->post('sess_id');
        $pass = $this->input->post('o_password');
        $npass = $this->input->post('n_password');
        $rpass = $this->input->post('c_password');
        if ($npass != $rpass) {
            $this->session->set_flashdata('error', 'Confirm password not macth.');
        } else {
            $qr = $this->db->query("select * from admin where id = " . $id)->row();
            if (md5($pass) == $qr->password) {
                $array = array(
                    'password' => md5($npass)
                );
                $result = $this->login_model->update_reset_password($array, $id);
                if ($result) {
                    $this->history_request();
                    $this->session->set_flashdata('success', PASSWORD_CHANGED);
                } else {
                    $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
                }
            } else {
                $this->session->set_flashdata('error', OLD_PASSWORD_NOT_MATCH);
            }
            redirect('login/change_password');
        }
    }
	
	public function my_profile() {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $data['data'] = $this->login_model->get_profile();
        $this->load->view('my_profile', $data);
        $this->load->view('include/footer_new.php');
    }
	
	public function update_profile() {
        $id = $this->input->post('sess_id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
		$array = array(
			'name' => $name,
			'email' => $email,
		);
		$result = $this->login_model->update_reset_password($array, $id);
		if ($result) {
			$this->session->set_userdata('name', $name);
			$this->history_request();
			$this->session->set_flashdata('success', RECORD_UPDATED);
		} else {
			$this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
		}
		redirect('login/my_profile');
    }
	

}

?>