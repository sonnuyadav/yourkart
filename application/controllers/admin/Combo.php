<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Combo extends Admin_Controller {
	public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->page_title->push(lang('menu_combo'));
        $this->data['pagetitle'] = $this->page_title->show();

        $this->lang->load('admin/combo');
        $this->load->helper('number','common');
        $this->load->model('admin/combo_model');
        if ( ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
    }
    public function index(){
    		
    	//$this->page_title->push(lang('menu_combo'));

    	$this->data['pagetitle'] = $this->page_title->show();
    	$this->breadcrumbs->unshift(2, lang('menu_combo'), 'admin/combo/');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['count_combo']       = $this->combo_model->get_count_record();
		$this->data['combo']       = $this->combo_model->getAll();
		$this->template->admin_render('admin/combo/index', $this->data);
    }
    public function create($ID = 0){    
		$prevProimage = isset($_POST['previmages']) ? implode(',',$_POST['previmages']) : '';
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
    				array(858,342)
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
    	
    	if(isset($_FILES['profile'])){
    		for($i = 0; $i < count($_FILES['profile']['name']); $i++){
				if(!empty($_FILES['profile']['name'][$i])){
	    			$_FILES['file']['name'] = $_FILES['profile']['name'][$i];
	    			$_FILES['file']['type'] = $_FILES['profile']['type'][$i];
	    			$_FILES['file']['tmp_name'] = $_FILES['profile']['tmp_name'][$i];
	    			$_FILES['file']['error'] = $_FILES['profile']['error'][$i];
	    			$_FILES['file']['size'] = $_FILES['profile']['size'][$i];
	    			$option = array(
	    			'thumb'=>
	    				array(100,100),				
					'medium'=>
	    				array(150,150),
					'large'=>
	    				array(400,300)
	    			);
		    		$pro_files[]  = imgUpload($option);
	    		}
    		}
    	}
    	
    	if(!is_numeric($ID)){
    		$this->session->set_flashdata('error_msg', 'Invalid combo');
			redirect('admin/combo','refresh');
    	}

    	
    	$this->data['image'] = '';
    	$this->data['thumbimage'] = '';
    	$this->data['pro_images'] = array();
    	/* Breadcrumbs */
//    	$this->data['pagetitle'] = $this->page_title->show();

    	$this->breadcrumbs->unshift(2, lang('menu_combo'), 'admin/combo/');
    	if($ID){
    		$this->breadcrumbs->unshift(3, lang('combo_edit'), 'admin/combo/create');
    		$this->data['subtitle'] = lang('combo_edit');
    	}else{

			$this->breadcrumbs->unshift(3, lang('combo_add'), 'admin/combo/create');
			$this->data['subtitle'] = lang('combo_add');
    	}
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
        /* Variables */
		
		/* Validate form input */
		$this->form_validation->set_rules('title', 'lang:combo_name', 'required');	
		if ($this->form_validation->run() == TRUE)
		{				
			$DATA['title'] 		= $this->input->post('title');
			$DATA['price'] 		= $this->input->post('price');
			$DATA['image'] 	= $image;
			$DATA['pro_images'] = '';
			if(isset($pro_files) && count($pro_files)){

				$DATA['pro_images'] = implode(',', $pro_files);
				
			}
			if(!empty($prevProimage)){
				$DATA['pro_images'] = trim($DATA['pro_images'].','.$prevProimage,',');
			}
			$DATA['image'] 	= $image;
			
			$status = $this->input->post('status');
			$DATA['status'] 		= is_null($status) ? '0' : '1';
			if(!$ID){
				$slug 					= create_slug($DATA['title']);
				$DATA['nicename'] 	= $this->combo_model->checkExistingNiceName($slug);
				$DATA['doe'] 		= date('Y-m-d H:i:s');
				$ID = $this->combo_model->insert($DATA); 	
				$this->session->set_flashdata('success_msg', 'combo Added Successfully');
			}else{
				$DATA['dou'] 		= date('Y-m-d H:i:s');
				$this->combo_model->update($DATA,$ID); 
				$this->session->set_flashdata('success_msg', 'combo Updated Successfully');
			}				
				//die();			
			redirect('admin/combo','refresh');
		}
		else
		{	
			$this->data['validation_message'] = validation_errors();
			  $inputValues = array();
            if(!$ID){
				$inputValues['title'] = $this->form_validation->set_value('title');
				$inputValues['status'] = $this->form_validation->set_value('status');
				$inputValues['price'] = $this->form_validation->set_value('price');				
            }else{
            	$this->combo_model->db->where(array('id'=>$ID));
            	$DATA = $this->combo_model->db->get_where($this->combo_model->table)->row();
            	if(!is_null($DATA)){
            		$inputValues['title'] = $DATA->title;
            		$inputValues['status'] = $DATA->status;
            		$inputValues['price'] = $DATA->price;
            		$this->data['image'] = $DATA->image;
            		$this->data['thumbimage'] = getThumb($DATA->image);
            		$this->data['pro_images'] = !empty($DATA->pro_images) ? explode(',',$DATA->pro_images) : array();
            	}else{
            		$this->session->set_flashdata('error_msg', 'Invalid combo');
					redirect('admin/combo','refresh');
            	}
            }
			$this->data['cattitle'] = array(
				'name'  => 'title',
				'id'    => 'title',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $inputValues['title'],
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
			
			$this->data['price'] = array(
				'name'  => 'price',
				'id'    => 'price',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $inputValues['price'],
			);
			
            /* Load Template */
            $this->template->admin_render('admin/combo/create', $this->data);
        }

    }
    function delete($id){
    	$this->combo_model->manageSubcombo($id);
    	$this->combo_model->deleteRow($id);
    	$this->session->set_flashdata('success_msg', 'combo Deleted Successfully');
		redirect('admin/combo', 'refresh');
    }
    function catFilter(){
		$this->data['filter'] = $this->combo_model->getCatFilters($_POST['catid']);
		$this->template->ajaxRender('admin/combo/filter', $this->data);
    }

}