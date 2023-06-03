 <div class="innerContainer">
 	<div class="row">
    	<div class="col-md-12">
            <ul class="breadcrumb">
              <li><a href="<?php echo base_url() ?>">Home</a></li>
              <li class="active">checkout</li>
            </ul>
            <div class="innerContainerContent">
                <h1>checkout</h1>
                <div class="content">
                	<div class="col-md-9">
                    	<div class="checkout">
                         <div class="panel-group" id="accordion">
                            <?php if(!isset($customer)){?>
                            <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a id="tab_1" class="checkoutTab"  data-toggle="collapse" data-parent="#accordion" href="#collapse1">Checkout options</a>
                              </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                              <div class="panel-body">
                                    <div class="col-md-6">
                                    	<h5>New Customer</h5>
                                        <div class="checkoutoptionHeading">Checkout Options:</div>
                                        <div class="checkoutoption">
                                            <form>
                                             <div class="radio">
                                              <label><input type="radio" checked    value="register" name="checkoutuserType">Register Account</label>
                                            </div>
                                            <div class="radio">
                                              <label><input type="radio" value="guest" name="checkoutuserType">Guest Checkout</label>
                                            </div>
                                            <div class="helptext">
                                              By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.                                                      
                                            </div>
                                            <button type="button" id="checkoutfirstbtn" class="btn btn-default">Continue</button>
                                        </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    	<h5>Returning Customer</h5>
                                        <div class="checkoutoptionHeading">I am a returning customer</div>
                                        <div class="checkoutoption">
                                             <form id="checkoutLogin" method="post">
                                              <div class="form-group">
                                                <label for="email">Email address:</label>
                                                <input type="email" name="email" class="form-control" id="email">
                                              </div>
                                              <div class="form-group">
                                                <label for="pwd">Password:</label>
                                                <input type="password" name="password" class="form-control" id="pwd">
                                              </div>                                                      
                                              <button type="submit" class="btn btn-default">Login</button>
                                              
                                            </form> 
                                            <div class="checkoutforgot">
                                                <div><a id="forgotPasswordButtonCheck" href="javascript:void(0)">Forgot Password</a></div>                                                
                                                <div id="forgotPasswordCheck">
                                                    <form role="form" action="" method="post">
                                                        <div class="form-group">
                                                            <input name="email" required class="form-control" placeholder="Enter email" type="email">
                                                            <span class="forgotmsg errorMSG" style="display:none"></span>
                                                            <span class="forgotmsg successMSG" style="display:none"></span>
                                                        </div>

                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary signin_button"><span class="glyphicon glyphicon-log-in" style="margin-right:5px;"></span> Submit</button>
                                                        </div> 

                                                    </form>
                                                </div>
                                              </div>
                                        </div>
                                    </div>
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a id="tab_2" class="checkoutTab" data-toggle="collapse" data-parent="#accordion" href="#collapse2">Account & Billing Details</a>
                              </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse <?php echo isset($customer) ? 'in' : ''?>">
                              <div class="panel-body">
                                 <form id="infoForm"> 
                                    <div class="col-md-6">
                                    	<h5>Personal detail</h5>
                                        <div class="personaldetail">
                                              <div class="form-group">
                                                <label for="email">Name:<span class="required">*</span></label>
                                                <input value="<?php echo isset($customer['fullname']) ? $customer['fullname'] : '' ?>" type="text" required class="form-control" name="name" placeholder="Enter your name">
                                              </div>
                                              <div class="form-group">
                                                <label for="email">Email:<span class="required">*</span></label>
                                                <input type="email" required value="<?php echo isset($customer['email']) ? $customer['email'] : '' ?>" class="form-control" name="email" placeholder="Enter your email address">
                                              </div>
                                              <div class="form-group">
                                                <label for="email">Fax:</label>
                                                <input type="text" class="form-control" value="<?php echo isset($customer['fax']) ? $customer['fax'] : '' ?>" name="fax" placeholder="Enter your fax number ">
                                              </div>
                                              <div class="form-group">
                                                <label for="email">Phone:<span class="required">*</span></label>
                                                <input type="text" required  value="<?php echo isset($customer['mobile']) ? $customer['mobile'] : '' ?>" class="form-control" name="phone" placeholder="Enter your phone number">
                                              </div>
                                        </div>
                                        <?php if(!isset($customer['fullname'])){ ?>
                                        <div class="passwordSection">
                                            <h5>Your Password</h5>
                                            <div class="personaldetail">
                                                  <div class="form-group">
                                                    <label for="email">Password:<span class="required">*</span></label>
                                                    <input type="text" required class="form-control" name="password" id="password" placeholder="Enter your password">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="email">Confirm Password:<span class="required">*</span></label>
                                                    <input type="text" required class="form-control" name="confirm_password" placeholder="Enter your confirm password">
                                                  </div>
                                                  <div class="checkbox">
                                                        <label><input type="checkbox" checked>My delivery and billing addresses are the same.</label>
                                                 </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-6">
                                    	<h5>Address</h5>
                                        <div class="personaldetail">
                                              <div class="form-group">
                                                <label for="email">Company:<span class="required">*</span></label>
                                                <input type="text" value="<?php echo isset($customer['company']) ? $customer['company'] : '' ?>" required class="form-control" name="company" placeholder="Enter your company name">
                                              </div>
                                              <div class="form-group">
                                                <label for="email">Address 1:<span class="required">*</span></label>
                                                <input type="text" required class="form-control" name="address1" value="<?php echo isset($customer['address1']) ? $customer['address1'] : '' ?>" placeholder="Enter your address 1">
                                              </div>
                                              <div class="form-group">
                                                <label for="email">Address 2:<span class="required">*</span></label>
                                                <input type="text" required class="form-control" name="address2" value="<?php echo isset($customer['address2']) ? $customer['address2'] : '' ?>" placeholder="Enter your address 2">
                                              </div>
                                              <div class="form-group">
                                                <label for="email">Postal code:<span class="required">*</span></label>
                                                <input type="text" required class="form-control" name="pincode" value="<?php echo isset($customer['pincode']) ? $customer['pincode'] : '' ?>" placeholder="Enter your postal code">
                                              </div>
                                              <div class="form-group">
                                                <label for="email">City:<span class="required">*</span></label>
                                                <input type="text" required class="form-control" name="city" value="<?php echo isset($customer['city']) ? $customer['city'] : '' ?>" placeholder="Enter your city">
                                              </div>
                                              <div class="form-group">
                                                <label for="email">State:<span class="required">*</span></label>
                                                <select class="form-control" name="state" required >
                                                      <option value="">Select state</option>
                                                      <?php foreach($states as $state){ ?>
                                          	             <option <?php echo isset($customer['state']) && $customer['state'] == $state->state_name ? 'selected' : '' ?> value="<?php echo $state->state_name?>"><?php echo $state->state_name?></option>
                                                      <?php } ?>
                                                </select>
                                              </div>
                                              <div class="form-group">
                                                <label for="email">Country:<span class="required">*</span></label>
                                                <select class="form-control">
                                                	<option selected value="india">India</option>
                                                </select>
                                              </div>
                                        </div>                                                
                                    </div>
                                    <div class="col-md-6">
                                    	<div class="checkbox">
                                            <label><input type="checkbox"><strong>I agree to the <a href="">Privacy Policy</a></strong></label>
                                        </div>
                                        <button type="submit" class="btn btn-default">Continue</button>
                                    </div>
                                 </form>                                         
                              </div>
                            </div>
                          </div>
                          
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a id="tab_3" class="checkoutTab" data-toggle="collapse" data-parent="#accordion" href="#collapse5">Payment Method</a>
                              </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                              <div class="panel-body">
                                  <p><label><input type="radio" name="payment_method" value="cod" checked /> Cash On Delivery</label></p>
                                  <p><a id="paymentmethodbutton" href="javascript:void(0);"><span class="btn btn-default">Continue</span></a></p>
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a id="tab_4" class="checkoutTab" data-toggle="collapse" data-parent="#accordion" href="#collapse6">Confirm Order</a>

                              </h4>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse">
                              <div class="panel-body">
                                <div class="col-md-4">
                                    <p>Rs. <?php echo $totalPrice ?></p>
                                </div>
                                <div class="col-md-8">
                                <p><a href="<?php echo base_url('basket/order')?>"><span class="btn btn-default">Order</span></a></p>
                            </div>
                              </div>
                            </div>
                          </div>
                        </div> 
                    </div>
                    </div>
                	<div class="col-md-3">
                    	<div class="advertisement"><img src="<?php echo base_url($frontend_dir)?>/images/banner1.jpg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      
<script type="text/javascript">
var userformtype = '';
var tab2form = '';
var tab3form = '';
function checkForms(){
    if(userformtype == ''){
      return false;
    }else{      
    return true;
    }

}
$(document).ready(function(){
  $('.checkoutTab').click(function(e){
    e.preventDefault();
    var id = $(this).attr('id');
      var tab1 = $('body').find('#tab_1');
      if(tab1.length == 1){
        var flag = checkForms();
      }
    if(!flag){
      return false;
    }
    if(id == 'tab_3'){
      if(tab2form == ''){
        return false;
      }else{
        return true;
      }
    }
    if(id == 'tab_4'){
      if(tab3form == ''){
        return false;
      }else{
        return true;
      }
    }
  })
  $('#paymentmethodbutton').click(function(){
    tab3form = 'submit';
    $('#collapse6').addClass('in');
    $('#collapse5').removeClass('in');
  })
    $('#checkoutfirstbtn').click(function(){
        var value = '';
        $('input[name="checkoutuserType"]').each(function(){
            if($(this).is(':checked')){
                value = $(this).val()
            }
        })
    userformtype = value;
    $('#collapse2').addClass('in');
    $('#collapse1').removeClass('in');
    })
    $('#infoForm').validate({
        rules:{
            pincode:{
                required:true,
                number:true,
                minlength:6,
                maxlength:6,
            },
            phone:{
                number:true,
                minlength:6,
                maxlength:15,
            },
            confirm_password:{
                equalTo:'#password',
            }

        },
        submitHandler:function(){
          
           $.ajax({
            url:URL+'customer/ajaxpostValue',
            data:$('#infoForm').serialize()+'&type='+userformtype,
            type:'post',
            success:function(res){
              var result = $.parseJSON(res);
              if(result.status == 1){
                tab2form = 'submit';
                $('#collapse5').addClass('in');
                $('#collapse2').removeClass('in');
              }else{
               var html =  '<label class="error" for="email" generated="true">Email Already Exists.</label>';
               $('input[name="email"]').closest('div.form-group').append(html);
               // alert('Email Already Exists');
                tab3form = '';
              }
            }
           })
        }
    })
    $('form#checkoutLogin').validate({
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
            $('form#checkoutLogin').find('div.alert').remove();
          //  $.blockUI({ message: 'processing'});
            var form = $('form#checkoutLogin').serialize();
            $.ajax({
                url:URL+'customer/login',
                data:form,
                type:'post',
                success:function(res){
                    console.log(res);
                    if(res != ''){ 
                        $('form#checkoutLogin').prepend('<div class="alert alert-success alert-dismissible" role="alert">Login Successfully </div>');
                        window.location.reload();
                    }else{
                        $('form#checkoutLogin').prepend('<div class="alert alert-danger alert-dismissible" role="alert">Email or Password wrong. </div>');
                    }
                }
            })
            
        }
    })


    /////////////  Script for Forgot Password ////////
    
    $('#forgotPasswordCheck').hide();
    $("#forgotPasswordButtonCheck").click(function(){
        $("#forgotPasswordCheck").slideToggle();
    });
    

    $('#forgotPasswordCheck form').validate({

      submitHandler:function(){
         $('span.forgotmsg').hide();
        var form = $('#forgotPasswordCheck form');

        $.ajax({
          url:URL+'customer/forgot',
          data:form.serialize(),
          type:'post',
          success:function(res){

            var result = $.parseJSON(res);
            if(result.status == 1)            {
              form.trigger('reset');
              var elem = $('span.forgotmsg.successMSG');
              elem.html(result.msg);
              elem.show();
            }else{
              var elem = $('span.forgotmsg.errorMSG');
              elem.html(result.msg);
              elem.show();
            }
            setTimeout(function(){
                elem.fadeOut('slow');
                elem.html('');
            },5000)
          }

        })
      }
    })


    ////////////////////////////////////////////////

})



</script>