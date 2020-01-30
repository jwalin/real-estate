<?php

class dashboard_models extends CI_Model {

//    function order_graph($i, $id) {
//        $query = $this->db->query("SELECT COUNT(*) AS order_count FROM `order_tbl` WHERE YEAR(order_date) = '" . date("Y") . "' AND MONTH(order_date) =" . $i . " AND restaurant_id =" . $id . " and order_status != 3");
//        return $query->row();
//    }

    function user_count() {

        $query = $this->db->query("SELECT COUNT(*) AS user_count FROM tbl_user");
        return $query->row();
    }

  

    

}

?>