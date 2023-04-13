<?php
class Profile_model extends CI_Model {

    public function get_profile($sess_id) {
        $this->db->select('*');
        $this->db->from('user_tbl');
        $this->db->where('id', $sess_id);
        $query = $this->db->get();
        return $query->row();
    }
    
}
?>