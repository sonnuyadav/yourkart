<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Admin_Controller {
	public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->page_title->push(lang('menu_orders'));
        $this->data['pagetitle'] = $this->page_title->show();
        $this->TemaplateAssetsUrl = base_url('assets/templates/');
        $this->lang->load('admin/orders');
        $this->load->helper('number','common');
        $this->load->model('admin/orders_model');
        $this->load->model('admin/orderitems_model');
        $this->load->model('admin/theme_model');
        if ( ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
    }
    public function index(){
    	$this->data['pagetitle'] = $this->page_title->show();
    	$this->breadcrumbs->unshift(2, lang('menu_orders'), 'admin/orders/');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['orders']       = $this->orders_model->getAllOrders();
       $this->template->admin_render('admin/order/index', $this->data);
    }

    public function changestatus(){
      $orderId = $this->input->get('oid');  
      $action = $this->input->get('action');  
    if(!is_numeric($orderId)){
            $this->session->set_flashdata('error_msg', 'Invalid Order Id');
            redirect('admin/orders','refresh');
        }

       if($action =='pending'){
             $subject = 'Your order has been received!';
              
          }else if($action =='shipped'){
            $subject = 'Your order has been Shipped!';
            $messages = 'Your order with the following details has been shipped and will reach you within few days';
          }else if($action =='canceled'){
            $subject = 'Your order has been cancelled';
            $messages = 'Your order with the following details has been cancelled';
          }

       $data = array();
     $this->data = $this->orders_model->getOrderDetailsById($orderId);   
      $completeaddress =  $this->data['order_address'] ." ". $this->data['order_landmark'] .",". $this->data['order_city'] .",".$this->data['order_zip']."-".$this->data['order_state'].",".$this->data['order_country'];
         $attributes['fullname']      = ucwords($this->data['name']);
         $attributes['tracking']        = $this->input->post('trackid');   
         $attributes['orderid']     = $this->data['invoice_id']; 
         $attributes['email']        = $this->data['emailid']; 
         $attributes['phone']        = $this->data['order_phone']; 
         $attributes['address']        = $completeaddress; 
         $attributes['table']        =  getOrderTable($orderId); 
         $attributes['messages']     = $messages; 
         $attributes['subjects']     = $subject; 
         $data['is_shiped'] = $action;
        $this->orders_model->update($data,$orderId);
 if(!islocal()){ 
  $message = $this->load->view('email-templates/admin/orderstatus', $attributes, true);
  $isMailSent = send_mail($this->data['emailid'],$subject,$message,'html');
  
  }
  $adminmail = 'info@globalproductsshopping.com';
  if(!islocal()){ 
  $message = $this->load->view('email-templates/admin/orderstatusadmin', $attributes, true);
  $isMailSent = send_mail($adminmail,$subject,$message,'html');
  
  }

  $this->session->set_flashdata('success_msg', 'Order status changed Successfully');
 redirect('admin/orders/','refresh');   

}

    public function viewdetails($oid =0){
        if(!is_numeric($oid)){
            $this->session->set_flashdata('error_msg', 'Invalid Order Id');
            redirect('admin/orders','refresh');
        }
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['pagetitle'] = $this->page_title->show();
        $this->data['order'] = $this->orders_model->getOrderDetailsById($oid); 
       //for send tracking on email
       $this->form_validation->set_rules('trackid', 'lang:order_tracking', 'required'); 
 
    if(isset($_POST['submit']) && $_POST['trackid'] !=""){
    if ($this->form_validation->run() == TRUE){
        $data = array();
     $this->data = $this->orders_model->getOrderDetailsById($oid);   
      $completeaddress =  $this->data['order_address'] ." ". $this->data['order_landmark'] .",". $this->data['order_city'] .",".$this->data['order_zip']."-".$this->data['order_state'].",".$this->data['order_country'];
         $attributes['fullname']      = ucwords($this->data['name']);
         $attributes['tracking']        = $this->input->post('trackid');   
         $attributes['orderid']     = $this->data['invoice_id']; 
         $attributes['email']        = $this->data['emailid']; 
         $attributes['phone']        = $this->data['order_phone']; 
         $attributes['address']        = $completeaddress; 
         $attributes['table']        =  getOrderTable($oid); 

         $data['tracking_no'] = $this->input->post('trackid');
        $this->orders_model->update($data,$oid);
 if(!islocal()){
  $subject ="Tracking Number";  
  $message = $this->load->view('email-templates/admin/couriertracking', $attributes, true);
  $isMailSent = send_mail($this->data['emailid'],$subject,$message,'html');
  
  }

  $this->session->set_flashdata('success_msg', 'Order tracking sent successfully');
  redirect('admin/orders/viewdetails/'.$oid,'refresh');
   }else{
     $this->data['validation_message'] = validation_errors();
  } 
    } 
      $this->data['tracking'] = array(
                'name'  => 'trackid',
                'id'    => 'trackid',
                'class' => 'form-control',
             );
        $this->data['orderid'] = array(
                'name'  => 'orderid',
                'id'    => 'orderid',
                'type'  => 'hidden',
                'class' => 'form-control',
                'value' => $oid,
            );
       $this->template->admin_render('admin/order/viewdetails', $this->data);  
    }
}