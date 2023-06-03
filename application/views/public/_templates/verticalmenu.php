<div class="header">
        <div class="row">
            <div class="col-md-3">
                    <div class="list-group">
                        <ul>
                            <li><a href="<?php echo base_url('shop/category/clothing') ?>" rel="Women">All Clothing <span class="productCount pull-right"><?php echo $homelinksCount[27]['number'] ?></span></a></li>
                            <li><a href="<?php echo base_url('shop/category/jwellery') ?>" rel="Women">All Jewellery <span class="productCount pull-right"><?php echo $homelinksCount[26]['number'] ?></span></a></li>
                            <li><a href="<?php echo base_url('shop/category/electronics') ?>" rel="Women">Electronics <span class="productCount pull-right"><?php echo $homelinksCount[12]['number'] ?></span></a></li>
                            <li><a href="<?php echo base_url('shop/category/men') ?>" rel="Women">Men <span class="productCount pull-right"><?php echo $homelinksCount[17]['number'] ?></span></a></li>
                            <li><a href="<?php echo base_url('shop/category/women') ?>" rel="Women">Women <span class="productCount pull-right"><?php echo $homelinksCount[25]['number'] ?></span></a></li>
                            <li><a href="<?php echo base_url('shop/category/home-appliances') ?>" rel="Women">All Home Appliances <span class="productCount pull-right"><?php echo $homelinksCount[13]['number'] ?></span></a></li>
                            <li><a href="<?php echo base_url('shop/category/laptops') ?>" rel="Women">Laptops <span class="productCount pull-right"><?php echo $homelinksCount[14]['number'] ?></span></a></li>
                            <li><a href="<?php echo base_url('shop/category/mobiles') ?>" rel="Women">Mobiles <span class="productCount pull-right"><?php echo $homelinksCount[15]['number'] ?></span></a></li>
                        </ul>
                    </div>
                </div>
    <?php   if(count($sliders)){  ?>
                
            <div class="col-md-9">
                <div class="row carousel-holder">
                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php for($i=0;$i<count($sliders);$i++){ ?>
                                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i ?>" class="<?php echo $i == 0 ? 'active' : '' ?>"></li>
                                <?php } ?>
                            </ol>
                            <div class="carousel-inner">
                            <?php $counter = 1; foreach($sliders as $slider){ ?>
                                <div class="item <?php echo $counter == 1 ? 'active': ''?>">
                                    <a href="<?php echo $slider->link?>"><img class="slide-image" src="<?php echo getLarge($slider->image) ?>" alt="<?php echo $slider->title ?>"></a>
                                </div>
                            <?php $counter++; } ?>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <img class="slide-image leftside" src="<?php echo base_url($frontend_dir)?>/images/Banner_arrow_left.png" alt="">
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <img class="slide-image rightside" src="<?php echo base_url($frontend_dir)?>/images/Banner_arrow_right.png" alt="">
                            </a>
                        </div>
                    </div>

                </div>
            </div>
<?php  } ?>
        </div>
</div>