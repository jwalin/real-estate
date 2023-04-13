<?php

class Search_defect extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $data['tracts_lots'] = $this->search_defect_model->get_tracts_lots();
        $data['partner'] = $this->trade_partner_model->get_trade_partner();
        $this->load->view('search_defect_list', $data);
        $this->load->view('include/footer_new.php');
    }

    public function search_result() {
        $filter = 'asc';
        if(isset($_GET['filter'])){
            $filter = $_GET['filter'];
        }
        $id = @$this->uri->segment(3);
        $ex = explode('-', $id);

        $cat_id = "";
        if (@$this->uri->segment(4)) {
            $cat_id = @$this->uri->segment(4);
        }
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $data['data_cat'] = $this->category_model->get_category();
        $data['data_record'] = $this->search_defect_model->get_search_defect_data($ex[0], $ex[1], @$ex[2], $cat_id);
       
        $record = array();
        foreach($data['data_record'] as $key => $value){
            $record[] = $value;
            $prtnr = json_decode($value->trade_partner);
            $pd = "";
            for ($p = 0; $p < count($prtnr); $p++) {
                    $getPrtnr = $this->search_defect_model->get_partner_by_id($prtnr[$p]);
                    $pd .= @$getPrtnr->partner_name.', ';
            }
            
            $record[$key]->partner_name = rtrim($pd, ', ');
        }
        foreach ($record as $key => $part) {
            $pname = explode(', ',$part->partner_name);
            $sort[$key]= ucfirst($part->partner_name);
        }
        if(count($record) > 0){
        if($filter != ''){
            if($filter=='asc'){
                array_multisort($sort, SORT_ASC, $record);
                $data['data'] = $record;
                $data['filter'] = 'asc';
                $data['filter_res'] = 'desc';
                
            }else if($filter == 'desc'){
                array_multisort($sort, SORT_DESC, $record);
                $data['data'] = $record;
                $data['filter'] = 'desc';
                $data['filter_res'] = 'asc';
            }else{
                $data['filter'] = 'asc';
                $data['filter_res'] = 'desc';
                $data['data'] = $data['data_record'];
            }
        }else{
            $data['filter'] = 'asc';
                $data['filter_res'] = 'desc';
            $data['data'] = $data['data_record'];
        }
    }else{
        $data['filter'] = 'asc';
                $data['filter_res'] = 'desc';
        $data['data'] = $data['data_record'];
    }
        

        
        //echo json_encode($record);exit;
        $export = $this->input->get('defect_export');
        if ($export) {
            $this->pdf_generate($data);
        }
        
        $this->load->view('search_result', $data);
        $this->load->view('include/footer_new.php');
    }
    public function export_pdf(){
        $filter = 'asc';
        if(isset($_GET['filter'])){
            $filter = $_GET['filter'];
        }
        $id = @$this->uri->segment(3);
        $ex = explode('-', $id);

        $cat_id = "";
        if (@$this->uri->segment(4)) {
            $cat_id = @$this->uri->segment(4);
        }
        $data['data_cat'] = $this->category_model->get_category();
        $data['data_record'] = $this->search_defect_model->get_search_defect_data($ex[0], $ex[1], @$ex[2], $cat_id);
        $record = array();
        foreach($data['data_record'] as $key => $value){
            $record[] = $value;
            $prtnr = json_decode($value->trade_partner);
            $pd = "";
            for ($p = 0; $p < count($prtnr); $p++) {
                    $getPrtnr = $this->search_defect_model->get_partner_by_id($prtnr[$p]);
                    $pd .= @$getPrtnr->partner_name.', ';
            }
            
            $record[$key]->partner_name = rtrim($pd, ', ');
        }
        $finalRecord = array();
        foreach ($record as $key => $part) {
            
            if($part->partner_name != ''){
              
            $pname = explode(', ',$part->partner_name);
            foreach($pname as $p){
                if($p!=''){
                    $getLableCode ='';
                   $getPartner = $this->db->query("select id from trade_partner_tbl where partner_name='".$p."'")->row();
                    $getLableCode = $this->db->query("SELECT * FROM `label_tbl` where id= (SELECT label FROM `label_association_tbl` where status = 1 and company_id = '".$part->company_id."' and category_id = (SELECT category_id FROM `tracts_category_partner_associations_tbl` where tract_id = '".$part->tract_id."' and status=1 and partner_id = (select id from trade_partner_tbl where partner_name='".$p."') limit 1))")->row();
                    //echo $this->db->last_query().'<br/><br/></hr>';
                    // $getLableCode->color_code
                    
                    if(!empty($getLableCode)){
                        $part->labelColor = $getLableCode->color_code;
                    }else{
                        $part->labelColor = '';
                    }
                    $part->partner_id =  $getPartner->id;
                  //  $part->labelColor = '';
                    $part->labelQuery = $this->db->last_query();
                    //  echo $p.'<br/>';
                    if(array_key_exists(ucfirst($p),$finalRecord)){
                        $finalRecord[ucfirst($p)][] = $part;
                    }else{
                        $finalRecord[ucfirst($p)][] = $part;
                    }
                }else{
                    $part->labelColor = '';
                    $finalRecord[''][] = $part;
                }
               
            }
        }else{
            $part->labelColor = '';
            $finalRecord[''][] = $part;
        }
            
            $sort[$key]= ucfirst($part->partner_name);
        }
        ksort($finalRecord);
        $data['data'] = $finalRecord;

        //  echo json_encode($finalRecord); 
        // exit;
        $this->pdf_generate_new($data);
    }

    public function search_result_partner() {
        $id = @$this->uri->segment(3);
        $tract_id = "";
        $data['data_lot'] = "";
        if (@$this->uri->segment(4)) {
            $tract_id = @$this->uri->segment(4);
            $data['data_lot'] = $this->home_model->get_lots_by_tract_id(@$this->uri->segment(4));
        }

        $lot_id = "";
        if (@$this->uri->segment(5)) {
            $lot_id = @$this->uri->segment(5);
        }
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $data['data_tract'] = $this->tracts_model->get_tracts();
        $data['data'] = $this->search_defect_model->get_search_defect_data_partner($id, $tract_id, $lot_id);
        
        $export = $this->input->get('defect_export');
        if ($export) {
            $this->pdf_generate_partner($data);
        }
        // echo json_encode($data); exit;
        $this->load->view('search_result_partner', $data);
        $this->load->view('include/footer_new.php');
    }

    public function search_tract_lot_detail() {
        $tract_lot = $this->input->post('tract_lot');
        $ex = explode('/', $tract_lot);
        $tract_check = $this->search_defect_model->check_tract_id_data($ex[0]);
        $lot_check = $this->search_defect_model->check_lot_id_data($ex[1]);

        if ($tract_check != "" && $lot_check != "") {
            $tact_lot = $tract_check->id . '-' . $lot_check->id;
            redirect('search_defect/search_result/' . $tact_lot);
        } else {
            $this->session->set_flashdata('error', 'Your tract/lot not exists.');
            redirect('search_defect');
        }
    }

    public function get_lots_by_tract_id() {
        $tract_id = $this->input->post('tract_id');
        $get_lots = $this->home_model->get_lots_by_tract_id($tract_id);
        if (!empty($get_lots)) {
            ?>
            <option value="">All Lot</option>
            <?php foreach ($get_lots as $row_lots) {
                ?>
                <option value="<?= $row_lots->id; ?>"><?= $row_lots->lot_no; ?></option>
                <?php
            }
        } else {
            echo '<option value="">All Lot</option>';
        }
    }
    public function pdf_generate_new($data) {
        $html = $this->load->view('defect_pdf_new', $data, true);
        // echo $html; exit;
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->SetTitle('Defect PDF');
        $pdfFilePath = time() . "_pdf.pdf";
        $this->m_pdf->pdf->WriteHTML($html);
//        $this->m_pdf->pdf->Output();
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }
    public function pdf_generate($data) {
        $html = $this->load->view('defect_pdf', $data, true);
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->SetTitle('Defect PDF');
        $pdfFilePath = time() . "_pdf.pdf";
        $this->m_pdf->pdf->WriteHTML($html);
//        $this->m_pdf->pdf->Output();
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }
    
    public function pdf_generate_partner($data) {
        $html = $this->load->view('defect_pdf_partner', $data, true);
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->SetTitle('Defect PDF');
        $pdfFilePath = time() . "_pdf.pdf";
        $this->m_pdf->pdf->WriteHTML($html);
//        $this->m_pdf->pdf->Output();
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

}
?>