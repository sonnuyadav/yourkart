<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Combo extends Public_Controller {
 
    public function __construct()
    {
        
        parent::__construct();
       
        $this->load->model('admin/theme_model');
        $this->load->model('admin/combo_model');
        
        $this->metaTitle = getThemeValue('meta_title');
        $this->metakeyword = getThemeValue('meta_keywords');
        $this->metadescription = getThemeValue('meta_desc');
    }

    public function index()
	{ 
        $this->data['combo'] = $this->combo_model->get_active_combo();
        $this->template->render('public/combo/index', $this->data);
	}
    public function single($nicename = '')
    {   
       
        $this->data['combo'] = $this->combo_model->getComboByNickname($nicename);
        $this->template->render('public/combo/single', $this->data);
    }
   

  
}
