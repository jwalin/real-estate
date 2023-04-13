<?php

class Home_model extends CI_Model {

    public function get_lots_by_tract_id($tract_id) {
        $this->db->select('*');
        $this->db->from('lots_tbl');
        $this->db->where('tract_id', $tract_id);
        $this->db->where('status', 1);
        $this->db->where('company_id', $this->company_id);
        $this->db->order_by('lot_no', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_step_1($data) {
        $this->db->insert('temp_defect', $data);
        return $this->db->insert_id();
    }

    public function insert_step_2($data, $id) {
        $this->db->where('id', $id);
        return $this->db->update('temp_defect_add', $data);
    }

    public function insert_step_3($data) {
        $this->db->insert('defect_tbl', $data);
        return $this->db->insert_id();
    }

    public function get_added_defect_data($id) {
        $query = $this->db->query("SELECT te.*, t.tract_no, l.lot_no 
                                    FROM temp_defect_add as te 
                                    LEFT JOIN tracts_tbl as t 
                                    ON te.tract_id = t.id
                                    LEFT JOIN lots_tbl as l
                                    ON te.lot_id = l.id
                                    WHERE te.id = $id AND te.status = 1 AND t.status = 1 AND l.status = 1");
        return $query->row();
    }

    public function temp_delete($temp_id) {
        $date = date('Y-m-d');
        $this->db->where('id', $temp_id);
        $this->db->delete('temp_defect_add');
        return $this->db->query("DELETE FROM temp_defect_add WHERE DATE(created_date) < '" . $date . "' AND company_id = $this->company_id AND created_by = $this->sess_id");
    }

    public function get_defect_category($id) {
        $query = $this->db->query("SELECT ta.*, c.id as cat_id, c.category_name
                                    FROM tracts_category_partner_associations_tbl as ta 
                                    LEFT JOIN trade_category_tbl as c 
                                    ON ta.category_id = c.id 
                                    WHERE ta.tract_id = $id AND ta.company_id = $this->company_id AND ta.status = 1 AND c.status = 1");
        return $query->result();
    }

    public function get_defect_trade_partner($id) {
        $query = $this->db->query("SELECT ta.*, p.id as partner_uniq_id, p.partner_name
                                    FROM tracts_category_partner_associations_tbl as ta 
                                    LEFT JOIN trade_partner_tbl as p
                                    ON ta.partner_id = p.id
                                    WHERE ta.tract_id = $id AND ta.company_id = $this->company_id AND ta.status = 1 AND p.status = 1 GROUP BY p.id");
        return $query->result();
    }

    public function get_category_defect_types($ids) {
        $query = $this->db->query("SELECT * FROM defect_type_tbl WHERE category_id = $ids AND company_id = $this->company_id AND status = 1");
        return $query->result();
    }
    
    public function get_category_loc_defect_types($cat_id, $loc_ids) {
        $query = $this->db->query("SELECT * FROM defect_type_tbl WHERE category_id = $cat_id AND defect_location_ids = $loc_ids AND company_id = $this->company_id AND status = 1");
        return $query->result();
    }

    public function get_defect_data_by_id($id) {
        $query = $this->db->query("SELECT d.*, t.tract_no, l.lot_no
                                    FROM defect_tbl as d
                                    LEFT JOIN tracts_tbl as t
                                    ON d.tract_id = t.id
                                    LEFT JOIN lots_tbl as l
                                    ON d.lot_id = l.id
                                    WHERE d.id = $id AND d.company_id = $this->company_id AND d.status = 1");
        return $query->row();
    }

    public function update_review_complete_defect($data, $id) {
        $this->db->where('id', $id);
        return $this->db->update('defect_tbl', $data);
    }

    public function get_partner_users_email($data_partner) {
        $partner_ids = $data_partner['partner_ids'];
        $query = $this->db->query("SELECT name, email FROM user_tbl WHERE partner_id IN ($partner_ids) AND company_id = $this->company_id AND status = 1");
        return $query->result();
    }

    public function get_label_id($lbl) {
        $query = $this->db->query("SELECT * FROM label_tbl WHERE label = '$lbl'");
        return $query->row();
    }

    public function get_label_catagory_id($lbl) {
        $query = $this->db->query("SELECT * FROM label_association_tbl WHERE label = $lbl AND company_id = $this->company_id AND status = 1");
        return $query->row();
    }

    public function get_category_partner($tract_id, $cat_id) {
        $query = $this->db->query("SELECT ta.*, p.partner_name FROM tracts_category_partner_associations_tbl as ta LEFT JOIN trade_partner_tbl as p ON ta.partner_id = p.id WHERE ta.company_id = $this->company_id AND ta.tract_id = $tract_id AND ta.category_id = $cat_id AND ta.status = 1");
        return $query->row();
    }

    public function get_tract_name($id) {
        $id = base64_decode(base64_decode($id));
        $query = $this->db->query("SELECT id, name, tract_no FROM tracts_tbl WHERE id = $id AND company_id = $this->company_id AND status = 1");
        return $query->row();
    }

    public function get_lot_name($id) {
        $id = base64_decode(base64_decode($id));
        $query = $this->db->query("SELECT id, lot_no FROM lots_tbl WHERE id = $id AND company_id = $this->company_id AND status = 1");
        return $query->row();
    }

    public function insert_step_3_temp($data) {
        return $this->db->insert('temp_defect', $data);
    }

    public function get_tract_lot_temp_data($tract_id, $lot_id) {
        $query = $this->db->query("SELECT * FROM temp_defect WHERE tract_id = $tract_id AND lot_id = $lot_id and company_id = $this->company_id AND created_by = $this->sess_id AND status = 1 AND is_save = 1");
        return $query->result();
    }

    public function get_lots_tract_check($tract_id, $lot_id) {
        $query = $this->db->query("SELECT * FROM temp_defect WHERE tract_id = $tract_id AND lot_id = $lot_id and company_id = $this->company_id AND created_by = $this->sess_id AND status = 1 AND is_save = 1");
        return $query->num_rows();
    }

    public function insert_defect_last($data) {
        return $this->db->insert_batch('defect_tbl', $data);
    }

    public function temp_delete_defect($tract_id, $lot_id) {
        return $this->db->query("DELETE FROM temp_defect WHERE tract_id = $tract_id AND lot_id = $lot_id AND company_id = $this->company_id AND created_by = $this->sess_id");
    }

    public function get_zz_scanner_code_temp() {
        return $this->db->query("SELECT * FROM temp_defect WHERE scanner_code LIKE '%zz_%' AND company_id = $this->company_id ORDER BY id DESC")->row();
    }

    public function get_zz_scanner_code_ori() {
        return $this->db->query("SELECT * FROM defect_tbl WHERE scanner_code LIKE '%zz_%' AND company_id = $this->company_id ORDER BY id DESC")->row();
    }

    public function get_check_code_temp($scanner_url) {
        return $this->db->query("SELECT * FROM temp_defect WHERE scanner_code = '$scanner_url' AND company_id = $this->company_id ORDER BY id DESC")->row();
    }

    public function get_check_code_ori($scanner_url) {
        return $this->db->query("SELECT * FROM defect_tbl WHERE scanner_code = '$scanner_url' AND company_id = $this->company_id AND status = 1 ORDER BY id DESC")->row();
    }

    public function delete_temp_defect_review($id) {
        $this->db->where('id', $id);
        return $this->db->delete('temp_defect');
    }

    public function get_partner_all() {
        return $this->db->query("SELECT * FROM trade_partner_tbl WHERE company_id = $this->company_id AND status = 1 ORDER BY partner_name ASC")->result();
    }

    public function get_defect_data_edit($id) {
        $query = $this->db->query("SELECT d.*, t.tract_no, l.lot_no
                                    FROM defect_tbl as d
                                    LEFT JOIN tracts_tbl as t
                                    ON d.tract_id = t.id
                                    LEFT JOIN lots_tbl as l
                                    ON d.lot_id = l.id
                                    WHERE d.id = $id AND d.company_id = $this->company_id AND d.status = 1");
        return $query->result();
    }

    public function update_defect($data, $id) {
        $this->db->where('id', $id);
        return $this->db->update('defect_tbl', $data);
    }

    public function get_partner_user_email($partner_ids) {
        $query = $this->db->query("SELECT company_id, name, email FROM user_tbl WHERE partner_id IN ($partner_ids) AND status = 1");
        return $query->result();
    }
    
    public function update_mail_status($id){
        $this->db->set('is_mail', 1);
        $this->db->where('id', $id);
        return $this->db->update('defect_tbl');
    }
    
    public function get_partner_name_email($partner_ids) {
        $query = $this->db->query("SELECT partner_name FROM trade_partner_tbl WHERE id IN ($partner_ids) AND status = 1 AND company_id = ".$this->company_id);
        return $query->result();
    }

}

?>