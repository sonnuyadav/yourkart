<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin_Controller {
	public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->page_title->push(lang('menu_category'));
        $this->data['pagetitle'] = $this->page_title->show();

        $this->lang->load('admin/category');
        $this->load->helper('number','common');
        $this->load->model('admin/category_model');
        if ( ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
    }
    public function index(){
    		
    	//$this->page_title->push(lang('menu_category'));

    	$this->data['pagetitle'] = $this->page_title->show();
    	$this->breadcrumbs->unshift(2, lang('menu_category'), 'admin/category/');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['count_category']       = $this->category_model->get_count_record();
		$this->data['category']       = $this->category_model->getAll();
		$this->template->admin_render('admin/category/index', $this->data);
    }
    public function create($cat_id = 0){        	
    	$previmage = isset($_POST['image'])  ? $_POST['image'] : '';
    	$image = isset($_POST['image'])  ? $_POST['image'] : '';    	
    	$fileflag  = 0;
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
    		$fileflag = 1;
    	}	
    	if(!empty($previmage)  && $fileflag){
    		$removeImg[] = 'upload/media/'.$previmage;
    		$removeImg[] = getThumb($previmage);
    		$removeImg[] = getMedium($previmage);
    		$removeImg[] = getLarge($previmage);
    		array_map('removeImg', $removeImg);    		
    	}
    	if(!is_numeric($cat_id)){
    		$this->session->set_flashdata('error_msg', 'Invalid Category');
			redirect('admin/category','refresh');
    	}
    	$this->data['cats'] = $this->category_model->getAllParent($cat_id);
    	$this->data['parentCat'] = 0;
    	$this->data['image'] = '';
    	$this->data['thumbimage'] = '';
    	$this->data['catFilters'] = array();
    	/* Breadcrumbs */
//    	$this->data['pagetitle'] = $this->page_title->show();

    	$this->breadcrumbs->unshift(2, lang('menu_category'), 'admin/category/');
    	if($cat_id){
    		$this->breadcrumbs->unshift(3, lang('category_edit'), 'admin/category/create');
    		$this->data['subtitle'] = lang('category_edit');
    	}else{

			$this->breadcrumbs->unshift(3, lang('category_add'), 'admin/category/create');
			$this->data['subtitle'] = lang('category_add');
    	}
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
        /* Variables */
		
		/* Validate form input */
		$this->form_validation->set_rules('title', 'lang:category_name', 'required');	
		if ($this->form_validation->run() == TRUE)
		{				
			$catdata['title'] 		= $this->input->post('title');
			$catdata['description'] = $this->input->post('description');
			$catdata['metatitle'] 	= $this->input->post('metatitle');
			$catdata['metakeyword'] = $this->input->post('metakeyword');
			$catdata['metadesc'] 	= $this->input->post('metadesc');
			$catdata['image'] 	= $image;
			$catdata['parent'] 	= $this->input->post('cat_parent');
			$status = $this->input->post('status');
			$catdata['status'] 		= is_null($status) ? '0' : '1';
			$featured = $this->input->post('featured');
			$catdata['featured'] 		= is_null($featured) ? '0' : '1';
			if(!$cat_id){
				$slug 					= create_slug($catdata['title']);
				$catdata['nicename'] 	= $this->category_model->checkExistingNiceName($slug);
				$catdata['doe'] 		= date('Y-m-d H:i:s');
				$cat_id = $this->category_model->insert($catdata); 	
				$this->session->set_flashdata('success_msg', 'Category Added Successfully');
			}else{
				$catdata['dou'] 		= date('Y-m-d H:i:s');
				$this->category_model->update($catdata,$cat_id); 
				$this->session->set_flashdata('success_msg', 'Category Updated Successfully');
			}
			if(isset($_POST['filter']) && count($_POST['filter'])){
				$this->category_model->insertFilter($_POST['filter'],$cat_id);    		
	    	}
	    	if(isset($_POST['oldFilter']) && count($_POST['oldFilter'])){
				$this->category_model->updateFilter($_POST['oldFilter']);    		
	    	}
	    	if(isset($_POST['delFilter']) && count($_POST['delFilter'])){
				$this->category_model->deleteFilter($_POST['delFilter']);    		
	    	}	
				//die();			
			redirect('admin/category','refresh');
		}
		else
		{	
			$this->data['validation_message'] = validation_errors();
			  $inputValues = array();
            if(!$cat_id){
				$inputValues['title'] = $this->form_validation->set_value('title');
				$inputValues['description'] = $this->form_validation->set_value('description');
				$inputValues['status'] = $this->form_validation->set_value('status');
				$inputValues['featured'] = $this->form_validation->set_value('featured');
				$inputValues['metakeyword'] = $this->form_validation->set_value('metakeyword');
				$inputValues['metatitle'] = $this->form_validation->set_value('metatitle');
				$inputValues['metadesc'] = $this->form_validation->set_value('metadesc');
            }else{
            	$this->category_model->db->where(array('id'=>$cat_id));
            	$catData = $this->category_model->db->get_where($this->category_model->table)->row();
            	if(!is_null($catData)){
            		$inputValues['title'] = $catData->title;
            		$inputValues['description'] = $catData->description;
            		$inputValues['metatitle'] = $catData->metatitle;
            		$inputValues['status'] = $catData->status;
            		$inputValues['featured'] = $catData->featured;
            		$inputValues['metakeyword'] = $catData->metakeyword;
            		$inputValues['metadesc'] = $catData->metadesc;
            		$this->data['parentCat'] = $catData->parent;
            		$this->data['image'] = $catData->image;
            		$this->data['thumbimage'] = getThumb($catData->image);
            		//pr($cat_id); die();
            		$this->data['catFilters'] = $this->category_model->getCatFilters($cat_id);
            	}else{
            		$this->session->set_flashdata('error_msg', 'Invalid Category');
					redirect('admin/category','refresh');
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
            $this->template->admin_render('admin/category/create', $this->data);
        }

    }
    function delete($id){
    	$this->category_model->manageSubCategory($id);
    	$this->category_model->deleteRow($id);
    	$this->session->set_flashdata('success_msg', 'Category Deleted Successfully');
		redirect('admin/category', 'refresh');
    }
    function catFilter(){
		$this->data['filter'] = $this->category_model->getCatFilters($_POST['catid']);
		$this->template->ajaxRender('admin/category/filter', $this->data);
    }

}