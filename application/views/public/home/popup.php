
<!---POP SECTION START-->
        <div class="modal fade" id="myModal_<?php echo $id?>" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style="width:75%;"><?php echo $title?></h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-4 productImg">
                        <div><img src="<?php echo getMedium($image) ?>" alt="<?php echo $title?>"></div>                    
                    </div>
                    <div class="col-md-8">
                        <h4 class="modal-title"><?php echo $title?></h4>
                        <div class="ratings">                                  
                             <div style="font-size:16px;">
                                <?php if($discount > 0){?>
                                <span class="" style="text-decoration:line-through; color:#ccc;"><i class="fa fa-inr"></i><?php echo $price?> </span>
                                <span style="margin:0px 15px; color:#006600;"><?php echo $discount+0?>% off</span>
                                <?php } ?>
                                <span style="margin-right:15px;"><i class="fa fa-inr"></i><?php echo $saleprice?></span>
                                <span class="fa fa-star-o plusrating"></span>
                                <span class="fa fa-star-o plusrating plusrating"></span>
                                <span class="fa fa-star-o plusrating plusrating"></span>
                                <span class="fa fa-star-o plusrating plusrating"></span>
                                <span class="fa fa-star-o"></span>
                             </div>                                         
                        </div>
                        <div class="productDetail" style="padding:15px 0px;">
                            <div><span><strong>Brand</strong>:</span> <a href="" target="_top"> <?php echo $brandtitle?>  </a></div>
                            <div><span><strong>Product Code:</strong></span> <?php echo $pro_code?></div>
                            <div><span><strong>Availability:</strong></span> <span class="in_stock"> <?php echo $qty?></span></div>
                        </div>
                        <div class="addtocartbuttonsection">
                            <a href="javascript:void(0)" data-id="<?php echo $id ?>" class="addtocartButton addtoCART">Add to cart</a>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
       </div>
<!--POP SECTION END-->