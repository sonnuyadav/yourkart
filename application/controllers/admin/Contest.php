<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contest extends Admin_Controller {
	public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->page_title->push(lang('menu_contest'));
        $this->lang->load('admin/contest');
        $this->data['pagetitle'] = $this->page_title->show();
      	$this->load->model('admin/contest_model');
        if ( ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
    }
    public function index(){
    	$this->data['pagetitle'] = $this->page_title->show();
    	$this->breadcrumbs->unshift(2, lang('menu_contest'), 'admin/contest/');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['contests']       = $this->contest_model->getAll();
		$this->template->admin_render('admin/contest/index', $this->data);
    }
    function changestatus($id,$status){
        $newStatus = '1';
        if($status == '1'){
            $newStatus = '0';
        }
        $update  = array();
        $update['status'] = $newStatus;
        $this->contest_model->update($update,$id);
        $this->session->set_flashdata('success_msg','Status Changed');
        redirect('/admin/contest');
    }
    function delete($id){
        
        $this->contest_model->deleteRow($id);
        $this->session->set_flashdata('success_msg', 'User Deleted');
        redirect('admin/contest', 'refresh');
    }
   
    
}