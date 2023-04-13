<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class My_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->router->fetch_class() != "login" && $this->router->fetch_class() != "api") {
            $this->is_validCheck();
            $this->sess_id = $this->session->userdata('id');
            $this->company_id = $this->session->userdata('company_id');
        }
    }

    private function is_validCheck() {
        if ($this->session->userdata('validated') != TRUE) {
            redirect('login');
        }
    }
    
    public function current_date() {
        return date('Y-m-d H:i:s');
    }

    public function send_email($email, $subject, $msg, $attachment = '') {
        ini_set("SMTP", "gator4169.hostgator.com");
        ini_set("smtp_port", "465");

        require_once(realpath(dirname(__FILE__)) . '/phpmailer/class.phpmailer.php');

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "gator4169.hostgator.com";
        $mail->Port = 465;
        $mail->IsHTML(true);
        $mail->Username = "no_reply@ezqcapp.com";
        $mail->Password = "d;%-49iSS&%g";
        $mail->SetFrom("no_reply@ezqcapp.com");
        $mail->Subject = $subject;
        $mail->FromName = 'EZQC';
        $body = $msg;
        $mail->Body = $body;
        $mail->AddAddress($email);
         if($attachment !=''){
        $mail->AddAttachment($attachment, $name = 'Defect_list.pdf',  $encoding = 'base64', $type = 'application/pdf');
        }
        if (!$mail->Send()) {
            return False;
        } else {
            return True;
        }
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

    public function history_request($ids = "") {
        if($ids != ""){
            $_POST['delete_id'] = $ids;
        }
        $dt = array(
            'company_id' => ($this->session->userdata('company_id')) ? $this->session->userdata('company_id') : 0,
            'user_id' => ($this->session->userdata('id')) ? $this->session->userdata('id') : 0,
            'request' => json_encode($_POST),
            'description' => $this->router->fetch_class() . ' / ' . $this->router->fetch_method(),
            'created_date' => date('Y-m-d H:i:s')
        );
        return $this->db->insert('history_tbl', $dt);
    }

}
