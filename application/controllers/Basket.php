<?php
//This is post controller
defined('BASEPATH') OR exit('No direct script access allowed');

class Basket extends Public_Controller {
   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/theme_model');
        $this->load->library('email');
        $this->load->model('admin/product_model');
        $this->load->model('admin/customer_model');
        $this->load->model('admin/orders_model');
        $this->load->model('admin/orderitems_model');
          $this->load->model('public/state_model');
        $this->metaTitle = getThemeValue('meta_title');
        $this->metakeyword = getThemeValue('meta_keywords');
        $this->metadescription = getThemeValue('meta_desc');
    }
    function getCartCount(){
      echo isset($_SESSION['shop_cart_session']) ? count($_SESSION['shop_cart_session']) : 0;
    }
// for add to cart
   public function addtocart() {
    //pr($_POST); die();
      $qty1 = isset($_POST['qty']) ? intval($_POST['qty']) :1;
      $proad_id = isset($_POST['pid']) ? intval($_POST['pid']) :0; 
      $cartArray = array();  
      $cartArray['qty'] = $qty1;
      $cartArray['pro_id'] = $proad_id; 
      $flag = 1; 
      if (isset($_SESSION['shop_cart_session']) && count($_SESSION['shop_cart_session'])) {
        $flag = 0;
        foreach($_SESSION['shop_cart_session'] as $key => $value){
      
          if($value['pro_id'] == $proad_id){
            if($_SESSION['shop_cart_session']){
              $_SESSION['shop_cart_session'];
            }
            $flag = 1;
          }
        }
        if(!$flag)

          array_push($_SESSION['shop_cart_session'], $cartArray);
        setcookie("shop_cart_cookie", json_encode($_SESSION['shop_cart_session']), strtotime('+365 days'), "/");
      } 
      else {
        
          $_SESSION['shop_cart_session'] = array();
          array_push($_SESSION['shop_cart_session'],$cartArray);
      }
      //redirect('basket');
} 
//for show items in cart
public function index(){
  //pr($_SESSION['shop_cart_session']); die(); 
  $this->data['cartCount'] = isset($_SESSION['shop_cart_session']) ? count($_SESSION['shop_cart_session']) : 0;
      $this->data['couponDiscount'] = 0;

      if($this->data['cartCount']){
        $this->data['cartItems'] = $_SESSION['shop_cart_session'];
        foreach($_SESSION['shop_cart_session'] as $key => $cartItems){
          $cartDetails = array();
         $cartDetails = $this->product_model->getCartProductsDetails($key);
          // pr($cartDetails);
           $this->data['cartItems'][$key]['productDetails'] = $cartDetails;
         }
        $this->data['totalPrice'] = 0;

        foreach($this->data['cartItems'] as $cartItems){
         $this->data['totalPrice'] += $cartItems['productDetails']['qtyPrice'];
         
        }

        $this->data['totalPrice'] = moneyFormat($this->data['totalPrice']);
      }
  $this->template->render('public/basket/index', $this->data);
 
 }
//for update qnty of basket
  function updateQty(){
    $cart = $this->product_model->getCartProductsDetails($_POST['key']);
   
      $Qty = $cart['qty'];
      if(intval($_POST['qty']) <= 0 ){
        $qty = 1;
      }else{
        $qty = intval($_POST['qty']);
      }
     if($qty > $Qty){
       $this->session->set_flashdata('carterror',"Selected quantities are not available in our stock");
      }else{
       $this->session->set_flashdata('cartsuccess','Quantity updated successfully');
        $_SESSION['shop_cart_session'][$_POST['key']]['qty'] = $qty;

      }

    }
