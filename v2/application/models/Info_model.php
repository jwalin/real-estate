<?php
class Info_model extends CI_Model {

    public function date_format($date) {
        return date('M j, Y', strtotime($date));
    }
    
    public function created_date() {
        return date('Y-m-d H:i:s');
    }
    
    public function get_company_data() {
        $query = $this->db->query("SELECT * FROM company_tbl WHERE id = ".$this->session->userdata('company_id'));
        return $query->row();
    }
    public function get_user_data() {
        $query = $this->db->query("SELECT * FROM user_tbl WHERE id = ".$this->session->userdata('id'));
        return $query->row();
    }
    
    public function get_company_data_by_id($id) {
        $query = $this->db->query("SELECT * FROM company_tbl WHERE id = ".$id);
        return $query->row();
    }
}
?>