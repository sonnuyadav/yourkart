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
                                <div class="box-body">
                                    <table id="datatables" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th><?php echo lang('signup_email');?></th>
                                                <th><?php echo lang('signup_status');?></th>
                                                <th><?php echo lang('signup_added_at');?></th>
                                                <th><?php echo lang('signup_action');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php $i=1;foreach ($signups as $values):
$statusHTml  = "<div class='label label-success'>Active</div>";
if($values->status == '0'){
$statusHTml  = "<div class='label label-danger'>Inactive</div>";
}
?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo htmlspecialchars($values->email, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                              <?php echo $statusHTml ?>
                            </td>
                            <td><?php echo htmlspecialchars(date('d M Y h:i:s',strtotime($values->doe)), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                              <a href="<?php echo base_url('admin/signups/changestatus/'.$values->id.'/'.$values->status)?>" class="btn btn-primary">Change Status</a>
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