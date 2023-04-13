<?php
class Analytics extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        
        $settings_analytics = $this->graph_model->get_settings_analytics();
        $time = "-30 day";
        if($settings_analytics->time_period == 1){
            $time = "-30 day";
        }else if($settings_analytics->time_period == 2){
            $time = "-60 day";
        }else if($settings_analytics->time_period == 3){
            $time = "-90 day";
        }else if($settings_analytics->time_period == 4){
            $time = "-180 day";
        }else if($settings_analytics->time_period == 5){
            $time = "-365 day";
        }
        $format = 'Y-m-d';
        $date = date($format);
        $start_date = date($format, strtotime($time . $date));
        $end_date = date("Y-m-d");
        $data['tracts'] = $this->tracts_model->get_tracts();
        $data['trade_partner'] = $this->trade_partner_model->get_trade_partner();
        if($this->session->userdata('type') != 4){
        /*------------------------------------Default start------------------------------------------*/
        /*-------------------------------------------------------------------------------------------*/
        $defect_count = $this->graph_model->get_defect_count($start_date, $end_date);
        $lot_count = $this->graph_model->get_lot_count($start_date, $end_date);
        $dcount = 0;
        $lcount = 0;
        $dcount = $defect_count->defect_count;
        $lcount = count($lot_count);
        if($dcount == 0 || $lcount == 0){
            $avgdd = 0;
        }else{
            $avgdd = $dcount / $lcount; 
        }
        $data['avg_defect_count_per_lot'] = round($avgdd, 2);
        /*-------------------------------------------------------------------------------------------*/
        $complete_defect = $this->graph_model->get_complete_defect($start_date, $end_date);
        $lotcount = 0;
        $dayscount = 0;
        foreach ($complete_defect as $complete_defect){
            $lot_defect = $this->graph_model->get_incomplete_defect_by_lot($complete_defect->lot_id);
            $incomplete_count = $lot_defect->incomplete_count;
            if($incomplete_count == 0){
                $diff_days = $this->graph_model->get_diff_days($complete_defect->lot_id);
                $dayscount = $dayscount + ( $diff_days->diff_days_count - $diff_days->weekend_days ) + 1;
                $lotcount++;
            }
        }
        if($dayscount == 0){
            $avg_days_list_completion = 0;
        }
        else{
            $avg_days_list_completion = $dayscount / $lotcount;
        }
        $data['avg_days_list_completion_count'] = round($avg_days_list_completion, 2);
        /*-------------------------------------------------------------------------------------------*/
		
			$c_graph = [];
            $get_category = $this->graph_model->get_category();
            foreach ($get_category as $category) {
                $category_defect = $this->graph_model->get_defect_by_category($category->id);
                if ($category_defect->category_defct_count != 0) {
                    $category_lot = $category_defect->category_defct_count / $lcount;
                    // $c_graph .= "['" . $category->category_name . "', " . $category_lot . "],";
                    $c_graph[$category->category_name] =  $category_lot ;
                }
            }

            if(!empty($c_graph)) {
                arsort($c_graph);
            }

            $data['category_defect_graph'] = generateStringFromArray($c_graph);
		
        /*-------------------------------------------------------------------------------------------*/
        // $p_graph = "";
        $p_graph = [];
        $get_partner = $this->graph_model->get_partner();
        foreach ($get_partner as $partner){
            $partner_defect = $this->graph_model->get_defect_by_partner($partner->id);
            if($partner_defect->partner_defct_count != 0){
                $partner_lot = $partner_defect->partner_defct_count / $lcount;
                
//                $datas[] = array(
//                    'count' => $partner_lot,
//                    'partner_name' => $partner->partner_name,
//                );
                
                // $p_graph .= "['".$partner->partner_name."', ".$partner_lot."],";
                $p_graph[$partner->partner_name] = $partner_lot ;
            }
        }     

        if(!empty($p_graph)) {
            arsort($p_graph);
        }
        
        //  $p_graph=ksort($p_graph, 1);
       // var_dump($p_graph);
      //  $p_graph = $this->msort($p_graph, array('count'));
      //  var_dump($p_graph);
//        print_r($datas);exit; 
        // $data['partner_defect_graph'] = $p_graph;
        $data['partner_defect_graph'] = generateStringFromArray($p_graph);
        /*-------------------------------------------------------------------------------------------*/
        /*------------------------------------Default End------------------------------------------*/
        /*------------------------------------Tract start------------------------------------------*/
        if($this->input->get('tract_id')){
            $tract_id = $this->input->get('tract_id');
        }else{
            $tract_id = $data['tracts'][0]->id;
        }
        /*-------------------------------------------------------------------------------------------*/
        $defect_count_tract = $this->graph_model->get_defect_count_tract($start_date, $end_date, $tract_id);
        $lot_count_tract = $this->graph_model->get_lot_count_tract($start_date, $end_date, $tract_id);
        $dcount_tract = 0;
        $lcount_tract = 0;
        $dcount_tract = $defect_count_tract->defect_count;
        $lcount_tract = count($lot_count_tract);
        if($dcount_tract == 0 && $lcount_tract == 0){
            $avg_defect_tract = 0;
        }
        else{
            $avg_defect_tract = $dcount_tract / $lcount_tract;
        }
        $data['avg_defect_count_per_lot_tract'] = round($avg_defect_tract, 2);
        /*-------------------------------------------------------------------------------------------*/
        $complete_defect_tract = $this->graph_model->get_complete_defect_tract($start_date, $end_date, $tract_id);
        $lotcount_tract = 0;
        $dayscount_tract = 0;
        foreach ($complete_defect_tract as $complete_defect_tract){
            $lot_defect_tract = $this->graph_model->get_incomplete_defect_by_lot_tract($complete_defect_tract->lot_id, $tract_id);
            $incomplete_count_tract = $lot_defect_tract->incomplete_count;
            if($incomplete_count_tract == 0){
                $diff_days_tract = $this->graph_model->get_diff_days_tract($complete_defect_tract->lot_id, $tract_id);
                $dayscount_tract = $dayscount_tract + ( $diff_days_tract->diff_days_count - $diff_days_tract->weekend_days ) + 1;
                $lotcount_tract++;
            }
        }
        if($dayscount_tract == 0 && $lotcount_tract == 0){
            $avg_defect_tract_complation = 0;
        }
        else{
            $avg_defect_tract_complation = $dayscount_tract / $lotcount_tract;
        }
        $data['avg_days_list_completion_count_tract'] = round($avg_defect_tract_complation, 2);
        /*-------------------------------------------------------------------------------------------*/
        // $p_graph_tract = "";
        $p_graph_tract = [];
        $get_partner_tract = $this->graph_model->get_partner();
        foreach ($get_partner_tract as $partner_tract){
            $partner_defect_tract = $this->graph_model->get_defect_by_partner_tract($partner_tract->id, $tract_id);
            if($partner_defect_tract->partner_defct_count != 0){
                $partner_lot_tract = $partner_defect_tract->partner_defct_count / $lcount_tract;
                // $p_graph_tract .= "['".$partner_tract->partner_name."', ".$partner_lot_tract."],";
                $p_graph_tract[$partner_tract->partner_name] = $partner_lot_tract ;
            }
        }

        if(!empty($p_graph_tract)) {
            arsort($p_graph_tract);
        }

        // $data['partner_defect_graph_tract'] = $p_graph_tract;
        $data['partner_defect_graph_tract'] = generateStringFromArray($p_graph_tract);
        /*-------------------------------------------------------------------------------------------*/
        // $tracts_datas = "";
        $tracts_datas = [];
        $tract_count_lot = $this->graph_model->get_total_defect_per_lot($start_date, $end_date, $tract_id);
        foreach($tract_count_lot as $tract_count_lot){
            if($tract_count_lot->tract_count != 0){
                $lot_name = $this->graph_model->get_lot_name($tract_count_lot->lot_id);
                // $tracts_datas .= "['".$lot_name->lot_no."', ".$tract_count_lot->tract_count."],";
                $tracts_datas[$lot_name->lot_no] = $tract_count_lot->tract_count;
            }
        }

//        if(!empty($tracts_datas)) {
//            arsort($tracts_datas);
//        }
        
        // $data['total_defect_per_lot_graph'] = $tracts_datas;
        $data['total_defect_per_lot_graph'] = generateStringFromArray($tracts_datas);


        /*-------------------------------------------------------------------------------------------*/
        //$totat_days_tract = "";
        $totat_days_tract = [];
        $tract_count_total_days = $this->graph_model->get_total_days_complation_defect_per_lot($tract_id);
        foreach($tract_count_total_days as $tract_count_total_days){
//            if($tract_count_total_days->total_days != 0){
                $lot_name = $this->graph_model->get_lot_name($tract_count_total_days->lot_id);
                //$totat_days_tract .= "['".$lot_name->lot_no."', ".$tract_count_total_days->total_days."],";

                $totat_days_tract[$lot_name->lot_no] = ( $tract_count_total_days->total_days - $tract_count_total_days->weekend_days ) + 1;
//            }
        }

//        if(!empty($totat_days_tract)) {
//            arsort($totat_days_tract);
//        }

        // $data['total_days_complation_graph'] = $totat_days_tract;
        $data['total_days_complation_graph'] = generateStringFromArray($totat_days_tract);
        /*-------------------------------------------------------------------------------------------*/
        /*------------------------------------Tract End------------------------------------------*/
        }
        /*------------------------------------Partner Start------------------------------------------*/
        if($this->input->get('partner_id')){
            $partner_id = $this->input->get('partner_id');
        }else{
            if ($this->session->userdata('type') == 4){
                $partner_id = $this->session->userdata('partner_id');
            }else{
                $partner_id = $data['trade_partner'][0]->id;
            }
        }
        /*-------------------------------------------------------------------------------------------*/
        $defect_count_partner = $this->graph_model->get_defect_count_partner($start_date, $end_date, $partner_id);
        $lot_count_partner = $this->graph_model->get_lot_count_partner($start_date, $end_date, $partner_id);
        $dcount_partner = 0;
        $lcount_partner = 0;
        $dcount_partner = $defect_count_partner->defect_count;
        $lcount_partner = count($lot_count_partner);
        if($dcount_partner == 0 && $lcount_partner == 0){
            $avg_defect_partner = 0;
        }
        else{
            $avg_defect_partner = $dcount_partner / $lcount_partner;
        }
        $data['avg_defect_count_per_lot_partner'] = round($avg_defect_partner, 2);
        /*-------------------------------------------------------------------------------------------*/
        $complete_defect_partner = $this->graph_model->get_complete_defect_partner($start_date, $end_date, $partner_id);

        // echo $this->db->last_query();
        // exit;
        $lotcount_partner = 0;
        $dayscount_partner = 0;
        foreach ($complete_defect_partner as $complete_defect_partner){
            $lot_defect_partner = $this->graph_model->get_incomplete_defect_by_lot_partner($complete_defect_partner->lot_id, $partner_id);

            
            $incomplete_count_partner = $lot_defect_partner->incomplete_count;
            if($incomplete_count_partner == 0){
                $diff_days_partner = $this->graph_model->get_diff_days_partner($complete_defect_partner->lot_id, $partner_id);

            
                $dayscount_partner = $dayscount_partner + ( $diff_days_partner->diff_days_count - $diff_days_partner->weekend_days ) + 1 ;
                $lotcount_partner++;
            }
        }
        
        if($dayscount_partner == 0 && $lotcount_partner == 0){
            $avg_defect_partner_complation = 0;
        } else{
            $avg_defect_partner_complation = $dayscount_partner / $lotcount_partner;
        }

        $data['avg_days_list_completion_count_partner'] = round($avg_defect_partner_complation, 2);
        /*-------------------------------------------------------------------------------------------*/
        $partner_defect_partner = $this->graph_model->get_defect_by_partner_partner($partner_id);
       // $p_graph_partner = "";
        $p_graph_partner = [];
        foreach ($partner_defect_partner as $partner_defect_partner){
            $p_data = $this->graph_model->get_defect_by_partner_by_tract($partner_id, $partner_defect_partner->tract_id);
            if($p_data->partner_tract_count != 0){
                $p_data_number_of_lot = $this->graph_model->get_defect_by_partner_number_of_lot_by_tract($partner_id, $partner_defect_partner->tract_id);
                if(count($p_data_number_of_lot) != 0){
                    $avg_partner_tract_count = $p_data->partner_tract_count / count($p_data_number_of_lot);
                    $tract_name = $this->graph_model->get_tract_name($p_data->tract_id);
                   // $p_graph_partner .= "['".$tract_name->tract_no."', ".$avg_partner_tract_count."],";

                    $p_graph_partner[$tract_name->tract_no] = $avg_partner_tract_count;
                }
            }
        }

        if(!empty($p_graph_partner)) {
            arsort($p_graph_partner);
        }

        // $data['partner_defect_graph_partner'] = $p_graph_partner;
        $data['partner_defect_graph_partner'] = generateStringFromArray($p_graph_partner);


        /*-------------------------------------------------------------------------------------------*/
        $partners_datas = [];
        $partner_count_lot = $this->graph_model->get_total_defect_per_lot_partner($start_date, $end_date, $partner_id);
        foreach($partner_count_lot as $partner_count_lot){
            if($partner_count_lot->partner_count != 0){
                $lot_name = $this->graph_model->get_lot_name($partner_count_lot->lot_id);
                // $partners_datas .= "['".$lot_name->lot_no."', ".$partner_count_lot->partner_count."],";
                $partners_datas[$lot_name->lot_no] = $partner_count_lot->partner_count;
            }
        }

