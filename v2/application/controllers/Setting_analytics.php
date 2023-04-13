<?php
class Setting_analytics extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $data['data'] = $this->setting_analytics_model->get_analytics($this->company_id);
        $this->load->view('setting_analytics', $data);
        $this->load->view('include/footer_new.php');
    }
    
    public function update() {
        $id = $this->input->post('id');
        $data = array(
            'company_id' => $this->company_id,
            'chart_type' => $this->input->post('chart_type'),
            'time_period' => $this->input->post('time_period'),
            'updated_by' => $this->sess_id,
            'updated_date' => $this->current_date()
        );
        $res = $this->setting_analytics_model->update($data, $id);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_UPDATED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('setting_analytics');
    }
    
}
?>