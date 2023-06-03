<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$success_msg = $this->session->flashdata('success_msg');
$error_msg = $this->session->flashdata('error_msg');
?>
<style type="text/css">
    div.sliderWrapper{
        float: left;
        margin-right: 10px;
    }
    div.uploadWrapper{
        margin: 10px 0 10px;
    }
    button.imgUploaderBtn{
        float: left;
        margin-right: 10px; 
    }
    .avatar-view {
    border: 3px solid #ffffff;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    display: block;
    height: 220px;
    overflow: hidden;
    width: 220px;
}
</style>
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

                       <div class="row">
            <?php echo form_open('admin/theme/create', array('class' => 'form-horizontal', 'id' => 'form-create_theme')) ; 
                                        ?>
                        <div class="col-md-12"> 
                <h3>General Information</h3>
                    <hr>
                <div class="form-group">
                  <label for="last-name" class="control-label col-md-3 col-sm-3 col-xs-12">Website Name</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12"  name="title" value="<?php echo getThemeValue('title');?>" type="text">
                  </div>
                </div>

                <div class="form-group">
                  <label for="last-name" class="control-label col-md-3 col-sm-3 col-xs-12">About Us Home</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="home_about_us" class="form-control col-md-7 col-xs-12 tinyMce"><?php echo getThemeValue('home_about_us');?></textarea>
                  </div>
                </div>


                <div class="form-group">
                  <label for="last-name" class="control-label col-md-3 col-sm-3 col-xs-12">Admin Email</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12"  name="admin_email" value="<?php echo getThemeValue('admin_email');?>" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label for="last-name" class="control-label col-md-3 col-sm-3 col-xs-12">Mobile No</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12"  name="admin_mobile" value="<?php echo getThemeValue('admin_mobile');?>" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label for="last-name" class="control-label col-md-3 col-sm-3 col-xs-12">Meta Title</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12"  name="meta_title" value="<?php echo getThemeValue('meta_title');?>" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label for="last-name" class="control-label col-md-3 col-sm-3 col-xs-12">Meta Keyword</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12"  name="meta_keywords" value="<?php echo getThemeValue('meta_keywords');?>" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label for="last-name" class="control-label col-md-3 col-sm-3 col-xs-12">Meta Description</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="meta_desc" class="form-control col-md-7 col-xs-12"><?php echo getThemeValue('meta_desc');?></textarea>
                  </div>
                </div>

                <h3>Social Information</h3>
                <hr>

                <div class="form-group">
                  <label for="last-name" class="control-label col-md-3 col-sm-3 col-xs-12">Facebook</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12"  name="facebook_url" value="<?php echo getThemeValue('facebook_url');?>" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label for="last-name" class="control-label col-md-3 col-sm-3 col-xs-12">Google</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12"  name="google_url" value="<?php echo getThemeValue('google_url');?>" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label for="last-name" class="control-label col-md-3 col-sm-3 col-xs-12">Twitter</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12"  name="twitter_url" value="<?php echo getThemeValue('twitter_url');?>" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label for="last-name" class="control-label col-md-3 col-sm-3 col-xs-12">Linkedin</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12"  name="linkedin_url" value="<?php echo getThemeValue('linkedin_url');?>" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label for="last-name" class="control-label col-md-3 col-sm-3 col-xs-12">Instagram</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12"  name="instagram_url" value="<?php echo getThemeValue('instagram_url');?>" type="text">
                  </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                        <div class="btn-group">
                            <?php echo form_button(array('type' => 'button', 'class' => 'btn btn-primary btn-flat submit', 'content' => lang('actions_submit'))); ?>
                            <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-default btn-flat', 'content' => lang('actions_reset'))); ?>
                         
                        </div>
                    </div>
                </div>
               
                 </div>

                                </div>
                                 <?php echo form_close();?>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
<script type="text/javascript">
  window.onload = function() {
    $('button.submit').click(function(){
      $('#form-create_theme').submit();
    });
  };
</script>
<script type="text/javascript" src="<?php echo base_url($frameworks_dir);?>/tinymce/index.js"></script>
<script type="text/javascript" src="<?php echo base_url($frameworks_dir);?>/tinymce/tinyMceInit.js"></script>