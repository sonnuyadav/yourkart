
<div class="productsSection">
<?php if(count($products)){
    foreach($products as $products){?>
            <div class="row">
                <div class="col-md-12">
                    <h2><?php echo $products->title ?> Collection</h2>
                    <div class="products flexslider carousel">
                        <ul class="slides">
                            <?php foreach($products->products as $list) {
                             //   pr($list);
                                $popups[] = $this->load->view('public/home/popup',$list,true);
                            ?>
                            <li>                            
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
                            </li>
                            <?php } ?>
                        </ul>
                  </div>
                </div>
            </div>
<?php } } ?>
<?php if(isset($popups) && count($popups)){
    foreach($popups as $popup){
    echo $popup;
}}?>


