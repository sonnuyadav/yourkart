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
                                            <?php echo lang('brand_name', 'title', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_input($cattitle);?>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <?php echo lang('brand_desc', 'description', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_textarea($description);?>
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <?php echo lang('brand_image', 'name', array('class' => 'col-sm-2 control-label')); ?>
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

                                            <?php echo lang('brand_status', 'status', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($status);?>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <?php echo lang('brand_featured', 'brand_featured', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($featured);?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <?php echo lang('brand_metatitle', 'metatitle', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_input($metatitle);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('brand_metakeyword', 'metakeyword', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_input($metakeyword);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('brand_metadescrition', 'name', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_textarea($metadesc);?>
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
                                    <?php echo form_close();?>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
            <script type="text/javascript">
function ImgUploader(){
    $('.imgUploaderBtn').parent().click(function(){
        $(this).find('img').removeClass('hide');
        $(this).addClass('activeDiv');
    })
    $('.imgUploaderBtn').parent().fancybox({
        'titleShow'  : false,
        'transitionIn'  : 'elastic',
        'transitionOut' : 'elastic',
        'href': URL+'/admin/media/mediaAjaxUploader',
        'type': 'iframe',
        afterShow: function () {
            $(".fancybox-iframe").ready(function () {
                
                $(".fancybox-iframe").contents().find('div.thumbnail')
                    .on("click", function (e) {
                        var imgPath = $(this).find('img').attr('src');
                        
                        e.preventDefault();
                        $('div.activeDiv').find('img').attr('src',imgPath);

                        $.fancybox.close();
                        $('div.activeDiv').removeClass('activeDiv');
                        // do something here after click
                }); // on click
            }); // iframe ready
        } // afterShow
    });
}
window.onload = function() {
    ImgUploader();
   
    
    $("[name='status']").bootstrapSwitch();
    $("[name='is_menu']").bootstrapSwitch();
    $("[name='featured']").bootstrapSwitch();
    






$('button.submit').click(function(){
    var imgStr = '';
    $('img.uploadingImg').each(function(){
        if($.trim($(this).attr('src')) != ''){
            imgStr += $(this).attr('src');
        }
    })
    $('#postImage').val(imgStr);
    //console.log(imgStr); return false;
    $('#form-create_brand').submit();
});



};

</script>