
 
<!---POP SECTION START-->
         <div class="productsSection innerPage">
         	<div class="row" id="productListSection">
            	<div class="col-md-12">
                    <div class="col-md-3">
                        <div class="innerCategory">
                            <form id="filterForm">
                            <div class="itemList">
                                <h3>Filter by price</h3>
                                <div class="pricefilter">
                                	<div class="pricefilterText">
                                      <input name="pricerange" type="text" id="amount" readonly>
                                    </div>
                                    <div id="slider-range"></div>
                                </div>
                            </div>
                             <?php if(count($discounts)){?>
                            <div class="itemList">
                                <h3>Filter by discount</h3>
                                <div class="pricefilter">
                                    <?php
                                    foreach($discounts  as $discount){
                                    ?>
                                	<div class="checkbox">
                                      <label><input type="checkbox" name="discount[]" value="<?php echo $discount->discount?>"><?php echo $discount->discount-0 ?>% Off</label>
                                    </div>
                                    <?php } ?>
                                	
                                </div>
                            </div>
                            <?php } if(count($brands)){?>
                            <div class="itemList">
                                <h3>Filter by brand</h3>
                                <div class="pricefilter">
                                    <?php foreach($brands as $brand){?>
                                	<div class="checkbox">
                                      <label><input name="brand[]" type="checkbox" value="<?php echo $brand->id ?>"><?php echo $brand->title ?></label>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php }?>

                            <?php if(count($filters)){ ?>
                            
                            <div class="itemList">
                                <h3>Filters</h3>
                                <div class="pricefilter">
                                <?php foreach($filters as $key => $filter){
                                    echo '<p><b>'.strtoupper($key).'</b></p>';
                                    foreach($filter as $filterval){ ?>
                                    <div class="checkbox">
                                      <label><input type="checkbox" name="filter[<?php echo $filterval['id'] ?>][]" value="<?php echo $filterval['value'] ?>"><?php echo $filterval['value'] ?></label>
                                    </div>
                                    <?php } ?>
                                <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                            </form>
                            <?php if(count($categorys)){?>
                            <div class="itemList">
                                <h3>Categories</h3>
                                <ul class="categorylist">
                                    <?php foreach($categorys as $cats){
                                        ?>
                                    <li><a href="<?php echo base_url('shop/category/'.$cats->nicename)?>" rel="Women"><?php echo $cats->title?></a></li>
                                    <?php } ?>
                                    
                                </ul>
                            </div>
                            <?php } ?>
                            <div class="itemList">
                                <h3>Advertisements</h3>
                                <div class="advertisement"><img src="<?php echo base_url($frontend_dir)?>/images/banner1.jpg"></div>
                                <div class="advertisement"><img src="<?php echo base_url($frontend_dir)?>/images/banner1.jpg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <ul class="breadcrumb">
                          <li><a href="<?php echo base_url() ?>">Home</a></li>
                          <li><?php echo urldecode($catName) ?></li>                          
                        </ul>
                        <div class="col-md-6 pagingContainer">
                             <?php echo $paging?>
                        </div>
                        <div class="col-md-4 pull-right">
                             <div class="form-group">
                              <label for="sel1"></label>
                              <select class="form-control" id="sel1">
                                <option value="">Default Sorting</option>
                                <option value="nameasc" >Sort By Name ASC</option>
                                <option value="namedesc" >Sort By Name DESC</option>                                
                                <option value="discountasc">Sort By Discount ASC</option>
                                <option value="discountdesc">Sort By Discount DESC</option>
                              </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                         <div class="col-md-12 productholder">
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
                         </div>
                         <div class="col-md-6 pagingContainer">
                            <?php echo $paging?>
                        </div>
                    </div>
                </div>
            </div>
            
<?php if(isset($popups) && count($popups)){
    foreach($popups as $popup){
    echo $popup;
}}?>
<script type="text/javascript">
function callAjax(form){
    $.blockUI({ message: 'Loading'}); 
    setTimeout(function(){
        $.ajax({
        url:window.location.href,
        data:form,
        type:'post',
        success:function(res){
            res = res.split('~|~');            
            $('.productholder').html(res[0]);
            $('.pagingContainer').html(res[1]);
            $.unblockUI();
            //$('.productholder').html(res[1]);
        }
    })

    }, 2000); 
    
}
$(document).ready(function(){
    $('body').on('change','#amount',function(){
        var form = $('#filterForm').serialize();
        callAjax(form);
    })
    $('body').on('click','.pagination li a', function(e){
        e.preventDefault();
        if(!$(this).parent().hasClass('disabled')){
          
        var page = $(this).html();
        var form = $('#filterForm').serialize()+'&page='+page;
        callAjax(form);
        
        }
    })
    $('#sel1').change(function(){
        var sort = $(this).val();
        var form = $('#filterForm').serialize()+'&sort='+sort;
        callAjax(form);
    })
    $('div.checkbox label').click(function(e){
    //e.preventDefault();
    // if($(this).find('input[type="checkbox"]').is(':checked')){
    //     $(this).find('input[type="checkbox"]').prop('checked',false);
    // }else{        
    //     $(this).find('input[type="checkbox"]').prop('checked',true);
    // }
    var form = $('#filterForm').serialize();
    callAjax(form);
   })
})
</script>