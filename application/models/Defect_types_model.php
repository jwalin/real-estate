<?php

class Defect_types_model extends CI_Model {

    public function get_defect_types() {
        $query = $this->db->query('SELECT d.*, c.category_name FROM defect_type_tbl as d LEFT JOIN trade_category_tbl as c ON d.category_id = c.id WHERE d.status = 1 AND c.status = 1 AND d.company_id = '.$this->company_id.' ORDER BY c.category_name, d.defect_type ASC');
//        $this->db->select('*');
//        $this->db->from('defect_type_tbl');
//        $this->db->where('status', 1);
//        $this->db->where('company_id', $this->company_id);
//        $this->db->order_by("id", "desc");
//        $query = $this->db->get();
        return $query->result();
    }

    public function get_defect_type_by_id($id) {
        $this->db->select('*');
        $this->db->from('defect_type_tbl');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->where('company_id', $this->company_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert($data) {
        return $this->db->insert('defect_type_tbl', $data);
    }

    public function update($data, $id) {
        $this->db->where('id', $id);
        return $this->db->update('defect_type_tbl', $data);
    }

    public function delete($id) {
         $this->db->set('status', 0);
        $this->db->where('id', $id);
        return $this->db->update('defect_type_tbl');
    }

}

?>