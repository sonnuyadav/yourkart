<style>
img.imgthumb{
    width:150px;
}
</style>
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
          <strong>Success!</strong> <?php echo $this->session->flashdata('success_msg') ?></div>
      	<?php } if(!is_null($error_msg)) { ?> 
         
      	<div class="alert alert-danger">
          <a aria-label="close" data-dismiss="alert" class="close" href="javascript:void(0)">×</a>
          <strong>Error!</strong> <?php echo $this->session->flashdata('error_msg') ?></div> 
      	<?php } ?>
      

                             <div class="box">
                                <div class="box-header with-border">
                                     
                                </div>
                                <div class="box-body">
                                    <table id="datatables" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th><?php echo lang('customer_name');?></th>
                                                <th><?php echo lang('customer_email');?></th>
                                                <th><?php echo lang('customer_phone');?></th>
                                                <th><?php echo lang('customer_state');?></th>
                                                <th><?php echo lang('customer_doe');?></th>
                                                <th><div class="pull-right"><?php echo lang('customer_orderamount');?></div></th>
                                                <th><div class="pull-right"><?php echo lang('customer_orders');?></div></th>
                                                 
                                            </tr>
                                        </thead>
                                        <tbody>
                     <?php $i=1;foreach ($customers as $dataValue):  ?>
                      <tr>
                          <td><?php echo $i++ ?></td>
                     <td><a href="<?php echo base_url('admin/customer/viewdetails/'.$dataValue->id)?>"><strong><?php echo ucwords($dataValue->fullname);?></strong></a></td>
                      <td><?php echo isset($dataValue->email) ? $dataValue->email :'';?></td>

                      <td><?php echo isset($dataValue->mobile) ? $dataValue->mobile :'';?></td>
                      <td><?php echo isset($dataValue->state) ? $dataValue->state :'';?></td>
                      
                      <td><?php echo isset($dataValue->doe) ? formatSQLDateTime($dataValue->doe,true) :'';?></td>
                      <td><div class="pull-right"><?php echo $dataValue->orderCount->order_count ?></div></td>
                      <td><div class="pull-right"><?php echo $dataValue->orderAmount->order_sum ?></div>  </td>
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