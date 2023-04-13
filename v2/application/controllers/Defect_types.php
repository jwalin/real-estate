<?php

class Defect_types extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('excel');
    }

    public function index() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data'] = $this->defect_types_model->get_defect_types();
        $this->load->view('defect_types', $data);
        $this->load->view('include/footer_new');
    }

    public function add() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data_location'] = $this->defect_location_model->get_defect_location();
        $data['data_category'] = $this->category_model->get_category();
        $this->load->view('defect_types_add', $data);
        $this->load->view('include/footer_new');
    }

    public function edit($id) {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data'] = $this->defect_types_model->get_defect_type_by_id($id);
        $data['data_location'] = $this->defect_location_model->get_defect_location();
        $data['data_category'] = $this->category_model->get_category();
        $this->load->view('defect_types_edit', $data);
        $this->load->view('include/footer_new');
    }

    public function insert() {
        $url = base64_decode(@$this->input->post('url'));
        $data = array(
            'company_id' => $this->company_id,
            'defect_type' => $this->input->post('defect_type'),
            'category_id' => $this->input->post('category_id'),
            'closing_hold' => $this->input->post('closing_hold'),
            'defect_location_ids' => $this->input->post('location'),
//            'defect_location_ids' =>  implode(',', $this->input->post('location')),
            'created_by' => $this->sess_id,
            'created_date' => $this->current_date()
        );
        $res = $this->defect_types_model->insert($data);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_ADDED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        if($url != ""){
            redirect($url);
        }else{
            redirect('defect_types/');
        }
    }

    public function update() {
        $id = $this->input->post('id');
        $data = array(
            'company_id' => $this->company_id,
            'defect_type' => $this->input->post('defect_type'),
            'category_id' => $this->input->post('category_id'),
            'closing_hold' => $this->input->post('closing_hold'),
            'defect_location_ids' => $this->input->post('location'),
//            'defect_location_ids' =>  implode(',', $this->input->post('location')),
            'updated_by' => $this->sess_id,
            'updated_date' => $this->current_date()
        );
        $res = $this->defect_types_model->update($data, $id);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_UPDATED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('defect_types/');
    }

    public function delete($id) {
        $res = $this->defect_types_model->delete($id);
        if ($res) {
            $this->history_request($id);
            $this->session->set_flashdata('success', RECORD_DELETED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('defect_types/');
    }

    public function excel_import() {
        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();

                for ($row = 2; $row <= $highestRow; $row++) {
                    $location = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $trade_cat = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $defect_type = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $closing_hold = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $closing_hold = trim($closing_hold);
                    if ($closing_hold == "Yes" || $closing_hold == "yes" || $closing_hold == "YES") {
                        $ch = 1;
                    } else {
                        $ch = 2;
                    }
                    $c_id = "";
                    $l_id = "";
                    if ($trade_cat != "") {
                        $category_data = $this->defect_types_model->get_trade_category_id($trade_cat);
                        if ($category_data->id != "") {
                            $c_id = $category_data->id;
                        } else {
                            $datac = array(
                                'company_id' => $this->company_id,
                                'category_name' => $trade_cat,
                                'created_by' => $this->sess_id,
                                'created_date' => $this->current_date()
                            );
                            $this->category_model->insert($datac);
                            $c_id = $this->db->insert_id();
                        }
                    }
                    if ($location != "") {
                        $location_data = $this->defect_types_model->get_defect_location_id($location);
                        if ($location_data->id != "") {
                            $l_id = $location_data->id;
                        } else {
                            $datal = array(
                                'company_id' => $this->company_id,
                                'defect_location' => $location,
                                'category_ids' => $c_id,
                                'created_by' => $this->sess_id,
                                'created_date' => $this->current_date()
                            );
                            $this->defect_location_model->insert($datal);
                            $l_id = $this->db->insert_id();
                        }
                    }
                    if ($l_id != "" && $c_id != "") {
                        if($defect_type != ""){
                            $defect_type = str_replace("&nbsp;", '', $defect_type);
                            $in_sys = 1;
                            $datas = $this->db->query('SELECT * FROM `defect_type_tbl` WHERE defect_type = "'.$defect_type.'" AND defect_location_ids = '.$l_id.' AND category_id = '.$c_id.' AND company_id = '.$this->company_id.' AND created_by = '.$this->sess_id)->row();
                            if($datas->id == ""){
                                $data = array(
                                    'company_id' => $this->company_id,
                                    'category_id' => $c_id,
                                    'defect_location_ids' => $l_id,
                                    'defect_type' => $defect_type,
                                    'closing_hold' => $ch,
                                    'created_by' => $this->sess_id,
                                    'created_date' => $this->current_date()
                                );
                                $this->defect_types_model->insert($data);
                            }
                        }else{
                            $in_sys = 2;
                        }
                    }
                }
            }
            if($in_sys == 1){
                $this->session->set_flashdata('success', RECORD_IMPORTED);
            }else{
                $this->session->set_flashdata('error', 'Please fill the defect type field.');
            }
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('defect_types/');
    }
    
    public function excel_export() {
        $data = $this->defect_location_model->get_defect_location();
        
        $filename = "Template";
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(14);

//         $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:D1');
//        $objPHPExcel->setActiveSheetIndex(0)
//                ->setCellValue('A1', 'NOTE: To add more than one Defect Type for any given Location-Trade Category simply insert a new row below, copy/paste the Location and Trade Category in the new row, then fill in the additional Defect Type and Priority Level.');
//         
//        $objPHPExcel->getActiveSheet()
//    ->getStyle('A1:A1')
//    ->getAlignment()
//    ->setWrapText(true);
        
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Location')
                ->setCellValue('B1', 'Trade Category')
                ->setCellValue('C1', 'Defect Type')
                ->setCellValue('D1', 'Closing Hold?');

        $i = 2;
        $j = 1;
        foreach ($data as $row) {
            $cats = $this->db->query('SELECT * FROM `trade_category_tbl` WHERE id IN ('.$row->category_ids.') ORDER BY category_name ASC')->result();
//            $cats = $this->db->query('SELECT * FROM `trade_category_tbl` WHERE id IN ('.$row->category_ids.') AND company_id = '.$this->company_id.' AND created_by = '.$this->sess_id.' ORDER BY category_name ASC')->result();
            
            foreach ($cats as $cat) {
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $row->defect_location)
                    ->setCellValue('B' . $i, $cat->category_name)
                    ->setCellValue('C' . $i, '')
                    ->setCellValue('D' . $i, '');
            $i++;
            $j++;
        }
        }
        for ($col = 'A'; $col <= 'Z'; $col++) {
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }
        
        $styleArray = array(
            'font' => array(
                'bold' => true,
                'size' => 15,
                'color' => array('rgb' => '000000')
        ));

        $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($styleArray);
//
//        $objPHPExcel->getActiveSheet()
//                ->getStyle('A1:M1')
//                ->getFill()
//                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
//                ->getStartColor()
//                ->setRGB('ffffff');
        
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;Filename=$filename.xlsx");
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');//Excel5 for xls and Excel2007 for xlsx
        $objWriter->save('php://output');
        exit;
    }

}

?>