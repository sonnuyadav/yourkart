<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends Admin_Controller {

   public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->page_title->push(lang('menu_category'));
        $this->data['pagetitle'] = $this->page_title->show();

        $this->lang->load('admin/category');
        $this->load->helper('number','common');
        
        $this->load->model('admin/page_model');
        $this->load->model('admin/category_model');
        $this->load->model('admin/menu_model');
        if ( ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
    }


	public function index(){
      if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {  
 

    /* Breadcrumbs */
      
      $this->data['breadcrumb'] = $this->breadcrumbs->show();

      $this->data['category']     =   $this->category_model->getCategoryForMenu();
      $this->data['pages']     =   $this->page_model->getpageForMenu();

      $html = '';
      $this->menu_model->getMenu($html);
     // pr($html); die();
      $this->data['menuhtml'] =  htmlentities($html);
      $this->template->admin_render('admin/menu/index', $this->data);
       } 

    }
    function saveItem(){
      $insertArray = array();
      $insertArray['slug'] = $_POST['slug'];
      $insertArray['type'] = $_POST['type'];
      $insertArray['title'] = $_POST['value'];
      $insertArray['menu_type'] = 'footer1';
       $insertArray['ordering'] = 100;
      $this->menu_model->insert($insertArray);
      $this->session->set_flashdata('success_msg', 'Menu Added Successfully');
      redirect('admin/menu', 'refresh');
    }

    function setMenu(){
      $menu = json_decode($_POST['menu'],true);
      $this->menu_model->setMenu($menu);
    }

    function deleteMenu(){
      $deleteArray = array();
      $deleteArray['id'] = $_POST['id'];
      $this->menu_model->deleteRow($_POST['id']);
      
      $updateArray = array();
      $updateArray['parent'] = 0;
      $whare = array();
      $whare['parent'] = $_POST['id'];
      $this->menu_model->db->where('parent='.$_POST['id']);
      $this->menu_model->updateMenu($updateArray);
      $this->session->set_flashdata('success_msg', 'Menu Deleted Successfully');
      redirect('admin/menu', 'refresh');
      
    }

}
