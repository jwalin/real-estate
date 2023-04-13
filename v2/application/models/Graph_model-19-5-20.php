<?php

class Graph_model extends CI_Model {

    public function get_settings_analytics() {
        $query = $this->db->query("SELECT * FROM settings_analytics_tbl WHERE company_id = ".$this->company_id);
        return $query->row();
    }

    public function get_defect_count($start_date, $end_date) {
        $query = $this->db->query("SELECT COUNT(*) as defect_count FROM defect_tbl WHERE company_id = ".$this->company_id." AND status = 1 AND DATE(created_date) BETWEEN '".$start_date."' AND '".$end_date."'");
        return $query->row();
    }
    
    public function get_lot_count($start_date, $end_date) {
//        $query = $this->db->query("SELECT COUNT(*) as lot_count FROM lots_tbl WHERE status = 1 AND company_id = ".$this->company_id);
        $query = $this->db->query("SELECT COUNT(*) as defect_count FROM defect_tbl WHERE company_id = ".$this->company_id." AND status = 1 AND DATE(created_date) BETWEEN '".$start_date."' AND '".$end_date."' GROUP BY lot_id");
        return $query->result();
    }
    
    public function get_partner() {
        $query = $this->db->query("SELECT * FROM trade_partner_tbl WHERE status = 1 AND company_id = ".$this->company_id);
        return $query->result();
    }
    
    public function get_defect_by_partner($pid) {
        $pids = '"'.$pid.'"';
        $partner_id = " trade_partner LIKE '%".$pids."%' AND ";
		
        $query = $this->db->query("SELECT COUNT(*) as partner_defct_count FROM defect_tbl WHERE $partner_id status = 1 AND company_id = ".$this->company_id);
        return $query->row();
    }
    
    public function get_category() {
        $query = $this->db->query("SELECT * FROM trade_category_tbl WHERE status = 1 AND company_id = ".$this->company_id);
        return $query->result();
    }
    
    public function get_defect_by_category($cid) {
        $cids = '"'.$cid.'"';
        $category_id = " trade_category LIKE '%".$cids."%' AND ";
		
        $query = $this->db->query("SELECT COUNT(*) as category_defct_count FROM defect_tbl WHERE $category_id status = 1 AND company_id = ".$this->company_id);
        return $query->row();
    }
    
    public function get_tracts() {
        $query = $this->db->query("SELECT * FROM tracts_tbl WHERE status = 1 AND company_id = ".$this->company_id);
        return $query->result();
    }
    
    public function get_defect_by_tracts($tid) {
        $query = $this->db->query("SELECT COUNT(*) as tract_defct_count, tract_id FROM defect_tbl WHERE tract_id = $tid AND status = 1 AND company_id = ".$this->company_id);
        return $query->row();
    }
    
    public function get_lots_by_tracts($tid) {
        $query = $this->db->query("SELECT COUNT(*) as lot_count, tract_id FROM lots_tbl WHERE tract_id = $tid AND status = 1 AND company_id = ".$this->company_id." AND id IN (SELECT lot_id FROM defect_tbl WHERE tract_id = $tid AND status = 1 AND company_id = ".$this->company_id.")");
        return $query->row();
    }
    
    public function get_tract_name($tid) {
        $query = $this->db->query("SELECT * FROM tracts_tbl WHERE id = $tid AND status = 1 AND company_id = ".$this->company_id);
        return $query->row();
    }
    
    public function get_complete_defect($start_date, $end_date) {
        $query = $this->db->query("SELECT * FROM defect_tbl WHERE status = 1 AND is_completed = 1 AND company_id = ".$this->company_id." AND DATE(created_date) BETWEEN '".$start_date."' AND '".$end_date."' GROUP BY lot_id");
        return $query->result();
    }
    
    public function get_incomplete_defect_by_lot($lot_id) {
        $query = $this->db->query("SELECT count(*) as incomplete_count FROM defect_tbl WHERE status = 1 AND is_completed != 1 AND company_id = ".$this->company_id." AND lot_id = ".$lot_id);
        return $query->row();
    }
    
