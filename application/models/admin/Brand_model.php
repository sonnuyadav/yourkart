<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Brand_model extends CI_Model {
 public function __construct()

    {

        parent::__construct();

        $this->table = 'tbl_brand';

        

    }



    public function get_count_record()

    {

        $query = $this->db->count_all($this->table);



        return $query;

    }



    public function getAll(){

       $this->db->order_by("id", "desc");

        $data = $this->db->get_where($this->table)->result();

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

  

    function getbrandsForMenu(){

        $this->db->where('status = "1"');

         $this->db->order_by("title", "asc");

        $data = $this->db->get($this->table)->result_array();

        

      return $data;

    }

public function getBrandByNickname($nickname){
    $nicename = $this->db->escape(trim($nickname));
    $this->db->where('status = "1" && nicename='.$nicename);
    return $this->db->get_where($this->table)->row();
   }

   public function getBrandHome($limit){
     $this->db->select('*')
       ->from($this->table)
       ->where('status','1')
       ->limit($limit);
     return $this->db->get()->result();
   }
   public function getFeaturedBrand($limit = 3){
        $this->db->where('status="1" AND featured = "1"');
        $this->db->limit($limit);
        $this->db->order_by('id','desc');
        $data = $this->db->get($this->table)->result();
        return $data;
   }
}
?>