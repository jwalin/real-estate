<?php

class Lots_model extends CI_Model {

    public function get_lots() {
        $query = $this->db->query('SELECT l.*, t.tract_no FROM lots_tbl as l LEFT JOIN tracts_tbl as t ON l.tract_id = t.id WHERE l.status = 1 AND t.status = 1 AND l.company_id = '.$this->company_id.' ORDER BY t.tract_no, l.lot_no ASC');
//        $this->db->select('*');
//        $this->db->from('lots_tbl');
//        $this->db->where('status', 1);
//        $this->db->where('company_id', $this->company_id);
//        $this->db->order_by("id", "desc");
//        $query = $this->db->get();
        return $query->result();
    }

    public function get_lots_by_id($id) {
        $this->db->select('*');
        $this->db->from('lots_tbl');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->where('company_id', $this->company_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert($data) {
        return $this->db->insert('lots_tbl', $data);
    }

    public function insert_batch($data) {
        return $this->db->insert('lots_tbl', $data);
//        return $this->db->insert_batch('lots_tbl', $data);
    }

    public function update($data, $id) {
        $this->db->where('id', $id);
        return $this->db->update('lots_tbl', $data);
    }

    public function delete($id) {
         $this->db->set('status', 0);
        $this->db->where('id', $id);
        return $this->db->update('lots_tbl');
    }
    
    public function get_tract_id($tract_no) {
        $this->db->select('*');
        $this->db->from('tracts_tbl');
        $this->db->where('tract_no', $tract_no);
        $this->db->where('company_id', $this->company_id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function get_tract_lot_data($tract_no, $lot_no) {
        $this->db->select('*');
        $this->db->from('lots_tbl');
        $this->db->where('tract_id', $tract_no);
        $this->db->where('lot_no', $lot_no);
        $this->db->where('company_id', $this->company_id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->row();
    }
    
}

?>