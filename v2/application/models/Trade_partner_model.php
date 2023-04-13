<?php

class Trade_partner_model extends CI_Model {

    public function get_trade_partner() {
        $this->db->select('*');
        $this->db->from('trade_partner_tbl');
        $this->db->where('status', 1);
        $this->db->where('company_id', $this->company_id);
        $this->db->order_by("partner_name", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_trade_partner_by_id($id) {
        $this->db->select('*');
        $this->db->from('trade_partner_tbl');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->where('company_id', $this->company_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert($data) {
        return $this->db->insert('trade_partner_tbl', $data);
    }

    public function update($data, $id) {
        $this->db->where('id', $id);
        return $this->db->update('trade_partner_tbl', $data);
    }

    public function delete($id) {
         $this->db->set('status', 0);
        $this->db->where('id', $id);
        return $this->db->update('trade_partner_tbl');
    }
    
}

?>