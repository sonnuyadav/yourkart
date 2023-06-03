<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Page_model extends CI_Model {
 public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_pages';
        
    }

    public function get_count_record()
    {
        $query = $this->db->count_all($this->table);

        return $query;
    }

    public function getAll($nicename=0){
        if($nicename){
            $this->db->where("nicename", "$nicename");
        }
       $this->db->order_by("id", "desc");
        $data = $this->db->get_where($this->table);
        if($nicename){
            return $data->row();
        }else{
            return $data->result();
        }
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
    function getpageForMenu(){        
        $this->db->order_by("id", "desc");
        $data = $this->db->get($this->table)->result_array();        
      return $data;
    }

}
?>