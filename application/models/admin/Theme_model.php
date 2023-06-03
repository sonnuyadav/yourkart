<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Theme_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_theme_options';
       
    }

    public function get_count_record()
    {
        $query = $this->db->count_all($this->table);

        return $query;
    }

    public function getAll(){
       $whereStr = " C.status = '1'";
        
        $this->db->select('C.*,CP.title as parentname');
        $this->db->from("$this->table C");
        $this->db->join("$this->table CP",'CP.id = C.parent','left');
        //$this->db->where($whereStr);
        $this->db->order_by("C.id", "desc");
        $data = $this->db->get()->result();
            // echo $this->db->last_query();
            // die();
        return $data;
    }
    public function getAllActiveCats(){
       $whereStr = " status = '1'";
        
        $this->db->from("$this->table");
        
        $this->db->where($whereStr);
        $this->db->order_by("title", "asc");
        $data = $this->db->get()->result();
            // echo $this->db->last_query();
            // die();
        return $data;
    }
    public function getAllParent($catid=0){
        $whereStr = " status = '1' AND parent = 0 ";
        if($catid){
             $whereStr .= " AND id != ".$catid;
        }
        $this->db->where($whereStr);
        $this->db->order_by("id", "desc");
        $data = $this->db->get($this->table)->result();
     // echo $this->db->last_query();
     //        die();
        return $data;
    }
    public function insert($data){
        $this->db->insert($this->table,$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    } 
    function update($data,$key){
        $this->db->where(array('metakey'=>$key));
        $this->db->update($this->table,$data);
        return true;
    }
    function deleteRow($id){
        $this->db->where('id', $id);
        $this->db->delete($this->table); 
        return true;
    }
    
    function manageThemeSettings($postdata = array()){
        if(count($postdata)){
            foreach($postdata as $key => $value){
                $this->db->where('metakey="'.$key.'"');
                $row = $this->db->get($this->table)->row();
                if(count($row)){
                    $updateArary = array();
                    $updateArary['metavalue'] = trim($value);
                    $this->update($updateArary,$key);    
                }else{
                    $insertArr = array();
                    $insertArr['metavalue'] = trim($value);
                    $insertArr['metakey'] = $key;
                    $this->insert($insertArr); 
                }
                
            }
        }
    }
    
}