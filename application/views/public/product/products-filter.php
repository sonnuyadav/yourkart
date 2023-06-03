<?php
if(count($products)){
foreach($products as $list){
$popups[] = $this->load->view('public/home/popup',$list,true);
?>
<div class="col-md-4">
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
<?php } }else{ ?>
<div class="col-md-10">
    <div class="alert alert-warning">
      <strong> No Products found </strong>
    </div>
</div>
<?php } ?>
<?php if(isset($popups) && count($popups)){
    foreach($popups as $popup){
    echo $popup;
}}?>

~|~
<div class="col-md-6 pagingContainer">
     <?php echo $paging?>
</div>