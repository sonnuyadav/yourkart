<?php

// SELECT `metavalue` FROM `tbl_theme_options` WHERE `metakey` = 'title'<pre>Array ( ) </pre>
	
	

 	function create_slug($string)
	{
		$replacement = '-';
		$CI =& get_instance();
		$CI->load->helper(array('url', 'text', 'string'));
		$string = strtolower(url_title(convert_accented_characters($string), $replacement));
		return $string;
	}
	function unique_slug($table,$slug, $separator='', $increment_number_at_end=FALSE,$feildName = 'nicename') {    
	    //check if the last char is a number
	    //that could break this script if we don't handle it
	    $ci = & get_instance();
	    $last_char_is_number = is_numeric($slug[strlen($slug)-1]);
	    //add a point to this slug if needed to prevent number collision..
	    $slug = $slug. ($last_char_is_number && $increment_number_at_end? '.':'');

	    //if slug exists already, increment it
	    $i=0;
	    $limit = 20; //for security reason
	    $ci->db->where('nicename=',$slug);
	    $data = $ci->db->get($table)->row();	    
	    while( count($ci->db->where('`'.$feildName.'`', $slug)->get($table)->row())) {
	        //increment the slug
	    

	        $slug = increment_string($slug, $separator);

	        if($i > $limit) {
	            //break;
	            return FALSE;
	        }

	        $i++;
	    }

	    //so now we have unique slug
	    //remove the dot create because number collision
	    if($last_char_is_number && $increment_number_at_end) $slug = str_replace('.','', $slug);

	    return $slug;
	}

function pr($value = null) {
    printf('<pre>%s</pre>', print_r($value, true));
}
function moneyFormat($value,$place=2){
$price = round($value,$place);
return $price;
}
function getFormattedPrice($price,$actualPrice = 0){
		$price = number_format($price,2,'.','');
		if($actualPrice){
		$actualPrice = number_format($actualPrice,2,'.','');
			$price = '<span class="stike">'.$actualPrice.'</span><span class="amount">'.$price.'</span>';
		}else{
			$price = '<span class="amount">'.$price.'</span>';
		}
		
		return $price;
	}



	function getUrl($type,$nicename){
		$baseURL = base_url();
		$url = $baseURL.$type.'/'.$nicename;
		return $url;
	}
	function getThemeValue($key){
		$ci = & get_instance();
		$ci->load->model('theme_model');
		$key = strtolower($key);
		$ci->theme_model->db->where('metakey',$key);
		$ci->theme_model->db->select('metavalue');
		$ci->theme_model->db->from('tbl_theme_options');
		$value = $ci->theme_model->db->get()->row();
		if(@count($value)){
	 		return trim($value->metavalue);
		}else{
			return '';
		}

	}
	function convertToSQLDateTime($date,$start=false){
		$formattedDate = '';
		$endTime = ' 23:23:59';
		$startTime = ' 01:01:01';
			$formattedDate = date('Y-m-d h:I:s',strtotime($date.$endTime));
		if($start){
			$formattedDate = date('Y-m-d h:I:s',strtotime($date.$startTime));
		}
		return $formattedDate;
	}
	function formatSQLDateTime($datetime,$time = FALSE){
		$formattedDate = '';
			$formattedDate = date('d-m-Y',strtotime($datetime));
		if($time){
			$formattedDate = date('d-m-Y H:I:s',strtotime($datetime));
		}
		return $formattedDate;
	}


	function getStringFirstLetter($str){
	  $rest = substr($str, 0,1);  
	  return ucfirst($rest);
	}

	function getRealUserIp(){
    switch(true){
      case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
      case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
      case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
      default : return $_SERVER['REMOTE_ADDR'];
    }
 }

    function getfaceBookLoginUrl(){
    	$CI =& get_instance();
    	$appId = $CI->config->item('FBappId');
    	$secret = $CI->config->item('FBsecret');
    	$fbRedirect = $CI->config->item('FBreditect');
    	$CI->load->library('common/facebook',array('appId' => $appId,
           'secret' => $secret)

    	); 
    	$loginUrl  = site_url();
        $loginUrl = $CI->facebook->getLoginUrl(array(
                'redirect_uri' => site_url($fbRedirect), 
                'scope' => array("email") // permissions here
            ));
      
        return $loginUrl ;
    }
     function getGoogleLoginURL(){
    	$CI =& get_instance();
    	$login_url = $CI->googleplus->loginURL();
    	return $login_url;

    }
 function send_mail($to,$subject,$message,$type,$cc='',$bcc='')
    {
    	$ci = & get_instance();
        $ci->email->set_mailtype($type); 
        $ci->email->from(FROMEMAIL, WEBSITE);
        $ci->email->to($to);
        $ci->email->subject($subject);
        $ci->email->message($message);  
        $ci->email->send();       
        return $ci->email->print_debugger(); 
    }
    function getUserForgotPasswordLinkStr($userdata){
    	$str = md5($userdata->username.','.$userdata->id);
    	return $str;
    }
