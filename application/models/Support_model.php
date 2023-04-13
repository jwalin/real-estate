<?php

class Support_model extends CI_Model {

    public function get_faq() {
        $query = $this->db->query("SELECT * FROM faq_tbl WHERE status = 1");
        return $query->result();
    }

    public function get_tutorial() {
        $query = $this->db->query("SELECT * FROM tutorial_tbl WHERE status = 1");
        return $query->result();
    }

    public function get_admin_data() {
        $query = $this->db->query("SELECT * FROM admin LIMIT 1");
        return $query->row();
    }

}

?>