<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_customers';
    }
    public function insert($data){
        $insertid = $this->db->insert($this->table,$data);
         return $this->db->insert_id();
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

    function login($email,$password){
    	$this->db->where('email="'.$email.'" AND password = "'.$password.'" AND status = "1	"');
    	$user = $this->db->get($this->table)->row();
    	
    	return $user;
    }
    function signup($data){
        $insertArray = array();
        $insertArray['fullname'] = $data['fullname'];
        $insertArray['email'] = $data['email'];
        $insertArray['mobile'] = $data['mobile'];
        $insertArray['password'] = $data['password'];
        $insertArray['doe'] = date('Y-m-d H:i:s');
        $insertArray['lastlogin'] = date('Y-m-d H:i:s');
        $insertArray['last_login_ip'] = $_SERVER['REMOTE_ADDR'];
        $insertArray['ipaddress'] = $_SERVER['REMOTE_ADDR'];
        $insertArray['status'] = '1';
        $insertArray['is_active'] = '1';
        $insertid = $this->insert($insertArray);
         $insertArray['id'] = $insertid;
          if(!islocal()){ 
             $attributes['name'] = $data['fullname'];   
             $attributes['email'] = $data['email'];   
             $attributes['password'] = $data['password'];   
            $subject = "Welcome to Global Product Shopping ";    
             $message = $this->load->view('email-templates/public/welcome', $attributes, true);
              $isMailSent = send_mail($data['email'],$subject,$message,'html');
              }
        if($insertid)
           return $insertArray;
        else
            return false;
    }
    function checkUserExists($email){
        $this->db->where('email="'.$email.'"');
        $user = $this->db->get($this->table)->num_rows();
        return $user;
    }
    function checkSocialUserExists($id,$type){
         $this->db->where("$type='".$id."'");
        $num = $this->db->get($this->table)->num_rows();
        //echo $this->db->last_query(); die();
        return $num;
    }

    function saveSocialUser($data,$type){
        $insertArray = array();
        if($type == 'facebook'){
             $insertArray['fb_id'] = $data['id'];
             $insertArray['fullname'] = $data['name'];
        }
        if($type == 'google'){
             $insertArray['google_id'] = $data['id'];
             $insertArray['fullname'] = $data['given_name'];
        }
        
        $insertArray['username'] =  create_slug($insertArray['fullname']);
        $insertArray['username'] =   unique_slug($this->table,$insertArray['username'],"''","''",'username');
        $insertArray['email'] = $data['email'];
        $insertArray['doe'] = date('Y-m-d H:i:s');
        $insertArray['lastlogin'] = date('Y-m-d H:i:s');
        $insertArray['last_login_ip'] = $_SERVER['REMOTE_ADDR'];
        $insertArray['ipaddress'] = $_SERVER['REMOTE_ADDR'];
        $insertArray['status'] = '1';
        $insertArray['is_active'] = '1';
        $insertid = $this->insert($insertArray);
        return $insertid ? $insertArray : false;
        
    }
    function getSocialUser($id,$type){
        $this->db->where("$type='".$id."'");
        $data = $this->db->get($this->table)->row_array();
        return $data;
    }
     //get user details by email id
     function getUserDetails($email){
        $this->db->where('email="'.$email.'"');
         return $this->db->get($this->table)->row_array();
         
    }
    function getUserByEmail($email){
        $this->db->where('email="'.$email.'"');
        $data = $this->db->get($this->table)->row();
        return $data;
    }
     function getCustomerByUsername($username){
        $this->db->where('username LIKE "'.$username.'"');
        $data = $this->db->get($this->table)->row();
        return $data;
    }

    //Function for checkout signup
    public function checkoutSignup($data){
        
       
        $insertArray = array();
        $insertArray['fullname'] = $data['name'];
        $insertArray['email'] = $data['email'];
        $insertArray['mobile'] = $data['phone'];
        $insertArray['phone'] = $data['phone'];
        $insertArray['address1'] = isset($data['address1']) ? $data['address1'] : '';  
        $insertArray['address2'] = isset($data['address1']) ? $data['address2'] : '';  
        $insertArray['company'] = isset($data['company']) ? $data['company'] : '';  
        $insertArray['landmark'] = isset($data['landmark']) ? $data['landmark'] : '';
        $insertArray['state'] = isset($data['state']) ? $data['state'] : '';
        $insertArray['city'] = isset($data['city']) ? $data['city'] : '';
        $insertArray['pincode'] = isset($data['pincode']) ? $data['pincode'] : '';
        $insertArray['ipaddress'] = getRealUserIp();
        $insertArray['status'] = '1';
        $insertArray['is_active'] = '1';
       $user = $this->getUserDetails($data['email']);
       if($user){
        $insertArray['dou'] = date('Y-m-d H:i:s');
        $insertArray['lastlogin'] = date('Y-m-d H:i:s');
        $insertArray['last_login_ip'] = getRealUserIp();
        $insertArray['uid'] = $this->update($insertArray,$user['id']);
        }else{
        $insertArray['password'] = $data['password'];
        $insertArray['doe'] = date('Y-m-d H:i:s');
        $insertArray['lastlogin'] = date('Y-m-d H:i:s');
        $insertArray['last_login_ip'] = getRealUserIp();
        $insertArray['uid'] = $this->insert($insertArray);
        }    
       return $insertArray; 
   


    }
     function checkForgotpasswordStr($str){
        $this->db->where('forgotPasswordStr="'.$str.'"');
        return $this->db->get($this->table)->row();
    }
    function recoverPassword($password,$userid){
        $updateArray = array();
        $updateArray['password'] = $password;
        $updateArray['forgotPasswordStr'] = '';
        $this->update($updateArray,$userid);
    }
    //get all customer
     public function getAllCustomers(){
        $this->db->order_by("id", "desc");
        return $this->db->get_where($this->table)->result();
    }
     function getUserById($id){
        $this->db->where('id',$id);
        return $this->db->get($this->table)->row();
     } 
}