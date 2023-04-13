<?php
class Login_model extends CI_Model {

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
    
    public function check_email($email) {
        return $this->db->query("SELECT * FROM admin WHERE email = '$email'")->row();
    }
    
	public function update_reset_password($dt, $UserID) {
        $this->db->where('id', $UserID);
        return $this->db->update('admin', $dt);
    }
	
	public function get_profile() {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('id', 1);
        $query = $this->db->get();
        return $query->row();
    }

}
?>