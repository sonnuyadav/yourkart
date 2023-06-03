<style type="text/css">
span.errorMSG{
    color: #B80000 ;
    font-weight: bold;
}
span.successMSG{
    color: #4caf50 ;
    font-weight: bold;
}
</style>
            <div class="clearfix"></div>
            <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
            <footer>
                <div class="row">
                    <div class="col-md-12">
                        <div class="footerArea">
                            <div class="col-md-2">
                                <h3>online shopping</h3>
                                <ul>
                                    <li><a href="<?php echo base_url('shop/category/men') ?>">Men</a></li>
                                    <li><a href="<?php echo base_url('shop/category/women') ?>">Women</a></li>
                                    <li><a href="<?php echo base_url('shop/category/mobiles') ?>">Mobiles</a></li>
                                    <li><a href="<?php echo base_url('shop/category/laptops') ?>">Laptops</a></li>
                                    <li><a href="<?php echo base_url('shop/category/home-appliances') ?>">Home Appliances</a></li>                                    <li><a href="<?php echo base_url('combo') ?>">Special Combo</a></li>
                                </ul>
                            </div>
                            <div class="col-md-2">
                                <h3>Usefull links</h3>
                                <ul>
                                    <li><a href="<?php echo base_url('page/about-us') ?>">About us</a></li>
                                    <li><a href="<?php echo base_url('contactus') ?>">Contact us</a></li>
                                    <li><a href="<?php echo base_url('page/privacy-policy') ?>">Privacy Policy</a></li>
                                    <li><a href="<?php echo base_url('page/terms-and-conditions') ?>">Terms & Condition</a></li>
                                    <li><a data-toggle="modal" data-target="#loginModalWindow">Sign in</a></li>
                                    <li><a data-toggle="modal" data-target="#loginModalWindow">Sign up</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h3>Newsletter Signup</h3>                                
                                <div class="newsletter">
                                	<form method="post" action="<?php echo base_url('signupcreate')?>">
                                    	<div class="form-group">
                                            <input name="email" class="form-control" placeholder="Enter Email" type="email" required>
                                            <span class="newslettermsg errorMSG" style="display:none"></span>
                                            <span class="newslettermsg successMSG" style="display:none"></span>
                                        </div>
                                        <div class="form-group" style="text-align:center;">
                                            <button type="submit" class="btn btn-primary signin_button">Subscribe</button>
                                        </div> 
                                    </form>                                    
                                </div>                                
                                <div class="appstorelink">We're available 24 hours a day <strong><?php echo getThemeValue('admin_mobile')?></strong> OR <a href="mailto:<?php echo getThemeValue('admin_email')?>" style="text-transform:lowercase; font-weight:bold; color:#777;"><?php echo getThemeValue('admin_email')?></a></div>
                            </div>
                            <div class="col-md-4">
                                <ul class="garantee">
                                    <li><a><div class="col-md-3"><img src="<?php echo base_url($frontend_dir)?>/images/original_icon.gif"></div><div class="col-md-9"><strong>100% ORIGINAL </strong> gurantee for all products</div></a><div class="clearfix"></div></li>
                                    <li><a><div class="col-md-3"><img src="<?php echo base_url($frontend_dir)?>/images/30days_icon.gif"></div><div class="col-md-9"><strong>Returns Within 30 Days</strong> of placing your order</div></a><div class="clearfix"></div></li>
                                    <li><a><div class="col-md-3"><img src="<?php echo base_url($frontend_dir)?>/images/Delivery_icon.gif"></div><div class="col-md-9"><strong>Get free delivery</strong> for every order above Rs. 999</div></a><div class="clearfix"></div></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="footerAreaBottom">
                    <div class="row">
                        <div class="col-md-4" style="border-left:none; border-right:none;">
                            <div class="trackOrder">
                                <span><img src="<?php echo base_url($frontend_dir)?>/images/trackorder1.png"></span>
                                <span><a href="">Track your order</a></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="EasyReturns">
                                <span><img src="<?php echo base_url($frontend_dir)?>/images/refresh.png"></span>
                                <span><a href="">Free & Easy Returns</a></span>
                            </div>
                        </div>
                        <div class="col-md-4"  style="border-left:none; border-right:none;">
                            <div class="OnlineCancellations">
                                <span><img src="<?php echo base_url($frontend_dir)?>/images/cancel.png"></span>
                                <span><a href="">Online Cancellations</a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footerAreaSocial">
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li><a href="<?php echo base_url('page/returns-policy') ?>">Returns Policy</a></li>
                                <li><a href="<?php echo base_url('page/terms-of-use') ?>">Terms of use</a></li>
                                <!--<li><a href="">Security</a></li>--->
                                <li><a href="<?php echo base_url('page/privacy-policy') ?>">Privacy Policy</a></li>
                                <!--<li><a href="">Infringement</a></li>-->
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="socialIcons">
                                <a>Keep in touch</a>
                                <a href="<?php echo getThemeValue('facebook_url')?>"><img src="<?php echo base_url($frontend_dir)?>/images/facebook.png" width="28px"></a>
                                <a href="<?php echo getThemeValue('google_url')?>"><img src="<?php echo base_url($frontend_dir)?>/images/google-plus.png" width="28px"></a>
                                <a href="<?php echo getThemeValue('twitter_url')?>"><img src="<?php echo base_url($frontend_dir)?>/images/twitter-1.png" width="28px"></a>
                                <a href="<?php echo getThemeValue('facebook_url')?>"><img src="<?php echo base_url($frontend_dir)?>/images/youtube.png" width="28px"></a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </footer>
            <div class="bottom"><div>&#169; 2016 Global Products Shopping All rights reserved</div><div>Powered by <a href="http://www.sharptechsolution.com/">sharptechsolution</a></div></div>
        </div>
    </div>
    <script src="<?php echo base_url($frontend_dir)?>/js/jquery.js"></script>
    <script src="<?php echo base_url($frontend_dir)?>/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    
    <script defer src="<?php echo base_url($frontend_dir)?>/js/jquery.flexslider.js"></script>
    <script src='<?php echo base_url($frontend_dir)?>/js/jquery.elevatezoom.js'></script>
    <script type="text/javascript" src="<?php echo base_url($frontend_dir)?>/js/script.js"></script>
    <script type="text/javascript" src="<?php echo base_url($frontend_dir)?>/js/jquery.blockUI.js"></script>
    <script type="text/javascript" src="<?php echo base_url($frontend_dir)?>/js/jquery.validate.js"></script>
      <script src="<?php echo base_url($frontend_dir)?>/js/jquery-ui.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#forgotPassword').hide();
                $("#forgotPasswordButton").click(function(){
                    $("#forgotPassword").slideToggle();
                });
            });
            
        </script>
        <script type="text/javascript">
        $(document).ready(function(){
            $('.newsletter form').validate({
                submitHandler:function(){
                    $.blockUI({ message: 'Please Wait'}); 
                    $('span.newslettermsg').hide();
                   $.ajax({
                        url:URL+'signupcreate',
                        data:   $('.newsletter form').serialize(),                         
                        type:'post',
                        success:function(res){
                            $.unblockUI();
                            var result = $.parseJSON(res);
                            if(result.status == 0){
                                var elem = $('span.newslettermsg.errorMSG');
                                elem.html(result.msg);
                                elem.show();
                            }else{
                                $('.newsletter form').trigger('reset');
                                var elem = $('span.newslettermsg.successMSG');
                                elem.html(result.msg);
                                elem.show();
                            }
                            setTimeout(function(){
                                elem.fadeOut('slow');
                                elem.html('');
                            },5000)
                      //  console.log(result.msg);
                        }
                    })  
                }
            });
             $(window).scroll(function () {
                if ($(this).scrollTop() > 100) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
             });
             $('#back-to-top').click(function () {
                $('#back-to-top').tooltip('hide');
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
             });
             $('#back-to-top').tooltip('show');
        });
        </script>
        <script type="text/javascript">
            function addtocart(pid){
                
                $.ajax({
                    url:URL+'basket/addtocart',
                    data:{pid:pid},
                    type:'post',
                    success:function(){
                        
                        $.ajax({
                            url:URL+'basket/getCartCount',                            
                            type:'post',
                            success:function(res){
                                $('.shoppingCart sub').html(res);
                            var html = '<div class="cartInfo">\
                                    <p></span>&nbsp;&nbsp;Product Added to your cart successfully. &nbsp;&nbsp;<a href="'+URL+'basket">Go to Cart</a></p>\
                                </div>';
                            $('body').prepend(html);
                            setTimeout(function(){
                                $('body .cartInfo').remove();
                            },5000)
                             
                            }
                        })                                
                    }

                })
            }
            $(function () {

                SyntaxHighlighter.all();
            });
            $(window).load(function () {
                $( "#slider-range" ).slider({
                      range: true,
                      min: <?php echo isset($minprice) ? $minprice : 0?>,
                      max: <?php echo isset($maxprice) ? $maxprice : 0?>,
                      values: [ <?php echo isset($minprice) ? $minprice : 0?>, <?php echo isset($maxprice) ? $maxprice : 0?> ],
                      slide: function( event, ui ) {
                        $( "#amount" ).val( "Rs." + ui.values[ 0 ] + " - Rs." + ui.values[ 1 ] );
                        var form = $('#filterForm').serialize();
                        callAjax(form);
                      }
                    });
                    $( "#amount" ).val( "Rs." + $( "#slider-range" ).slider( "values", 0 ) +
                      " - Rs." + $( "#slider-range" ).slider( "values", 1 ) );
               
                $('.flexslider').flexslider({
                    animation: "slide",
                    animationLoop: true,
                    itemWidth: 210,
                    itemMargin: 15,
                    minItems: 2,
                    maxItems: 4,
                    slideshowSpeed: 7000
                });
                $("#zoom_09").elevateZoom({
                    gallery: "gallery_09",
                    galleryActiveClass: "active"
                  });
                //////////////  ADD TO CART SCRIPT ////////////
                
                $('body').on('click','.addtoCART',function(){
                    var pid = $(this).data('id');
                    addtocart(pid);
                })
                $('.proQty').keyup(function(e){
                    if(e.keyCode == 8){
                        return false;
                    }
                    var key = $(this).attr('id').split('_')[1];
                    var value = $(this).val();

                     $.ajax({
                        url:URL+'basket/updateQty',
                        type:'post',
                        data:{key:key,qty:value},
                        success:function(res){
                         window.location.href=URL+"basket";
                        }
                    })
                })
                $('.proQty').change(function(){
                    var key = $(this).attr('id').split('_')[1];
                    var value = $(this).val();

                     $.ajax({
                        url:URL+'basket/updateQty',
                        type:'post',
                        data:{key:key,qty:value},
                        success:function(res){
                         window.location.href=URL+"basket";
                        }
                    })
                })

            ///////////////////////////////////////////////
            });
        </script>

</body>
</html>