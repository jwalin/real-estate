<?php

class Company_model extends CI_Model {

    public function get_company_user() {
        $query = $this->db->query("SELECT u.*, c.company_name, c.company_logo, c.status as company_status FROM user_tbl as u LEFT JOIN company_tbl as c ON u.company_id = c.id WHERE c.status != 0 GROUP BY u.company_id");
        return $query->result();
    }
    
    public function get_company_user_by_id($id) {
        $query = $this->db->query("SELECT u.*, c.company_name, c.company_logo, c.status as company_status FROM user_tbl as u LEFT JOIN company_tbl as c ON u.company_id = c.id WHERE u.status != 0 AND c.status != 0 AND u.id = ".$id);
        return $query->row();
    }

    public function company_insert($data) {
        $this->db->insert('company_tbl', $data);
        return $this->db->insert_id();
    }

    public function insert($data) {
        return $this->db->insert('user_tbl', $data);
    }

    public function analytics_insert($data) {
        return $this->db->insert('settings_analytics_tbl', $data);
    }

    public function company_update($data, $id) {
        $this->db->where('id', $id);
        return $this->db->update('company_tbl', $data);
    }

    public function update($data, $id) {
        $this->db->where('id', $id);
        return $this->db->update('user_tbl', $data);
    }

    public function company_delete($id) {
         $this->db->set('status', 0);
        $this->db->where('id', $id);
        return $this->db->update('company_tbl');
    }

    public function delete($id) {
         $this->db->set('status', 0);
        $this->db->where('company_id', $id);
        return $this->db->update('user_tbl');
    }
	
	public function check_user_email($email) {
        $this->db->select('*');
        $this->db->from('user_tbl');
        $this->db->where('email', $email);
        $this->db->where('status !=', 0);
//        $this->db->where('type !=', 4);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
}

?>