<?php

class Lots extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('excel');
    }

    public function index() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data'] = $this->lots_model->get_lots();
        $this->load->view('lots', $data);
        $this->load->view('include/footer_new');
    }

    public function add() {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data_tract'] = $this->tracts_model->get_tracts();
        $this->load->view('lots_add', $data);
        $this->load->view('include/footer_new');
    }

    public function edit($id) {
        $this->load->view('include/header_new');
        $this->load->view('include/sidebar_new');
        $data['data_tract'] = $this->tracts_model->get_tracts();
        $data['data'] = $this->lots_model->get_lots_by_id($id);
        $this->load->view('lots_edit', $data);
        $this->load->view('include/footer_new');
    }

    public function insert() {
        $data = array(
            'company_id' => $this->company_id,
            'tract_id' => $this->input->post('tract_id'),
            'lot_no' => $this->input->post('lot_no'),
            'created_by' => $this->sess_id,
            'created_date' => $this->current_date()
        );
        $res = $this->lots_model->insert($data);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_ADDED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('lots/');
    }

    public function update() {
        $id = $this->input->post('id');
        $data = array(
            'company_id' => $this->company_id,
            'tract_id' => $this->input->post('tract_id'),
            'lot_no' => $this->input->post('lot_no'),
            'updated_by' => $this->sess_id,
            'updated_date' => $this->current_date()
        );
        $res = $this->lots_model->update($data, $id);
        if ($res) {
            $this->history_request();
            $this->session->set_flashdata('success', RECORD_UPDATED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('lots/');
    }

    public function delete($id) {
        $res = $this->lots_model->delete($id);
        if ($res) {
            $this->history_request($id);
            $this->session->set_flashdata('success', RECORD_DELETED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('lots/');
    }

    public function excel_import() {
        //$fileExt = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 1; $row <= $highestRow; $row++) {
                    $tract_no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $lot_no = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $tract_ids = $this->lots_model->get_tract_id($tract_no);
                    if(@$tract_ids->id != ""){
                        $in_systen = 0;
                        $lot_ids = $this->lots_model->get_tract_lot_data(@$tract_ids->id, $lot_no);
                        if(empty($lot_ids)){
                            $in_systen = 1;
                            $data = array(
                                'company_id' => $this->company_id,
                                'tract_id' => @$tract_ids->id,
                                'lot_no' => $lot_no,
                                'created_by' => $this->sess_id,
                                'created_date' => $this->current_date()
                            );
                            $res = $this->lots_model->insert_batch($data);
                        }
                        else{
                            $in_systen = 2;
                        }
                    }else{
                        $in_systen = 3;
                    }
                }
            }
            if ($in_systen == 3) {
                $this->session->set_flashdata('error', 'Tract no not exists.');
            } elseif ($in_systen == 2) {
                $this->session->set_flashdata('error', 'Tract no and lot already exists.');
            }else{
                $this->session->set_flashdata('success', RECORD_IMPORTED);
            }
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect('lots/');
    }

}

?>
	