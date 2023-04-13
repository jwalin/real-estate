<?php

class Checklists_defect_model extends CI_Model {

    public function get_defect_location($ex5) {
        $this->db->select('*');
        $this->db->from('defect_location_tbl');
        $this->db->where('status', 1);
        $this->db->where('company_id', $this->company_id);
        $this->db->where('id', $ex5);
        $query = $this->db->get();
        return $query->row();
    }

	public function insert_defect($data) {
        return $this->db->insert('defect_tbl', $data);
    }
	
	public function insert_df_type($data) {
        $this->db->insert('defect_type_tbl', $data);
		return $this->db->insert_id();
    }
	
}

?>