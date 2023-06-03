<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Theme extends Admin_Controller {
	public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->page_title->push(lang('menu_theme_options'));
        $this->data['pagetitle'] = $this->page_title->show();

        $this->lang->load('admin/theme');
        $this->load->helper('number','common');
        $this->load->model('admin/theme_model');
        if ( ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
    }
    public function index(){    		
    	$this->data['pagetitle'] = $this->page_title->show();
    	$this->breadcrumbs->unshift(2, lang('menu_theme_options'), 'admin/theme/');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->template->admin_render('admin/theme/index', $this->data);
    }
    public function create($saleid = 0){
    	$this->breadcrumbs->unshift(2, lang('menu_theme'), 'admin/theme/');
		$this->theme_model->manageThemeSettings($_POST);
		$this->session->set_flashdata('success_msg', 'Theme settings updated Successfully');
		redirect('admin/theme','refresh');
    }
}