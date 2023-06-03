<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

<section class="content">
  <!--main content start-->
    <div class="right_col" role="main">
          <div class="">
   <div class="invoice">
  <div id="mydiv">
          <div class="row">
            <div class="col-xs-12">
            <?php if(!empty($validation_message)){ ?>
              <div class="alert alert-danger">
                           <?php echo $validation_message ?></div>
             <?php }  ?>
              <h2 class="page-header">
                <?php echo getThemeValue('title');?>
                <small class="pull-right">Date: <?php echo formatSQLDateTime($order['order_date']);?></small>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">

            <div class="col-sm-4 invoice-col">
              From
              <address>
                <strong><?php echo getThemeValue('title');?></strong><br>
                
                Phone: <?php echo getThemeValue('admin_mobile');?><br/>
                Email: <?php echo getThemeValue('admin_email');?>
              </address> 
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
              To
              <address>
                <strong><?php 

                echo isset($order['name']) ? ucwords($order['name']) :'';?></strong><br>
                <?php echo !empty($order['order_address'])? $order['order_address'].'<br>' : '';?>
               <?php echo !empty($order['order_city'])? $order['order_city'].'<br/>' : '';?> 
               <?php echo !empty($order['order_zip'])? $order['order_zip'] : '';?>
               <?php echo !empty($order['order_state'])? $order['order_state'] : '';?>
                <?php echo !empty($order['order_country']) ? ucwords($order['order_country'].'<br/>') :'';
                if(!empty($order['order_phone'])){
                ?>
                Phone: <?php echo !empty($order['order_phone'])? $order['order_phone'].'<br/>' : '';
                } 
                if(!empty($order['emailid'])){
                ?>
                Email: <?php echo !empty($order['emailid'])? $order['emailid'] : ''; }?>
              </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <b>Invoice #<?php echo $order['invoice_id'];?></b><br/>
              
              <b>Order ID:</b> <?php echo $order['order_no'];?><br/>
              
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Table row -->
          <?php echo getOrderTable($order['id']);?>

         </div>
  </div>
        </div><!-- /.content -->



          </div>
      </div>
    

    


 </section>
</div>