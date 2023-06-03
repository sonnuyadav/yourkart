<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends Public_Controller {
    public function __construct()
    { 
        parent::__construct(); 
        $this->load->model('admin/customer_model');
        $this->load->model('admin/product_model');
       // $this->load->model('public/cart');
         $this->load->model('admin/orders_model');
         $this->load->model('admin/orderitems_model');
        $this->load->model('admin/theme_model');
         $this->load->model('public/state_model');

        //$this->load->model('public/menus_model');
        $appId = $this->config->item('FBappId');
        $secret = $this->config->item('FBsecret');
        $this->load->library('common/facebook',array('appId' => $appId,
           'secret' => $secret)); 
         $this->metaTitle = getThemeValue('meta_title');
        $this->metakeyword = getThemeValue('meta_keywords');
        $this->metadescription = getThemeValue('meta_desc');
    }
    function dashboard(){
        if(!isset($_SESSION['customer'])){
            show_404();
        }
        $user = $this->customer_model->getUserDetails(trim($_SESSION['customer']['email']));
        $this->data['states'] = $this->state_model->getAllState(); 
        
            $this->data['orders'] = $this->orders_model->getOrderByuseremail($user['email']);        
            if(count($this->data['orders'])){
                foreach($this->data['orders'] as $key => $order){
                    $orderItems = $this->orderitems_model->getListitems($order->id);
                     $this->data['orders'][$key]->orderItems  = $orderItems;
                }
            }
            $this->data['user'] = $user;
            $this->template->render('public/customer/dashboard',$this->data);
     
    }
    function passwordupdate(){
        if(!isset($_SESSION['customer'])){
            show_404();
        }
        $user = $this->customer_model->getUserDetails(trim($_SESSION['customer']['email']));
        $currentPassword = $user['password'];
        if(trim($_POST['oldpassword']) != trim($currentPassword)){
            $this->session->set_flashdata('error','Incorrect Old Password');
            redirect('/user/dashboard','refresh');
        }
        $data = array();
        $user_id = $user['id'];
        $data['password'] = $this->input->post('password');
        $data['password'] = trim($data['password']);
        $this->customer_model->update($data,$user_id);
        $this->session->set_flashdata('success','Password Changed Successfully');
        redirect('/user/dashboard','refresh');
    }
    function profileupdate(){
        //pr($_SESSION['customer']); die();
        if(!isset($_SESSION['customer'])){
            show_404();
        }
        $user = $this->customer_model->getUserDetails(trim($_SESSION['customer']['email']));
        $data = array();
        $user_id = $user['id'];        
        $data['fullname'] = $this->input->post('name');
        $data['mobile'] = $this->input->post('phone');
        $data['phone'] = $this->input->post('phone');        
        $data['fax'] = $this->input->post('fax');        
        $data['company'] = $this->input->post('company');        
        $data['address1'] = $this->input->post('address1');
        $data['address2'] = $this->input->post('address2');
        $data['state'] = $this->input->post('state');
        $data['city'] = $this->input->post('city');
        $data['pincode'] = $this->input->post('pincode');
        $this->customer_model->update($data,$user_id);
        $_SESSION['customer']['fullname'] = $data['fullname'];
        $_SESSION['customer']['phone'] = $data['mobile'];

        $this->session->set_flashdata('success','Profile Updated Successfully');
        redirect('/user/dashboard','refresh');


    }
    function googlelogin(){
        if (isset($_GET['code'])) {
            $this->googleplus->getAuthenticate();
            $data = $this->googleplus->getUserInfo();
            
            $exists = $this->customer_model->checkSocialUserExists($data['id'],'google_id');
            if($exists){
                $this->customer_model->getSocialUser($data['id'],'google_id');
            }else{
                $user = $this->customer_model->saveSocialUser($data,'google');
            }
            $customerArray = array('customer'=>array());
            $customerArray['customer']['username'] = $user['username'];
            $customerArray['customer']['email']= $user['email'];
            $customerArray['customer']['loggedin'] = 1;
            $customerArray['customer']['fullname']= $user['fullname'];
            $this->session->set_userdata($customerArray);
            if(isset($_COOKIE['socialRedirect'])){
                header('location:'.$_COOKIE['socialRedirect']);
                exit;
            }
        } 
        redirect('/','refresh');
    }
    function fblogin(){
        $user = $this->facebook->getUser();
        if ($user) {
            $exists =  $this->customer_model->checkSocialUserExists($user,'fb_id');
            $data = $this->facebook->api('/me?fields=name,email');
            if($exists){
                $user = $this->customer_model->getSocialUser($user,'fb_id');
            }else{
                 $user = $this->customer_model->saveSocialUser($data,'facebook');
            }
           
            $customerArray = array('customer'=>array());
            $customerArray['customer']['username'] = $user['username'];
            $customerArray['customer']['email']= $user['email'];
            $customerArray['customer']['loggedin'] = 1;
            $customerArray['customer']['fullname']= $user['fullname'];
            $this->session->set_userdata($customerArray);
             if(isset($_COOKIE['socialRedirect'])){
                header('location:'.$_COOKIE['socialRedirect']);
                exit;
            }
        }
        redirect('/','refresh');
    }
    

    public function login(){
    	$email = $this->input->post('email');
    	$password = $this->input->post('password');
    	$user = $this->customer_model->login($email,$password);    	
    	if(is_null($user)){
    		echo '';
    	}else{
    		$customerArray = array('customer'=>array());    		
            $customerArray['customer']['id']= $user->id;
    		$customerArray['customer']['email']= $user->email;
    		$customerArray['customer']['loggedin'] = 1;
    		$customerArray['customer']['phone']= $user->phone;
    		$customerArray['customer']['fullname']= $user->fullname;
    		$this->session->set_userdata($customerArray);
    		echo json_encode($customerArray);
    	}
    }
    function signup(){
        $user = $this->customer_model->signup($_POST);
        if($user){ 
            $customerArray = array('customer'=>array());            
            $customerArray['customer']['id']= $user['id'];
            $customerArray['customer']['email']= $user['email'];
            $customerArray['customer']['loggedin'] = 1;
            $customerArray['customer']['phone']= $user['mobile'];
            $customerArray['customer']['fullname']= $user['fullname'];
            $this->session->set_userdata($customerArray);
            echo 'true';
        }else{
            echo 'false';
        }
    }
     function checkoutSignup(){
        $user = $this->customer_model->signup($_POST);
        if($user){ 
            $customerArray = array('customer'=>array());            
            $customerArray['customer']['id']= $user['id'];
            $customerArray['customer']['email']= $user['email'];
            $customerArray['customer']['loggedin'] = 1;
            $customerArray['customer']['phone']= $user['mobile'];
            $customerArray['customer']['fullname']= $user['fullname'];
            $this->session->set_userdata($customerArray);
            echo 'true';
        }else{
            echo 'false';
        }
    }
    function logout(){
        $this->session->sess_destroy();
    	$this->session->unset_userdata('customer');
        // $this->googleplus->revokeToken();
        // $this->facebook->destroySession();
    	redirect('/','refresh');
    }
 
    function userExists(){
        $email = trim($this->input->get('email'));
    
        $user = $this->customer_model->checkUserExists($email);
        echo $user ? 'false' : 'true';
    }
    function forgot(){       
        $email = trim($this->input->post('email'));
        $user = $this->customer_model->checkUserExists($email);        
        $jsonArr = array('status'=>0,'msg'=>'');
        if(!$user){
            $jsonArr['status'] = 0;
            $jsonArr['msg'] = 'Email not exists';
        }else{
            $userData = $this->customer_model->getUserByEmail($email);

            if($userData->is_active != '1'){
                $jsonArr['status'] = 0;
                $jsonArr['msg'] = 'You are not active user';
            }else{
                $jsonArr['status'] = 1;
                $jsonArr['msg'] = 'New Password sent to your email.';

                ////////  Sending Mail for Forgot password ////
            $newPassword = rand(0,9).rand(0,9).rand(0,9).rand(0,9);            
            $updateArray = array('password'=>$newPassword);
            $this->customer_model->update($updateArray,$userData->id);
            $attributes['fullname']      = ucwords($userData->fullname);
            $attributes['password']        = $newPassword;
            $subject ="Forgot Password";
            $message = $this->load->view('email-templates/public/forgotpassword', $attributes, true);            
            $isMailSent = send_mail($userData->email,$subject,$message,'html');
                ////////////////////////////////////////
            }
            
        }
        echo json_encode($jsonArr);
    }

    public function ajaxpostValue(){        
        $returnArray = array('msg'=>'','status'=>1);
        if($_POST['type'] == 'register' || $_POST['type'] == '' ){
            $user = $this->customer_model->checkoutSignup($_POST);
            $_SESSION['checkout']['type'] = 'registered';            
            $_SESSION['checkout']['email'] = $user['email'];
            $_SESSION['checkout']['fullname']= $user['fullname'];            
            $_SESSION['checkout']['phone']= $user['phone'];
            $_SESSION['checkout']['company']= $user['company'];
            $_SESSION['checkout']['address1']= $user['address1'];
            $_SESSION['checkout']['address2']= $user['address2'];
            $_SESSION['checkout']['city']= $user['city'];
            $_SESSION['checkout']['state']= $user['state'];
            $_SESSION['checkout']['pincode']= $user['pincode'];
        }else{            
            $user = $this->customer_model->checkUserExists($_POST['email']);
            if($user)            {
                $returnArray['status'] = 0;
            }else{
                $_SESSION['checkout']['type']       = 'guest';            
                $_SESSION['checkout']['email']      = $_POST['email'];
                $_SESSION['checkout']['fullname']   = $_POST['name'];            
                $_SESSION['checkout']['phone']      = $_POST['phone'];
                $_SESSION['checkout']['company']    = $_POST['company'];
                $_SESSION['checkout']['address1']   = $_POST['address1'];
                $_SESSION['checkout']['address2']   = $_POST['address2'];
                $_SESSION['checkout']['city']       = $_POST['city'];
                $_SESSION['checkout']['state']      = $_POST['state'];
                $_SESSION['checkout']['pincode']    = $_POST['pincode'];                     
            }
        }
        
        echo json_encode($returnArray);

  }

    function recoverPassword($str){
        $user = $this->customer_model->checkForgotpasswordStr($str);
        if(is_null($user)){
            show_404();  
        }else{
            $this->data['userid'] = $user->id;
            $this->template->render('public/customer/recoverPassword', $this->data);
        }
    }
    function recoverPasswordForm(){
       $userid = $this->input->post('userid');
       $password = $this->input->post('password');
       $this->customer_model->recoverPassword($password,$userid);
       $this->session->set_flashdata('success_msg', 'Password Reset successfully');
    }
}