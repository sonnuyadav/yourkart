<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
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
                                    <?php echo form_open(current_url(), array('enctype'=>'multipart/form-data','class' => 'form-horizontal', 'id' => 'form-create_product')) ;
                                        ?>
                                        <div class="form-group">
                                            <?php echo lang('product_name', 'title', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_input($ptitle);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('product_qty', 'title', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-2">
                                                <?php echo form_input($qty);?>
                                            </div>
                                            <?php echo lang('product_code', 'pro_code', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-2">
                                                <?php echo form_input($pro_code);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('product_price', 'title', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-2">
                                                <?php echo form_input($price);?>
                                            </div>
                                            <?php echo lang('product_discount', 'title', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-2">
                                                <?php echo form_input($discount);?>
                                            </div>
                                        </div>
                                        

                                        <div class="form-group">
                                            <?php echo lang('product_category', 'cat_parent', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-2">
                                                <select id="cat_id" name="catid" class="form-control">
                                                <option value='0'>Choose Category</option>
                                                <?php if(isset($cats) && count($cats)){
                                                    foreach ($cats as $cat) { ?>
                                                        <option <?php echo $cat_id == $cat->id ? 'selected': '' ?> value="<?php echo $cat->id ?>"><?php echo $cat->title ?></option>
                                               <?php     }
                                                } ?>
                                                </select>
                                            </div>
                                            <?php echo lang('product_brand', 'brand', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-2">
                                                <select id="brand" name="brandid" class="form-control">
                                                <option value=''>Choose Brand</option>
                                                <?php if(isset($brands) && count($brands)){
                                                    foreach ($brands as $brand) { ?>
                                                        <option <?php echo $brand_id == $brand->id ? 'selected': '' ?> value="<?php echo $brand->id ?>"><?php echo $brand->title ?></option>
                                               <?php     }
                                                } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('product_desc', 'description', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_textarea($description);?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">

                                            <?php echo lang('product_status', 'status', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($status);?>
                                            </div>
                                            <?php echo lang('product_featured', 'featured', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($featured);?>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('product_image', 'name', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-4">
                                              <input type="file" name="file" />  
                                            </div>
                                            <?php if(!empty($image)){?>
                                            <div class="col-sm-3">
                                              <img src="<?php echo $thumbimage?>" />  
                                              <input type="hidden" name="image" value="<?php echo $image?>" />  
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div class="filtersWrapper"> 
                                            <?php if(count($sliders)){ 
                                                //pr($sliders);
                                                foreach($sliders as $slider){
                                            ?>
                                            <div class="form-group itemRow">
                                                <?php echo lang('product_sliderimage', 'name', array('class' => 'col-sm-2 control-label')); ?>
                                                <div style="display:none" class="col-sm-2">
                                                  <input data-id="<?php echo $slider->id ?>" type="file" name="oldsliderfile[<?php $slider->id?>]" />  
                                                </div>
                                                                    
                                                <div class="col-sm-3">
                                                  <img src="<?php echo getThumb($slider->image)?>" />
                                                </div>
                                                <div class="btnWrapper col-sm-2">
                                                    <span class="removePrevItem btn btn-danger fa fa-close"></span>
                                                </div>
                                            </div>
                                            <?php }} ?>
                                            <div class="form-group itemRow">
                                                <?php echo lang('product_sliderimage', 'name', array('class' => 'col-sm-2 control-label')); ?>
                                                <div class="col-sm-2">
                                                  <input type="file" name="sliderfile[]" />  
                                                </div>
                                                <div class="btnWrapper col-sm-2">
                                                    <span class="additem btn btn-primary fa fa-plus"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <h3>Specifications</h3>
                                        <div id="specificationholder">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="title">Content</label>
                                                <div class="col-sm-6">
                                                    <?php echo form_textarea($specification);?>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <h3>SEO</h3>
                                        <div class="form-group">
                                            <?php echo lang('product_metatitle', 'metatitle', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-2">
                                                <?php echo form_input($metatitle);?>
                                            </div>
                                            <?php echo lang('product_metakeyword', 'metakeyword', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-2">
                                                <?php echo form_input($metakeyword);?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <?php echo lang('product_metadescrition', 'name', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-6">
                                                <?php echo form_textarea($metadesc);?>
                                            </div>
                                        </div>
                                        
                                        <h3>Filter</h3>
                                        <div id="FilterWrapper">
                                            <?php if(count($filters)){
                                               // pr($filters);
                                                foreach($filters as $filter){ ?>
                <div class="form-group">
                <label class="col-sm-2 control-label" for="<?php echo $filter->filter.'_'.$filter->filterid ?>"><?php echo $filter->filter ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="<?php echo $filter->filter.'_'.$filter->filterid ?>" name="filter[<?php echo $filter->filterid ?>]" value="<?php echo $filter->value ?>">
                </div>
            </div>
            <?php        } } ?>
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
    function getFilter(catid){
        $.ajax({
            url:'<?php echo base_url("admin/category/catFilter") ?>',
            type:'post',
            data:{catid:catid},
            success:function(res){
                $('#FilterWrapper').html(res);
            }
        });
    }
    window.onload = function() {
        $("[name='status']").bootstrapSwitch();
        $("[name='featured']").bootstrapSwitch();
        $('body').on('click','.addspecitem',function(){
            $(this).find('.addspecitem').remove();
            var btn = '<span class="removespecitem btn btn-danger fa fa-close"></span>';
            $('.btnWrapper1').html(btn);
            var html =      '<div class="form-group">\
                    <label class="col-sm-2 control-label" for="title">Heading</label>\
                    <div class="col-sm-6">\
                        <input type="text" name="heading[]" class="form-control" />\
                    </div>\
                </div>\
                <div class="form-group">\
                    <label class="col-sm-2 control-label" for="title">Content</label>\
                    <div class="col-sm-6">\
                        <textarea class="form-control" name="content[]"></textarea>\
                    </div>\
                    <div class="btnWrapper1 col-sm-2">\
                        <span class="addspecitem btn btn-primary fa fa-plus"></span>\
                    </div>\
                </div>';
                $('#specificationholder').append(html); 
                 
                
        })
        $('body').on('click','.additem',function(){
            $(this).find('.additem').remove();
            var btn = '<span class="removeitem btn btn-danger fa fa-close"></span>';
            $('.btnWrapper').html(btn);
            
            var html =  '<div class="form-group itemRow">\
                <label for="name" class="col-sm-2 control-label">Slider Images</label>\
                <div class="col-sm-2">\
                  <input type="file" name="sliderfile[]">\
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
            var id = $(this).closest('div.itemRow').find('input[type="file"]').data('id');
            $(this).closest('div.itemRow').hide();
            $(this).closest('div.itemRow').find('input[type="file"]').attr('name','delFiles['+id+']').attr('type','text');
        });
        $('body').on('change','#cat_id',function(){
            var catid = $(this).val();
            if(catid == 0){
                $('#FilterWrapper').html('');
            }else{
                getFilter(catid);
            }
        });
    };
</script>
<script type="text/javascript" src="<?php echo base_url($frameworks_dir);?>/tinymce/index.js"></script>
<script type="text/javascript" src="<?php echo base_url($frameworks_dir);?>/tinymce/tinyMceInit.js"></script>
