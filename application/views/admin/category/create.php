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
                                    
                                    <?php echo form_open(current_url(), array('enctype'=>'multipart/form-data','class' => 'form-horizontal', 'id' => 'form-create_category')) ;
                                        ?>
                                        <div class="form-group">
                                            <?php echo lang('category_name', 'title', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_input($cattitle);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('category_parent', 'cat_parent', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <select id="cat_parent" name="cat_parent" class="form-control">
                                                <option value=''>Choose Category</option>
                                                <?php if(isset($cats) && count($cats)){
                                                    foreach ($cats as $cat) { ?>
                                                        <option <?php echo $parentCat == $cat->id ? 'selected': '' ?> value="<?php echo $cat->id ?>"><?php echo $cat->title ?></option>
                                               <?php     }
                                                } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('category_desc', 'description', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_textarea($description);?>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <?php echo lang('category_status', 'status', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($status);?>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <?php echo lang('category_featured', 'featured', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($featured);?>
                                            </div>
                                        </div>
                                         
                                        <div class="form-group">
                                            <?php echo lang('category_metatitle', 'metatitle', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_input($metatitle);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('category_metakeyword', 'metakeyword', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_input($metakeyword);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('category_metadescrition', 'name', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_textarea($metadesc);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('category_image', 'name', array('class' => 'col-sm-2 control-label')); ?>
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
                                        <h3>Filters</h3>
                                        <div class="filtersWrapper">                                           
                                            <?php if(count($catFilters)){ 
                                                foreach($catFilters as $catFilter) {
                                                ?>
                                                <div class="form-group itemRow">
                                                    <label class="col-sm-2 control-label">Filter</label>                                            
                                                    <div class="col-sm-4">
                                                        <input data-id="<?php echo $catFilter->id ?>" type="text" name="oldFilter[<?php echo $catFilter->id ?>]" value="<?php echo $catFilter->filter ?>" class="form-control"/>
                                                    </div>
                                                    <div class="btnWrapper col-sm-2">
                                                        <span class="removePrevItem btn btn-danger fa fa-close"></span>
                                                    </div>
                                                </div>
                                            <?php }}  ?>
                                            <div class="form-group itemRow">
                                                <label class="col-sm-2 control-label">Filter</label>                                            
                                                <div class="col-sm-4">
                                                    <input type="text" name="filter[]" class="form-control"/>
                                                </div>
                                                <div class="btnWrapper col-sm-2">
                                                    <span class="additem btn btn-primary fa fa-plus"></span>
                                                </div>
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
        $("[name='featured']").bootstrapSwitch();
        $('body').on('click','.additem',function(){
            $(this).find('.additem').remove();
            var btn = '<span class="removeitem btn btn-danger fa fa-close"></span>';
            $('.btnWrapper').html(btn);
            var html =  '<div class="form-group itemRow">\
                            <label class="col-sm-2 control-label">Filter</label>\
                            <div class="col-sm-4">\
                                <input type="text" name="filter[]" class="form-control"/>\
                            </div>\
                            <div class="btnWrapper col-sm-2">\
                                <span class="additem btn btn-primary fa fa-plus"></span>\
                            </div>\
                        </div>';
            $('.filtersWrapper').append(html);            
        });
        $('body').on('click','.removeitem',function(){
            $(this).closest('div.itemRow').remove();
        });
        $('body').on('click','.removePrevItem',function(){
            var id = $(this).closest('div.itemRow').find('input[type="text"]').data('id');
            $(this).closest('div.itemRow').hide();
            $(this).closest('div.itemRow').find('input[type="text"]').attr('name','delFilter['+id+']');
        });
        
    };
</script>