    public function get_diff_days($lot_id) {
        $query = $this->db->query("SELECT DATEDIFF(MAX(completion_date), MIN(created_date)) as diff_days_count, getWorkingday(DATE_FORMAT(MIN(created_date),'%Y-%c-%d'),
    MAX(completion_date),'weekend_days') as weekend_days FROM defect_tbl WHERE status = 1 AND is_completed = 1 AND company_id = ".$this->company_id." AND lot_id =". $lot_id);
        return $query->row();
    }
    
    
    
    /*------------- Start Analytics Tract -------------*/
    public function get_defect_count_tract($start_date, $end_date, $tract_id) {
        $query = $this->db->query("SELECT COUNT(*) as defect_count FROM defect_tbl WHERE company_id = ".$this->company_id." AND status = 1 AND DATE(created_date) BETWEEN '".$start_date."' AND '".$end_date."' AND tract_id = $tract_id");
        return $query->row();
    }
    
    public function get_lot_count_tract($start_date, $end_date, $tract_id) {
        $query = $this->db->query("SELECT COUNT(*) as defect_count FROM defect_tbl WHERE company_id = ".$this->company_id." AND status = 1 AND DATE(created_date) BETWEEN '".$start_date."' AND '".$end_date."' AND tract_id = $tract_id GROUP BY lot_id");
        return $query->result();
    }
    
    public function get_complete_defect_tract($start_date, $end_date, $tract_id) {
        $query = $this->db->query("SELECT * FROM defect_tbl WHERE status = 1 AND is_completed = 1 AND company_id = ".$this->company_id." AND DATE(created_date) BETWEEN '".$start_date."' AND '".$end_date."' AND tract_id = $tract_id GROUP BY lot_id");
        return $query->result();
    }
    
    public function get_incomplete_defect_by_lot_tract($lot_id, $tract_id) {
        $query = $this->db->query("SELECT count(*) as incomplete_count FROM defect_tbl WHERE status = 1 AND is_completed != 1 AND company_id = ".$this->company_id." AND tract_id = $tract_id AND lot_id = ".$lot_id);
        return $query->row();
    }
    
    public function get_diff_days_tract($lot_id, $tract_id) {
        $query = $this->db->query("SELECT DATEDIFF(MAX(completion_date), MIN(created_date)) as diff_days_count, getWorkingday(DATE_FORMAT(MIN(created_date),'%Y-%c-%d'),
		MAX(completion_date),'weekend_days') as weekend_days FROM defect_tbl WHERE status = 1 AND is_completed = 1 AND company_id = ".$this->company_id." AND tract_id = $tract_id AND lot_id =". $lot_id);
        return $query->row();
    }
    
    public function get_defect_by_partner_tract($pid, $tract_id) {
        $pids = '"'.$pid.'"';
        $partner_id = " trade_partner LIKE '%".$pids."%' AND ";
	
        $query = $this->db->query("SELECT COUNT(*) as partner_defct_count FROM defect_tbl WHERE $partner_id status = 1 AND tract_id = $tract_id AND company_id = ".$this->company_id);
        return $query->row();
    }
    
    public function get_total_defect_per_lot($start_date, $end_date, $tract_id) {
        $query = $this->db->query("SELECT COUNT(*) as tract_count, lot_id FROM defect_tbl WHERE status = 1 AND company_id = $this->company_id AND DATE(created_date) BETWEEN '".$start_date."' AND '".$end_date."' AND tract_id = $tract_id GROUP BY lot_id");
        return $query->result();
    }
    
    public function get_total_days_complation_defect_per_lot($tract_id) {
        $query = $this->db->query("SELECT COUNT(*) as cnt, lot_id, DATEDIFF(MAX(completion_date), MIN(created_date)) as total_days, getWorkingday(DATE_FORMAT(MIN(created_date),'%Y-%c-%d'),
		MAX(completion_date),'weekend_days') as weekend_days FROM defect_tbl WHERE status = 1 AND company_id = $this->company_id AND tract_id = $tract_id AND is_completed = 1 AND lot_id NOT IN(SELECT lot_id FROM defect_tbl WHERE is_completed != 1 AND status = 1 AND company_id = $this->company_id AND tract_id = $tract_id) GROUP BY lot_id ORDER BY completion_date DESC LIMIT 20");
        return $query->result();
    }
    