//for order status button
function isOrderStatus($isStatus){
  $class ='';
    switch ($isStatus) {
   case "canceled":
       $class ="danger";
        break;
 case "pending":
       $class = "primary";

 case "shipped":
       $class = "success";
  case "":
       $class = "success";      
}
return $class;
}
function humanTiming($time)
	{

	    $time = time() - $time; // to get the time since that moment
	    $time = ($time<1)? 1 : $time;
	    $tokens = array (
	        31536000 => 'year',
	        2592000 => 'month',
	        604800 => 'week',
	        86400 => 'day',
	        3600 => 'hour',
	        60 => 'minute',
	        1 => 'second'
	    );

	    foreach ($tokens as $unit => $text) {
	        if ($time < $unit) continue;
	        $numberOfUnits = floor($time / $unit);
	        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s ago':' ago');
	    }

	}

	function imgUpload($resize_options = array()){
		$ci = & get_instance();
		$uploadPath = './upload/media';
    	$uploadPath1 = 'upload/media/';
    	$config['upload_path']      = $uploadPath;
        $config['allowed_types']    = 'gif|jpg|png|jpeg';
        $config['maintain_ratio'] = TRUE;
        // $config['max_size']         = 2048;
        // $config['max_width']        = 1024;
        // $config['max_height']       = 1024;
        $config['encrypt_name'] = TRUE;
        $config['file_ext_tolower'] = TRUE;
        $ci->load->library('upload', $config);


        if ( ! $ci->upload->do_upload('file'))
        {
            /* Data */
            $error = $ci->upload->display_errors();
            pr($error); die();

        }
        else
        {
            /* Data */
            $uploaddata = $ci->upload->data();
            //pr($uploaddata); die();
         	$newImage = '';
         	$newImage = $uploaddata['file_name'];

            $imgpath = $uploaddata['full_path'];
		    $filename = $uploaddata['file_name'];
		    $filepath = $uploaddata['file_path'];
         	$ci->load->library('image_lib');
         	if(count($resize_options)){
				foreach ($resize_options as $key => $resize) {
					//pr($filepath .$key);
					if(!is_dir($filepath .$key)){
						mkdir($filepath .$key);
					}

				    $config = array(
				        'source_image' => $uploaddata['full_path'],
				        'new_image' => $filepath .$key,
				        'maintain_ratio' => TRUE,
				        'master_dim' => 'height',
				        //'width' => $resize[0],
				        'height' => $resize[1]
				    );

				    $ci->image_lib->initialize($config);
				    $ci->image_lib->resize();
				    $ci->image_lib->clear();
				  //  array_push($newImage, $key.'/'.$filename);
				}
			}	

        }
        return $newImage;

	}

	function getThumb($filename = ''){
		$uploadDir = 'upload/media/thumb/';
		return base_url($uploadDir.$filename);
	}
	function getMedium($filename = ''){
		$uploadDir = 'upload/media/medium/';
		return base_url($uploadDir.$filename);	
	}
	function getLarge($filename = ''){
		$uploadDir = 'upload/media/large/';
		return base_url($uploadDir.$filename);
	}


	function removeImg($img = '') {
		if(!empty($img)){
			$img = str_replace(base_url(), '', $img);
		}
		unlink($img);
	}

   
 