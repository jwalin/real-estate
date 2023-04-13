<?php

class Tracts_model extends CI_Model {

    public function get_tracts() {
        $this->db->select('*');
        $this->db->from('tracts_tbl');
        $this->db->where('status', 1);
        $this->db->where('company_id', $this->company_id);
        $this->db->order_by("tract_no", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_tracts_by_id($id) {
        $this->db->select('*');
        $this->db->from('tracts_tbl');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->where('company_id', $this->company_id);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function get_category_partner_by_id($id) {
        $this->db->select('*');
        $this->db->from('tracts_category_partner_associations_tbl');
        $this->db->where('tract_id', $id);
        $this->db->where('status', 1);
        $this->db->where('company_id', $this->company_id);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function check_category_partner_associations($company_id, $tract_id, $category_id) {
        $this->db->select('*');
        $this->db->from('tracts_category_partner_associations_tbl');
        $this->db->where('company_id', $company_id);
        $this->db->where('tract_id', $tract_id);
        $this->db->where('category_id', $category_id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function insert($data) {
        $this->db->insert('tracts_tbl', $data);
        return $this->db->insert_id();
    }

    public function category_partner_associations_insert_edit($data) {
        return $this->db->insert('tracts_category_partner_associations_tbl', $data);
    }

    public function category_partner_associations_insert($data) {
        return $this->db->insert_batch('tracts_category_partner_associations_tbl', $data);
    }

    public function category_partner_associations_update($data, $id, $category_id) {
        $this->db->where('tract_id', $id);
        $this->db->where('category_id', $category_id);
        return $this->db->update('tracts_category_partner_associations_tbl', $data);
    }

    public function update($data, $id) {
        $this->db->where('id', $id);
        return $this->db->update('tracts_tbl', $data);
    }

    public function delete($id) {
         $this->db->set('status', 0);
        $this->db->where('id', $id);
        return $this->db->update('tracts_tbl');
    }
	
	public function get_last_tracts_data() {
        $query = $this->db->query('SELECT * FROM `tracts_tbl` WHERE company_id = '.$this->company_id.' AND status = 1 ORDER BY id DESC LIMIT 1');
        return $query->row();
    }
    
	public function get_cat_partner_data_by_tracts($tracts_id, $cat_id) {
        $query = $this->db->query('SELECT * FROM `tracts_category_partner_associations_tbl` WHERE company_id = '.$this->company_id.' AND category_id = '.$cat_id.' AND tract_id = '.$tracts_id.' AND status = 1');
        return $query->row();
    }
    
}

?>