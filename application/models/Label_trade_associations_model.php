<?php

class Label_trade_associations_model extends CI_Model {

    public function get_labels() {
        $query = $this->db->query("SELECT la.*, l.label as label_name, c.category_name 
                                FROM label_association_tbl as la 
                                    LEFT JOIN label_tbl as l 
                                    ON la.label = l.id
                                LEFT JOIN trade_category_tbl as c 
                                    ON la.category_id = c.id
                                WHERE la.company_id = $this->company_id AND la.status = 1 AND c.status != 0 Order By l.label ASC");
        return $query->result();
    }
    
    public function get_labels_only() {
        $this->db->select('*');
        $this->db->from('label_tbl');
        $this->db->where('status', 1);
        $this->db->order_by("id", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_label_by_id($id) {
        $this->db->select('*');
        $this->db->from('label_association_tbl');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->where('company_id', $this->company_id);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function get_label_only_by_id($id) {
        $this->db->select('*');
        $this->db->from('label_tbl');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert($data) {
        return $this->db->insert('label_association_tbl', $data);
    }

    public function update($data, $id) {
        $this->db->where('id', $id);
        return $this->db->update('label_association_tbl', $data);
    }

    public function delete($id) {
         $this->db->set('status', 0);
        $this->db->where('id', $id);
        return $this->db->update('label_association_tbl');
    }

}

?>