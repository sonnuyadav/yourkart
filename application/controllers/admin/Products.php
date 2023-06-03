<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller {
	public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->page_title->push(lang('menu_products'));
        $this->data['pagetitle'] = $this->page_title->show();

        $this->lang->load('admin/product');
        $this->load->helper('number','common');
        $this->load->model('admin/product_model');
        $this->load->model('admin/category_model');
        $this->load->model('admin/brand_model');
        if ( ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
    }
    public function index(){
    		
    	//$this->page_title->push(lang('menu_products'));

    	$this->data['pagetitle'] = $this->page_title->show();

    	$this->breadcrumbs->unshift(2, lang('menu_products'), 'admin/product/');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['products'] = $this->product_model->getAll();
		
		$this->template->admin_render('admin/product/index', $this->data);
    }
    public function create($ID = 0){ 
		if(!is_numeric($ID)){
    		$this->session->set_flashdata('error_msg', 'Invalid Category');
			redirect('admin/product','refresh');
    	}

    	//$this->data['pagetitle'] = $this->page_title->show();    	
    	$this->breadcrumbs->unshift(2, lang('menu_products'), 'admin/product/');
    	if($ID){
    		$this->breadcrumbs->unshift(3, lang('product_edit'), 'admin/product/	create');
    		$this->data['subtitle'] = lang('product_edit');
    	}else{

			$this->breadcrumbs->unshift(3, lang('product_add'), 'admin/product/create');
			$this->data['subtitle'] = lang('product_add');
    	}
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

    	if(isset($_POST['delFiles'])){

    		$this->product_model->deleteSliders($_POST['delFiles']);
    	}
    	$previmage = isset($_POST['image'])  ? $_POST['image'] : '';
    	$image = isset($_POST['image'])  ? $_POST['image'] : '';
    	$this->data['sliders'] = array();
    	$this->data['filters'] = array();
    	$fileflag  = 0;
    	if(!empty($_FILES['file']['name'])){
    		$option = array(
    			'thumb'=>
    				array(100,100),				
				'medium'=>
    				array(150,150),
				'large'=>
    				array(400,300)
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
    	if(isset($_FILES['sliderfile']) && !empty($_FILES['sliderfile']['name'][0])){
    		for($i = 0; $i < count($_FILES['sliderfile']['name']); $i++){
    			
    			$_FILES['file']['name'] = $_FILES['sliderfile']['name'][$i];
    			$_FILES['file']['type'] = $_FILES['sliderfile']['type'][$i];
    			$_FILES['file']['tmp_name'] = $_FILES['sliderfile']['tmp_name'][$i];
    			$_FILES['file']['error'] = $_FILES['sliderfile']['error'][$i];
    			$_FILES['file']['size'] = $_FILES['sliderfile']['size'][$i];
    			$option = array(
    			'thumb'=>
    				array(100,100),				
				'medium'=>
    				array(150,150),
				'large'=>
    				array(400,300)
    			);
	    		$sliderImages[]  = imgUpload($option);
    		}
    	}
    	
    	
    	
    	$this->data['cats'] = $this->category_model->getAll();
    	$this->data['brands'] = $this->brand_model->getAll();
    	//pr($this->data['brands']); die();
    	$this->data['cat_id'] = 0;
    	$this->data['brand_id'] = 0;
    	$this->data['image'] = '';
    	$this->data['thumbimage'] = '';
    	$this->data['catFilters'] = array();
    	
        /* Variables */
		
		/* Validate form input */
		$this->form_validation->set_rules('title', 'lang:product_name', 'required');	
		if(isset($_POST['qty']) && $_POST['qty'] != 0){
			$this->form_validation->set_rules('qty', 'lang:product_qty', 'required|numeric|greater_than[0]');	
		}
		if(isset($_POST['price']) && $_POST['price'] != 0){
			$this->form_validation->set_rules('price', 'lang:product_price', 'required|numeric|greater_than[0]');	
		}
		if(isset($_POST['discount']) && $_POST['discount'] != 0){
			$this->form_validation->set_rules('discount', 'lang:product_discount', 'required|numeric|greater_than[0]|less_than[100]');	
		}
		$this->form_validation->set_rules('catid', 'lang:product_category', 'required');	
		if ($this->form_validation->run() == TRUE)
		{				
			$DATA['title'] 		= $this->input->post('title');
			$DATA['description'] = $this->input->post('description');
			$DATA['metatitle'] 	= $this->input->post('metatitle');
			$DATA['metakeyword'] = $this->input->post('metakeyword');
			$DATA['metadesc'] 	= $this->input->post('metadesc');
			$DATA['price'] 	= $this->input->post('price');
			$DATA['qty'] 	= $this->input->post('qty');
			$DATA['discount'] 	= $this->input->post('discount');
			$DATA['catid'] 	= $this->input->post('catid');
			$DATA['brandid'] 	= $this->input->post('brandid');
			$DATA['pro_code'] 	= $this->input->post('pro_code');
			$DATA['specification'] 	= $this->input->post('specification');
			$DATA['specification'] 	= htmlentities($DATA['specification']);
			$DATA['image'] 	= $image;
			$status = $this->input->post('status');
			$DATA['status'] 		= is_null($status) ? '0' : '1';
			$featured = $this->input->post('featured');
			$DATA['featured'] 		= is_null($featured) ? '0' : '1';			
			if(!$ID){
				$slug 					= create_slug($DATA['title']);
				$DATA['nicename'] 	= $this->product_model->checkExistingNiceName($slug);
				$DATA['doe'] 		= date('Y-m-d H:i:s');
				$ID = $this->product_model->insert($DATA); 	
				$this->session->set_flashdata('success_msg', 'Product Added Successfully');
			}else{
				$DATA['dou'] 		= date('Y-m-d H:i:s');
				$this->product_model->update($DATA,$ID); 
				$this->session->set_flashdata('success_msg', 'Product Updated Successfully');
			}
			if(isset($sliderImages) && count($sliderImages)){
				$this->product_model->insertSliderImage($sliderImages,$ID);
			}
			if(isset($_POST['filter']) ){
				$this->product_model->processFilter($_POST['filter'],$ID);
			}
			
		
			redirect('admin/products','refresh');
		}
		else
		{	
			$this->data['validation_message'] = validation_errors();
			  $inputValues = array();
            if(!$ID){
				$inputValues['title'] = $this->form_validation->set_value('title');
				$inputValues['description'] = $this->form_validation->set_value('description');
				$inputValues['status'] = $this->form_validation->set_value('status');
				$inputValues['featured'] = $this->form_validation->set_value('featured');
				$inputValues['metakeyword'] = $this->form_validation->set_value('metakeyword');
				$inputValues['metatitle'] = $this->form_validation->set_value('metatitle');
				$inputValues['metadesc'] = $this->form_validation->set_value('metadesc');
				$inputValues['price'] = $this->form_validation->set_value('price');
				$inputValues['discount'] = $this->form_validation->set_value('discount');
				$inputValues['qty'] = $this->form_validation->set_value('qty');
				$inputValues['pro_code'] = $this->form_validation->set_value('pro_code');
				$inputValues['specification'] = $this->form_validation->set_value('specification');

            }else{
            	$this->product_model->db->where(array('id'=>$ID));
            	$catData = $this->product_model->db->get_where($this->product_model->table)->row();
            	$this->data['filters'] = $this->product_model->getProductFilter($ID,$catData->catid);
            	$this->data['sliders'] = $this->product_model->getSliders($ID);
            	
            	if(!is_null($catData)){
            		$inputValues['title'] = $catData->title;
            		$inputValues['description'] = $catData->description;
            		$inputValues['metatitle'] = $catData->metatitle;
            		$inputValues['status'] = $catData->status;
            		$inputValues['featured'] = $catData->featured;
            		$inputValues['metakeyword'] = $catData->metakeyword;
            		$inputValues['metadesc'] = $catData->metadesc;
            		$inputValues['price'] = $catData->price;
            		$inputValues['discount'] = $catData->discount;
            		$inputValues['pro_code'] = $catData->pro_code;
            		$inputValues['specification'] = $catData->specification;
            		$inputValues['qty'] = $catData->qty;
            		$this->data['cat_id'] = $catData->catid;
            		$this->data['brand_id'] = $catData->brandid;
            		$this->data['image'] = $catData->image;
            		$this->data['thumbimage'] = getThumb($catData->image);
            		
            	}else{
            		$this->session->set_flashdata('error_msg', 'Invalid Product');
					redirect('admin/category','refresh');
            	}
            }
			$this->data['ptitle'] = array(
				'name'  => 'title',
				'id'    => 'title',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $inputValues['title'],
			);
			$this->data['price'] = array(
				'name'  => 'price',
				'id'    => 'price',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $inputValues['price'],
			);
			$this->data['discount'] = array(
				'name'  => 'discount',
				'id'    => 'discount',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $inputValues['discount'],
			);
			$this->data['qty'] = array(
				'name'  => 'qty',
				'id'    => 'qty',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $inputValues['qty'],
			);
			$this->data['pro_code'] = array(
				'name'  => 'pro_code',
				'id'    => 'pro_code',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $inputValues['pro_code'],
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'textarea',
                'class' => 'form-control',
				'value' => $inputValues['description'],
			);
			$this->data['specification'] = array(
				'name'  => 'specification',
				'id'    => 'specification',
				'type'  => 'textarea',
                'class' => 'form-control tinyMce',
				'value' => html_entity_decode($inputValues['specification']),
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
            $this->template->admin_render('admin/product/create', $this->data);
        }

    }
    function delete($id){
    	$this->product_model->deleteRow($id);
    	$this->session->set_flashdata('success_msg', 'Product Deleted Successfully');
		redirect('admin/products', 'refresh');
    }


}