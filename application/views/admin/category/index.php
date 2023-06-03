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
                                    <h3 class="box-title"><?php echo anchor('admin/category/create', '<i class="fa fa-plus"></i> '. lang('category_create'), array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                                </div>
                                <div class="box-body">
                                    <table id="datatables" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th><?php echo lang('category_name');?></th>
                                                <th><?php echo lang('category_image');?></th>
                                                <th><?php echo lang('category_parent');?></th>
                                                
                                                <th><?php echo lang('category_status');?></th>
                                                <th><?php echo lang('category_featured');?></th>
                                                <th><?php echo lang('category_added_at');?></th>
                                                <th><?php echo lang('category_updated_at');?></th>
                                                
                                                
                                                <th><?php echo lang('groups_action');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php $i=1;foreach ($category as $values):
?>
                                            <tr>
                                                <td><?php echo $i++ ?></td>
                                                <td><?php echo htmlspecialchars($values->title, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php 
                                                if($values->image != ''){ ?>

                                                    <img src="<?php echo getThumb($values->image); ?>" /></td>
                                                <?php } else {
                                                    echo '';
                                                } ?>
                                                
                                                <td><?php echo is_null($values->parentname) ? 'NA' :  $values->parentname ?></td>
                                                <td><?php echo $values->status == '0' ? '<span class="label label-danger">Inactive</span>' : '<span class="label label-success">Active</span>'; ?></td>
                                                <td><?php echo $values->featured == '0' ? '<span class="label label-danger">Inactive</span>' : '<span class="label label-success">Active</span>'; ?></td>
                                                <td><?php echo htmlspecialchars(date('d M Y h:i:s',strtotime($values->doe)), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php
                                            
                                                if(intval($values->dou))
                                                 echo date('d M Y h:i:s',strtotime($values->dou));else echo '-'; ?></td>
                                                
                                                <td>
                                                	<?php echo anchor("admin/category/create/".$values->id, '&nbsp;','class="fa fa-pencil"'); ?>
                                            		<?php echo anchor("admin/category/delete/".$values->id,'&nbsp;','class="fa fa-trash delete"'); ?>
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
    $('.delete').click(function(){
        return confirm('Are you sure to delete this category?');
    });
    $('#datatables').DataTable();
};
    
</script>