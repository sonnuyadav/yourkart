<?php
//This is post controller
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Admin_Controller {
    public function __construct()
    { 
        parent::__construct(); 
        $this->page_title->push(lang('menu_customer'));
        $this->data['pagetitle'] = $this->page_title->show();
        $this->lang->load('admin/customer');
        $this->lang->load('admin/orders');
        $this->load->model('admin/customer_model');
        $this->load->model('admin/orders_model');
       if ( ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }

    }

     public function index(){
         $this->data['pagetitle'] = $this->page_title->show();
        $this->breadcrumbs->unshift(2, lang('menu_customer'), 'admin/orders/');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
       $this->data['customers']      = $this->customer_model->getAllCustomers();
       $countCustomer = count($this->customer_model->getAllCustomers());

    for($i=0; $i<count($this->data['customers']);$i++){
          $totalAmount = 0;
          
          $this->data['customers'][$i]->orderCount = 0;
          //$totalamount = $this->orders_model->getAmountByCustomers($this->data['customers'][$i]->id);
          $totalamount = 0;
          
          $this->data['customers'][$i]->orderCount = $this->orders_model->getUserOrderCount($this->data['customers'][$i]->id);
 
         $this->data['customers'][$i]->orderAmount = $this->orders_model->getUserOrderSum($this->data['customers'][$i]->id);
         }
        // pr($this->data['customers']); die();
       $this->template->admin_render('admin/customer/index', $this->data);
    }

    function viewdetails($id = 0){
      $this->data['pagetitle'] = $this->page_title->show();
      $this->breadcrumbs->unshift(2, lang('menu_customer'), 'admin/orders/');
      $this->data['breadcrumb'] = $this->breadcrumbs->show();
      $this->data['customer'] = $this->customer_model->getUserById($id);
      $this->data['orders'] = $this->orders_model->getOrderByuserid($id);
      $this->template->admin_render('admin/customer/viewdetails', $this->data);
    }
}