
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$success_msg = $this->session->flashdata('success_msg');
$error_msg = $this->session->flashdata('error_msg');
?>
              <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
        <?php if(!is_null($success_msg)) {?> 
        <div class="alert alert-success">
          <a aria-label="close" data-dismiss="alert" class="close" href="javascript:void(0)">×</a>
          Success! <?php echo $this->session->flashdata('success_msg') ?></div>
        <?php } if(!is_null($error_msg)) { ?> 
         
        <div class="alert alert-danger">
          <a aria-label="close" data-dismiss="alert" class="close" href="javascript:void(0)">×</a>
          Error! <?php echo $this->session->flashdata('error_msg') ?></div> 
        <?php } ?>
        <div class="box">
          <div class="box-header with-border">
               <h3>Customer Details</h3>
          </div>
          <div class="box-body">
              <table class="table table-striped table-hover">
                  <thead>
                      <tr>
                          <th><?php echo lang('customer_name');?></th>
                          <th><?php echo lang('customer_email');?></th>
                          <th><?php echo lang('customer_phone');?></th>
                          <th><?php echo lang('customer_company');?></th>
                          <th><?php echo lang('customer_address');?></th>
                          <th><?php echo lang('customer_state');?></th>
                          <th><?php echo lang('customer_city');?></th>
                          <th><?php echo lang('customer_zip');?></th>
                          <th><?php echo lang('customer_register');?></th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td><?php echo ucwords($customer->fullname);?></td>
                        <td><?php echo $customer->email;?></td>
                        <td><?php echo $customer->mobile;?></td>
                        <td><?php echo $customer->company;?></td>
                        <td><?php echo $customer->address1;?></td>
                        <td><?php echo $customer->state;?></td>
                        <td><?php echo $customer->city;?></td>
                        <td><?php echo $customer->pincode;?></td>
                        <td><?php echo formatSQLDateTime($customer->doe);?></td>
                    </tr>
                  </tbody>
              </table>
          </div>
      </div>
         <div class="box">
            <div class="box-header with-border">
                 <h3>Orders</h3>
            </div>
            <div class="box-body">
                <table id="datatables" class="table table-striped table-hover">
                    <thead>
                        <tr>
                          <th>#</th>
                            <th><?php echo lang('order_date');?></th>
                            <th><?php echo lang('order_method');?></th>
                            <th><?php echo lang('order_status');?></th>
                            <th><?php echo lang('order_amount');?></th>
                             <th><?php echo lang('order_action');?></th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php $i=1;foreach ($orders as $dataValue):
                     //pr($dataValue); die();
                     ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo date('d-m-Y h:i',strtotime($dataValue->order_date));?></td>      

                        <td><?php echo ucwords($dataValue->order_method);?></td>
                        <td><?php echo $dataValue->ord_status =='' ? 'Pending' : $dataValue->ord_status ;?></td>
                        
                        <td>Rs. <?php echo $dataValue->ord_total_amount-$dataValue->couponamount ;?></td>
                        <td>
                           <div class="btn-group">
                              <?php 
                                 if($dataValue->is_shiped !=""){
                                 $morder = isset($dataValue->is_shiped) ? ucfirst($dataValue->is_shiped) :'';
                                 }else{
                                 $morder = 'New Order';
                                 }
                                 ?>
                              <a class="btn btn-<?php echo isOrderStatus($dataValue->is_shiped);?>" href="" title="Bootstrap 3 themes generator"><?php echo $morder;?></a>
                              <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href=""><span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                 <li><a href="<?php echo base_url("admin/orders/changestatus?oid=$dataValue->id&action=pending"); ?>">Pending</a></li>
                                 <li><a href="<?php echo base_url("admin/orders/changestatus?oid=$dataValue->id&action=shipped"); ?>">Shipped</a></li>                
                                 <li><a href="<?php echo base_url("admin/orders/changestatus?oid=$dataValue->id&action=canceled"); ?>">Cancelled</a></li>
                              </ul>
                           </div>
                           &nbsp;
                           <a href="<?php echo base_url('admin/orders/viewdetails/'.$dataValue->id)?>"><span class="btn btn-primary fa fa-info"></span></a>
                           <!-- /btn-group -->
                        </td>
                   </tr>
           <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
<script type="text/javascript">
window.onload = function() {
    $('#datatables').DataTable();
   
};
</script>