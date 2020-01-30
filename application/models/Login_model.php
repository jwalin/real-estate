<?php

class login_model extends CI_Model {

    public function loginprocess($email, $pass) {





        $this->db->select('*');


        $this->db->from('admin');


        $this->db->where('email', $email);


        $this->db->where('password', md5($pass));


        $this->db->limit(1);





        $query = $this->db->get();





        if ($query->num_rows() == 1) {


            return $query->row_array();
        } else {


            return false;
        }
    }

    public function update_Password($array, $id) {





        $this->db->where('id', $id);


        return $this->db->update('admin', $array);
    }

    public function email_check($email) {

        $query = $this->db->query("SELECT * FROM admin WHERE email = '" . $email . "'");
        return $query->result();
    }

    public function update_reset_password($dt, $UserID) {
        $this->db->where('id', $UserID);
        return $this->db->update('admin', $dt);
    }

}

/* 


 * To change this license header, choose License Headers in Project Properties.


 * To change this template file, choose Tools | Templates


 * and open the template in the editor.


 */





