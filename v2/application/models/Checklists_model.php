<?php

class Checklists_model extends CI_Model {

    public function getData() {
        $query = $this->db->query("SELECT * FROM `defect_location_tbl` where status = 1 AND company_id = " . $this->company_id . " ORDER BY defect_location ASC");
        return $query->result();
    }

    public function getData_checked($tractid, $lotid) {
        $query = $this->db->query("SELECT l.* FROM defect_location_tbl l, inspection_location i WHERE l.company_id = " . $this->company_id . " AND l.id = i.location_id AND l.status = 1 AND i.tract_id = $tractid AND i.lot_id = $lotid");
        return $query->result();
    }

    public function checklocationdefect($id, $tractid, $lotid) {
        // return $this->db->query('SELECT COUNT(d.id) as defect_count, d.tract_id, d.lot_id, t.tract_no, l.lot_no FROM defect_tbl as d LEFT JOIN tracts_tbl as t ON d.tract_id = t.id LEFT JOIN lots_tbl as l ON d.lot_id = l.id WHERE d.is_completed != 1 AND d.status = 1 AND d.company_id = '. $this->company_id .' AND d.defect_location = '. $id .' GROUP BY d.lot_id')->row();
        return $this->db->query('SELECT COUNT(id) as defect_count FROM `defect_tbl` WHERE defect_location = ' . $id . ' AND company_id = ' . $this->company_id . ' AND status = 1 AND is_completed != 1 AND tract_id = ' . $tractid . ' AND lot_id = ' . $lotid)->row();
    }

    public function checklocationdefectall($id, $tractid, $lotid) {
        return $this->db->query('SELECT COUNT(id) as defect_count FROM `defect_tbl` WHERE defect_location = ' . $id . ' AND company_id = ' . $this->company_id . ' AND status = 1 AND tract_id = ' . $tractid . ' AND lot_id = ' . $lotid)->row();
    }

    public function checklocationdefect_checklist($id, $tractid, $lotid, $catid) {
        return $this->db->query('SELECT COUNT(id) as defect_count FROM `defect_tbl` WHERE defect_location = ' . $id . ' AND company_id = ' . $this->company_id . ' AND status = 1 AND is_completed != 1 AND tract_id = ' . $tractid . ' AND lot_id = ' . $lotid . ' AND trade_category LIKE "%' . $catid . '%"')->row();
    }

    public function get_search_defect_data($tract_id, $lot_id, $type = "", $cat_id, $locid) {
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
									WHERE $cat_ids $types $partner_id d.tract_id = $tract_id AND d.lot_id = $lot_id AND d.defect_location = $locid AND d.company_id = $this->company_id AND d.status = 1");
        return $query->result();
    }
    
    public function get_search_defect_data_last($tract_id, $lot_id, $type = "", $cat_id, $locid, $defet_type_id) {
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
									WHERE $cat_ids $types $partner_id d.tract_id = $tract_id AND d.lot_id = $lot_id AND d.defect_location = $locid AND d.company_id = $this->company_id AND d.status = 1 AND d.defect_type = $defet_type_id");
        return $query->result();
    }
    
    public function get_search_defect_data_last_incomplete($tract_id, $lot_id, $type = "", $cat_id, $locid, $defet_type_id) {
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
									WHERE $cat_ids $types $partner_id d.tract_id = $tract_id AND d.lot_id = $lot_id AND d.defect_location = $locid AND d.company_id = $this->company_id  AND is_completed != 1 AND d.status = 1 AND d.defect_type = $defet_type_id");
        return $query->result();
    }

    public function getDefectCount($uri1, $uri2, $locids) {
        return $this->db->query('SELECT COUNT(id) as defect_count FROM `defect_tbl` WHERE defect_location IN (' . $locids . ') AND company_id = ' . $this->company_id . ' AND status = 1 AND tract_id = ' . $uri1 . ' AND lot_id = ' . $uri2)->row();
    }

    public function getIncompleteDefectCount($uri1, $uri2, $locids) {
        return $this->db->query('SELECT COUNT(id) as defect_count FROM `defect_tbl` WHERE defect_location IN (' . $locids . ') AND company_id = ' . $this->company_id . ' AND is_completed != 1 AND status = 1 AND tract_id = ' . $uri1 . ' AND lot_id = ' . $uri2)->row();
    }

