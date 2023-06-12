<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function  get_patientlabtest_details_item_info(){
        $sql = 'SELECT * FROM backenduser';
        $binds = array();
        $query = $this->db->query($sql, $binds);
        return $query->result();
    }
}
?>