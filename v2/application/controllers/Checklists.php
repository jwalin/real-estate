<?php

class Checklists extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Checklists_model');
    }

    public function index() {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $data['data'] = $this->tracts_model->get_tracts();
        $this->load->view('checklists', $data);
        $this->load->view('include/footer_new.php');
    }

    public function checklists_step_1() {
        $tract = $this->input->post('tract_id');
        $lot = $this->input->post('lot_id');
        redirect('Checklists/checklists_dashboard/' . $tract . '/' . $lot);
    }

    public function checklists_dashboard($uri1, $uri2) {
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $data['val'] = $this->Checklists_model->getData();
        $data['loc_checked'] = $this->Checklists_model->getData_checked($uri1, $uri2);
        // echo $this->db->last_query();exit;
        // print_r($data['loc_checked']);exit;
        $locids = '';
        foreach ($data['loc_checked'] as $loc) {
            $locids .= $loc->id . ',';
        }
        $locids = rtrim($locids, ',');
        // print_r($locids);exit;
        if ($locids) {
            $data['defect_count'] = $this->Checklists_model->getDefectCount($uri1, $uri2, $locids);
            $data['incomplete_defect_count'] = $this->Checklists_model->getIncompleteDefectCount($uri1, $uri2, $locids);
        } else {
            $data['defect_count'] = '';
            $data['incomplete_defect_count'] = '';
        }
        // print_r($data);exit;
        $this->load->view('checklists_dashboard', $data);
        $this->load->view('include/footer_new.php');
    }

    public function trade_categories($uri1, $uri2, $uri3) {
        $data['data_category'] = $this->category_model->get_category();
        $data['data'] = $this->defect_location_model->get_defect_location_by_id($uri3);
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $this->load->view('checklists_location', $data);
        $this->load->view('include/footer_new.php');
    }
    
    public function location_category_checklist($uri1, $uri2, $uri3, $uri4) {
        $data['data_loc'] = $this->defect_location_model->get_defect_location_by_id($uri3);
        $data['data_cat'] = $this->category_model->get_category_by_id($uri4);
        $data['data'] = $this->Checklists_model->get_location_category_defect_type($uri4, $uri3);
        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $this->load->view('checklists_location_category', $data);
        $this->load->view('include/footer_new.php');
    }

    public function checklist_defects($uri1, $uri2, $uri3, $uri4, $uri5) {
        $data['defect_type'] = $this->defect_types_model->get_defect_type_by_id($uri5);
        $data['data'] = $this->defect_location_model->get_defect_location_by_id($uri3);
        $data['val'] = $this->category_model->get_category_by_id($uri4);

        $this->load->view('include/header_new.php');
        $this->load->view('include/sidebar_new.php');
        $data['value'] = $this->Checklists_model->get_search_defect_data_last($uri1, $uri2, '', $uri4, $uri3, $uri5);
        $this->load->view('checklists_category_defect', $data);
        $this->load->view('include/footer_new.php');
    }

    public function status_all_complete() {
        $completion_date = $this->input->post('completion_date');
        $id = $this->input->post('ids');
        $tract_id = $this->input->post('tract_id');
        $lot_id = $this->input->post('lot_id');
        $status = $this->input->post('is_completed');
        $url = base64_decode($this->input->post('url'));
        $ids = explode(',', $id);
        foreach ($ids as $id_row) {
            if ($id_row != '' && is_numeric($id_row)) {
                $data = array(
                    'is_completed' => $status,
                    'completion_date' => date('Y-m-d', strtotime($completion_date)),
                );
                $res = $this->Checklists_model->update_status($data, $id_row, $tract_id, $lot_id);
            }
        }

        if ($res) {
            $this->session->set_flashdata('success', 'Defect status successfully changed.');
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect($url);
    }

    public function status_all_complete_by_category() {
        $completion_date = $this->input->post('completion_date');
        $id = $this->input->post('ids');
        $tract_id = $this->input->post('tract_id');
        $lot_id = $this->input->post('lot_id');
        $defect_location = $this->input->post('defect_location');
        $status = $this->input->post('is_completed');
        $url = base64_decode($this->input->post('url'));
        $ids = explode(',', $id);
        foreach ($ids as $id_row) {
            if ($id_row != '' && is_numeric($id_row)) {
                $data = array(
                    'is_completed' => $status,
                    'completion_date' => date('Y-m-d', strtotime($completion_date)),
                );
                $res = $this->Checklists_model->update_status_category($data, $id_row, $tract_id, $lot_id, $defect_location);
            }
        }
        if ($res) {
            $this->session->set_flashdata('success', 'Defect status successfully changed.');
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect($url);
    }

    public function send_checklists_report() {
        $tract = $this->input->post('tract');
        $lot = $this->input->post('lot');
        $loc_ids = $this->input->post('loc_ids');
        $getInsRecord = $this->input->post('all_checklist_ins');

        $defects = $this->Checklists_model->get_defects_by_tract_lot($tract, $lot, $loc_ids);
        if(!empty($defects)){
        foreach ($defects as $defect) {
            $data1[] = (object) array(
                        'company_id' => $this->company_id,
                        'tract_id' => $this->input->post('tract'),
                        'lot_id' => $this->input->post('lot'),
                        'scanner_code' => $defect->scanner_code,
                        'image' => $defect->image,
                        'description' => $defect->description,
                        'trade_category' => $defect->trade_category,
                        'trade_partner' => $defect->trade_partner,
                        'defect_type' => $defect->defect_type,
                        'defect_location' => $defect->defect_location,
                        'created_by' => $this->sess_id,
                        'created_date' => $this->current_date(),
                        'is_notify' => $defect->is_notify,
                        'is_completed' => $defect->is_completed
            );
        }

        $getTractno = $this->db->query("SELECT tract_no FROM `tracts_tbl` where id=" . $data1[0]->tract_id)->row();
        $getLotno = $this->db->query("SELECT lot_no FROM `lots_tbl` where id=" . $data1[0]->lot_id)->row();
//        $getInsRecord = $this->db->query("SELECT * FROM `inspection_location` WHERE tract_id = ".$data1[0]->tract_id." AND lot_id = ".$data1[0]->lot_id." AND created_by = ".$this->sess_id." AND status = 1")->result();
        $lot_n_tract_no = 'Lot ' . $getLotno->lot_no . '/Tract ' . $getTractno->tract_no;
        if ($defects) {
            $link = $this->export_pdf($data1, $lot_n_tract_no, $getInsRecord);
            if ($link) {
                $dtsbuilders = $this->db->query('select name,email from user_tbl where company_id = ' . $this->company_id . ' and type != 4 and  status != 0')->result();
                $message_builder = $this->load->view('email/notify_builder.html', '', true);
                foreach ($dtsbuilders as $builder) {
                    $toRepArray = array('[!track!]', '[!name!]', '[!defecturl!]', '[!url!]', '[!img!]');
                    $fromRepArray = array(
                        'Lot ' . $getLotno->lot_no . '/Tract ' . $getTractno->tract_no,
                        $builder->name,
                        base_url('search_defect/search_result/' . $data1[0]->tract_id . '-' . $data1[0]->lot_id),
                        base_url('search_defect/search_result/' . $data1[0]->tract_id . '-' . $data1[0]->lot_id),
                        LOGO_IMG
                    );
                    $message = str_replace($toRepArray, $fromRepArray, $message_builder);
                    $this->send_email($builder->email, 'New EZQC Defect List', $message, $link);
                }
            }
        }
        echo 1;
        }else{
        echo 2;
        }
    }

    public function export_pdf($data, $lot_n_tract_no = '', $getInsRecord = '') {
        $record = array();
		$CHdefect = 0;
		$df_check_array = array();
        foreach ($data as $key => $value) {
            //echo $value->trade_partner; exit;
            $record[] = $value;
            $prtnr = json_decode($value->trade_partner);
            $pd = "";
            for ($p = 0; $p < count($prtnr); $p++) {
                $getPrtnr = $this->search_defect_model->get_partner_by_id($prtnr[$p]);
                $pd .= @$getPrtnr->partner_name . ', ';
            }
            if ($value->defect_location != '') {
                $loc = $this->db->query("select * from defect_location_tbl where id = '" . $value->defect_location . "'")->row();
                $record[$key]->defect_location_name = $loc->defect_location;
            } else {
                $record[$key]->defect_location_name = '';
            }

            if ($value->defect_type != '') {
                $dt = $this->db->query("select * from defect_type_tbl where id = '" . $value->defect_type . "'")->row();
                $record[$key]->defect_type_name = $dt->defect_type;
                $record[$key]->closing_hold = $dt->closing_hold;
				if($dt->closing_hold == 1){
					if(in_array($dt->defect_type, $df_check_array)){
                        $CHdefect++;
                    }else{
						$df_check_array[] = $dt->defect_type;
						$CHdefect++;
					}
				}
            } else {
                $record[$key]->defect_type_name = '';
                $record[$key]->closing_hold = '';
            }
            $record[$key]->is_completed = $value->is_completed;


            $record[$key]->partner_name = rtrim($pd, ', ');
        }
        $finalRecord = array();
        foreach ($record as $key => $part) {
            if ($part->partner_name != '') {

                $pname = explode(', ', $part->partner_name);
                foreach ($pname as $p) {
                    if ($p != '') {
                        $getLableCode = $this->db->query("SELECT * FROM `label_tbl` where id= (SELECT label FROM `label_association_tbl` where status=1 and company_id = '" . $part->company_id . "' and category_id = (SELECT category_id FROM `tracts_category_partner_associations_tbl` where status=1 and tract_id = '" . $part->tract_id . "' and partner_id = (select id from trade_partner_tbl where partner_name='" . $p . "' AND status = 1) limit 1))")->row();
                        //echo $this->db->last_query().'</hr>';
                        // $getLableCode->color_code
                        if (!empty($getLableCode)) {
                            $part->labelColor = $getLableCode->color_code;
                        } else {
                            $part->labelColor = '';
                        }
                        //  $part->labelColor = '';
                        $part->labelQuery = $this->db->last_query();
                        //  echo $p.'<br/>';
                        if (array_key_exists(ucfirst($p), $finalRecord)) {
                            $finalRecord[ucfirst($p)][] = $part;
                        } else {
                            $finalRecord[ucfirst($p)][] = $part;
                        }
                    } else {
                        $part->labelColor = '';
                        $finalRecord[''][] = $part;
                    }
                }
            } else {
                $part->labelColor = '';
                $finalRecord[''][] = $part;
            }

            $sort[$key] = ucfirst($part->partner_name);
        }
        ksort($finalRecord);
		
		$data['all_count'] = count($data);
		$data['CH_defect'] = $CHdefect;
		if($getInsRecord){
			$data['check_ins'] = $getInsRecord;
		}else{
			$data['check_ins'] = 0;
		}
        $data['data'] = $finalRecord;

        // echo json_encode($finalRecord); exit;
        return $this->pdf_generate_new($data, $lot_n_tract_no);
    }

    public function pdf_generate_new($data, $lot_n_tract_no = '') {
        $data['lot_n_tract_no'] = $lot_n_tract_no;
		// print_r($data);exit;
        $html = $this->load->view('defect_pdf_new', $data, true);
        // echo $html; exit;
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->SetTitle('Defect PDF');
        $pdfFilePath = time() . "_pdf.pdf";
        $this->m_pdf->pdf->WriteHTML($html);
       // $this->m_pdf->pdf->Output();
        $this->m_pdf->pdf->Output('upload/defects/' . $pdfFilePath, "F");
        return 'upload/defects/' . $pdfFilePath;
    }

    public function send_checklists_report_old() {
        $tract = $this->input->post('tract');
        $lot = $this->input->post('lot');
        $total_defect = $this->input->post('total_defect');
        $total_in_defect = $this->input->post('total_in_defect');
        $ckindefect = $this->input->post('ckindefect');

        $sess_id = $this->session->userdata('id');
        $user_data = $this->profile_model->get_profile($sess_id);

        $toRepArray = array('[!tract!]', '[!lot!]', '[!total_defect!]', '[!total_in_defect!]', '[!ckindefect!]', '[!name!]', '[!img!]');
        $fromRepArray = array(
            $tract,
            $lot,
            $total_defect,
            $total_in_defect,
            $ckindefect,
            $user_data->name,
            LOGO_IMG
        );
        $subject = "EZQC: Checklists Report";
        $message_templete = $this->load->view('email/checklists_report.html', '', true);
        $message = str_replace($toRepArray, $fromRepArray, $message_templete);
        $sentmail = $this->send_email($user_data->email, $subject, $message);
        if ($sentmail) {
            echo 1;
        } else {
            $this->session->set_flashdata('error', ERR_EMAIL_NOT_SENT);
            echo 0;
        }
        // redirect('checklists/checklists_dashboard/'.$tract.'/'.$lot);
    }

    // public function insert() {
    //     $url = base64_decode($this->input->post('url'));
    //     $loc_id = $this->input->post('defect_location');
    //     $data_loc = $this->defect_location_model->get_defect_location_by_id($loc_id);
    //     $data = array(
    //         'company_id' => $this->company_id,
    //         'category_name' => $this->input->post('category_name'),
    //         'created_by' => $this->sess_id,
    //         'created_date' => $this->current_date()
    //     );
    //     $res = $this->Checklists_model->insert_cat_by_location($data);
    //     if ($res) {
    //         $data = array(
    //             'category_ids' => $data_loc->category_ids . ',' . $res,
    //             'updated_by' => $this->sess_id,
    //             'updated_date' => $this->current_date()
    //         );
    //         $this->defect_location_model->update($data, $loc_id);
    //         $this->session->set_flashdata('success', RECORD_ADDED);
    //     } else {
    //         $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
    //     }
    //     redirect($url);
    // }
    
    public function insert() {
        $url = base64_decode($this->input->post('url'));
        $loc_id = $this->input->post('defect_location');
        $data = array(
            'category_ids' => implode(',', $this->input->post('category_name')),
            'updated_by' => $this->sess_id,
            'updated_date' => $this->current_date()
        );
        $res = $this->defect_location_model->update($data, $loc_id);
        if ($res) {
            $this->session->set_flashdata('success', RECORD_UPDATED);
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect($url);
    }

    public function inspection_location() {
        $tract_id = $this->input->post('tract_id');
        $lot_id = $this->input->post('lot_id');
        $locid = $this->input->post('locid');
        $type = $this->input->post('type');
        $sess_id = $this->session->userdata('id');
        if ($type == 2) {
            $data = array(
                'tract_id' => $tract_id,
                'lot_id' => $lot_id,
                'location_id' => $locid,
                'created_by' => $this->sess_id,
            );
            $res = $this->Checklists_model->insert_inspection_location($data);
        } else {
            $res = $this->Checklists_model->delete_inspection_location($tract_id, $lot_id, $locid, $this->sess_id);
        }
        if ($res) {
            if ($type == 2) {
                $this->session->set_flashdata('success-ins', 'Checked your location successfully.');
            } else {
                $this->session->set_flashdata('success-ins', 'Unchecked your location successfully.');
            }
            echo 1;
        } else {
            echo 0;
        }
    }

    public function inspection_category() {
        $tract_id = $this->input->post('tract_id');
        $lot_id = $this->input->post('lot_id');
        $locid = $this->input->post('locid');
        $catid = $this->input->post('catid');
        $type = $this->input->post('type');
        $sess_id = $this->session->userdata('id');
        if ($type == 2) {
            $data = array(
                'tract_id' => $tract_id,
                'lot_id' => $lot_id,
                'location_id' => $locid,
                'category_id' => $catid,
                'created_by' => $this->sess_id,
            );
            $res = $this->Checklists_model->insert_inspection_category($data);
        } else {
            $res = $this->Checklists_model->delete_inspection_category($tract_id, $lot_id, $locid, $catid, $this->sess_id);
        }
        if ($res) {
            if ($type == 2) {
                $this->session->set_flashdata('success-ins', 'Checked your category successfully.');
            } else {
                $this->session->set_flashdata('success-ins', 'Unchecked your category successfully.');
            }
            echo 1;
        } else {
            $this->session->set_flashdata('error-ins', 'Something went wrong.');
            echo 0;
        }
    }
    
    public function inspection_category_location() {
        $tract_id = $this->input->post('tract_id');
        $lot_id = $this->input->post('lot_id');
        $locid = $this->input->post('locid');
        $catid = $this->input->post('catid');
        $defect_type_id = $this->input->post('defect_type_id');
        $type = $this->input->post('type');
        $sess_id = $this->session->userdata('id');
        if ($type == 2) {
            $data = array(
                'tract_id' => $tract_id,
                'lot_id' => $lot_id,
                'location_id' => $locid,
                'category_id' => $catid,
                'defect_type_id' => $defect_type_id,
                'created_by' => $this->sess_id,
            );
            $res = $this->Checklists_model->insert_inspection_location_category($data);
        } else {
            $res = $this->Checklists_model->delete_inspection_location_category($tract_id, $lot_id, $locid, $catid, $defect_type_id, $this->sess_id);
        }
        if ($res) {
            if ($type == 2) {
                $this->session->set_flashdata('success-ins', 'Checked your defect type successfully.');
            } else {
                $this->session->set_flashdata('success-ins', 'Unchecked your defect type successfully.');
            }
            echo 1;
        } else {
            $this->session->set_flashdata('error-ins', 'Something went wrong.');
            echo 0;
        }
    }

    public function inspection_location_all() {
        $tract_id = $this->input->post('tract_id');
        $lot_id = $this->input->post('lot_id');
        $locid = $this->input->post('locid');
        $sess_id = $this->session->userdata('id');

        $res = 1;
        if ($locid) {
            $ex = explode(',', $locid);
            for ($i = 0; $i < count($ex); $i++) {

//                $result = $this->defect_location_model->get_defect_location_by_id($ex[$i]);
//
//                if ($result->category_ids) {
//
//                    $exc = explode(',', $result->category_ids);
//                    for ($ic = 0; $ic < count($exc); $ic++) {
//                        $resultc = $this->Checklists_model->get_inspection_category($ex[$i], $tract_id, $lot_id, $exc[$ic]);
//                        if (empty($resultc)) {
//                            $data = array(
//                                'tract_id' => $tract_id,
//                                'lot_id' => $lot_id,
//                                'location_id' => $ex[$i],
//                                'category_id' => $exc[$ic],
//                                'created_by' => $this->sess_id,
//                            );
//                            $res = $this->Checklists_model->insert_inspection_category($data);
//                        }
//                    }
//                }

                $result = $this->Checklists_model->get_inspection_location($ex[$i], $tract_id, $lot_id);
                if(empty($result)){
                    $data = array(
                    'tract_id' => $tract_id,
                    'lot_id' => $lot_id,
                    'location_id' => $ex[$i],
                    'created_by' => $this->sess_id,
                    );
                    $res = $this->Checklists_model->insert_inspection_location($data);
                }
            }
        }
        if ($res) {
            $this->session->set_flashdata('success-ins', 'Checked your all location successfully.');
            echo 1;
        } else {
            $this->session->set_flashdata('error-ins', 'Something went wrong.');
            echo 0;
        }
    }

    public function inspection_category_all() {
        $tract_id = $this->input->post('tract_id');
        $lot_id = $this->input->post('lot_id');
        $locid = $this->input->post('locid');
        $catid = $this->input->post('catid');
        $sess_id = $this->session->userdata('id');
        $res = 1;
        if ($catid) {
            $ex = explode(',', $catid);
            for ($i = 0; $i < count($ex); $i++) {
                $result = $this->Checklists_model->get_inspection_category($locid, $tract_id, $lot_id, $ex[$i]);
                if (empty($result)) {
                    $data = array(
                        'tract_id' => $tract_id,
                        'lot_id' => $lot_id,
                        'location_id' => $locid,
                        'category_id' => $ex[$i],
                        'created_by' => $this->sess_id,
                    );
                    $res = $this->Checklists_model->insert_inspection_category($data);
                }
            }
        }
        if ($res) {
            $this->session->set_flashdata('success-ins', 'Checked your all category successfully.');
            echo 1;
        } else {
            $this->session->set_flashdata('error-ins', 'Something went wrong.');
            echo 0;
        }
    }
    
    public function inspection_location_category_all() {
        $tract_id = $this->input->post('tract_id');
        $lot_id = $this->input->post('lot_id');
        $locid = $this->input->post('locid');
        $catid = $this->input->post('catid');
        $defect_type_id = $this->input->post('defect_type_id');
        $sess_id = $this->session->userdata('id');
        $res = 1;
        if ($defect_type_id) {
            $ex = explode(',', $defect_type_id);
            for ($i = 0; $i < count($ex); $i++) {
                $result = $this->Checklists_model->get_inspection_location_category($locid, $tract_id, $lot_id, $catid, $ex[$i]);
                if (empty($result)) {
                    $data = array(
                        'tract_id' => $tract_id,
                        'lot_id' => $lot_id,
                        'location_id' => $locid,
                        'category_id' => $catid,
                        'defect_type_id' => $ex[$i],
                        'created_by' => $this->sess_id,
                    );
                    $res = $this->Checklists_model->insert_inspection_location_category($data);
                }
            }
        }
        if ($res) {
            $this->session->set_flashdata('success-ins', 'Checked your all defect type successfully.');
            echo 1;
        } else {
            $this->session->set_flashdata('error-ins', 'Something went wrong.');
            echo 0;
        }
    }
    
    public function status_all_complete_by_category_location() {
        $completion_date = $this->input->post('completion_date');
        $id = $this->input->post('ids');
        $catid = $this->input->post('catid');
        $tract_id = $this->input->post('tract_id');
        $lot_id = $this->input->post('lot_id');
        $defect_location = $this->input->post('defect_location');
        $status = $this->input->post('is_completed');
        $url = base64_decode($this->input->post('url'));
        $ids = explode(',', $id);
        foreach ($ids as $id_row) {
            if ($id_row != '' && is_numeric($id_row)) {
                $data = array(
                    'is_completed' => $status,
                    'completion_date' => date('Y-m-d', strtotime($completion_date)),
                );
                $res = $this->Checklists_model->update_status_category_location($data, $id_row, $tract_id, $lot_id, $defect_location, $catid);
            }
        }
        if ($res) {
            $this->session->set_flashdata('success', 'Defect status successfully changed.');
        } else {
            $this->session->set_flashdata('error', ERR_DATA_PROCESSING_ERROR);
        }
        redirect($url);
    }
    
    public function inspection_category_all_defect_checklist() {
        $tract_id = $this->input->post('tract_id');
        $lot_id = $this->input->post('lot_id');
        $locid = $this->input->post('locid');
        $catid = $this->input->post('catid');
        $res = 1;
        if ($catid) {
            $ex = explode(',', $catid);
            for ($i = 0; $i < count($ex); $i++) {
                $results = $this->Checklists_model->get_cat_by_defect_checklist($locid, $ex[$i]);
                foreach ($results as $row) {
                    $chk_ins = $this->Checklists_model->get_inspection_location_category($row->defect_location_ids, $tract_id, $lot_id, $row->category_id, $row->id);
                    // if(count($chk_ins) == 0){
                    if(empty($chk_ins)){
                        $data = array(
                            'tract_id' => $tract_id,
                            'lot_id' => $lot_id,
                            'location_id' => $row->defect_location_ids,
                            'category_id' => $row->category_id,
                            'defect_type_id' => $row->id,
                            'created_by' => $this->sess_id,
                        );
                        $res = $this->Checklists_model->insert_inspection_location_category($data);
                    }
                }
            }
        }
        if ($res) {
            $this->session->set_flashdata('success-ins', 'Checked your all category successfully.');
            echo 1;
        } else {
            $this->session->set_flashdata('error-ins', 'Something went wrong.');
            echo 0;
        }
    }
    
    public function inspection_location_category_all_defect_checklist() {
        $tract_id = $this->input->post('tract_id');
        $lot_id = $this->input->post('lot_id');
        $locid = $this->input->post('locid');
        $result_loc_cat = $this->Checklists_model->get_cat_by_defect_location_checklist($locid);
        
        foreach ($result_loc_cat as $row_loc_cat) {
            $catid = $row_loc_cat->category_ids;
            $res = 1;
            if ($catid) {
                $ex = explode(',', $catid);
                for ($i = 0; $i < count($ex); $i++) {
                    $results = $this->Checklists_model->get_cat_by_defect_checklist($row_loc_cat->id, $ex[$i]);
                    foreach ($results as $row) {
                        $chk_ins = $this->Checklists_model->get_inspection_location_category($row->defect_location_ids, $tract_id, $lot_id, $row->category_id, $row->id);
                        // if(count($chk_ins) == 0){
                        if(empty($chk_ins)){
                            $data = array(
                                'tract_id' => $tract_id,
                                'lot_id' => $lot_id,
                                'location_id' => $row->defect_location_ids,
                                'category_id' => $row->category_id,
                                'defect_type_id' => $row->id,
                                'created_by' => $this->sess_id,
                            );
                            $res = $this->Checklists_model->insert_inspection_location_category($data);
                        }
                    }
                }
            }
        }
        if ($res) {
            $this->session->set_flashdata('success-ins', 'Checked your all location successfully.');
            echo 1;
        } else {
            $this->session->set_flashdata('error-ins', 'Something went wrong.');
            echo 0;
        }
    }

}

?>