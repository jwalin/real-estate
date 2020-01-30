<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class My_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function dateTime($date) {
        return date('F l, Y ,m H:i A', strtotime($date));
    }

    public function created_date() {
        return date('Y-m-d H:i:s');
    }

    public function send_email($email, $subject, $msg) {
// return $this->success_response_body('success');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

        ini_set("SMTP", "sg2plcpnl0112.prod.sin2.secureserver.net");
        ini_set("smtp_port", "465");

        require_once(realpath(dirname(__FILE__)) . './phpmailer/class.phpmailer.php');

        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "sg2plcpnl0112.prod.sin2.secureserver.net";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "safan.marediya@itriangletechnolabs.com";
        $mail->Password = "itt@123";
        $mail->setfrom("safan.marediya@itriangletechnolabs.com");
        $mail->Subject = $subject;
        $mail->FromName = 'Slap';

        $body = $msg;

// $body = str_replace('{otp}', $otp, $body);

        $mail->Body = $body;

        $mail->AddAddress($email);

        if (!$mail->Send()) {
// $this->success_response_body('Something went wrong!');
        } else {

// $this->success_response_body('success');
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */