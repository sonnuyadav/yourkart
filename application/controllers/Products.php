<?php
//This is post controller
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Public_Controller {
 
    public function __construct()
    { 
        parent::__construct();
        $this->limit = 20;
        $this->load->library('paginator',array('perPage'=>$this->limit));


   // echo $this->table->generate($events);
        $this->load->model('admin/category_model');
        $this->load->model('admin/brand_model');
        $this->load->model('admin/product_model');
        $this->load->model('admin/theme_model');
        //$this->load->model('public/rating_model');
        $this->metaTitle = getThemeValue('meta_title');
        $this->metakeyword = getThemeValue('meta_keywords');
        $this->metadescription = getThemeValue('meta_desc');
        
    }
 
// this is show products by brands from menu
    public function BrandListing($nicename){
       $filterdata = $_POST;    
      $this->totalProducts = 0;
      $this->data['brands'] = array();
      $this->data['discounts'] = array();
      $this->data['filters'] = array();       
      $data = $this->brand_model->getBrandByNickname($nicename); 

      if(is_null($data)){
        show_404();
      }
      $this->metaTitle = $this->metaTitle.' : '.$data->metatitle;
      $this->metakeyword = $this->metaTitle.' : '.$data->metakeyword;
      $this->metadescription = $this->metaTitle.' : '.$data->metadesc;
      $this->data['prodata'] = $this->product_model->getbrandProducts($data->id,$this->paginator->getLimit(),$filterdata);
      $this->totalProducts = $this->data['prodata']['counts']->numcount;
      //pr($this->totalProducts);
      $this->data['products'] = $this->data['prodata']['products'];
      $this->data['filters'] = $this->data['prodata']['filters']; 
      $this->data['brands'] = $this->data['prodata']['brands']; 
      $this->data['discounts'] = $this->data['prodata']['discount']; 
      $this->data['categorys'] = $this->data['prodata']['category']; 
      $this->data['minprice'] = $this->data['prodata']['minprice']; 
      $this->data['maxprice'] = $this->data['prodata']['maxprice'];       
      $filters = array();
      if(count($this->data['filters'])){
        $idarray = array(); 
        foreach($this->data['filters'] as $filter){
            $key  = strtolower($filter->filter);
            if(!in_array(strtolower($filter->value), $idarray) && !empty($filter->value)){
              $filters[$key][] = array('id'=>$filter->id,'value'=>$filter->value);
            }
            array_push($idarray, strtolower($filter->value));
        }
      }
      $this->data['filters'] = $filters;
 
      $this->data['catName'] = $data->title;
      $this->paginator->setTotal($this->totalProducts);
      $this->data['paging'] = $this->paginator->pageLinks(); 
      if($this->input->is_ajax_request()){
        $this->template->ajaxrender('public/product/products-filter', $this->data);
      }else{
        $this->template->render('public/product/products-listing', $this->data);
        
      }
    }

// this is show post by category from menu
    public function categoryListing($nicename){  
      $filterdata = $_POST;    
      $this->totalProducts = 0;
      $this->data['brands'] = array();
      $this->data['discounts'] = array();
      $this->data['filters'] = array();       
      $data = $this->category_model->getCatDetailsByNickname($nicename);      
      if(is_null($data)){
        show_404();
      }
      $this->metaTitle = $this->metaTitle.' : '.$data->metatitle;
      $this->metakeyword = $this->metaTitle.' : '.$data->metakeyword;
      $this->metadescription = $this->metaTitle.' : '.$data->metadesc;
      $this->data['prodata'] = $this->product_model->getCatProducts($data->id,$this->paginator->getLimit(),$filterdata);
      $this->totalProducts = $this->data['prodata']['counts']->numcount;
      //pr($this->totalProducts);
      $this->data['products'] = $this->data['prodata']['products'];
      $this->data['filters'] = $this->data['prodata']['filters']; 
      $this->data['brands'] = $this->data['prodata']['brands']; 
      $this->data['discounts'] = $this->data['prodata']['discount']; 
      $this->data['categorys'] = $this->data['prodata']['category']; 
      $this->data['minprice'] = $this->data['prodata']['minprice']; 
      $this->data['maxprice'] = $this->data['prodata']['maxprice'];       
      $filters = array();
      if(count($this->data['filters'])){
        $idarray = array(); 
        foreach($this->data['filters'] as $filter){
            $key  = strtolower($filter->filter);
            if(!in_array(strtolower($filter->value), $idarray) && !empty($filter->value)){
              $filters[$key][] = array('id'=>$filter->id,'value'=>$filter->value);
            }
            array_push($idarray, strtolower($filter->value));
        }
      }
      $this->data['filters'] = $filters;
 
      $this->data['catName'] = $data->title;
      $this->paginator->setTotal($this->totalProducts);
      $this->data['paging'] = $this->paginator->pageLinks(); 
      if($this->input->is_ajax_request()){
        $this->template->ajaxrender('public/product/products-filter', $this->data);
      }else{
        $this->template->render('public/product/products-listing', $this->data);
        
      }
    }

 //Search post from front end
    public function searchListing($str=''){
      
      $searchVal = trim($_GET['search']);

      $filterdata = $_POST;    
      $this->totalProducts = 0;
      $this->data['brands'] = array();
      $this->data['discounts'] = array();
      $this->data['filters'] = array();       
      
      $this->data['prodata'] = $this->product_model->getsearchProducts($searchVal,$this->paginator->getLimit(),$filterdata);
      $this->totalProducts = $this->data['prodata']['counts']->numcount;
      //pr($this->totalProducts);
      $this->data['products'] = $this->data['prodata']['products'];
      $this->data['filters'] = $this->data['prodata']['filters']; 
      $this->data['brands'] = $this->data['prodata']['brands']; 
      $this->data['discounts'] = $this->data['prodata']['discount']; 
      $this->data['categorys'] = $this->data['prodata']['category']; 
      $this->data['minprice'] = $this->data['prodata']['minprice']; 
      $this->data['maxprice'] = $this->data['prodata']['maxprice'];       
      $filters = array();
      if(count($this->data['filters'])){
        $idarray = array(); 
        foreach($this->data['filters'] as $filter){
            $key  = strtolower($filter->filter);
            if(!in_array(strtolower($filter->value), $idarray) && !empty($filter->value)){
              $filters[$key][] = array('id'=>$filter->id,'value'=>$filter->value);
            }
            array_push($idarray, strtolower($filter->value));
        }
      }
      $this->data['filters'] = $filters;
 
      $this->data['catName'] = $searchVal;
      $this->paginator->setTotal($this->totalProducts);
      $this->data['paging'] = $this->paginator->pageLinks(); 
      if($this->input->is_ajax_request()){
        $this->template->ajaxrender('public/product/products-filter', $this->data);
      }else{
        $this->template->render('public/product/products-listing', $this->data);
        
      }



    }

    //This method show post listing
    public function productsDetails($nicename)
    { 

      $this->data['productDetails'] = $this->product_model->getProductDetails($nicename);
      
      $this->metaTitle = $this->metaTitle.' : '.$this->data['productDetails']->metatitle;
      $this->metakeyword = $this->metaTitle.' : '.$this->data['productDetails']->metakeyword;
      $this->metadescription = $this->metaTitle.' : '.$this->data['productDetails']->metadesc;
      $this->data['totalRating']  = 0;
      $this->data['productimages'] =  $getImage = $this->product_model->getGelleryImages($this->data['productDetails']->id);
      $firstImage = array('image'=>$this->data['productDetails']->image);
      array_unshift($this->data['productimages'],(object)$firstImage);

      $this->data['similerproducts'] = $this->product_model->getSimilerProducts($this->data['productDetails']->catid,$this->data['productDetails']->id);
      
      // unset($firstImage);
      // $this->data['reviews'] = $this->rating_model->getProductRatings($this->data['productDetails']->id);
      //   if($this->data['reviews']){
      // $this->data['totalRating'] = 0;
      //   for($i = 0;$i<count($this->data['reviews']);$i++){
      //     $this->data['totalRating'] +=$this->data['reviews'][$i]->rating;
      //   }
      //   $this->data['totalRating'] = abs($this->data['totalRating']/count($this->data['reviews']));
      // }
     $this->template->render('public/product/index', $this->data);
    }
  function addReview(){
    $data = array();
    $sessionArray =  $this->session->userdata('customer');
    $data['name']     = $sessionArray['fullname'];
    $data['email']    = $sessionArray['email'];
    $data['rating']   = $_POST['star'];
    $data['p_id']     = $_POST['pid'];
    $data['doe']      = date('Y-m-d h:i:s');
    $data['title']    = $_POST['title'];
    $data['message']  = $_POST['description'];
    $ratingid = $this->rating_model->insert($data);
    $this->session->set_flashdata('success','Review Added');

  }
  function searchlist(){
    $str = $_GET['search'];
    $this->category_model->db->like('title',$str);
    $this->category_model->db->select('title,id,nicename');
    $data = $this->category_model->db->get($this->category_model->table)->result();

    $returnarray = array();
    if(count($data)){
        foreach($data as $pro){
          $itemarray = array();
          $itemarray['id'] = $pro->id;
          $itemarray['title'] = $pro->title;
          $itemarray['nicename'] =   $pro->nicename;
          $itemarray['link'] =   base_url('shop/category/'.$pro->nicename);
          array_push($returnarray, $itemarray);
        }
    }

    $data = array();
    $this->product_model->db->like('title',$str);
    $this->product_model->db->select('title,id,nicename');
    $data = $this->product_model->db->get($this->product_model->table)->result();
    
    if(count($data)){
        foreach($data as $pro){
          $itemarray = array();
          $itemarray['id'] = $pro->id;
          $itemarray['title'] = $pro->title;
          $itemarray['nicename'] =   $pro->nicename;
          $itemarray['link'] =   base_url('product/'.$pro->nicename);
          array_push($returnarray, $itemarray);
        }
    }
    echo json_encode($returnarray);

  }

}
