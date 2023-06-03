<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_signup';
    }
    public function getAll(){
        $this->db->order_by("id", "desc");
	 	$data = $this->db->get($this->table)->result();
	 	return $data;
    }
    public function insert($data){
        $this->db->insert($this->table,$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    } 
    function update($data,$id){
        $this->db->where(array('id'=>$id));
        $this->db->update($this->table,$data);
        return true;
    }
    function deleteRow($id){
        $this->db->where('id', $id);
        $this->db->delete($this->table); 
        return true;
    }
    function checkExisting($email=''){
        $this->db->where('email = "'.$email.'"');
        $data = $this->db->get($this->table)->result(); 
        //echo $this->db->last_query(); 
        
        return count($data) ? true : false;
    }
    
}