    public function get_lot_name($lid) {
        $query = $this->db->query("SELECT * FROM lots_tbl WHERE id = $lid AND status = 1 AND company_id = ".$this->company_id);
        return $query->row();
    }
    /*------------- End Analytics Tract -------------*/
    
    /*------------- Start Analytics Partner -------------*/
    public function get_defect_count_partner($start_date, $end_date, $partner_id) {
        $pids = '"'.$partner_id.'"';
        $partner_ids = " trade_partner LIKE '%".$pids."%' ";
        $query = $this->db->query("SELECT COUNT(*) as defect_count FROM defect_tbl WHERE company_id = ".$this->company_id." AND status = 1  AND DATE(created_date) BETWEEN '".$start_date."' AND '".$end_date."' AND $partner_ids");
        return $query->row();
    }
    
    public function get_lot_count_partner($start_date, $end_date, $partner_id) {
        $pids = '"'.$partner_id.'"';
        $partner_ids = " trade_partner LIKE '%".$pids."%' ";
        $query = $this->db->query("SELECT COUNT(*) as defect_count FROM defect_tbl WHERE company_id = ".$this->company_id." AND status = 1  AND DATE(created_date) BETWEEN '".$start_date."' AND '".$end_date."' AND $partner_ids GROUP BY lot_id");
        return $query->result();
    }
    
    public function get_complete_defect_partner($start_date, $end_date, $partner_id) {
        $pids = '"'.$partner_id.'"';
        $partner_ids = " trade_partner LIKE '%".$pids."%' ";
        $query = $this->db->query("SELECT * FROM defect_tbl WHERE status = 1 AND is_completed = 1 AND company_id = ".$this->company_id." AND  DATE(created_date) BETWEEN '".$start_date."' AND '".$end_date."' AND $partner_ids  GROUP BY lot_id");
        return $query->result();
    }
    
    public function get_incomplete_defect_by_lot_partner($lot_id, $partner_id) {
        $pids = '"'.$partner_id.'"';
        $partner_ids = " trade_partner LIKE '%".$pids."%' ";
        $query = $this->db->query("SELECT count(*) as incomplete_count FROM defect_tbl WHERE status = 1 AND is_completed != 1 AND company_id = ".$this->company_id." AND $partner_ids AND lot_id = ".$lot_id);
        return $query->row();
    }
    
    public function get_diff_days_partner($lot_id, $partner_id) {
        $pids = '"'.$partner_id.'"';
        $partner_ids = " trade_partner LIKE '%".$pids."%' ";
        /*
        $query = $this->db->query("SELECT DATEDIFF(MAX(completion_date), MIN(created_date)) as diff_days_count , DATE_FORMAT(MIN(created_date),'%Y-%c-%d') as start_date, MAX(completion_date) as end_date FROM defect_tbl WHERE  status = 1  AND is_completed = 1 AND company_id = ".$this->company_id." AND $partner_ids AND lot_id =". $lot_id);
        */

        $query = $this->db->query("SELECT DATEDIFF(MAX(completion_date), MIN(created_date)) as diff_days_count , getWorkingday(DATE_FORMAT(MIN(created_date),'%Y-%c-%d'),
    MAX(completion_date),'weekend_days')  as weekend_days FROM defect_tbl WHERE  status = 1  AND is_completed = 1 AND company_id = ".$this->company_id." AND $partner_ids AND lot_id =". $lot_id);

        return $query->row();
    }
    
    public function get_defect_by_partner_partner($pid) {
        $pids = '"'.$pid.'"';
        $partner_id = " trade_partner LIKE '%".$pids."%' AND ";
	
        $query = $this->db->query("SELECT * FROM defect_tbl WHERE $partner_id status = 1 AND company_id = ".$this->company_id." GROUP BY tract_id");
        return $query->result();
    }
    
    public function get_defect_by_partner_by_tract($pid, $tract_id) {
        $pids = '"'.$pid.'"';
        $partner_id = " trade_partner LIKE '%".$pids."%' AND ";
	
        $query = $this->db->query("SELECT COUNT(*) as partner_tract_count, tract_id FROM defect_tbl WHERE $partner_id status = 1 AND tract_id = $tract_id AND company_id = ".$this->company_id);
        return $query->row();
    }
    
