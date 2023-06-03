<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Combo_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_combo';        
    }

    public function get_count_record()
    {
        $query = $this->db->count_all($this->table);

        return $query;
    }

    public function getAll(){        
        $this->db->order_by('id','desc');
        $data = $this->db->get($this->table)->result();
            // echo $this->db->last_query();
            // die();
        return $data;
    }
     public function get_active_combo(){        
        $this->db->order_by('id','desc');
        $this->db->where('status','1');
        $data = $this->db->get($this->table)->result();
            // echo $this->db->last_query();
            // die();
        return $data;
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
    function checkExistingNiceName($niceName,$id=false){
        if($id){ 
       
            $this ->db->where('id !='. $id.' && nicename = '.$nicename);
            $data = $this->db->get_where($this->table)->result();

        }else{
            $this ->db->where('nicename = "'.$niceName.'"');
            $data = $this->db->get($this->table)->result();
            if(count($data)){
                $niceName = unique_slug($this->table,$niceName);
            }
        }
        return $niceName;
    }
    
    function getCategory($catid){
        $this->db->where('id='.$catid);
        return $this->db->get($this->table)->row();
    }
    

 public function getComboByNickname($nickname){    
    $nicename = $this->db->escape(trim($nickname));
    $this->db->where('status = "1" && nicename='.$nicename);
    return $this->db->get_where($this->table)->row();
   }


}