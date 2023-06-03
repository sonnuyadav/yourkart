
<link rel="stylesheet" type="text/css" href="<?php echo base_url($frontend_dir)?>/css/cart.css">
<!---POP SECTION START------------------------------>
         <div class="innerContainer innerPage">
         	<div class="row">
            	<div class="col-md-12">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo base_url()?>">Home</a></li>
                      <li class="active">Shopping Cart</li>
                    </ul>
                    <div class="innerContainerContent cart">
                    <?php if(isset($cartItems) && count($cartItems)){?>
                        <div class="content">
                          <div class="col-md-8">
                            	<h4><a href="<?php echo base_url()?>"><i class="forward glyphicon glyphicon-arrow-left"></i> Shopping Cart</a></h4>
                                <div class="itemList">
                                	<h5>Products</h5>
                                    <div class="item">                                    	
                                        <table class="table table-hover">
                                            <thead>
                                            	<tr>
                                                	<th>Image</th>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php 
                                              foreach($cartItems as $key => $cart){?>
                                              <tr>
                                                <td><img src="<?php echo getThumb($cart['productDetails']['image'])?>" width="75"></td>
                                                <td><?php echo $cart['productDetails']['title']?></td>
                                                <td><i class="fa fa-inr"></i> <?php echo $cart['productDetails']['saleprice']?></td>
                                                <td><input type="number" id="example-number-input_<?php echo $key ?>" class="quantity proQty" name="" value="<?php echo $cart['qty'] ?>"></td>
                                                <td><a href="<?php echo base_url('basket/removeItem/'.$key)?>" class="cancel"><i class="glyphicon glyphicon-remove"></i></a></td>
                                              </tr>                                
                                            <?php } ?>                      
                                             </tbody>                                             
                                        </table>
                                    </div>
                                </div>
                            </div>
                        	<div class="col-md-3 pull-right">
                            	<h4 align="right"><a href="<?php echo base_url()?>">Continue Shopping <i class="forward glyphicon glyphicon-arrow-right"></i></a></h4>
                                <div class="itemList">
                                	<h5>Subtotal</h5>
                                    <div class="item">
                                    	<table class="table table-hover" width="100%">                                            
                                            <tbody>
                                              <tr>
                                                <td>Total</td>
                                                <td align="right"><i class="fa fa-inr"></i> <?php echo $totalPrice ?></td>
                                              </tr>
                                              <tr>
                                                <td>Net Price</td>
                                                <td align="right"><i class="fa fa-inr"></i> <?php echo $totalPrice ?></td>
                                              </tr>   
                                              <tr>
                                                <td colspan="2"><a href="<?php echo base_url('basket/checkout') ?>" class="checkout">Checkout</a></td>
                                              </tr>                                                   
                                             </tbody>                                             
                                        </table>
                                     </div>
                                </div>
                            </div>
                        	<div class="clearfix"></div>
                        </div>
                    <?php } else{ ?>
                      <div class="content">
                          <div class="col-md-12">
                            Empty Basket
                          </div>
                      </div>
                    <?php } ?>
                    </div>
                </div>
            </div>           
    <script type="text/javascript" src="<?php echo base_url($frontend_dir)?>/js/script.js"></script>
