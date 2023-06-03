<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends Public_Controller {

    public function __construct()
    {
        parent::__construct();

       $this->load->model('admin/brand_model');
        $this->load->model('admin/theme_model');
        $this->load->model('admin/product_model');
        $this->metaTitle = getThemeValue('meta_title');
        $this->metakeyword = getThemeValue('meta_keywords');
        $this->metadescription = getThemeValue('meta_desc');
    }

 
	public function thankyou()
	{
	
		$this->template->render('public/page/thankyou', $this->data);
	}
}
