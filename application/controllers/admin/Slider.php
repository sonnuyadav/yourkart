<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends Admin_Controller {
	public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->page_title->push(lang('menu_slider'));
        $this->data['pagetitle'] = $this->page_title->show();

        $this->lang->load('admin/slider');
  
        $this->load->model('admin/slider_model');
        if ( ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
    }
    public function index(){
    		
    	

    	$this->data['pagetitle'] = $this->page_title->show();
    	$this->breadcrumbs->unshift(2, lang('menu_slider'), 'admin/slider/');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['count_brand']       = $this->slider_model->get_count_record();
		$this->data['brands']       = $this->slider_model->getAll();
		$this->template->admin_render('admin/slider/index', $this->data);
    }
    public function create($ID = 0){
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
    				array(858,342)
    			);
    		$image  = imgUpload($option);
    	}	
    	//var_dump($image); die();
    	if(!is_numeric($ID)){
    		$this->session->set_flashdata('error_msg', 'Invalid Slider');
			redirect('admin/brands','refresh');
    	}
    	
    	$this->breadcrumbs->unshift(2, lang('menu_slider'), 'admin/slider/');
    	if($ID){
    		$this->breadcrumbs->unshift(3, lang('slider_edit'), 'admin/brands/create');
    		$this->data['subtitle'] = lang('slider_edit');
    	}else{

			$this->breadcrumbs->unshift(3, lang('slider_add'), 'admin/brands/create');
			$this->data['subtitle'] = lang('slider_add');
    	}
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
       $this->data['sliders'] = array();	
        
        /* Variables */
		
		/* Validate form input */
        $this->form_validation->set_rules('title', 'lang:slider_name', 'required');		
	
		if ($this->form_validation->run() == TRUE)
		{	
			
            $DATA['title']      = $this->input->post('title');
			$DATA['link'] 		= $this->input->post('link');
			$DATA['image'] 	= $image;
			$status = $this->input->post('status');
			$DATA['status'] 		= is_null($status) ? '0' : '1';
			if(!$ID){
				$DATA['doe'] 		= date('Y-m-d H:i:s');
				$ID = $this->slider_model->insert($DATA); 
				$this->session->set_flashdata('success_msg', 'Slider Added Successfully');
				redirect('admin/slider','refresh');
			}else{
				$DATA['dou'] 		= date('Y-m-d H:i:s');
				$this->slider_model->update($DATA,$ID); 
				$this->session->set_flashdata('success_msg', 'Slider Updated Successfully');
				redirect('admin/slider','refresh');
			}		 	
		}
		else
		{	
			
			$this->data['validation_message'] = validation_errors();
			
            $inputValues = array();
            if(!$ID){
                $inputValues['title'] = $this->form_validation->set_value('title');
				$inputValues['link'] = $this->form_validation->set_value('link');
				$inputValues['status'] = $this->form_validation->set_value('status');
            }else{
            	$this->slider_model->db->where(array('id'=>$ID));
            	$DATA = $this->slider_model->db->get_where($this->slider_model->table)->row();
            	if(!is_null($DATA)){
            		$this->data['postImage'] = $DATA->image;
                    $inputValues['title'] = $DATA->title;
            		$inputValues['link'] = $DATA->link;
            		$inputValues['status'] = $DATA->status;
            		$this->data['image'] = $DATA->image;
            		$this->data['thumbimage'] = getThumb($DATA->image);
            	}else{
            		$this->session->set_flashdata('error_msg', 'Invalid  Slider');
					redirect('admin/slider','refresh');
            	}
            }
			$this->data['cattitle'] = array(
				'name'  => 'title',
				'id'    => 'title',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $inputValues['title'],
			);
            $this->data['link'] = array(
                'name'  => 'link',
                'id'    => 'link',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $inputValues['link'],
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
            $this->template->admin_render('admin/slider/create', $this->data);
        }

    }
    function delete($id){
    	
    	$this->slider_model->deleteRow($id);
    	$this->session->set_flashdata('success_msg', 'Slider Deleted Successfully');
		redirect('admin/slider', 'refresh');
    }
}