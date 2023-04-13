<?php

class Setting_analytics_model extends CI_Model {

    public function get_analytics($id) {
        $this->db->select('*');
        $this->db->from('settings_analytics_tbl');
        $this->db->where('status', 1);
        $this->db->where('company_id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function update($data, $id) {
        $this->db->where('id', $id);
        return $this->db->update('settings_analytics_tbl', $data);
    }

}

?>