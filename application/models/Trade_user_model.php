<?php

class Trade_user_model extends CI_Model {

    public function get_trade_user($id = "") {
        $partner_query = "";
        if($id != "All"){
            $partner_query = ' AND u.partner_id = '.$id;
        } 
        $query = $this->db->query('SELECT u.*, p.partner_name FROM user_tbl as u LEFT JOIN trade_partner_tbl as p ON u.partner_id = p.id WHERE u.type = 4 AND u.status != 0 AND p.status = 1 AND u.company_id = '.$this->company_id.$partner_query.' ORDER BY p.partner_name, u.name ASC');
//        $this->db->select('*');
//        $this->db->from('user_tbl');
//        $this->db->where('company_id', $this->company_id);
//        $this->db->where('status !=', 0);
//        $this->db->where('type =', 4);
//        if($id != "All"){
//            $this->db->where('partner_id', $id);
//        }        
//        $this->db->order_by("id", "desc");
//        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_builder_user() {
        $this->db->select('*');
        $this->db->from('user_tbl');
        $this->db->where('company_id', $this->company_id);
        $this->db->where('status !=', 0);
        $this->db->where('type !=', 4);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_trade_user_by_id($id) {
        $this->db->select('*');
        $this->db->from('user_tbl');
        $this->db->where('id', $id);
        $this->db->where('company_id', $this->company_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert($data) {
        return $this->db->insert('user_tbl', $data);
    }

    public function update($data, $id) {
        $this->db->where('id', $id);
        return $this->db->update('user_tbl', $data);
    }

    public function delete($id) {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        return $this->db->update('user_tbl');
    }

    public function check_user_email($email) {
        $this->db->select('*');
        $this->db->from('user_tbl');
        $this->db->where('email', $email);
        $this->db->where('status !=', 0);
//        $this->db->where('type !=', 4);
        $this->db->where('company_id', $this->company_id);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function check_trade_user_email($email) {
        $this->db->select('*');
        $this->db->from('user_tbl');
        $this->db->where('email', $email);
        $this->db->where('status !=', 0);
//        $this->db->where('type =', 4);
        $this->db->where('company_id', $this->company_id);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
}

?>