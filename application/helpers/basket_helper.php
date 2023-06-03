<?php
function getcartdetails(){
  $obj = & get_instance();
  //for session cart data
 $data['cartCount'] = isset($_SESSION['shop_cart_session']) ? count($_SESSION['shop_cart_session']) : 0;
      $data['couponDiscount'] = 0;
      if($data['cartCount']){
        $data['cartItems'] = $_SESSION['shop_cart_session'];
        foreach($_SESSION['shop_cart_session'] as $key => $cartItems){
          $cartDetails = array();
          $cartDetails = $obj->product_model->getCartProductsDetails($key);
          $data['cartItems'][$key]['productDetails'] = $cartDetails;
        }
        $data['totalPrice'] = 0;
        foreach($data['cartItems'] as $cartItems){
         $data['totalPrice'] += $cartItems['productDetails']['qtyproductPrice'];
        }
 
        $data['totalPrice'] = getFormattedPrice($data['totalPrice']);
        if(isset($_SESSION['shop_cart_coupon'])){
            
             if($_SESSION['shop_cart_coupon']['category'] == ''){

              $data['couponDiscount'] = getFormattedPrice(($data['totalPrice']*$_SESSION['shop_cart_coupon']['percent'])/100);
              //$data['totalPrice'] = $data['totalPrice']-$data['couponDiscount'];
            }else{
              $counponCategory = explode(',',$_SESSION['shop_cart_coupon']['category']);
              $couponValidAmount = 0;
              foreach($data['cartItems'] as $cartItems){

                if(in_array($cartItems['productDetails']['cat_id'], $counponCategory)){
                  $couponValidAmount += $cartItems['productDetails']['qtyproductPrice'];
                }
              }
              $data['couponDiscount'] = getFormattedPrice(($couponValidAmount*$_SESSION['shop_cart_coupon']['percent'])/100);
            }
        }

      }
      return $data;
}





//for send email using order table
function getOrderTable($oid){
	$obj = & get_instance();
	$orderdetails = $obj->orders_model->getOrderDetailsById($oid);
	$ordItems = $obj->orderitems_model->getListitems($oid); 
ob_start();
 ?>
<table cellspacing="0" cellpadding="6" style="width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;color:#737373;border:1px solid #e4e4e4" border="1">
          <thead>
             <tr>
                <th scope="col" style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">Product</th>
                <th scope="col" style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">Quantity</th>
                <th scope="col" style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">Price</th>
             </tr>
          </thead>
          <tbody>
         <?php
          $couponDiscount = $orderdetails['couponamount'];
         foreach ($ordItems as $key => $mailValue):
             $price = $mailValue->item_price;
             $subtotal[] = $price * $mailValue->qty;
          ?>
             <tr>
                <td style="text-align:left;vertical-align:middle;border:1px solid #eee;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;color:#737373;padding:12px"><?php echo isset($mailValue->item_name) ? $mailValue->item_name :'';?><br><small></small>
                </td>
                <td style="text-align:left;vertical-align:middle;border:1px solid #eee;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;color:#737373;padding:12px"><?php echo isset($mailValue->qty) ? $mailValue->qty :'';?></td>
                <td style="text-align:left;vertical-align:middle;border:1px solid #eee;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;color:#737373;padding:12px"><span><?php echo isset($mailValue->item_price) ? $mailValue->item_price :'';?></span></td>
             </tr>
             <?php endforeach;?>
             </tbody>

            <tfoot>
               <tr>
                  <th scope="row" colspan="2" style="text-align:left;border-top-width:4px;color:#737373;border:1px solid #e4e4e4;padding:12px">Subtotal:</th>
                  <td style="text-align:left;border-top-width:4px;color:#737373;border:1px solid #e4e4e4;padding:12px"><span><?php  echo moneyFormat(array_sum($subtotal));?></span></td>
               </tr>
               <?php if($couponDiscount){?>
               <tr>
                 <th scope="row" colspan="2" style="text-align:left;border-top-width:4px;color:#737373;border:1px solid #e4e4e4;padding:12px">Coupon Discount:</th>
                  <td style="text-align:left;border-top-width:4px;color:#737373;border:1px solid #e4e4e4;padding:12px"><span><?php  echo moneyFormat($couponDiscount);?></span></td>
               </tr>
               <?php } ?>
               <tr>
                  <th scope="row" colspan="2" style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">Shipping:</th>
                  <td style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">
                     <span><?php
                     $shipping = isset($mailValue->order_shipping_charge) ? $mailValue->order_shipping_charge:'';
                     echo moneyFormat($shipping);
                     ?></span>&nbsp;
                     <?php if(!empty($mailValue->order_city)){?>
                        <small>
                     via <?php echo isset($mailValue->order_city) ? $mailValue->order_city:'';?></small>
                     <?php }?>
                  </td>
               </tr>
             
               <tr>
                  <th scope="row" colspan="2" style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">Payment Method:</th>
                  <td style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px"><?php echo isset($mailValue->order_method) ? ucwords($mailValue->order_method):'';?></td>
               </tr>
               <tr>
                  <th scope="row" colspan="2" style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">Total:</th>
                  <td style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px"><span><?php echo 
                  moneyFormat(array_sum($subtotal)+$shipping-$couponDiscount);
                  ?></span></td>
               </tr>
            </tfoot>
           </table>
           <?php
          return $table = ob_get_clean();
}