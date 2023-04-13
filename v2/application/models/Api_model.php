<?php
class Api_model extends CI_Model {

    public function get_defect() {
        $query = $this->db->query("SELECT * FROM defect_tbl WHERE status = 1 AND is_mail = 0 AND is_notify = 1");
        return $query->result();
    }
    
    public function get_partner_user_email($data_partner){
        $partner_ids = $data_partner['partner_ids'];
        $query = $this->db->query("SELECT name, email FROM user_tbl WHERE partner_id IN ($partner_ids) AND company_id = $this->company_id AND status = 1");
        return $query->result();
    }
    
    public function update_mail_status($id){
        $this->db->set('is_mail', 1);
        $this->db->where('id', $id);
        return $this->db->update('defect_tbl');
    }
	
	public function get_partner() {
        $query = $this->db->query("SELECT * FROM trade_partner_tbl WHERE status = 1");
        return $query->result();
    }
	
	public function get_partner_email_from_user($id){
        $query = $this->db->query("SELECT * FROM user_tbl WHERE partner_id = $id AND status = 1");
        return $query->result();
    }
	
	public function get_defect_by_partner($id){
        $query = $this->db->query("SELECT d.*, dt.defect_type as defect_type_name, dl.defect_location as defect_location_name 
										FROM defect_tbl as d 
										LEFT JOIN defect_type_tbl as dt 
										ON d.defect_type = dt.id 
										LEFT JOIN defect_location_tbl as dl
										ON d.defect_location = dl.id
									WHERE d.trade_partner LIKE '%$id%' AND d.status = 1 AND d.is_completed = 0");
        return $query->result();
    }
	
	public function get_category_by_id($id) {
        $query = $this->db->query("SELECT * FROM trade_category_tbl WHERE id = $id AND status = 1");
        return $query->row();
    }
	
	public function get_partner_by_id($id) {
        $query = $this->db->query("SELECT * FROM trade_partner_tbl WHERE id = $id AND status = 1");
        return $query->row();
    }
	
}
?>