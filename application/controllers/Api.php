<?php

class Api extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $get_defect = $this->api_model->get_defect();
        foreach ($get_defect as $get_defect) {
            $trade_partner_id = json_decode($get_defect->trade_partner);
            $im_prtnr = implode(',', $trade_partner_id);
            $data_partner = array(
                'partner_ids' => rtrim($im_prtnr, ",")
            );
            $get_email = $this->api_model->get_partner_user_email($data_partner);
            foreach ($get_email as $get_email) {
                $email = $get_email->email;
                $url = base_url();
                $toRepArray = array('[!name!]', '[!code!]', '[!url!]', '[!img!]');
                $fromRepArray = array(
                    $get_email->name,
                    $get_defect->scanner_code,
                    $url,
                    LOGO_IMG
                );
                $subject = "New defect notification arrived!";
                $message_templete = $this->load->view('email/notify_trades.html', '', true);
                $message = str_replace($toRepArray, $fromRepArray, $message_templete);
                $sent_mail = $this->send_email($email, $subject, $message);
                if ($sent_mail) {
                    $res = $this->api_model->update_mail_status($get_defect->id);
                }
            }
        }
    }
	
	public function incomplete_defect_mail() {
		$get_partner = $this->api_model->get_partner();
        foreach ($get_partner as $get_partner) {
			
			$data['data'] = $this->api_model->get_defect_by_partner($get_partner->id);
			// print_r($data['data']);
			// $data['partner_id'] = $get_partner->id;
			
			$get_email = $this->api_model->get_partner_email_from_user($get_partner->id);
			// print_r($get_defect);
			
			// foreach ($get_defect as $get_defect) {
                // echo $get_defect->id;
				
			// foreach ($get_email as $get_email) {
                // echo $get_email->email;
				// print_r($data['data']);
				
				$email = 'dipak.itt@gmail.com';
                $url = base_url();
                $toRepArray = array('[!name!]', '[!code!]', '[!url!]', '[!img!]');
                $fromRepArray = array(
                    'name',
                    'code',
                    $url,
                    LOGO_IMG
                );
                $subject = "Incomplete Defect Reminder!";
                $message_templete = $this->load->view('email/defect_partner_mail', $data, true);
                $message = str_replace($toRepArray, $fromRepArray, $message_templete);
                $sent_mail = $this->send_email($email, $subject, $message);
				
				
				
				
			// }
			}
			
		}exit;
	}

}

?>