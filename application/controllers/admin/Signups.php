<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Signups extends Admin_Controller {
	public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->page_title->push(lang('menu_signup'));
        $this->lang->load('admin/signup');
        $this->data['pagetitle'] = $this->page_title->show();
      	$this->load->model('admin/signup_model');
        if ( ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
    }
    public function index(){
    	$this->data['pagetitle'] = $this->page_title->show();
    	$this->breadcrumbs->unshift(2, lang('menu_signup'), 'admin/signup/');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['signups']       = $this->signup_model->getAll();
		$this->template->admin_render('admin/signup/index', $this->data);
    }
    function changestatus($id,$status){
        $newStatus = '1';
        if($status == '1'){
            $newStatus = '0';
        }
        $update  = array();
        $update['status'] = $newStatus;
        $this->signup_model->update($update,$id);
        $this->session->set_flashdata('success_msg','Status Changed');
        redirect('/admin/signups');

    }
    
}