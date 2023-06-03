<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_product';
        $this->sliderTable = 'tbl_product_slider';
        $this->FilterTable = 'tbl_product_filter';
    }

    public function get_count_record()
    {
        $query = $this->db->count_all($this->table);

        return $query;
    }

    public function getAll(){
        $whereStr = " P.status = '1'";
        $this->db->select('C.title as cattitle,P.*,B.title as brandtitle');
        $this->db->from("$this->table P");
        $this->db->join("tbl_category C",'P.catid = C.id','left');
        $this->db->join("tbl_brand B",'P.brandid = B.id','left');
        $this->db->order_by("P.id", "desc");
        $data = $this->db->get()->result();
        return $data;
    }
    public function getAllActiveCats(){
       $whereStr = " status = '1'";
        
        $this->db->from("$this->table");
        
        $this->db->where($whereStr);
        $this->db->order_by("title", "asc");
        $data = $this->db->get()->result();
            // echo $this->db->last_query();
            // die();
        return $data;
    }
    public function getAllParent($catid=0){
        $whereStr = " status = '1' ";
        if($catid){
             $whereStr .= " AND id != ".$catid;
        }
        $this->db->where($whereStr);
        $this->db->order_by("id", "desc");
        $data = $this->db->get($this->table)->result();
        return $data;
    }
    public function insert($data,$table=false){
        if(!$table){
            $table = $this->table;
        }
        $this->db->insert($table,$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    } 
    function update($data,$id=0,$table= false){
        if(!$table){
            $table = $this->table;
        }
        if($id)
        $this->db->where(array('id'=>$id));
        $this->db->update($table,$data);
        return true;
    }
    function deleteRow($id,$table=false){
        if(!$table){
            $table = $this->table;
        }
        $this->db->where('id', $id);
        $this->db->delete($table); 
        return true;
    }
    function checkExistingNiceName($niceName,$id=false){
        if($id){ 
       
            $this ->db->where('id !='. $id.' && nicename = '.$nicename);
            $data = $this->db->get_where($this->table)->result();

        }else{
            $this ->db->where('nicename = "'.$niceName.'"');
            $data = $this->db->get($this->table)->result();
            if(count($data)){
                $niceName = unique_slug($this->table,$niceName);
            }
        }
        return $niceName;
    }
    function manageSubCategory($catid = 0){
        $this->db->where('id',$catid);
        $catData = $this->db->get($this->table)->row();
        $newparent = 0;
        if($catData->parent != 0){
            $newparent = $catData->parent;
        }
        $updateArray = array();
        $updateArray['parent']  = $newparent;
        $this->db->where('parent',$catid);
        $this->update($updateArray);
    }
    function insertFilter($data = array(),$catid = 0){
        if(count($data)){
            foreach($data as $value){
                if($value != ''){
                    $insertArr = array();
                    $insertArr['catid'] = $catid;
                    $insertArr['filter'] = $value;
                    $this->insert($insertArr,$this->FilterTable);
                }
            }
        }
        return true;
        //$this->FilterTable
    }
    function getCatFilters($cid=0){
        $this->db->where('catid='.$cid);
        return $this->db->get($this->FilterTable)->result();
    }
    function updateFilter($data = array()){
        if(count($data)){
            foreach($data as $key => $value){
                $updateArr = array();
                $updateArr['filter'] = $value;
                $this->update($updateArr,$key,$this->FilterTable);
            }
        }
       // pr($data); die();
        return true;
        //pr($data); die();
    }
    function deleteFilter($data = array()){
        
        if(count($data)){
            foreach($data as $key => $value){
                $this->deleteRow($key,$this->FilterTable);
            }
        }
        return true;//pr($data); die();
    }

    function insertSliderImage($images = array(),$pid = 0){
        if(count($images)){
            foreach($images as $image){
                $insertArray = array();
                $insertArray['image'] = $image;
                $insertArray['pid'] = $pid;
                $this->insert($insertArray,$this->sliderTable);
            }
        }
    }
    function getSliders($pid = 0){
        $this->db->where('pid='.$pid);
        return $this->db->get($this->sliderTable)->result();
    }
    function deleteSliders($images = array()){
        if(count($images)){
            foreach($images as $key => $value){
                 $this->deleteRow($key,$this->sliderTable);
            }
        }
    }
    function processFilter($data = array(),$pid = 0){
        if(count($data)){
        $this->db->where('pid', $pid);
        $this->db->delete($this->FilterTable); 
            foreach($data as $key => $filter){
                $this->db->where('pid='.$pid.' AND filterid='.$key);
                $row = $this->db->get($this->FilterTable)->row();
                if(count($row)){
                    $updateArray = array();
                    $updateArray['value'] = trim($filter);
                    $this->update($updateArray,$row->id,$this->FilterTable);
                }else{
                    $insertArray = array();
                    $insertArray['filterid'] = $key;
                    $insertArray['value'] = trim($filter);
                    $insertArray['pid'] = $pid;
                    $this->insert($insertArray,$this->FilterTable);
                }


            }
        }
    }
    function getProductFilter($pid = 0,$cid = 0){
        //$this->db->where('F.pid='.$pid.' AND CF.catid = '.$cid);
        $this->db->where('F.pid='.$pid);
        $this->db->select('F.*,CF.filter');
        $this->db->from($this->FilterTable.' F');
        $this->db->join('tbl_category_filter CF','CF.id = F.filterid','LEFT');
        return $result = $this->db->get()->result();
    }
    function getchildcategory($catid){
         $this->db->where_in('parent',$catid);
         $this->db->where('status','1');
        return $this->db->get('tbl_category')->result();
    }
    function getHomeProducts($catid=0,$limit = 120){
        if($catid){
            $catArray = array();
            $cid = array();
            $cid[] = $catid;
            $catArray[] = $catid;
            for($i = 0;$i<=20;$i++){
                $data = $this->getchildcategory($cid);
                if(array($data) && count($data)){
                    $cid = array();
                    foreach($data as $catdata){
                        $catArray[] = $catdata->id;
                        $cid[] = $catdata->id;
                    }
                }else{
                    break;
                }                               
            }  
            $this->db->where_in('P.catid',$catArray );
            $this->db->where("P.featured = '1' AND P.status = '1'");
            $this->db->from($this->table.' P');            
            $this->db->join('tbl_brand B','P.brandid = B.id','LEFT');
            $this->db->select('P.*,B.title as brandtitle, TRUNCATE( P.price - (( P.price * P.discount )/100) , 2 ) AS saleprice');
            $this->db->order_by('P.id','desc');
            //$this->db->limit($limit);
            $return = $this->db->get()->result();
            //echo $this->db->last_query();   
            return $return;
        }else{
            return array();
        }
        
    }
    function getHomelinkCount($catarray=array()){
        foreach($catarray as $catid){
            if($catid){
                $catArray = array();
                $cid = array();
                $cid[] = $catid;
                $catArray[] = $catid;
                for($i = 0;$i<=20;$i++){
                    $data = $this->getchildcategory($cid);
                    if(array($data) && count($data)){
                        $cid = array();
                        foreach($data as $catdata){
                            $catArray[] = $catdata->id;
                            $cid[] = $catdata->id;
                        }
                    }else{
                        break;
                    }                               
                }                  
                $this->db->where_in('catid',$catArray );
                $this->db->where("status = '1'");                      
                $this->db->select("count(*) as number");
                $return[$catid] = $this->db->get($this->table)->row_array();                            
            }
        }
        return $return;
        
    }

    public function getProductArryById($pid =NULL){
        $this->db->where('status = "1" && id='.$pid);
        $this->db->select('id,title,price,discount,qty, image,TRUNCATE( price - (( price * discount )/100) , 2 ) AS saleprice');
        $data = $this->db->get_where($this->table)->row_array();
        return $data;
        
    }
    public function getCartProductsDetails($key){
   
      $returnArray = array();
      if(isset($_SESSION['shop_cart_session'][$key])){
        $cart = array();
        $cart = $_SESSION['shop_cart_session'][$key];
       
      $proid = $cart['pro_id'];
      $qty = $cart['qty'];

      $returnArray = $this->getProductArryById($proid);
      $returnArray['qtyPrice'] = $returnArray['saleprice']*$qty;
    return $returnArray;

    }
   }
   public function getProductDetails($nicename = NULL){
       $nicename = $this->db->escape(trim($nicename));
        $this->db->where('P.status = "1" && P.nicename='.$nicename);
        $this->db->join('tbl_category C','C.id = P.catid','LEFT');
        $this->db->from($this->table. ' P');
        $this->db->SELECT('P.*,TRUNCATE( P.price - (( P.price * P.discount )/100) , 2 ) AS saleprice,C.title as cattitle,C.nicename as catnicename');
        $data = $this->db->get()->row();
        return $data;  
    }
    function getGelleryImages($pid){
        $this->db->where('pid', $pid);
        $this->db->from($this->sliderTable);
        $result = $this->db->get()->result();
        return $result;
    }

    function getSimilerProducts($catid,$pid){

        $this->db->where('P.status = "1" AND P.id != "'.$pid.'" AND P.catid='.$catid );
        $this->db->join('tbl_category C','C.id = P.catid','LEFT');
        $this->db->join('tbl_brand B','P.brandid = B.id','LEFT');
        $this->db->from($this->table. ' P');
        $this->db->SELECT('P.*,B.title as brandtitle,TRUNCATE( P.price - (( P.price * P.discount )/100) , 2 ) AS saleprice,C.title as cattitle,C.nicename as catnicename');
        $this->db->limit(4);
        $this->db->order_by('P.id ','RANDOM');
        $data = $this->db->get()->result();
        return $data; 
    }

    function getsearchProducts($search,$limit,$filters = array()){   
    
        $search = urldecode($search);
        if(isset($filters['filter']) && count($filters['filter'])){
            $filterKey = array();
            $filtervalues = array();
            foreach($filters['filter'] as $key => $filterArr){ 
           // pr($filterArr);die();
                $filterKey[] = $key;
                if(is_array($filterArr)){
                    foreach($filterArr as $fill){
                        $filtervalues[] = $fill;
                        
                    }
                }
            }
        }
        if(isset($filters['pricerange'])){
            $pricerange = str_replace('Rs.', '', $filters['pricerange']);
            $pricerange = explode(' - ',$pricerange);            
        }
        
        $retunrData = array();        
        $this->db->SELECT('count(*) as numcount');  
        $this->db->where('status = "1"');
        $this->db->like('title', $search);
        
        $this->db->from($this->table .' P');        
        if(isset($filters['discount']) && count($filters['discount'])){
            $this->db->where_in('P.discount',$filters['discount']); 
        }
        if(isset($pricerange)){
         $this->db->where('P.price BETWEEN '.$pricerange[0].' AND '.$pricerange[1]);    
        }
        if(isset($filtervalues) && count($filtervalues)){
        $this->db->join('tbl_product_filter PF','PF.pid = P.id','LEFT');
        
        $this->db->where_in('PF.filterid',$filterKey);
        $this->db->where_in('PF.value',$filtervalues);
        $countQuery = $this->db->get(); 
        }else{
            $countQuery = $this->db->get(); 
        }
     //   echo $this->db->last_query(); die();
        $retunrData['category'] = array();

        $this->db->SELECT('B.title,B.id');      
        $this->db->from($this->table. ' P');
        $this->db->join('tbl_brand B','P.brandid = B.id','LEFT');
        $this->db->where('P.status = "1" AND P.brandid != "" ');        
        

        $this->db->group_by('P.brandid');                
        $retunrData['brands'] = $this->db->get($this->table)->result();

        $this->db->SELECT('P.discount');        
        $this->db->from($this->table. ' P');        
        $this->db->where('P.status = "1" AND P.discount > 0');
        $this->db->like('P.title',$search);        
        $this->db->group_by('P.discount');
        $retunrData['discount'] = $this->db->get($this->table)->result();

        $query = $this->db->query("SELECT (SELECT price  FROM `tbl_product`  WHERE `status` = '1' AND `title` LIKE '%".$search."%' ORDER BY price DESC LIMIT 1) as maxprice, (SELECT price  FROM `tbl_product`  WHERE `status` = '1' AND `title` LIKE '%".$search."%' ORDER BY price ASC LIMIT 1) as minprice");

        $price = $query->row();
        $retunrData['minprice'] = $price->minprice;
        $retunrData['maxprice'] = $price->maxprice;

        $this->db->SELECT('CF.id,PF.value,CF.filter');        
        $this->db->from('tbl_product_filter PF');        
        
        $this->db->where("PF.pid in (SELECT id FROM `tbl_product`  WHERE status = '1' AND `title` LIKE '%".$search."%')");
          $this->db->join('tbl_category_filter CF','PF.filterid  = CF.id','LEFT');
          //$this->db->group_by('PF.value,PF.id');
        $retunrData['filters'] = $this->db->get($this->table)->result();
  


        $this->db->SELECT('P.*,B.title as brandtitle,TRUNCATE( P.price - (( P.price * P.discount )/100) , 2 ) AS saleprice');
        $this->db->limit($limit['end'],$limit['start']);
        $this->db->from($this->table. ' P');
        $this->db->join('tbl_brand B','P.brandid = B.id','LEFT');
        $this->db->where('P.status = "1"');
        $this->db->like('P.title',$search);
        if(isset($filters['brand']) && count($filters['brand'])){
            $this->db->where_in('P.brandid',$filters['brand']); 
        }
        if(isset($filters['discount']) && count($filters['discount'])){
            $this->db->where_in('P.discount',$filters['discount']); 
        }
        if(isset($pricerange)){
         $this->db->where('P.price BETWEEN '.$pricerange[0].' AND '.$pricerange[1]);    
        }


        $this->db->group_by('P.id');
        if(isset($filters['sort']) && $filters['sort'] == 'nameasc'){
            $this->db->order_by('P.title','ASC');    
        }else if(isset($filters['sort']) && $filters['sort'] == 'namedesc')
        {
           $this->db->order_by('P.title','DESC');
        }
        else if(isset($filters['sort']) && $filters['sort'] == 'discountasc')
        {
           $this->db->order_by('P.discount','asc');
        }
        else if(isset($filters['sort']) && $filters['sort'] == 'discountdesc')
        {
           $this->db->order_by('P.discount','DESC');
        } else{            
            $this->db->order_by('P.id','DESC');
        }
        if(isset($filtervalues) && count($filtervalues)){
        $this->db->join('tbl_product_filter PF','PF.pid = P.id','LEFT');
        
        $this->db->where_in('PF.filterid',$filterKey);
        $this->db->where_in('PF.value',$filtervalues);        
        }

        $retunrData['products'] = $this->db->get($this->table)->result();
       // echo $this->db->last_query();
        $retunrData['counts'] = $countQuery->row();
        
        
        return $retunrData;
    }


    function getbrandProducts($brandid,$limit,$filters = array()){   
    
        
        if(isset($filters['filter']) && count($filters['filter'])){
            $filterKey = array();
            $filtervalues = array();
            foreach($filters['filter'] as $key => $filterArr){ 
           // pr($filterArr);die();
                $filterKey[] = $key;
                if(is_array($filterArr)){
                    foreach($filterArr as $fill){
                        $filtervalues[] = $fill;
                        
                    }
                }
            }
        }
        if(isset($filters['pricerange'])){
            $pricerange = str_replace('Rs.', '', $filters['pricerange']);
            $pricerange = explode(' - ',$pricerange);            
        }
        
        $retunrData = array();        
        $this->db->SELECT('count(*) as numcount');  
        $this->db->where('status = "1"');
        $this->db->where_in('brandid',$brandid);  
        $this->db->from($this->table .' P');        
        if(isset($filters['discount']) && count($filters['discount'])){
            $this->db->where_in('P.discount',$filters['discount']); 
        }
        if(isset($pricerange)){
         $this->db->where('P.price BETWEEN '.$pricerange[0].' AND '.$pricerange[1]);    
        }
        if(isset($filtervalues) && count($filtervalues)){
        $this->db->join('tbl_product_filter PF','PF.pid = P.id','LEFT');
        
        $this->db->where_in('PF.filterid',$filterKey);
        $this->db->where_in('PF.value',$filtervalues);
        $countQuery = $this->db->get(); 
        }else{
            $countQuery = $this->db->get(); 
        }
        $retunrData['brands'] = array();
        $retunrData['category'] = array();

        // $this->db->SELECT('B.title,B.id');      
        // $this->db->from($this->table. ' P');
        // $this->db->join('tbl_brand B','P.brandid = B.id','LEFT');
        // $this->db->where('P.status = "1" AND P.brandid != "" ');
        // $this->db->where_in('P.brandid',$brandid);                
        // $retunrData['brands'] = $this->db->get($this->table)->result();

        $this->db->SELECT('P.discount');        
        $this->db->from($this->table. ' P');        
        $this->db->where('P.status = "1" AND P.discount > 0');
        $this->db->where_in('P.brandid',$brandid);        
        $this->db->group_by('P.discount');
        $retunrData['discount'] = $this->db->get($this->table)->result();

        $query = $this->db->query("SELECT (SELECT price  FROM `tbl_product`  WHERE `status` = '1' AND `brandid` = '".$brandid."' ORDER BY price DESC LIMIT 1) as maxprice, (SELECT price  FROM `tbl_product`  WHERE `status` = '1' AND `brandid` = '".$brandid."' ORDER BY price ASC LIMIT 1) as minprice");

        $price = $query->row();
        $retunrData['minprice'] = $price->minprice;
        $retunrData['maxprice'] = $price->maxprice;

        $this->db->SELECT('CF.id,PF.value,CF.filter');        
        $this->db->from('tbl_product_filter PF');        
        
        $this->db->where("PF.pid in (SELECT id FROM `tbl_product`  WHERE status = '1' AND `brandid` = '".$brandid."')");
          $this->db->join('tbl_category_filter CF','PF.filterid  = CF.id','LEFT');
          $this->db->group_by('PF.value');
        $retunrData['filters'] = $this->db->get($this->table)->result();
         // echo $this->db->last_query();
  


        $this->db->SELECT('P.*,B.title as brandtitle,TRUNCATE( P.price - (( P.price * P.discount )/100) , 2 ) AS saleprice');
        $this->db->limit($limit['end'],$limit['start']);
        $this->db->from($this->table. ' P');
        $this->db->join('tbl_brand B','P.brandid = B.id','LEFT');
        $this->db->where('P.status = "1"');
        $this->db->where_in('P.brandid',$brandid);
        if(isset($filters['brand']) && count($filters['brand'])){
            $this->db->where_in('P.brandid',$filters['brand']); 
        }
        if(isset($filters['discount']) && count($filters['discount'])){
            $this->db->where_in('P.discount',$filters['discount']); 
        }
        if(isset($pricerange)){
         $this->db->where('P.price BETWEEN '.$pricerange[0].' AND '.$pricerange[1]);    
        }


        $this->db->group_by('P.id');
        if(isset($filters['sort']) && $filters['sort'] == 'nameasc'){
            $this->db->order_by('P.title','ASC');    
        }else if(isset($filters['sort']) && $filters['sort'] == 'namedesc')
        {
           $this->db->order_by('P.title','DESC');
        }
        else if(isset($filters['sort']) && $filters['sort'] == 'discountasc')
        {
           $this->db->order_by('P.discount','asc');
        }
        else if(isset($filters['sort']) && $filters['sort'] == 'discountdesc')
        {
           $this->db->order_by('P.discount','DESC');
        } else{            
            $this->db->order_by('P.id','DESC');
        }
        if(isset($filtervalues) && count($filtervalues)){
        $this->db->join('tbl_product_filter PF','PF.pid = P.id','LEFT');
        
        $this->db->where_in('PF.filterid',$filterKey);
        $this->db->where_in('PF.value',$filtervalues);        
        }

        $retunrData['products'] = $this->db->get($this->table)->result();
       // echo $this->db->last_query();
        $retunrData['counts'] = $countQuery->row();
        
        
        return $retunrData;
    }

    function getCatProducts($catid,$limit,$filters = array()){   
    
        $catArray = array();
        $cid = array();
        $cid[] = $catid;
        $catdetails = array();
        $catArray[] = $catid;
        for($i = 0;$i<=20;$i++){
            $data = $this->getchildcategory($cid);
            if(array($data) && count($data)){
                $cid = array();
                foreach($data as $catdata){
                    $catArray[] = $catdata->id;
                    $catdetails[] = $catdata;
                    $cid[] = $catdata->id;
                }
            }else{
                break;
            }                               
        }   
        if(isset($filters['filter']) && count($filters['filter'])){
            $filterKey = array();
            $filtervalues = array();
            foreach($filters['filter'] as $key => $filterArr){ 
           // pr($filterArr);die();
                $filterKey[] = $key;
                if(is_array($filterArr)){
                    foreach($filterArr as $fill){
                        $filtervalues[] = $fill;
                        
                    }
                }
            }
        }
        if(isset($filters['pricerange'])){
            $pricerange = str_replace('Rs.', '', $filters['pricerange']);
            $pricerange = explode(' - ',$pricerange);            
        }
        
        $retunrData = array();
        $retunrData['category'] = $catdetails;
        $this->db->SELECT('count(*) as numcount');  
        $this->db->where('status = "1"');
        $this->db->where_in('catid',$catArray);  
        $this->db->from($this->table .' P');
        if(isset($filters['brand']) && count($filters['brand'])){
            $this->db->where_in('P.brandid',$filters['brand']); 
        }
        if(isset($filters['discount']) && count($filters['discount'])){
            $this->db->where_in('P.discount',$filters['discount']); 
        }
        if(isset($pricerange)){
         $this->db->where('P.price BETWEEN '.$pricerange[0].' AND '.$pricerange[1]);    
        }
        if(isset($filtervalues) && count($filtervalues)){
        $this->db->join('tbl_product_filter PF','PF.pid = P.id','LEFT');
        
        $this->db->where_in('PF.filterid',$filterKey);
        $this->db->where_in('PF.value',$filtervalues);
        $countQuery = $this->db->get(); 
        }else{
            $countQuery = $this->db->get(); 
        }


        $this->db->SELECT('B.title,B.id');      
        $this->db->from($this->table. ' P');
        $this->db->join('tbl_brand B','P.brandid = B.id','LEFT');
        $this->db->where('P.status = "1" AND P.brandid != "" ');
        $this->db->where_in('P.catid',$catArray);        
        $this->db->group_by('P.brandid');
        $retunrData['brands'] = $this->db->get($this->table)->result();

        $this->db->SELECT('P.discount');        
        $this->db->from($this->table. ' P');        
        $this->db->where('P.status = "1" AND P.discount > 0');
        $this->db->where_in('P.catid',$catArray);        
        $this->db->group_by('P.discount');
        $retunrData['discount'] = $this->db->get($this->table)->result();

        $query = $this->db->query("SELECT (SELECT price  FROM `tbl_product`  WHERE `status` = '1' AND `catid` IN ('".implode("','",$catArray)."') ORDER BY price DESC LIMIT 1) as maxprice, (SELECT price  FROM `tbl_product`  WHERE `status` = '1' AND `catid` IN('".implode("','",$catArray)."') ORDER BY price ASC LIMIT 1) as minprice");

        $price = $query->row();
        $retunrData['minprice'] = $price->minprice;
        $retunrData['maxprice'] = $price->maxprice;

        $this->db->SELECT('CF.id,PF.value,CF.filter');        
        $this->db->from('tbl_product_filter PF');        
        
        $this->db->where("PF.pid in (SELECT id FROM `tbl_product`  WHERE status = '1' AND `catid` IN('".implode("','",$catArray)."'))");
          $this->db->join('tbl_category_filter CF','PF.filterid  = CF.id','LEFT');
          //$this->db->group_by('PF.value,PF.id');
        $retunrData['filters'] = $this->db->get($this->table)->result();
  


        $this->db->SELECT('P.*,B.title as brandtitle,TRUNCATE( P.price - (( P.price * P.discount )/100) , 2 ) AS saleprice');
        $this->db->limit($limit['end'],$limit['start']);
        $this->db->from($this->table. ' P');
        $this->db->join('tbl_brand B','P.brandid = B.id','LEFT');
        $this->db->where('P.status = "1"');
        $this->db->where_in('P.catid',$catArray);
        if(isset($filters['brand']) && count($filters['brand'])){
            $this->db->where_in('P.brandid',$filters['brand']); 
        }
        if(isset($filters['discount']) && count($filters['discount'])){
            $this->db->where_in('P.discount',$filters['discount']); 
        }
        if(isset($pricerange)){
         $this->db->where('P.price BETWEEN '.$pricerange[0].' AND '.$pricerange[1]);    
        }


        $this->db->group_by('P.id');
        if(isset($filters['sort']) && $filters['sort'] == 'nameasc'){
            $this->db->order_by('P.title','ASC');    
        }else if(isset($filters['sort']) && $filters['sort'] == 'namedesc')
        {
           $this->db->order_by('P.title','DESC');
        }
        else if(isset($filters['sort']) && $filters['sort'] == 'discountasc')
        {
           $this->db->order_by('P.discount','asc');
        }
        else if(isset($filters['sort']) && $filters['sort'] == 'discountdesc')
        {
           $this->db->order_by('P.discount','DESC');
        } else{            
            $this->db->order_by('P.id','DESC');
        }
        if(isset($filtervalues) && count($filtervalues)){
        $this->db->join('tbl_product_filter PF','PF.pid = P.id','LEFT');
        
        $this->db->where_in('PF.filterid',$filterKey);
        $this->db->where_in('PF.value',$filtervalues);        
        }

        $retunrData['products'] = $this->db->get($this->table)->result();
       // echo $this->db->last_query();
        $retunrData['counts'] = $countQuery->row();
        
        
        return $retunrData;
    }
   function getActiveProductCount(){
     
      $this->db->where('status  = "1"');
      return $this->db->get($this->table)->num_rows();
    }
    function getPopulerProducts($limit=5){
      $limit = intval($limit);
        $this->db->select('P.*');
        $this->db->from($this->table.' P');
        $this->db->join('tbl_order_items OI','P.id = OI.pid','join'); 
        $this->db->group_by('P.id'); 
        $this->db->order_by('count(OI.pid)','desc'); 
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    function getOutOfStockProduct($limit=5){
      $limit = intval($limit);
      $this->db->where('qty < 1 ');
      $this->db->limit($limit);
      $this->db->order_by('id','desc');
      return $this->db->get($this->table)->result();
    }
}