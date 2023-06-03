<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends Admin_Controller {
	public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->page_title->push(lang('menu_brand'));
        $this->data['pagetitle'] = $this->page_title->show();

        $this->lang->load('admin/brand');
        $this->load->helper('number','common');
        $this->load->model('admin/brand_model');
        if ( ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
    }
    public function index(){
    		
    	

    	$this->data['pagetitle'] = $this->page_title->show();
    	$this->breadcrumbs->unshift(2, lang('menu_brand'), 'admin/brand/');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['count_brand']       = $this->brand_model->get_count_record();
		$this->data['brands']       = $this->brand_model->getAll();
		$this->template->admin_render('admin/brand/index', $this->data);
    }
    public function create($brandid = 0){
    	$this->data['image'] = '';
    	$this->data['thumbimage'] = '';
    	$image = isset($_POST['image'])  ? $_POST['image'] : '';
    	if(!empty($_FILES['file']['name'])){
    		$option = array(
    			'thumb'=>
    				array(50,50),				
				'medium'=>
    				array(150,250),
				'large'=>
    				array(600,800)
    			);
    		$image  = imgUpload($option);
    	}	
    	//var_dump($image); die();
    	if(!is_numeric($brandid)){
    		$this->session->set_flashdata('error_msg', 'Invalid Brand');
			redirect('admin/brands','refresh');
    	}
    	
    	$this->breadcrumbs->unshift(2, lang('menu_brand'), 'admin/brands/');
    	if($brandid){
    		$this->breadcrumbs->unshift(3, lang('brand_edit'), 'admin/brands/create');
    		$this->data['subtitle'] = lang('brand_edit');
    	}else{

			$this->breadcrumbs->unshift(3, lang('brand_add'), 'admin/brands/create');
			$this->data['subtitle'] = lang('brand_add');
    	}
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
       $this->data['sliders'] = array();	
        
        /* Variables */
		
		/* Validate form input */
		$this->form_validation->set_rules('title', 'lang:brand_name', 'required');
	
		if ($this->form_validation->run() == TRUE)
		{	
			
			$branddata['title'] 		= $this->input->post('title');
			$branddata['description'] = $this->input->post('description');
			$branddata['metatitle'] 	= $this->input->post('metatitle');
			$branddata['metakeyword'] = $this->input->post('metakeyword');
			$branddata['metadesc'] 	= $this->input->post('metadesc');
			$branddata['image'] 	= $image;
			$status = $this->input->post('status');
			$branddata['status'] 		= is_null($status) ? '0' : '1';
			$featured = $this->input->post('featured');
			$branddata['featured'] 		= is_null($featured) ? '0' : '1';
			if(!$brandid){
				$slug 					= create_slug($branddata['title']);
				$branddata['nicename'] 	= $this->brand_model->checkExistingNiceName($slug);
				$branddata['doe'] 		= date('Y-m-d H:i:s');
				$brandid = $this->brand_model->insert($branddata); 
				$this->session->set_flashdata('success_msg', 'Brand Added Successfully');
				redirect('admin/brands','refresh');
			}else{
				$branddata['dou'] 		= date('Y-m-d H:i:s');
				$this->brand_model->update($branddata,$brandid); 
				$this->session->set_flashdata('success_msg', 'Brand Updated Successfully');
				redirect('admin/brands','refresh');
			}		 	
		}
		else
		{	
			
			$this->data['validation_message'] = validation_errors();
			
            $inputValues = array();
            if(!$brandid){
				$inputValues['title'] = $this->form_validation->set_value('title');
				$inputValues['description'] = $this->form_validation->set_value('description');
				$inputValues['metatitle'] = $this->form_validation->set_value('metatitle');
				$inputValues['status'] = $this->form_validation->set_value('status');
				$inputValues['featured'] = $this->form_validation->set_value('featured');
				$inputValues['is_menu'] = $this->form_validation->set_value('is_menu');
				$inputValues['metakeyword'] = $this->form_validation->set_value('metakeyword');
				$inputValues['metadesc'] = $this->form_validation->set_value('metadesc');
            }else{
            	$this->brand_model->db->where(array('id'=>$brandid));
            	$branddata = $this->brand_model->db->get_where($this->brand_model->table)->row();
            	$this->brand_model->db->where(array('cat_id'=>$brandid));
            	
            	if(!is_null($branddata)){
            		$this->data['postImage'] = $branddata->image;
            		$inputValues['title'] = $branddata->title;
            		$inputValues['description'] = $branddata->description;
            		$inputValues['metatitle'] = $branddata->metatitle;
            		$inputValues['status'] = $branddata->status;
            		$inputValues['featured'] = $branddata->featured;
            		$inputValues['metakeyword'] = $branddata->metakeyword;
            		$inputValues['metadesc'] = $branddata->metadesc;
            		$this->data['image'] = $branddata->image;
            		$this->data['thumbimage'] = getThumb($branddata->image);
            	}else{
            		$this->session->set_flashdata('error_msg', 'Invalid  Brand');
					redirect('admin/brands','refresh');
            	}
            }
			$this->data['cattitle'] = array(
				'name'  => 'title',
				'id'    => 'title',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $inputValues['title'],
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'textarea',
                'class' => 'form-control',
				'value' => $inputValues['description'],
			);
			$this->data['metatitle'] = array(
				'name'  => 'metatitle',
				'id'    => 'metatitle',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $inputValues['metatitle'],
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
			
			$this->data['featured'] = array(
				'name'  => 'featured',
				'id'    => 'featured',
				'type'  => 'checkbox',
                'class' => 'form-control',
				'value' => $inputValues['featured'],
			);
			if($inputValues['featured'] == '1'){
				$this->data['featured']['checked'] = 'checked';
			}
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
            $this->template->admin_render('admin/brand/create', $this->data);
        }

    }
    function delete($id){
    	
    	$this->brand_model->deleteRow($id);
    	$this->session->set_flashdata('success_msg', 'Brand Deleted Successfully');
		redirect('admin/brands', 'refresh');
    }
}