<div class="innerContainer">
         	<div class="row">
            	<div class="col-md-12">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo base_url()?>">Home</a></li>
                      <li class="active"><?php echo $productDetails->title?></li>
                    </ul>
                    <div class="innerContainerContent">
                        <div class="content productDetail">
                        	<div class="col-md-5">
                            	<div class="zoom-wrapper">
                                    <div class="zoom-left">
                                        <img class="product_main" data-zoom-image="<?php echo base_url('upload/media/'.$productDetails->image) ?>" src="<?php echo getLarge($productDetails->image)?>" id="zoom_09" style="border:1px solid #e8e8e6;">
                                        <div id="gallery_09">                    
                                          <?php if(count($productimages))    {
                                            foreach($productimages as $images){?>
                                            <a data-zoom-image="<?php echo base_url('upload/media/'.$images->image) ?>" data-image="<?php echo getLarge($images->image) ?>" data-update="" class="elevatezoom-gallery " href="#">
                                                <img class="thumb" src="<?php echo getThumb($images->image) ?>"></a>                        
                                        <?php } } ?>
                                        </div>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="buttonArea">
                                	<a href="javascript:void(0)" data-id="<?php echo $productDetails->id?>" class="addtocart addtoCART"><i class="glyphicon glyphicon-shopping-cart "></i> Add to cart</a>
                                	<a href="javascript:void(0)" data-id="<?php echo $productDetails->id?>" class="buynow BUYnow"><i class="glyphicon glyphicon-flash"></i> Buy now</a>
                                </div>
                            </div>
                        	<div class="col-md-7">
                            	<h1><?php echo $productDetails->title ?></h1>
                                <div class="price">
                                	<span class="oldPrice"><i class="fa fa-inr"></i><?php echo $productDetails->price?></span>
                                    <span class="discount"><?php echo $productDetails->discount?>% Off</span>
                                    <span class="newPrice"><i class="fa fa-inr"></i><?php echo $productDetails->saleprice?></span>
                                </div>
                                <?php if(!empty($productDetails->description)){ ?>
                                <div class="features">
                                	<div class="col-md-3">
                                    	<h3>Features</h3>
                                   </div>
                                	<div class="col-md-9">
                                    	<ul>
                                        <?php foreach(explode(PHP_EOL,$productDetails->description) as $lines){
                                          ?>
                                        	<li><?php echo $lines ?></li>
                                        <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="clearfix"></div>
                                
                                <?php echo html_entity_decode($productDetails->specification) ?>
                            </div>
                            <div class="clearfix"></div>
                            <?php if(count($similerproducts)){?>
                            <div class="similarProducts">
                                <h5>Similar products</h5>
                                <?php foreach($similerproducts as $list) {
                             //   pr($list);
                                $popups[] = $this->load->view('public/home/popup',$list,true);
                            ?>
                            	<div class="col-md-3">
                                    <div class="productsList">
                                        <div class="sliderInner">
                                            <div class="thumbnail">
                                                <?php if($list->discount > 0){?>
                                                    <span class="onsale"><?php echo $list->discount+0?>% off</span>
                                                <?php } ?>
                                                <div class="productImage"><img src="<?php echo getMedium($list->image) ?>" class="image" alt=""></div>
                                                <div class="caption">
                                                    <h4><a href="<?php echo base_url('product/'.$list->nicename) ?>"><?php echo $list->title ?></a></h4>
                                                </div>
                                                <div class="ratings">  
                                                    <?php if($list->discount > 0){?>
                                                    <span class="oldPrice"><i class="fa fa-inr"></i><?php echo round($list->price-0)?></span>
                                                    <?php } ?>                                
                                                    
                                                    <span class="newPrice"><i class="fa fa-inr"></i><?php echo round($list->saleprice-0)?></span>
                                                    <span class="fa fa-star-o plusrating"></span>
                                                    <span class="fa fa-star-o plusrating plusrating"></span>
                                                    <span class="fa fa-star-o plusrating plusrating"></span>
                                                    <span class="fa fa-star-o plusrating plusrating"></span>
                                                    <span class="fa fa-star-o"></span>                                             
                                                </div>
                                                <div class="addtocartbuttonsection">
                                                    <a href="javascript:void(0)" data-id="<?php echo $list->id ?>" class="addtocartButton addtoCART">Add to cart</a>                                    
                                                </div>                                   
                                            </div>
                                            <div class="middle">
                                                <a class="text" data-toggle="modal" data-target="#myModal_<?php echo $list->id?>">Quick view</a>
                                                <a href="<?php echo base_url('product/'.$list->nicename) ?>" class="viewDetail">Go to detail</a>                               
                                           </div>
                                        </div>
                                    </div>

                                </div>
                                <?php } ?>
                           </div>
                         <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
<?php if(isset($popups) && count($popups)){
      foreach($popups as $popup){
      echo $popup;
}}?>
<script type="text/javascript">
function buynow(pid){
    $.ajax({
        url:URL+'basket/addtocart',
        data:{pid:pid},
        type:'post',
        success:function(){
            window.location.href=URL+"basket/checkout";
        }

    })
}
$(document).ready(function(){
    $('body').on('click','.BUYnow',function(){
    var pid = $(this).data('id');
    buynow(pid);
})
})

</script>