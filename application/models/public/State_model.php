<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_state';
    }
  
    public function getAllState() {
        $this->db->where("country_id", "104");
        $this->db->order_by("state_name", "ASC");
        return $this->db->get_where($this->table)->result();
      } 
}  



