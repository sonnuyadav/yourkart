<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends Admin_Controller {
	public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->page_title->push(lang('menu_template'));
        $this->data['pagetitle'] = $this->page_title->show();

        $this->lang->load('admin/templates');
        $this->load->helper('number');
        $this->load->model('admin/template_model');
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
    }
    public function index(){
    	
    	$this->page_title->push(lang('blog_templates_view'));
    	$this->data['pagetitle'] = $this->page_title->show();
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['count_template']       = $this->template_model->get_count_record();
		$this->data['templates']       = $this->template_model->getAll();
		$this->template->admin_render('admin/blogTemplates/index', $this->data);
    }
    public function create($id=0){
    	
    	/* Breadcrumbs */

    	if(!is_numeric($id)){
    		$this->session->set_flashdata('error_msg', 'Invalid Template');
			redirect('admin/templates','refresh');
    	}
        $this->breadcrumbs->unshift(2, lang('menu_template'), 'admin/templates/');
        if($id){
    		$this->breadcrumbs->unshift(3, lang('template_edit'), 'admin/template/create');
    		$this->data['subtitle'] = lang('template_edit');
    	}else{

			$this->breadcrumbs->unshift(3, lang('template_add'), 'admin/template/create');
			$this->data['subtitle'] = lang('template_add');
    	}

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

       
		/* Validate form input */
		$this->form_validation->set_rules('name', 'lang:template_name', 'required');
		
		// $this->form_validation->set_rules('html', 'lang:template_html', 'required');
		
		
		

		if ($this->form_validation->run() == TRUE )
		{
			//var_dump($this->input->post('html')); die();
            $tempdata = array();
			$tempdata['title'] 		= $this->input->post('name');
			$tempdata['html'] 	= base64_encode($this->input->post('html'));
			$tempdata['image'] 	= $this->input->post('image');
			$status = $this->input->post('status');
			$tempdata['status'] 		= is_null($status) ? '0' : '1';
			if(!$id){
				
				$this->template_model->insert($tempdata); 
				$this->session->set_flashdata('success_msg', 'Template Added Successfully');
				redirect('admin/templates','refresh');
			}else{
				
				$this->template_model->update($tempdata,$id); 
				$this->session->set_flashdata('success_msg', 'Template Updated Successfully');
				redirect('admin/templates','refresh');
			}	
		}
		else
		{
            $this->data['validation_message'] = validation_errors();

            $inputValues = array();
            if(!$id){
				$inputValues['name'] = $this->form_validation->set_value('name');
				$inputValues['image'] = $this->form_validation->set_value('image');
				$inputValues['html'] = $this->form_validation->set_value('html');
				$inputValues['status'] = $this->form_validation->set_value('status');
				
            }else{
            	$this->template_model->db->where(array('id'=>$id));
            	$tempData = $this->template_model->db->get_where($this->template_model->table)->row();
            	if(!is_null($tempData)){
            		$inputValues['name'] = $tempData->title;
            		$inputValues['image'] = $tempData->image;
            		$inputValues['html'] = base64_decode($tempData->html)	;
            		$inputValues['status'] = $tempData->status;
            		
            	}else{
            		$this->session->set_flashdata('error_msg', 'Invalid Template');
					redirect('admin/template','refresh');
            	}
            }



			$this->data['name'] = array(
				'name'  => 'name',
				'id'    => 'name',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $inputValues['name'],
			);
			$this->data['image'] = array(
				'name'  => 'image',
				'id'    => 'image',
				'type'  => 'file',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('image'),
			);
			$this->data['html'] = array(
				'name'  => 'html',
				'id'    => 'html',
				'type'  => 'textarea',
                'class' => 'form-control',
				'value' => $inputValues['html'],
			);
			$this->data['status'] = array(
				'name'  => 'status',
				'id'    => 'status',
				'type'  => 'checkbox',
                'class' => 'form-control',
				'value' => $inputValues['status'],
			);
			if($inputValues['status'] == '1'){
				$this->data['status']['checked'] = 'checked';
			}
			

            /* Load Template */
            $this->template->admin_render('admin/blogTemplates/create', $this->data);
        }


    }
}
