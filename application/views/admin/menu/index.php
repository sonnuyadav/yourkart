<style>
/**
 * Nestable
 */

.dd { position: relative; display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; }

.dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
.dd-list .dd-list { padding-left: 30px; }
.dd-collapsed .dd-list { display: none; }

.dd-item,
.dd-empty,
.dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

.dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd-handle:hover { color: #2ea8e5; background: #fff; }

.dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
.dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
.dd-item > button[data-action="collapse"]:before { content: '-'; }

.dd-placeholder,
.dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
.dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
    background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                      -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                         -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                              linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;
}

.dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
.dd-dragel > .dd-item .dd-handle { margin-top: 0; }
.dd-dragel .dd-handle {
    -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
}

/**
 * Nestable Extras
 */

.nestable-lists { display: block; clear: both; width: 100%; border: 0; }

#nestable-menu { padding: 0; margin: 20px 0; }


@media only screen and (min-width: 700px) {

    .dd { float: left; width: 48%; }
    .dd + .dd { margin-left: 2%; }

}

.dd-hover > .dd-handle { background: #2ea8e5 !important; }

/**
 * Nestable Draggable Handles
 */

.dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd3-content:hover { color: #2ea8e5; background: #fff; }

.dd-dragel > .dd3-item > .dd3-content { margin: 0; }

.dd3-item > button { margin-left: 30px; }

.dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
    border: 1px solid #aaa;
    background: #ddd;
    background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:         linear-gradient(top, #ddd 0%, #bbb 100%);
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
.dd3-handle:hover { background: #ddd; }



a.deletebutton{
  position: absolute;
  right: 10px;
  top: 9px;
  z-index: 9999;
}

</style>

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
                                    <h3 class="box-title">
                                      <span id="submitMenu" class="btn btn-primary">Save Menu</span>
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                <div class="col-md-4">
                  <div class="panel-group">
                  <?php if(isset($category) && count($category)){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" href="#categories">Categories</a>
                        </h4>
                      </div>
                      <div id="categories" class="panel-collapse collapse">
                        <div class="panel-body">
                        <form data-id="category">
                          <?php foreach($category as $cats){ ?>
                            <p><label><input type="checkbox" name="menuCheck" value="<?php echo $cats['nicename']?>" data-value="<?php echo $cats['title'] ?>"/>&nbsp;<?php echo $cats['title'] ?></label></p>
                          <?php } ?>
                          <input type="submit" value="Add To Menu" class="btn btn-primary"/>
                        </form>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(isset($products) && count($products)){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" href="#products">Products</a>
                        </h4>
                      </div>
                      <div id="products" class="panel-collapse collapse">
                        <div class="panel-body">
                          <form data-id="product">
                          <?php foreach($products as $product){ ?>
                            <p><label><input type="checkbox" name="menuCheck" value="<?php echo $product['nicename']?>" data-value="<?php echo $product['title'] ?>"/>&nbsp;<?php echo $product['title'] ?></label></p>
                          <?php } ?>
                          <input type="submit" value="Add To Menu" class="btn btn-primary"/>
                          </form>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(isset($pages) && count($pages)){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" href="#pages">Pages</a>
                        </h4>
                      </div>
                      <div id="pages" class="panel-collapse collapse">
                        <div class="panel-body">
                          <form data-id="page">
                          <?php foreach($pages as $page){ ?>
                            <p><label><input type="checkbox" name="menuCheck" value="<?php echo $page['nicename']?>" data-value="<?php echo $page['title'] ?>" />&nbsp;<?php echo $page['title'] ?></label></p>
                          <?php } ?>
                          <input type="submit" value="Add To Menu" class="btn btn-primary"/>
                          </form>
                        </div>
                       
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="cf nestable-lists">
                    <div class="dd" id="nestable">
                        <ol class="dd-list">
                            <?php echo html_entity_decode($menuhtml) ?>
                        </ol>
                    </div>
                  </div>

                </div>
              </div>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>

<script src="<?php echo base_url($plugins_dir . '/nestable/jquery.nestable.js'); ?>"></script>


<script type="text/javascript">
function saveMenuItem(type,slug,value){
  $.ajax({
    url:URL+'admin/menu/saveItem',
    data:{type:type,slug:slug,value:value},
    type:'post',
    success:function(res){
      window.location.reload();
    }
  })
}
var updateOutput = function(e)
{
    var list   = e.length ? e : $(e.target),
        output = list.data('output');
       var menu = window.JSON.stringify(list.nestable('serialize'));
       $.ajax({
        url:URL+'admin/menu/setMenu',
        type:'post',
        data:{menu,menu},
        success:function(res){
         window.location.reload();
        }
       })
    
};
  $(document).ready(function(){
    $('form').submit(function(e){
      e.preventDefault();
      var type = $(this).attr('data-id');
      $(this).find('input[type="checkbox"]').each(function(){
        if($(this).is(':checked')){
          var slug = $(this).val();
          var value = $(this).attr('data-value');
          saveMenuItem(type,slug,value);
        }
      })
    });
    $('#nestable').nestable({
        group: 1
    })
    
    $('#submitMenu').click(function(){

    updateOutput($('#nestable').data('output', $('#nestable-output')));
    });
    $('a.deletebutton').click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        url:URL+'admin/menu/deleteMenu',
        type:'post',
        data:{id,id},
        success:function(res){
         window.location.reload();
        }
      })
    })
  })
</script> 