//for remove cart item
      public function removeItem($key = false){
        
      if($key !== false){
        $cartItems = intval($key);
       // pr($_SESSION['shop_cart_session'][$key]); die();
        unset($_SESSION['shop_cart_session'][$key]);
      }
      //pr($_SESSION['shop_cart_session']); die();  
      redirect('basket','refresh');
      //$this->session->set_flashdata('cartsuccess','Cart item removed successfully');
    }
    
 public function checkout(){
     $this->data['cartCount'] = isset($_SESSION['shop_cart_session']) ? count($_SESSION['shop_cart_session']) : 0;
     if($this->data['cartCount'] <1){
      redirect(base_url(),'refresh');
     }
  $customer= isset($_SESSION['customer']) ? $_SESSION['customer'] : array();
     $this->data['states'] = $this->state_model->getAllState(); 
     if(count($customer)){      
     $this->data['customer'] = $this->customer_model->getUserDetails($customer['email']); 
     }
     
     
      $this->data['couponDiscount'] = 0;

      if($this->data['cartCount']){
        $this->data['cartItems'] = $_SESSION['shop_cart_session'];
        foreach($_SESSION['shop_cart_session'] as $key => $cartItems){
          $cartDetails = array();
         $cartDetails = $this->product_model->getCartProductsDetails($key);
          // pr($cartDetails);
           $this->data['cartItems'][$key]['productDetails'] = $cartDetails;
         }
        $this->data['totalPrice'] = 0;

        foreach($this->data['cartItems'] as $cartItems){
         $this->data['totalPrice'] += $cartItems['productDetails']['qtyPrice'];
         
        }

        $this->data['totalPrice'] = moneyFormat($this->data['totalPrice']);
      }

  $this->template->render('public/basket/checkout', $this->data);
 
 }

  public function checkCoupon(){
    $coupon  = isset($_POST['coupon']) ? $_POST['coupon'] : 0; 
      $couponDetails = $this->coupon_model->checkCouponValidity($coupon);
      $return = 1;
      if(!$couponDetails){
        $return = 0;
      }else{
        $_SESSION['shop_cart_coupon'] = $couponDetails;
      }
      echo json_encode($return);
    } 

     function removeCoupon(){
      unset($_SESSION['shop_cart_coupon']);
     redirect('basket/checkout');
    } 

//for order
public function order(){
if(!isset($_SESSION['shop_cart_session'])){
 redirect('basket');
} 

foreach($_SESSION['shop_cart_session'] as $key => $cartItems){
    $cartDetails = array();
   $cartDetails = $this->product_model->getCartProductsDetails($key);
    // pr($cartDetails);
     $this->data['cartItems'][$key]['productDetails'] = $cartDetails;
   }
  $this->data['totalPrice'] = 0;

  foreach($this->data['cartItems'] as $cartItems){
   $this->data['totalPrice'] += $cartItems['productDetails']['qtyPrice'];
   
  }
  $totalprice = $this->data['totalPrice'];


//for payment gateway value send and insert data for order value
$this->data = array();
$this->data['uid'] = 1;

$this->data['name'] = $_SESSION['checkout']['fullname'];
$this->data['order_address'] = $_SESSION['checkout']['address1'];
$this->data['order_landmark'] = $_SESSION['checkout']['address2'];
$this->data['order_city'] = $_SESSION['checkout']['city'];
$this->data['order_country'] = 'India';
$this->data['order_state'] = isset($_SESSION['checkout']['state']) ? $_SESSION['checkout']['state'] : '' ;
$this->data['order_zip'] = $_SESSION['checkout']['pincode'];
$this->data['order_phone'] = $_SESSION['checkout']['phone'];
$this->data['ord_total_amount'] =  $totalprice;
 
$this->data['emailid'] = $_SESSION['checkout']['email'];
$this->data['order_method'] = 'COD';
$this->data['ipaddress'] = getRealUserIp();
$this->data['order_date'] = date('Y-m-d H:i:s');

$getLastId = $this->orders_model->getLastId();
$this->data['order_no'] = 'GPS' . "~" . ($getLastId['id'] + 1);
$pre = date('y');
$next = date('y') + 1;
$inv_id = 'GPS/' . $pre . '-' . $next . '/' . date("m") . '-' . (($getLastId['id']) + 1);
$this->data['invoice_id'] = $inv_id;


$this->data['orderid'] = $this->orders_model->insert($this->data);
//for session cart data
 $data['cartCount'] = isset($_SESSION['shop_cart_session']) ? count($_SESSION['shop_cart_session']) : 0;
      $data['couponDiscount'] = 0;
      if($data['cartCount']){
        $data['cartItems'] = $_SESSION['shop_cart_session'];
        foreach($_SESSION['shop_cart_session'] as $key => $cartItems){
          $cartDetails = array();
          $cartDetails = $this->product_model->getCartProductsDetails($key);
          $data['cartItems'][$key]['productDetails'] = $cartDetails;
        }
        $data['totalPrice'] = 0;
        foreach($data['cartItems'] as $cartItems){
        
         $data['totalPrice'] += $cartItems['productDetails']['saleprice']*$cartItems['qty'];
        }

        $data['totalPrice'] = $data['totalPrice'];
      }
if($data['cartCount']){ 
foreach ($data['cartItems'] as $key => $cartval) {
    $ordersVal['pid']         = $cartval['productDetails']['id'];
    $ordersVal['ord_id']      = $this->data['orderid'];
    $ordersVal['item_name']   = $cartval['productDetails']['title'];
    $ordersVal['item_image']  = $cartval['productDetails']['image'];
    $ordersVal['item_price']   = $cartval['productDetails']['saleprice'];     
    $ordersVal['qty']         = $cartval['qty'];
    $this->orderitems_model->insert($ordersVal);
}

} 
if($this->data['order_method'] == 'COD'){ 
$cartValue = isset($data['cartItems']) ? $data['cartItems']:'';
if(!empty($cartValue)){
foreach ($cartValue as $key => $cartItems) {
  //$this->updateStock($cartItems['pro_id'],$cartItems['qty']);
 }
}

  $orderMsg ='Success';
  $ordersUpdate = $this->orderStatusTable($this->data['orderid'],$orderMsg);
  $completeaddress =  $this->data['order_address'] ." ". $this->data['order_landmark'] .",". $this->data['order_city'] .",".$this->data['order_zip']."-".$this->data['order_state'].",".$this->data['order_country'];
   $attributes['fullname']      = ucwords($this->data['name']);   
   $attributes['orderid']     = $this->data['invoice_id']; 
   $attributes['email']        = $this->data['emailid']; 
   $attributes['phone']        = $this->data['order_phone']; 
   $attributes['address']        = $completeaddress; 
   $attributes['table']        =  getOrderTable($this->data['orderid']);
  $subject ="Your order has been success";   
 if(!islocal()){
  $message = $this->load->view('email-templates/public/ordersuccess', $attributes, true);
  $isMailSent = send_mail($this->data['emailid'],$subject,$message,'html');
  } 
   $subject ="GPS New Order";  
   $adminmail  = 'info@globalproductsshopping.com';
   //$adminmail  = 'saifi.sahiq@gmail.com';
 if(!islocal()){
  $message = $this->load->view('email-templates/public/adminorder', $attributes, true);
  $isMailSent = send_mail($adminmail,$subject,$message,'html');
  } 
//$delete = $this->cartModel->delete(array('uid' => Session::get('user_id'))) ? 'true' : 'false';
  unset($_SESSION['checkout']);
  unset($_SESSION['shop_cart_session']);
  unset($_SESSION['shop_count_session']);
  unset($_SESSION['shop_cart_coupon']);
  redirect('thankyou');
  }

}
 
