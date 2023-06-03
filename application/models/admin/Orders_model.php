<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orders_model extends CI_Model {
   public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_orders';
        
    }
  public function getLastId() {
        $this->db->order_by("id", "desc");
          $this->db->limit('0','1');
       return $this->db->get_where($this->table)->row_array();
    }
 public function insert($data){
        $insertid = $this->db->insert($this->table,$data);
         return $this->db->insert_id();
    } 
    
 function update($data,$oid){
        $this->db->where(array('id'=>$oid));
       return $this->db->update($this->table,$data);
         
    }
public function getOrderDetailsById($id){
          $this->db->where('id',$id);
          $this->db->where('status','1');
          $this->db->limit('0','1');
          $this->db->limit('0','1');
       return $this->db->get_where($this->table)->row_array();
 }
 public function getOrderByuserid($userid){
      $this->db->where('uid='.$userid.' AND status = "1"');
      $this->db->order_by('id','desc');
      return $this->db->get_where($this->table)->result();
    }
    public function getOrderByuseremail($email){
      $this->db->where('emailid="'.$email.'" AND status = "1"');
      $this->db->order_by('id','desc');
      return $this->db->get_where($this->table)->result();
    }

  public function getAllOrders(){
        $this->db->order_by("id", "desc");
        $data = $this->db->get_where($this->table)->result();
        return $data;
    }  
    function getRecentOrders($limit=10){
      $limit = intval($limit); 

      $this->db->select('id,invoice_id,order_no,ord_total_amount,order_method,ord_status,order_date');
      $this->db->order_by('id','desc');
      $this->db->limit($limit);
      return $this->db->get($this->table)->result();
    }
    public function getTodayOrderCount(){
      $date   =   date('Y-m-d');
      $this->db->where('status = "1" AND date(order_date)  = "'.$date.'"');
      return $this->db->get($this->table)->num_rows();
    }
    public function getTodaySale(){
      $date   =   date('Y-m-d');
      $this->db->where('status = "1" AND date(order_date)  = "'.$date.'" AND ord_status != "failure"');
      $this->db->select('COALESCE(sum(ord_total_amount),0) as totalAmt,COALESCE(sum(order_shipping_charge),0) as totalShip');
       return $this->db->get($this->table)->row();
    }
    public function getTotalOrderCount(){
      
      $this->db->where('status = "1" ');
      return $this->db->get($this->table)->num_rows();
    }
    
     public function getUserOrderCount($userid){
      $this->db->where('uid='.$userid.' AND status = "1"');
      $this->db->select('count(*) as order_count');
      return $this->db->get($this->table)->row();
    }
    public function getUserOrderSum($userid){
      $this->db->where('uid='.$userid.' AND status = "1"');
      $this->db->select('COALESCE(sum(ord_total_amount-couponamount),0) as order_sum');
      return $this->db->get($this->table)->row();
    }
}