    public function update_status($data, $id, $tract_id, $lot_id) {
        $this->db->where('defect_location', $id);
        $this->db->where('tract_id', $tract_id);
        $this->db->where('lot_id', $lot_id);
        return $this->db->update('defect_tbl', $data);
    }

    public function update_status_category($data, $id, $tract_id, $lot_id, $defect_location) {
        $this->db->where('trade_category LIKE', '%' . $id . '%');
        $this->db->where('defect_location', $defect_location);
        $this->db->where('tract_id', $tract_id);
        $this->db->where('lot_id', $lot_id);
        return $this->db->update('defect_tbl', $data);
    }

    public function insert_cat_by_location($data) {
        $this->db->insert('trade_category_tbl', $data);
        return $this->db->insert_id();
    }

    public function insert_inspection_location($data) {
        $this->db->insert('inspection_location', $data);
        return $this->db->insert_id();
    }

    public function delete_inspection_location($tract_id, $lot_id, $locid, $sess_id) {
        return $this->db->query('DELETE FROM `inspection_location` WHERE tract_id = ' . $tract_id . ' AND lot_id = ' . $lot_id . ' AND location_id = ' . $locid . ' and created_by = ' . $sess_id);
    }

    public function get_inspection_location($locid, $tract_id, $lot_id) {
        $sess_id = $this->sess_id;
        $query = $this->db->query('SELECT * FROM `inspection_location` WHERE tract_id = ' . $tract_id . ' AND lot_id = ' . $lot_id . ' AND location_id = ' . $locid . ' and created_by = ' . $sess_id);
        return $query->row();
    }

    public function insert_inspection_category($data) {
        $this->db->insert('inspection_category', $data);
        return $this->db->insert_id();
    }

    public function delete_inspection_category($tract_id, $lot_id, $locid, $catid, $sess_id) {
        return $this->db->query('DELETE FROM `inspection_category` WHERE tract_id = ' . $tract_id . ' AND lot_id = ' . $lot_id . ' AND location_id = ' . $locid . ' AND category_id = ' . $catid . ' and created_by = ' . $sess_id);
    }

    public function get_inspection_category($locid, $tract_id, $lot_id, $catid) {
        $sess_id = $this->sess_id;
        $query = $this->db->query('SELECT * FROM `inspection_category` WHERE tract_id = ' . $tract_id . ' AND lot_id = ' . $lot_id . ' AND location_id = ' . $locid . ' AND category_id = ' . $catid . ' and created_by = ' . $sess_id);
        return $query->row();
    }

    public function get_inspection_category_check($locid, $tract_id, $lot_id) {
        $sess_id = $this->sess_id;
        $query = $this->db->query('SELECT count(*) as checked_cat_count FROM `inspection_category` WHERE tract_id = ' . $tract_id . ' AND lot_id = ' . $lot_id . ' AND location_id = ' . $locid . ' AND created_by = ' . $sess_id);
        return $query->row();
    }

    public function get_defects_by_tract_lot($tract, $lot, $loc_ids) {
        $query = $this->db->query("SELECT * FROM `defect_tbl` WHERE defect_location IN (" . $loc_ids . ") AND  tract_id = $tract AND lot_id = $lot AND company_id = " . $this->company_id . " AND status = 1");
        return $query->result();
    }

    public function get_location_category_defect_type($catid, $loc_id) {
        $query = $this->db->query("SELECT * FROM `defect_type_tbl` WHERE category_id = $catid AND FIND_IN_SET('$loc_id', defect_location_ids) AND company_id = " . $this->company_id . " AND status = 1");
        return $query->result();
    }
    
    public function insert_inspection_location_category($data) {
        $this->db->insert('inspection_defect_type', $data);
        return $this->db->insert_id();
    }
    
    public function delete_inspection_location_category($tract_id, $lot_id, $locid, $catid, $defect_type_id, $sess_id) {
        return $this->db->query('DELETE FROM `inspection_defect_type` WHERE tract_id = ' . $tract_id . ' AND lot_id = ' . $lot_id . ' AND location_id = ' . $locid . ' AND category_id = ' . $catid . ' and defect_type_id = ' . $defect_type_id . ' and created_by = ' . $sess_id);
    }
    
