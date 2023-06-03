<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?php echo $subtitle; ?></h3>
                                </div>
                                <div class="box-body">

                        <?php if(!empty($validation_message)){ ?>
                            <div class="alert alert-danger">
                            
                            <?php echo $validation_message ?></div>
                        <?php }  ?>
                                    
                                    <?php echo form_open(current_url(), array('enctype'=>"multipart/form-data", 'class' => 'form-horizontal', 'id' => 'form-create_brand')) ;
                                        ?>
                                        <div class="form-group">
                                            <?php echo lang('slider_name', 'title', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_input($cattitle);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('slider_link', 'link', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_input($link);?>
                                            </div>
                                        </div>
                                        
                                        
                                       <div class="form-group">
                                            <?php echo lang('slider_image', 'name', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                              <input type="file" name="file" />  
                                            </div>
                                            <?php if(!empty($image)){?>
                                            <div class="col-sm-3">
                                              <img src="<?php echo $thumbimage?>" />  
                                              <input type="hidden" name="image" value="<?php echo $image?>" />  
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">

                                            <?php echo lang('slider_status', 'status', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($status);?>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-6">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat submit', 'content' => lang('actions_submit'))); ?>
                                                    <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-default btn-flat', 'content' => lang('actions_reset'))); ?>
                                                 
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
<script type="text/javascript">
window.onload = function() {    
    $("[name='status']").bootstrapSwitch();
};

</script>