//        if(!empty($partners_datas)) {
//            arsort($partners_datas);
//        }

        $data['total_defect_per_lot_graph_partner'] = generateStringFromArray($partners_datas);
        /*-------------------------------------------------------------------------------------------*/
        $totat_days_partner = [];
        $partner_count_total_days = $this->graph_model->get_total_days_complation_defect_per_lot_partner($partner_id);
        foreach($partner_count_total_days as $partner_count_total_days){
//            if($partner_count_total_days->total_days != 0){
                $lot_name = $this->graph_model->get_lot_name($partner_count_total_days->lot_id);
                // $totat_days_partner .= "['".$lot_name->lot_no."', ".$partner_count_total_days->total_days."],";
                $totat_days_partner[$lot_name->lot_no] = ( $partner_count_total_days->total_days - $partner_count_total_days->weekend_days ) + 1;
//            }
        }

//        if(!empty($totat_days_partner)) {
//            arsort($totat_days_partner);
//        }

        $data['total_days_complation_graph_partner'] = generateStringFromArray($totat_days_partner);
        /*-------------------------------------------------------------------------------------------*/
        /*-------------------------------------------------------------------------------------------*/
        $get_complete_defect = $this->graph_model->get_complete_defect($start_date, $end_date);
        $completed_lot_no = array();
        foreach ($get_complete_defect as $complete_defect){
//            $lot_comp_defect = $this->graph_model->get_lot_check_complete_defect($complete_defect->lot_id);
//            if(count($lot_comp_defect) == 0){
                $completed_lot_no[] = $complete_defect->lot_id;
//            }
        }
        $lot_complation_graph = [];        
        $get_partners = $this->trade_partner_model->get_trade_partner();
        foreach ($get_partners as $get_partner){
            $partner_lot = 0;
            $partner_complation_diff = 0;
            for($p=0; $p<count($completed_lot_no); $p++){
                $get_check_lot_partner = $this->graph_model->get_check_lot_partner($get_partner->id, $completed_lot_no[$p]);
                if(count($get_check_lot_partner) > 0){
                    $lot_comp_defect = $this->graph_model->get_lot_check_complete_defect($get_partner->id, $completed_lot_no[$p]);
                    if(count($lot_comp_defect) == 0){
                        $get_min_max_complation_date = $this->graph_model->get_min_max_complation_date($get_partner->id, $completed_lot_no[$p]);
                        $partner_lot++;
                        $partner_complation_diff = $partner_complation_diff + ( $get_min_max_complation_date->diff_days_count - $get_min_max_complation_date->weekend_days ) + 1;
                    }
                }
            }
            if($partner_lot > 0){
                $partner_complation_diff_per = $partner_complation_diff / $partner_lot;
                if($partner_complation_diff_per != 0){
                    //$lot_complation_graph .= "['".$get_partner->partner_name."', ".$partner_complation_diff_per."],";

                    $lot_complation_graph[$get_partner->partner_name] = $partner_complation_diff_per ;
                }
            }
        }

        if(!empty($lot_complation_graph)) {
            arsort($lot_complation_graph);
        }

        $data['lot_complation_graph'] = generateStringFromArray($lot_complation_graph);

     
        // echo '<pre>';
        // print_r($lot_complation_graph);
        // print_r($partner_defect_graph_tract);
        // print_r($data['lot_complation_graph'] );
        // print_r($data['partner_defect_graph_tract'] );


        // print_r($data);
        // exit;
        /*-------------------------------------------------------------------------------------------*/
        
        $data['tracts'] = $this->tracts_model->get_tracts();
        $data['trade_partner'] = $this->trade_partner_model->get_trade_partner();
        $this->load->view('analytics', $data);
        $this->load->view('include/footer_new.php');
    }
   public function msort($array, $key, $sort_flags = SORT_DESC) {
    if (is_array($array) && count($array) > 0) {
        if (!empty($key)) {
            echo $key;
            $mapping = array();
            foreach ($array as $k => $v) {
                $sort_key = '';
                if (!is_array($key)) {
                    $sort_key = $v[$key];
                } else {
                    // @TODO This should be fixed, now it will be sorted as string
                    foreach ($key as $key_key) {
                        $sort_key .= $v[$key_key];
                    }
                    $sort_flags = SORT_STRING;
                }
                $mapping[$k] = $sort_key;
            }
            asort($mapping, $sort_flags);
            $sorted = array();
            foreach ($mapping as $k => $v) {
                $sorted[] = $array[$k];
            }
            return $sorted;
        }
    }
    return $array;
}



}


?>