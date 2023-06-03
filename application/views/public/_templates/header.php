<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Globalproductsshopping</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url($frontend_dir)?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url($frontend_dir)?>/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url($frontend_dir)?>/css/flexslider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


        <link rel="stylesheet" type="text/css" href="<?php echo base_url($frontend_dir)?>/css/menu.css">
        <script src='<?php echo base_url($frontend_dir)?>/js/jquery-1.8.3.min.js'></script>
<style>
.cartInfo {
  border: 1px solid #ccc;
  bottom: 26%;
  padding: 10px;
  left: 34%;
  position: fixed;
  z-index: 9999;
  background: #212121 none repeat scroll 0 0;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 2px;
    box-shadow: 0 1px 6px 0 rgba(0, 0, 0, 0.1);
    color: #fff;    
    font-size: 16px;
    margin: 0 auto;
    max-width: 568px;
    transform: translateY(110%);
    transition: transform 0.3s ease-in-out 0s, -webkit-transform 0.3s ease-in-out 0s;
}

</style>
</head>
<body>
    
    <div class="container">
        <header>
            <div class="keeyInTouch">
                <div class="row">
                    <div class="col-md-6">
                         <div class="sub-menus">
                             <ul>
                                <li><a href="javascript:void(0)"><i class="glyphicon glyphicon-phone"></i><span style="padding-left:2px;"><?php echo getThemeValue('admin_mobile')?></span></a></li>
                                <li><a href="javascript:void(0)"><i class="glyphicon glyphicon-envelope"></i><span style="padding-left:3px;"><?php echo getThemeValue('admin_email')?></span></a></li>
                             </ul>
                         </div>
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
            <div class="logoSection">
                <div class="row">
                    <div class="col-md-4"><a href="<?php echo base_url()?>"><img src="<?php echo base_url($frontend_dir)?>/images/GPS_logo.gif"></a></div>
                    <div class="col-md-8">
                        <div class="topMenu">
                            <div class="col-md-5">COD is Available in india only</div>
                            <div class="col-md-7">
                                <ul>
                                    <li><a href="<?php echo base_url('contactus') ?>">Contact us</a></li>
                                    <li><a href="<?php echo base_url('page/about-us') ?>">About us</a></li>
                                    <?php if(isset($_SESSION['customer'])){ ?>
                                    <li><a href="<?php echo base_url('user/dashboard') ?>">Welcome <?php echo $_SESSION['customer']['fullname'] ?></a></li>    
                                    <li><a href="<?php echo base_url('customer/logout')?>">Sign Out</a></li>    
                                    <?php }else{ ?>
                                    <li><a data-toggle="modal" data-target="#loginModalWindow">Join</a></li>
                                    <li><a data-toggle="modal" data-target="#loginModalWindow">Sign in</a></li>                                    
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="searchBar">
                            <div class="col-md-10">
                                <form id="searchform" action="<?php echo base_url('search')?>" method="get">
                                    <div class="">
                                        <input required  type="text" id="searchField" name="search" placeholder="Search..">
                                        <input type="submit" value="search">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2 shoppingCart"><a href="<?php echo base_url('basket')?>"><i class="glyphicon glyphicon-shopping-cart"></i><sub><?php echo isset($_SESSION['shop_cart_session']) ? count($_SESSION['shop_cart_session']) : 0 ?></sub></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!----START LOGIN POPUP WINDOW-------------->
        <div id="loginModalWindow" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registration / Login</h4>
                <div class="happytosee">Happy to see you here!</div>
              </div>
              <div class="modal-body">
                <div class="col-md-6" style="border-right:1px solid #ddd;">
                    <h5>New to register? Register Here</h5>
                    <div style="padding:15px 0px;">
                        <form role="form" id="signup" action="" method="post">
                        <div class="form-group">
                            <input name="fullname" class="form-control" placeholder="Enter Name" type="text">
                        </div>
                        <div class="form-group">
                            <input name="email" class="form-control" placeholder="Enter Email" type="email">
                        </div>
                        <div class="form-group">
                            <input name="mobile" class="form-control" placeholder="Enter Mobile" type="text">
                        </div>
                        <div class="form-group">
                            <input name="password" class="form-control" placeholder="Enter Password" type="password">
                        </div> 
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary signin_button">sign up now</button>
                        </div>                  
                    </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5>Existing User? Sign In Here</h5>
                    <div style="padding:15px 0px;">
                        <form id="login" role="form" action="" method="post">
                            <div class="form-group">
                                <input required name="email" class="form-control" placeholder="Enter email" type="email">
                            </div>
                            <div class="form-group">
                                <input required name="password" class="form-control" placeholder="Enter password" type="password">
                            </div>                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary signin_button"> <span class="glyphicon glyphicon-log-in" style="margin-right:5px;"></span> Login</button>
                            </div>                  
                        </form>
                        <div class="forgotPassswordSection">
                            <a id="forgotPasswordButton">Forgot Password? Click Here</a>
                            <div id="forgotPassword">
                                <form role="form" action="" method="post">
                                    <div class="form-group">
                                        <input name="email" class="form-control" placeholder="Enter email" type="email">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary signin_button"><span class="glyphicon glyphicon-log-in" style="margin-right:5px;"></span> Submit</button>
                                    </div>                  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
              </div>             
            </div>
          </div>
        </div>
        <!----END LOGIN POPUP WINDOW-------------->
        
        <div class="navigation">
            <div class="row">
                <div class="col-md-12">
                    <a class="toggleMenu" href="#">Menu</a>
                    <ul class="nav">
                        <li>
                            <a href="<?php echo base_url() ?>">Home</a>
                        </li>
                        <li class="head">
                            <a href="<?php echo base_url('shop/category/men') ?>">Mens <i class="glyphicon glyphicon-triangle-bottom"></i></a>
                            <ul>
                                <li>
                                    <a href="<?php echo base_url('shop/category/bags') ?>">Beg</a>
                                    <ul>
                                        <li><a href="<?php echo base_url('shop/category/footwear') ?>">Back</a></li>                                        
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('shop/category/watches') ?>">watch</a>                                    
                                </li>
                                <li>
                                    <a href="<?php echo base_url('shop/category/clothes') ?>">clothes</a>
                                    <!--<ul>
                                        <li><a href="#">jacket</a></li>                                        
                                        <li><a href="#">jeans</a></li>                                        
                                        <li><a href="#">shirt</a></li>                                        
                                    </ul>--->
                                </li><li>
                                    <a href="<?php echo base_url('shop/category/footwear') ?>">footwear</a>
                                    <!--<ul>
                                        <li><a href="#">shoes</a></li>                                        
                                    </ul>-->
                                </li>
                            </ul>
                        </li>
                        <li class="head">
                            
                            <a href="<?php echo base_url('shop/category/women') ?>">womens <i class="glyphicon glyphicon-triangle-bottom"></i></a>
                            <ul>
                                <li>
                                    <a href="<?php echo base_url('shop/category/bags') ?>">Beg</a>
                                    <!--<ul>
                                        <li><a href="#">Back</a></li>                                        
                                    </ul>
                                    --->
                                </li>
                                <li>
                                    <a href="<?php echo base_url('shop/category/watches') ?>">watch</a>                                    
                                </li>
                                <li>                                   
                                    <a href="<?php echo base_url('shop/category/clothing') ?>">clothes</a>
                                    <!--<ul>
                                        <li><a href="#">jacket</a></li>                                        
                                        <li><a href="#">jeans</a></li>                                        
                                        <li><a href="#">shirt</a></li>                                        
                                    </ul>--->
                                </li><li>
                                    <a href="<?php echo base_url('shop/category/footwear1') ?>">footwear</a>
                                    <!--<ul>
                                        <li><a href="#">shoes</a></li>                                        
                                    </ul>--->
                                </li>
                            </ul>
                        </li>
                        <li class="head">
                            <a href="<?php echo base_url('shop/category/electronics') ?>">Electronics <i class="glyphicon glyphicon-triangle-bottom"></i></a>
                            <ul>
                                <li>
                                    <a href="<?php echo base_url('shop/category/home-appliances') ?>">Home appliances</a>
                                    <ul>
                                        <li><a href="<?php echo base_url('shop/category/fans') ?>">fans</a></li>
                                        <!--<li><a href="">Kitchen Appliances</a></li>
                                        <li><a href="">Small Appliances</a></li>-->
                                        <li><a href="<?php echo base_url('shop/category/television') ?>">Television</a></li>
                                        <li><a href="<?php echo base_url('shop/category/washing-machine') ?>">Washing Machine</a></li>                                   </ul>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('shop/category/laptops') ?>">Laptops</a>
                                    <ul>
                                        <!--<li><a href="">Apple</a></li>-->
                                        <li><a href="<?php echo  base_url('brand/acer')?>">acer</a></li>
                                        <li><a href="<?php echo  base_url('brand/dell')?>">dell</a></li>                           
                                        <!--<li><a href="">HP</a></li>   
                                        <li><a href="">Lenovo</a></li> -->                               
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('shop/category/mobiles') ?>">Mobiles</a>
                                    <ul>
                                        <li><a href="<?php echo  base_url('brand/apple')?>">Apple</a></li>
                                        <li><a href="<?php echo  base_url('brand/oppo')?>">OPPO</a></li>
                                        <!--<li><a href="">Redmi</a></li>
                                        <li><a href="">Mi</a></li>
                                        <li><a href="">Lenovo</a></li>-->
                                        <li><a href="<?php echo  base_url('brand/micromax')?>">micromax</a></li>
                                        <li><a href="<?php echo  base_url('brand/samsung')?>">samsung</a></li>
                                    </ul>
                                </li>
                                <!--<li>
                                    <a href="">Mobile Accessories</a>
                                      <ul>
                                        <li><a href="">Power Banks</a></li>
                                        <li><a href="">Headphones</a></li>
                                        <li><a href="">Memory Cards</a></li>
                                        <li><a href="">Mobile Battery</a></li> 
                                        <li><a href="">Mobile Cables</a></li>
                                        <li><a href="">Selfie Sticks</a></li>                                             
                                    </ul>                               
                                </li>--->
                            </ul>
                        </li>
                        <li class="head">
                            <a>furniture <i class="glyphicon glyphicon-triangle-bottom"></i></a>
                            <!--<ul>
                                <li>
                                    <a href="#">bookcases</a>                                    
                                </li>
                                <li>
                                    <a href="#">chairs</a>                                    
                                </li>
                                <li>
                                    <a href="#">dinning tables</a>                                    
                                </li>
                                <li>
                                    <a href="#">closets</a>                                    
                                </li>
                                <li>
                                    <a href="#">mattresses</a>                                    
                                </li>
                            </ul>-->
                        </li>
                        <li class="head"><a href="<?php echo base_url('combo') ?>">Special combo</a></li>
                        <li class="head"><a href="<?php echo base_url('contactus') ?>">Contact us</a></li>
                        <li class="head"><a href="<?php echo base_url('contest') ?>">Contest</a></li>
                        <li class="head"><a href="<?php echo base_url('page/terms-and-conditions') ?>">Terms & conditions</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php 
        if(isset($horizantlemenu)){
            echo $horizantlemenu;
        }?>        
<script type="text/javascript">
var URL = '<?php echo base_url() ?>';
</script>
<style type="text/css">
.blockOverlay{
    z-index: 9000!important;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
    $('form#login').validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true
            },
         },
        messages: {
            'loginEmail': {
                required: 'E-mail is required',
                email: 'Enter a valid Email',
            },
            'loginPassword': {
                required: 'Enter password',
            },
        },
        submitHandler:function(){
            $('form#login').find('div.alert').remove();
          //  $.blockUI({ message: 'processing'});
            var form = $('form#login').serialize();
            $.ajax({
                url:URL+'customer/login',
                data:form,
                type:'post',
                success:function(res){
                    if(res != ''){ 
                        $('form#login').prepend('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button><span class="fa fa-exclamation-circle">Login Successfully</span> </div>');
                        window.location.reload();
                    }else{
                        $('form#login').prepend('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button><span class="fa fa-exclamation-circle"> Email or Password wrong.</span> </div>');
                    }
                }
            })
            
        }
    })
    $('form#signup').validate({
        rules: {
            fullname: { 
                // minlength: 2,
                required: true,
                //alphaNumeric: true
            },
            email: {
                required: true,
                email: true,
                remote: URL+"customer/userExists",
            },
            password: {
                minlength: 3,
                required: true
            },

            mobile: {
                minlength: 10,
                number: true,
                required: true
            },
        },


        messages: {
            'name': {
                required: 'Enter fullname'
            },
            
            'email': {
                required: 'E-mail is required',
                email: 'Enter a valid Email',
                remote: "Email already register with us"
            },
            'password': {
                required: 'Enter password',
                minlength: 'Enter 3 characters',
            },
            'mobile': {
                required: 'Enter contact number',
                minlength: 'Enter 10 numbers',
                numeric: 'Enter number only'
            },
        },
        submitHandler:function(){            
            $.ajax({
                url:URL+'customer/signup',
                data:$('#signup').serialize(),
                type:'post',
                success:function(res){
                    if(res == 'true'){ 
                        $('form#signup').prepend('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button><span class="fa fa-exclamation-circle">Registration Successfully</span> </div>')
                        window.location.reload();
                    }else{
                        $('form#signup').prepend('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button><span class="fa fa-exclamation-circle">Registration Failed</span> </div>')
                        
                    }
                    
                }
                
            })
        }
    })
    
})
    
    function split( val ) {
    return val.split( /,\s*/ );
    }
  function extractLast( term ) {
    return split( term ).pop();
    }
    $( function() {
  $("#searchField").autocomplete({
    minLength: 2,
    source: function( request, response ) {
            var file = "";
            file =  URL+"searchlist";
            $.getJSON( file, {
            search: extractLast( request.term )
            }, response );
    },
    focus: function( event, ui ) {
       
    $("#searchField").closest('form').attr('action', ui.item.link );    
    return false;
    },
    select: function( event, ui ) {
           $("#searchField").closest('form').attr('action', ui.item.link );    
            $('#searchform').submit();
    }
    })
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
     /* price = "";
      if(item.type == 'product'){
        var price = "<br/>"+item.price;
      }*/
    return $( "<li>" )
    .append("<div style='width:60%'>"+item.title+"</div>")
    .appendTo(ul);
    }


  
  } );

</script>
<style type="text/css">
label.error{
    color: #B80000 ;
}
</style>

<?php if(isset($_SESSION['newsletter_msg'])){ ?>
<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){
            alert("<?php echo $_SESSION['newsletter_msg'] ?>");
        },300)
    })
</script>
<?php } ?>