    public function get_inspection_location_category($locid, $tract_id, $lot_id, $catid, $defect_type_id) {
        $sess_id = $this->sess_id;
        $query = $this->db->query('SELECT * FROM `inspection_defect_type` WHERE tract_id = ' . $tract_id . ' AND lot_id = ' . $lot_id . ' AND location_id = ' . $locid . ' AND category_id = ' . $catid . ' and defect_type_id = ' . $defect_type_id . ' and created_by = ' . $sess_id);
        return $query->row();
    }
    
    public function check_location_category_defect_checklist($locid, $tractid, $lotid, $catid, $defect_type_id) {
        return $this->db->query('SELECT COUNT(id) as defect_count FROM `defect_tbl` WHERE defect_location = ' . $locid . ' AND company_id = ' . $this->company_id . ' AND status = 1 AND is_completed != 1 AND tract_id = ' . $tractid . ' AND lot_id = ' . $lotid . ' AND trade_category LIKE "%' . $catid . '%" AND defect_type = ' . $defect_type_id)->row();
    }
    
    public function update_status_category_location($data, $id, $tract_id, $lot_id, $defect_location, $catid) {
        $this->db->where('trade_category LIKE', '%' . $catid . '%');
        $this->db->where('defect_location', $defect_location);
        $this->db->where('tract_id', $tract_id);
        $this->db->where('lot_id', $lot_id);
        $this->db->where('defect_type', $id);
        return $this->db->update('defect_tbl', $data);
    }
    
    public function get_inspection_def_check($locid, $tract_id, $lot_id, $cat_id) {
        $sess_id = $this->sess_id;
        $query = $this->db->query('SELECT count(*) as checked_def_count FROM `inspection_defect_type` WHERE tract_id = ' . $tract_id . ' AND lot_id = ' . $lot_id . ' AND location_id = ' . $locid . ' AND category_id = ' . $cat_id . ' AND created_by = ' . $sess_id);
        return $query->row();
    }
    
    public function get_dash_defect_type($loc_id, $catid) {
        $query = $this->db->query("SELECT * FROM `defect_type_tbl` WHERE category_id IN ($catid) AND FIND_IN_SET('$loc_id', defect_location_ids) AND company_id = " . $this->company_id . " AND status = 1");
        return $query->result();
    }
    
    public function get_inspection_location_category_dash($locid, $tract_id, $lot_id) {
        $sess_id = $this->sess_id;
        $query = $this->db->query('SELECT * FROM `inspection_defect_type` WHERE tract_id = ' . $tract_id . ' AND lot_id = ' . $lot_id . ' AND location_id = ' . $locid . ' AND created_by = ' . $sess_id);
        return $query->result();
    }
    
    public function get_cat_by_defect_checklist($locid, $cat_id) {
        $query = $this->db->query("SELECT * FROM `defect_type_tbl` WHERE category_id = $cat_id AND defect_location_ids = $locid AND company_id = " . $this->company_id . " AND status = 1");
        return $query->result();
    }
    
    public function get_cat_by_defect_location_checklist($locid) {
        $query = $this->db->query("SELECT * FROM `defect_location_tbl` WHERE id IN (".$locid.") AND status = 1 AND company_id = ".$this->company_id);
        return $query->result();
    }
    
    public function checklocationdefectall_ch($id, $tractid, $lotid) {
        return $this->db->query('SELECT d.*, df.* FROM defect_type_tbl as d LEFT JOIN defect_tbl as df ON df.defect_type = d.id WHERE df.status = 1 AND df.company_id = ' . $this->company_id . ' AND df.defect_location = '.$id.' AND d.closing_hold = 1 AND df.tract_id = '.$tractid.' AND df.lot_id ='. $lotid)->result();
    }
    
    public function checklocationdefectall_ch_category($catid, $locid, $tractid, $lotid) {
        return $this->db->query('SELECT d.*, df.* FROM defect_type_tbl as d LEFT JOIN defect_tbl as df ON df.defect_type = d.id WHERE df.status = 1 AND df.company_id = ' . $this->company_id . ' AND df.defect_location = '.$locid.' AND d.closing_hold = 1 AND df.tract_id = '.$tractid.' AND df.lot_id ='. $lotid.' AND df.trade_category LIKE "%'.$catid.'%"')->result();
    }

}

?>