public function orderresponse(){
if(!empty($_POST['ResponseMessage']) && !empty($_POST['MerchantRefNo'])){  
$ordId = isset($_POST['MerchantRefNo']) ? $_POST['MerchantRefNo'] :0;
$orderMsg = array();
$orderMsg['ord_status'] =isset($_POST['ResponseMessage']) ? $_POST['ResponseMessage'] :'';
$cartValue = $_SESSION['shop_cart_session'];
if(!empty($cartValue)){
foreach ($cartValue as $key => $cartItems) {
  $this->updateStock($cartItems['pro_id'],$cartItems['qty']);
 }
}

$orderMsg['respcode'] =isset($_POST['TransactionID']) ? $_POST['TransactionID'] :'';
$this->orders_model->update($orderMsg, intval($ordId));
$serialize['payuresponse'] = serialize($_POST);
$serialize['oid'] = $ordId;
 $this->payresponse_model->insert($serialize);
 
$getOrderDetails = $this->orders_model->getOrderDetailsById($ordId);
$completeaddress =  $getOrderDetails['order_address'] ." ". $getOrderDetails['order_landmark'] .",". $getOrderDetails['order_city'] .",".$getOrderDetails['order_zip']."-".$getOrderDetails['order_state'].",".$getOrderDetails['order_country'];
         $attributes['fullname']      = ucwords($getOrderDetails['name']);   
         $attributes['orderid']     = $getOrderDetails['invoice_id']; 
         $attributes['email']        = $getOrderDetails['emailid']; 
         $attributes['phone']        = $getOrderDetails['order_phone']; 
         $attributes['address']        = $completeaddress; 
         $attributes['table']        =  getOrderTable($ordId); 
  $subject ="Your order has been success"; 
 if(!islocal()){
  //$message = $this->load->view('email-templates/public/orderresponse', $attributes, true);
  //$isMailSent = send_mail($getOrderDetails['emailid'],$subject,$message,'html');
  } 

  unset($_SESSION['shop_cart_session']);
  unset($_SESSION['shop_count_session']);
  unset($_SESSION['shop_cart_coupon']);
  redirect('thankyou');
}else{
  redirect();
}
}

public function updateStock($pid,$qty){
    $data = $this->product_model->getQuantity($pid);
    $id = $data['id'];
    $prevqty = $data['qty'];
    $update = array();
    $update['qty'] = abs($prevqty-$qty);
   $this->product_model->update($update,$id);
  }

  public function orderStatusTable($oid =NULL, $fields =NULL){
 $update['ord_status'] = $fields;
 return $this->orders_model->update($update,$oid);
  }

public function codorderconfirmation(){
  $this->template->render('public/basket/codorderconfirmation');
}

}
