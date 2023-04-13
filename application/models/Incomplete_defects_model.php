<?php
class Incomplete_defects_model extends CI_Model {

    public function get_incomplete_defects_data($id){
		$partner_id = "";
		if($this->session->userdata('type') == 4){
			$pid = $this->session->userdata('partner_id');
			$pids = '"'.$pid.'"';
			$partner_id = " d.trade_partner LIKE '%".$pids."%' AND ";
		}
		
        $tract_query = "";
        if($id != ""){
            $tract_query = " AND d.tract_id = $id";
        }
        return $this->db->query("SELECT COUNT(d.id) as defect_count, d.tract_id, d.lot_id, t.tract_no, l.lot_no FROM defect_tbl as d LEFT JOIN tracts_tbl as t ON d.tract_id = t.id LEFT JOIN lots_tbl as l ON d.lot_id = l.id WHERE $partner_id d.is_completed != 1 AND d.status = 1 AND d.company_id = $this->company_id $tract_query GROUP BY d.lot_id")->result();
    }
    
    public function defect_status_change($id, $status) {
		if($status == 1){
			$this->db->set('completion_date', date('Y-m-d'));
		}
        $this->db->set('is_completed', $status);
        $this->db->where('id', $id);
        return $this->db->update('defect_tbl');
    }
    
}
?>