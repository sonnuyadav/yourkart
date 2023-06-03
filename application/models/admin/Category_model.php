<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_category';
        $this->sliderTable = 'tbl_category_sliders';
        $this->FilterTable = 'tbl_category_filter';
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
        $whereStr = " status = '1' ";
        if($catid){
             $whereStr .= " AND id != ".$catid;
        }
        $this->db->where($whereStr);
        $this->db->order_by("id", "desc");
        $data = $this->db->get($this->table)->result();
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
    function manageSubCategory($catid = 0){
        $this->db->where('id',$catid);
        $catData = $this->db->get($this->table)->row();
        $newparent = 0;
        if($catData->parent != 0){
            $newparent = $catData->parent;
        }
        $updateArray = array();
        $updateArray['parent']  = $newparent;
        $this->db->where('parent',$catid);
        $this->update($updateArray);
    }
    function insertFilter($data = array(),$catid = 0){
        if(count($data)){
            foreach($data as $value){
                if($value != ''){
                    $insertArr = array();
                    $insertArr['catid'] = $catid;
                    $insertArr['filter'] = $value;
                    $this->insert($insertArr,$this->FilterTable);
                }
            }
        }
        return true;
        //$this->FilterTable
    }
    function getCategory($catid){
        $this->db->where('id='.$catid);
        return $this->db->get($this->table)->row();
    }
    function getCatFilters($cid=0){
        //$this->db->where('catid='.$cid);
        $catArray = array();
        $catArray[] = $cid;
        

        
            for($i = 0;$i<=10;$i++){
                $data = $this->getCategory($cid);
                if($data->parent != 0){
                    $catArray[] = $data->parent;
                    $cid = $data->parent;
                }                
            }    
        $this->db->where_in('catid',$catArray);
        return  $this->db->get($this->FilterTable)->result();
        
        //return 
    }
    function updateFilter($data = array()){
        if(count($data)){
            foreach($data as $key => $value){
                $updateArr = array();
                $updateArr['filter'] = $value;
                $this->update($updateArr,$key,$this->FilterTable);
            }
        }
       // pr($data); die();
        return true;
        //pr($data); die();
    }
    function deleteFilter($data = array()){
        
        if(count($data)){
            foreach($data as $key => $value){
                $this->deleteRow($key,$this->FilterTable);
            }
        }
        return true;//pr($data); die();
    }


    
    function getHomecategory($limit = 100){
        $this->db->where('status = "1" AND featured = "1"');
        //$this->db->limit($limit);
        $this->db->select('id,title,nicename');
        return $this->db->get($this->table)->result();
    }
    function getCategoryForMenu(){
        $this->db->where('status = "1"');
         $this->db->order_by("id", "desc");
        $data = $this->db->get($this->table)->result_array();
        
      return $data;
    }   

 public function getCatDetailsByNickname($nickname){    
    $nicename = $this->db->escape(trim($nickname));
    $this->db->where('status = "1" && nicename='.$nicename);
    return $this->db->get_where($this->table)->row();
   }


}