<?php

class Defect_types_model extends CI_Model {

    public function get_defect_types() {
//        $query = $this->db->query('SELECT d.*, c.category_name FROM defect_type_tbl as d LEFT JOIN trade_category_tbl as c ON d.category_id = c.id WHERE d.status = 1 AND c.status = 1 AND d.company_id = ' . $this->company_id . ' ORDER BY c.category_name, d.defect_type ASC');
        $query = $this->db->query('SELECT d.*, c.category_name, dl.defect_location FROM defect_type_tbl as d LEFT JOIN trade_category_tbl as c ON d.category_id = c.id LEFT JOIN defect_location_tbl as dl ON d.defect_location_ids = dl.id WHERE d.status = 1 AND c.status = 1 AND d.company_id = ' . $this->company_id . ' ORDER BY dl.defect_location, c.category_name, d.defect_type ASC');
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

    public function defect_location_multi($data) {
        return $this->db->query('SELECT * FROM `defect_location_tbl` WHERE id IN (' . $data . ') ORDER BY defect_location ASC')->result();
    }

    public function get_defect_location_id($location) {
        // return $this->db->query('SELECT * FROM `defect_location_tbl` WHERE defect_location = "'.$location.'" AND status = 1 AND company_id = '.$this->company_id.' AND created_by = '.$this->sess_id)->row();
        return $this->db->query('SELECT * FROM `defect_location_tbl` WHERE defect_location = "'.$location.'" AND status = 1 AND company_id = '.$this->company_id)->row();
    }

    public function get_trade_category_id($trade_cat) {
        // return $this->db->query('SELECT * FROM `trade_category_tbl` WHERE category_name = "'.$trade_cat.'" AND status = 1 AND company_id = '.$this->company_id.' AND created_by = '.$this->sess_id)->row();
        return $this->db->query('SELECT * FROM `trade_category_tbl` WHERE category_name = "'.$trade_cat.'" AND status = 1 AND company_id = '.$this->company_id)->row();
    }

}

?>