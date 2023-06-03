<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orderitems_model extends CI_Model {
   public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_order_items';
        
    }

 public function insert($data){
        $insertid = $this->db->insert($this->table,$data);
         return $this->db->insert_id();
    } 
 
 public function getListitems($oid)
 		{
 	
  $this->db->from('tbl_order_items oi');
  $this->db->join('tbl_orders o', 'o.id = oi.ord_id','LEFT');
  $this->db->where('oi.ord_id',$oid);
  return $this->db->get()->result();
		}   



}