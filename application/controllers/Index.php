<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends Public_Controller {
 
    public function __construct()
    {
        
        parent::__construct();
       
        $this->load->model('admin/theme_model');
        $this->load->model('admin/slider_model');
        $this->load->model('admin/product_model');
        $this->load->model('admin/category_model');
        $this->load->model('admin/signup_model');
        
        $this->metaTitle = getThemeValue('meta_title');
        $this->metakeyword = getThemeValue('meta_keywords');
        $this->metadescription = getThemeValue('meta_desc');
    }

  public function index()
	{ 
        $this->data['sliders'] = $this->slider_model->getAll(true);
        $catids  = array(12,25,17,13,26,14,15,20,27);
        $this->data['homelinksCount'] = $this->product_model->getHomelinkCount($catids);
        $category = $this->category_model->getHomecategory();        
        if(count($category)){
            foreach($category as $key => $cats){
                $products = $this->product_model->getHomeProducts($cats->id);
                if(count($products)){                    
                    $category[$key]->products = $products;
                }else{
                    unset($category[$key]);
                }

            }
        }
        $this->data['horizantlemenu'] = $this->load->view('public/_templates/verticalmenu',$this->data,true);
        $this->data['products'] = $category;
        $this->template->render('public/home/index', $this->data);
	}
    function page($page = ''){
        $this->load->model('admin/page_model');
        $this->data['page'] = $this->page_model->getAll($page);
        if(is_null($this->data['page'])){
            show_404();
        }

        $this->template->render('public/page/index', $this->data);

    }
    function contact(){        
        $this->template->render('public/page/contact', $this->data);
    }
    function contest(){        
        $this->template->render('public/page/contest', $this->data);
    }
    function contest_submit(){        
        $this->load->model('admin/contest_model');
        $attributes['name']      = ucwords($_POST['name']);   
        $attributes['email']     = $_POST['email']; 
        $attributes['phone']        = $_POST['phone']; 
        $attributes['city']        = $_POST['city'];         
        $attributes['doe']        = date('Y-m-d H:i:s');         
        $adminmail = 'saifi.sahiq@gmail.com';
        $adminmail = 'info@globalproductsshopping.com';
        $subject ="GPS Contest Participation"; 
        $this->contest_model->insert($attributes);
        if(!islocal()){
          $messageuser = $this->load->view('email-templates/public/contest_user.php', $attributes, true);
        $messageadmin = $this->load->view('email-templates/public/contest_admin.php', $attributes, true);
          $isMailSent = send_mail($attributes['email'],$subject,$messageuser,'html');
          $isMailSent = send_mail($adminmail,$subject,$messageadmin,'html');
        }
        $this->session->set_flashdata('success_msg','Thanks for your participation in contest');
        redirect('contest','refresh');

    }
    function contact_form(){        
       
        $attributes['name']      = ucwords($_POST['name']);   
        $attributes['email']     = $_POST['email']; 
        $attributes['phone']        = $_POST['phone']; 
        $attributes['message']        = $_POST['message'];         
        $adminmail = 'info@globalproductsshopping.com';
        $subject ="GPS Contact Form"; 
        if(!islocal()){
          $messageuser = $this->load->view('email-templates/public/contact_user.php', $attributes, true);
        $messageadmin = $this->load->view('email-templates/public/contact_admin.php', $attributes, true);
          $isMailSent = send_mail($attributes['email'],$subject,$messageuser,'html');
          $isMailSent = send_mail($adminmail,$subject,$messageadmin,'html');
        }
        $this->session->set_flashdata('success_msg','Form submitted successfully');
        redirect('contactus','refresh');

    }

    public function signupcreate(){
        $return = array('msg'=>'','status'=>0);
    //pr($_POST); die();
      $email = $_POST['email'];
      $insertArray  = array();
      $insertArray['email'] = $email;
      $insertArray['doe'] = date('Y-m-d H:i:s');
    
  //    var_dump($this->signup_model->checkExisting($email)); die();
      if(!$this->signup_model->checkExisting($email)){
        $newletterid = $this->signup_model->insert($insertArray);
        //$newletterid = base64_encode($newletterid);

        $attributes['email']     = $_POST['email']; 
        $attributes['unsubsURL']     = 'newletter_unsubscribe/'.$newletterid; 
        $adminmail = 'info@globalproductsshopping.com';
        $subject ="GPS Newsletter Signup"; 
        if(!islocal()){

          $messageuser = $this->load->view('email-templates/public/newsletter_user.php', $attributes, true);
        $messageadmin = $this->load->view('email-templates/public/newsletter_admin.php', $attributes, true);        
          $isMailSent = send_mail($attributes['email'],$subject,$messageuser,'html');
          $isMailSent = send_mail($adminmail,$subject,$messageadmin,'html');
        }

        $return['msg'] = "We've got your email id & will keep you updated";
        $return['status'] = 1;
      }else{
        $return['msg'] = 'Email Already signed up';
        $return['status'] = 0;
      }
     echo json_encode($return);
  }
  function newletter_unsubscribe($newsletterid){
    $this->signup_model->db->where('id',$newsletterid);
    $data = $this->signup_model->db->get($this->signup_model->table)->row();
    
    if($data->status == 0){
        $this->session->set_flashdata('newsletter_msg', 'Newletter already unsubscribed');    
    }else{
        $updateData = array();
        $updateData['status'] = '0';
        $this->signup_model->update($updateData,$newsletterid);
        $this->session->set_flashdata('newsletter_msg', 'Newletter unsubscribed successfully');    
    }
    redirect(base_url(),'refresh');
  }

  
}
