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
                                    
                                    <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_brand')) ;
                                        ?>
                                        <div class="form-group">
                                            <?php echo lang('page_name', 'title', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_input($cattitle);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('page_desc', 'content', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_textarea($content);?>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <?php echo lang('page_metatitle', 'metatitle', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_input($metatitle);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('page_metakeyword', 'metakeyword', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_input($metakeyword);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('page_metadescrition', 'name', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_textarea($metadesc);?>
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
<script type="text/javascript" src="<?php echo base_url($frameworks_dir);?>/tinymce/index.js"></script>
<script type="text/javascript" src="<?php echo base_url($frameworks_dir);?>/tinymce/tinyMceInit.js"></script>
