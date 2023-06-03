<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contest_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_contest';
       
    }
    function getAll(){
        $data = $this->db->get($this->table)->result();
        return $data;
    }

    public function get_count_record()
    {
        $query = $this->db->count_all($this->table);
        return $query;
    }   
    public function insert($data,$table=false){
        if(!$table){
            $table = $this->table;
        }
        $this->db->insert($table,$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    } 
    function update($data,$id=0,$table= false){
        if(!$table){
            $table = $this->table;
        }
        if($id)
        $this->db->where(array('id'=>$id));
        $this->db->update($table,$data);
        return true;
    }
    function deleteRow($id,$table=false){
        if(!$table){
            $table = $this->table;
        }
        $this->db->where('id', $id);
        $this->db->delete($table); 
        return true;
    }
   

}