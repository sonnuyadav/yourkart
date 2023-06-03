<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends Admin_Controller {
	public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->page_title->push(lang('menu_page'));
        $this->data['pagetitle'] = $this->page_title->show();

        $this->lang->load('admin/page');
        $this->load->helper('number','common');
        $this->load->model('admin/page_model');
        if ( ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
    }
    public function index(){
    		
    	

    	$this->data['pagetitle'] = $this->page_title->show();
    	$this->breadcrumbs->unshift(2, lang('menu_page'), 'admin/page/');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['count_brand']       = $this->page_model->get_count_record();
		$this->data['pages']       = $this->page_model->getAll();
		$this->template->admin_render('admin/page/index', $this->data);
    }
    public function create($ID = 0){
    	if(!is_numeric($ID)){
    		$this->session->set_flashdata('error_msg', 'Invalid Brand');
			redirect('admin/page','refresh');
    	}
    	
    	$this->breadcrumbs->unshift(2, lang('menu_page'), 'admin/page/');
    	if($ID){
    		$this->breadcrumbs->unshift(3, lang('page_edit'), 'admin/page/create');
    		$this->data['subtitle'] = lang('page_edit');
    	}else{

			$this->breadcrumbs->unshift(3, lang('page_add'), 'admin/page/create');
			$this->data['subtitle'] = lang('page_add');
    	}
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		
		/* Validate form input */
		$this->form_validation->set_rules('title', 'lang:page_name', 'required');
	
		if ($this->form_validation->run() == TRUE)
		{	
			
			$DATA['title'] 			= $this->input->post('title');
			$DATA['content'] 		= htmlentities($this->input->post('content'));
			$DATA['metatitle'] 		= $this->input->post('metatitle');
			$DATA['metakeyword'] 	= $this->input->post('metakeyword');
			$DATA['metadesc'] 		= $this->input->post('metadesc');
			if(!$ID){
				$slug 					= create_slug($DATA['title']);
				$DATA['nicename'] 	= $this->page_model->checkExistingNiceName($slug);
				$DATA['doe'] 		= date('Y-m-d H:i:s');
				$ID = $this->page_model->insert($DATA); 
				$this->session->set_flashdata('success_msg', 'Brand Added Successfully');
				redirect('admin/page','refresh');
			}else{
				$DATA['dou'] 		= date('Y-m-d H:i:s');
				$this->page_model->update($DATA,$ID); 
				$this->session->set_flashdata('success_msg', 'Page Updated Successfully');
				redirect('admin/page','refresh');
			}		 	
		}
		else
		{	
			
			$this->data['validation_message'] = validation_errors();
			
            $inputValues = array();
            if(!$ID){
				$inputValues['title'] = $this->form_validation->set_value('title');
				$inputValues['content'] = $this->form_validation->set_value('content');
				$inputValues['metatitle'] = $this->form_validation->set_value('metatitle');
				$inputValues['metakeyword'] = $this->form_validation->set_value('metakeyword');
				$inputValues['metadesc'] = $this->form_validation->set_value('metadesc');
            }else{
            	$this->page_model->db->where(array('id'=>$ID));
            	$DATA = $this->page_model->db->get_where($this->page_model->table)->row();
            	$this->page_model->db->where(array('cat_id'=>$ID));
            	
            	if(!is_null($DATA)){
            		$inputValues['title'] = $DATA->title;
            		$inputValues['content'] = html_entity_decode($DATA->content);
            		$inputValues['metatitle'] = $DATA->metatitle;
            		$inputValues['metakeyword'] = $DATA->metakeyword;
            		$inputValues['metadesc'] = $DATA->metadesc;
            		
            	}else{
            		$this->session->set_flashdata('error_msg', 'Invalid  Page');
					redirect('admin/page','refresh');
            	}
            }
			$this->data['cattitle'] = array(
				'name'  => 'title',
				'id'    => 'title',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $inputValues['title'],
			);
			$this->data['content'] = array(
				'name'  => 'content',
				'id'    => 'content',
				'type'  => 'textarea',
                'class' => 'form-control tinyMce',
				'value' => $inputValues['content'],
			);
			$this->data['metatitle'] = array(
				'name'  => 'metatitle',
				'id'    => 'metatitle',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $inputValues['metatitle'],
			);
			$this->data['metakeyword'] = array(
				'name'  => 'metakeyword',
				'id'    => 'metakeyword',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $inputValues['metakeyword'],
			);
			$this->data['metadesc'] = array(
				'name'  => 'metadesc',
				'id'    => 'metadesc',
				'type'  => 'textarea',
                'class' => 'form-control',
				'value' => $inputValues['metadesc'],
			);
            /* Load Template */
            $this->template->admin_render('admin/page/create', $this->data);
        }
    }
    function delete($id){
    	$this->page_model->deleteRow($id);
    	$this->session->set_flashdata('success_msg', 'Page Deleted Successfully');
		redirect('admin/page', 'refresh');
    }
}