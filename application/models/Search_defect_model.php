<?php

class Search_defect_model extends CI_Model {

    public function get_tracts_lots() {
        $query = $this->db->query("SELECT t.*, l.id as lot_id, l.lot_no FROM tracts_tbl as t INNER JOIN lots_tbl as l ON t.id = l.tract_id WHERE t.company_id = $this->company_id AND l.company_id = $this->company_id AND t.status = 1 AND l.status = 1 ORDER BY t.tract_no DESC, l.lot_no DESC");
        return $query->result();
    }

    public function get_search_defect_data($tract_id, $lot_id, $type, $cat_id) {
        $partner_id = "";
        if ($this->session->userdata('type') == 4) {
            $pid = $this->session->userdata('partner_id');
            $pids = '"' . $pid . '"';
            $partner_id = " d.trade_partner LIKE '%" . $pids . "%' AND ";
        }

        $cat_ids = "";
        if ($cat_id) {
            $cids = '"' . $cat_id . '"';
            $cat_ids = " d.trade_category LIKE '%" . $cids . "%' AND ";
        }

        $types = "";
        if ($type == 1) {
            $types = " d.is_completed != 1 AND ";
        }

        $query = $this->db->query("SELECT d.*, dt.defect_type as defect_type_name, dl.defect_location as defect_location_name 
										FROM defect_tbl as d 
										LEFT JOIN defect_type_tbl as dt 
										ON d.defect_type = dt.id 
										LEFT JOIN defect_location_tbl as dl
										ON d.defect_location = dl.id
									WHERE $cat_ids $types $partner_id d.tract_id = $tract_id AND d.lot_id = $lot_id AND d.company_id = $this->company_id AND d.status = 1");
        return $query->result();
    }

    public function get_category_by_id($id) {
        $query = $this->db->query("SELECT * FROM trade_category_tbl WHERE id = $id AND status = 1 AND company_id = $this->company_id");
        return $query->row();
    }

    public function get_partner_by_id($id) {
        $query = $this->db->query("SELECT * FROM trade_partner_tbl WHERE id = $id AND status = 1 AND company_id = $this->company_id");
        return $query->row();
    }

    public function get_defect_detail_by_label($label) {
        $query = $this->db->query("SELECT d.*, dt.defect_type as defect_type_name, dl.defect_location as defect_location_name 
										FROM defect_tbl as d 
										LEFT JOIN defect_type_tbl as dt 
										ON d.defect_type = dt.id 
										LEFT JOIN defect_location_tbl as dl
										ON d.defect_location = dl.id
									WHERE d.scanner_code = '$label' AND d.company_id = $this->company_id AND d.status = 1");
        return $query->row();
    }

    public function get_label_check($label) {
        $partner_id = "";
        if ($this->session->userdata('type') == 4) {
            $pid = $this->session->userdata('partner_id');
            $pids = '"' . $pid . '"';
            $partner_id = " trade_partner LIKE '%" . $pids . "%' AND ";
        }
        $query = $this->db->query("SELECT * FROM defect_tbl WHERE $partner_id scanner_code = '$label' AND company_id = $this->company_id AND status = 1");
        return $query->row();
    }

    public function check_tract_id_data($id) {
        $query = $this->db->query("SELECT * FROM tracts_tbl WHERE tract_no = '$id' AND company_id = $this->company_id AND status = 1");
        return $query->row();
    }

    public function check_lot_id_data($id) {
        $query = $this->db->query("SELECT * FROM lots_tbl WHERE lot_no = '$id' AND company_id = $this->company_id AND status = 1");
        return $query->row();
    }

    public function get_search_defect_data_partner($id, $tract_id, $lot_id) {
        $partner_id = "";
        if ($this->session->userdata('type') == 4) {
            $pid = $this->session->userdata('partner_id');
            $pids = '"' . $pid . '"';
            $partner_id = " d.trade_partner LIKE '%" . $pids . "%' AND ";
        }

        $tract_ids = "";
        if ($tract_id) {
            $tract_ids = " d.tract_id = $tract_id AND ";
        }
        $lot_ids = "";
        if ($lot_id) {
            $lot_ids = " d.lot_id = $lot_id AND ";
        }
        $query = $this->db->query("SELECT d.*, dt.defect_type as defect_type_name, dl.defect_location as defect_location_name 
										FROM defect_tbl as d 
										LEFT JOIN defect_type_tbl as dt 
										ON d.defect_type = dt.id 
										LEFT JOIN defect_location_tbl as dl
										ON d.defect_location = dl.id
									WHERE " . $tract_ids . $lot_ids . $partner_id . " d.trade_partner LIKE '%$id%' AND d.company_id = $this->company_id AND d.status = 1");
        return $query->result();
    }

    public function get_partner_name($id) {
        $query = $this->db->query("SELECT * FROM trade_partner_tbl WHERE id = $id AND company_id = $this->company_id AND status = 1");
        return $query->row();
    }

    public function update_status($data, $id) {
        $this->db->where('id', $id);
        return $this->db->update('defect_tbl', $data);
    }
}

?>