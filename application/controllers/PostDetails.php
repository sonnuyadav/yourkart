<?php
//This is post controller
defined('BASEPATH') OR exit('No direct script access allowed');

class PostDetails extends Public_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('public/menus_model');
        // $this->load->model('public/post_model');
        $this->load->model('public/category_model');
        
    }
//This method show post listing
    public function index($nicename)
    { 
        $this->data['postDetails'] = $this->post_model->getPostDetails($nicename);
        $this->template->render('public/post/index', $this->data);
	}
// this is show post by category from menu
    public function categoryListing($nicename){

          $productsperpage = 2;
        $data = $this->category_model->getCatDetailsByNickname($nicename);
        $this->data['sliderImage'] = $this->category_model->getCatSliderById($data->id);
        $this->data['catName'] = $data->id;
        $this->template->render('public/post/postlisting', $this->data);
    }

 //Search post from front end
    public function searchListing(){
        $searchVal = $this->input->get('q', TRUE);
        $this->data['postList'] = $this->post_model->getPostBySearch($searchVal);
        $this->template->render('public/post/searchlisting', $this->data);
    }
 //load more post value
    public function loadMore(){
     $limit = $this->input->get('limit') ? $this->input->get('limit') : 2;
     $offset = $this->input->get('offset') ? $this->input->get('offset') : 0;
      $nicename = $this->input->get('page') ? $this->input->get('page') : '';
     $this->data['post'] = $this->post_model->getLoadmoreByLimit($limit,$offset,$nicename);
     $this->template->ajaxRender('public/post/loadmorelisting', $this->data);  
   
    }

}
