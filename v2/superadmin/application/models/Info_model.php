<?php
class Info_model extends CI_Model {

    public function date_format($date) {
        return date('M j, Y', strtotime($date));
    }
    
    public function created_date() {
        return date('Y-m-d H:i:s');
    }
    
}
?>