    public function get_defect_by_partner_number_of_lot_by_tract($pid, $tract_id) {
        $pids = '"'.$pid.'"';
        $partner_id = " trade_partner LIKE '%".$pids."%' AND ";
	
        $query = $this->db->query("SELECT COUNT(*) as partner_tract_count, tract_id FROM defect_tbl WHERE $partner_id status = 1 AND tract_id = $tract_id AND company_id = ".$this->company_id." GROUP BY lot_id");
        return $query->result();
    }
    
    public function get_total_defect_per_lot_partner($start_date, $end_date, $partner_id) {
        $pids = '"'.$partner_id.'"';
        $partner_ids = " trade_partner LIKE '%".$pids."%' ";
        $query = $this->db->query("SELECT COUNT(*) as partner_count, lot_id FROM defect_tbl WHERE status = 1 AND company_id = ".$this->company_id."  AND  DATE(created_date) BETWEEN '".$start_date."' AND '".$end_date."' AND $partner_ids GROUP BY lot_id");
        return $query->result();
    }
    
    public function get_total_days_complation_defect_per_lot_partner($partner_id) {
        $pids = '"'.$partner_id.'"';
        $partner_ids = " trade_partner LIKE '%".$pids."%' ";
        $query = $this->db->query("SELECT COUNT(*) as cnt, lot_id, DATEDIFF(MAX(completion_date), MIN(created_date)) as total_days, getWorkingday(DATE_FORMAT(MIN(created_date),'%Y-%c-%d'),
		MAX(completion_date),'weekend_days') as weekend_days FROM defect_tbl WHERE status = 1 AND company_id = $this->company_id AND $partner_ids AND is_completed = 1 AND lot_id NOT IN(SELECT lot_id FROM defect_tbl WHERE is_completed != 1 AND status = 1 AND company_id = $this->company_id AND $partner_ids) GROUP BY lot_id ORDER BY completion_date DESC LIMIT 20");
        return $query->result();
    }
    /*------------- End Analytics Partner -------------*/
    
    
//    public function get_complete_defect_($start_date, $end_date){
//        return $this->db->query("SELECT * FROM defect_tbl WHERE is_completed = 1 AND completion_date BETWEEN '".$start_date."' AND '".$end_date."' AND status = 1 AND company_id = $this->company_id GROUP BY lot_id")->result();
//    }
    
//    public function get_lot_check_complete_defect($lot_id){
//        return $this->db->query("SELECT * FROM defect_tbl WHERE lot_id = $lot_id AND is_completed != 1 AND status = 1 AND company_id = $this->company_id")->result();
//    }
    
     public function get_lot_check_complete_defect($partner_id, $lot_id){
        $pids = '"'.$partner_id.'"';
        $partner_ids = " trade_partner LIKE '%".$pids."%' AND";
        return $this->db->query("SELECT * FROM defect_tbl WHERE $partner_ids lot_id = $lot_id AND is_completed != 1 AND status = 1 AND company_id = $this->company_id")->result();
    }
    
    public function get_check_lot_partner($partner_id, $lot_id){
        $pids = '"'.$partner_id.'"';
        $partner_ids = " trade_partner LIKE '%".$pids."%' AND";
        return $this->db->query("SELECT id FROM defect_tbl WHERE $partner_ids status = 1 AND is_completed = 1 AND company_id = ".$this->company_id." AND lot_id =". $lot_id)->result();
    }
    
    public function get_min_max_complation_date($partner_id, $lot_id){
        $pids = '"'.$partner_id.'"';
        $partner_ids = " trade_partner LIKE '%".$pids."%' AND";
        return $this->db->query("SELECT DATEDIFF(MAX(completion_date), MIN(created_date)) as diff_days_count, getWorkingday(DATE_FORMAT(MIN(created_date),'%Y-%c-%d'),
		MAX(completion_date),'weekend_days') as weekend_days FROM defect_tbl WHERE $partner_ids status = 1 AND is_completed = 1 AND company_id = ".$this->company_id." AND lot_id =". $lot_id)->row();
    }
    
}

?>