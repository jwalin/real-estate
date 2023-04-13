<?php

class Defect_location_model extends CI_Model {

    public function get_defect_location() {
        $this->db->select('*');
        $this->db->from('defect_location_tbl');
        $this->db->where('status', 1);
        $this->db->where('company_id', $this->company_id);
        $this->db->order_by("defect_location", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_defect_location_by_id($id) {
        $this->db->select('*');
        $this->db->from('defect_location_tbl');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->where('company_id', $this->company_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert($data) {
        return $this->db->insert('defect_location_tbl', $data);
    }

    public function update($data, $id) {
        $this->db->where('id', $id);
        return $this->db->update('defect_location_tbl', $data);
    }

    public function delete($id) {
         $this->db->set('status', 0);
        $this->db->where('id', $id);
        return $this->db->update('defect_location_tbl');
    }
	
	public function defectcat($data){
		return $this->db->query('SELECT * FROM `trade_category_tbl` WHERE id IN ('.$data.') ORDER BY category_name ASC')->result();
	}

}

?>