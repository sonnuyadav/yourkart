<style>
.dashboard .changepassword button {
    background: #790000 none repeat scroll 0 0;
    border: medium none;
    color: #fff;
    display: block;
    margin-top: 25px;
    text-align: center;
    text-transform: uppercase;
    width: 100%;
}
</style>
         <div class="innerContainer">
         	<div class="row">
            	<div class="col-md-12">
                    <ul class="breadcrumb">
                      <li><a href="#">Home</a></li>
                      <li class="active">Dashboard</li>
                    </ul>
                    <div class="innerContainerContent">
                        <!--<h1>Dashboard</h1>-->
                        <div class="content dashboard">
                        	<div class="col-md-3">
                            	<!-- <div class="profileImage">
                                	<img src="images/no_image.png">
                                    <div class="updateimage">
                                    	<a href=""><i class="glyphicon glyphicon-pencil"></i> Image</a>
                                   </div>                                   
                                </div> -->
                                <div><span style="color:#790000;">Welcome,</span> <?php echo $_SESSION['customer']['fullname'] ?></div>
                                <div class="list-group">
                                  <a href="javascript:void(0)" data-class="updateProfileForm" class="list-group-item active">Update Profile</a>
                                  <a href="javascript:void(0)" data-class="orders" class="list-group-item ">View Order</a>
                                  <a href="javascript:void(0)" data-class="changepassword" class="list-group-item">Change Password</a>
                                </div>
                            </div>
                        	<div class="col-md-9 " >
                                <?php //    pr($orders) ?>
                            	<div style="display:none" class="table-responsive dashboard orders">
                                    <?php if(count($orders)){   ?>
                                  <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th>S.no</th>
                                        <th>Invoice Id</th>
                                        <th>Price</th>
                                        <th>Payment type</th>
                                        <th>Purchase date</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 0;
                                        foreach($orders as $order){
                                    //      pr($order); die();
                                    $popups[] = $this->load->view('public/customer/order_popup',$order,true);
                                            $counter++;
                                        ?>
                                      <tr>
                                        <td><?php echo $counter?>.  </td>
                                        <td><?php echo $order->invoice_id?></td>
                                        <td><?php echo $order->ord_total_amount?></td>
                                        <td><?php echo $order->order_method?></td>
                                        <td><?php echo date('jS F Y',strtotime($order->order_date))?></td>
                                        <td>
                                        	<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal_<?php echo $order->id?>"><i class="glyphicon glyphicon-eye-open"></i></a>
                                        </td>
                                      </tr>
                                      <?php } ?>
                                    </tbody>
                                  </table>
                                  <?php } ?>
                                </div>
                                
                                <div class="dashboard updateProfileForm" >
                                	 <form method="post" id="form" action="<?php echo base_url('user/update_profile')?>">
                                        <?php if(isset($_SESSION['success'])){ ?>
                                          <div class="alert alert-success"><?php echo $_SESSION['success'] ?></div>
                                        <?php } ?>
                                        <?php if(isset($_SESSION['error'])){ ?>
                                          <div class="alert alert-danger"><?php echo $_SESSION['error'] ?></div>
                                        <?php } ?>
                                          <div class="form-group">
                                            <div class="col-md-6">
                                            <label >Name:</label>
                                            <input required type="text" name="name" value="<?php echo  $user['fullname'] ?>" class="form-control">
                                          </div>
                                          <div class="col-md-6">
                                            <label >Phone:</label>
                                            <input required type="text" name="phone" value="<?php echo  $user['phone'] ?>" class="form-control">
                                          </div>
                                          </div> 
                                          <div class="clearfix"></div>   
                                          <div class="form-group">
                                            <div class="col-md-6">
                                            <label >Fax:</label>
                                            <input type="text" name="fax" value="<?php echo  $user['fax'] ?>" class="form-control">
                                          </div>
                                          <div class="col-md-6">
                                            <label >Company:</label>
                                            <input required type="text" name="company" value="<?php echo  $user['company'] ?>" class="form-control">
                                          </div>  
                                        </div>
                                        <div class="clearfix"></div>   
                                          <div class="form-group">
                                            <div class="col-md-6">
                                            <label >Address1:</label>
                                            <input required type="text" value="<?php echo  $user['address1'] ?>" name="address1"  class="form-control">
                                          </div>  
                                          <div class="col-md-6">
                                            <label >Address2:</label>
                                            <input required type="text" name="address2" value="<?php echo  $user['address2'] ?>" class="form-control">
                                          </div> 
                                        </div>
                                        <div class="clearfix"></div>   
                                          <div class="form-group">
                                            <div class="col-md-6">
                                            <label >Postal Code:</label>
                                            <input required type="text" value="<?php echo  $user['pincode'] ?>" name="pincode" class="form-control">
                                          </div> 
                                          <div class="col-md-6">
                                            <label >City:</label>
                                            <input required type="city" value="<?php echo  $user['city'] ?>" name="city" class="form-control">
                                          </div> 
                                        </div>
                                        <div class="clearfix"></div>   
                                          <div class="form-group">
                                            <div class="col-md-6">
                                            <label >State:</label>
                                            <select required class="form-control" name="state">
                                              <option value="">Choose State</option>
                                              <?php foreach($states as $state){ ?>
                                              <option <?php echo $state->state_name == $user['state'] ? 'selected' : '' ?> value="<?php echo $state->state_name ?>"><?php echo $state->state_name ?></option>
                                              <?php } ?>
                                              

                                            </select>
                                          </div>      
                                          </div>    

                                      <div class="clearfix"></div>                                                                          
                                      <div class="col-md-12">
                                          <button type="submit" class="btn btn-default buttonArea">Submit</button>
                                        </div>
                                     </form>
                                </div>
                                <div class="dashboard changepassword" style="display:none">
                                   <form id="changepassword" method="post" action="<?php echo base_url('user/change_password')?>">
                                          <div class="row">
                                          <div class="form-group">
                                            <div class="col-md-6">
                                              <label for="pwd">Old Password:</label>
                                              <input required type="password" name="oldpassword" class="form-control">
                                            </div>
                                          </div>
                                          </div>
                                          <div class="row">
                                          <div class="form-group">
                                            <div class="col-md-6">
                                              <label for="pwd">New Password:</label>
                                              <input required type="password" name="password" id="profile_password" class="form-control">
                                            </div>
                                          </div> 
                                          </div>
                                          <div class="row">
                                          <div class="form-group">
                                            <div class="col-md-6">
                                              <label for="pwd">Confirm Password:</label>
                                              <input required type="password" name="conpassword" class="form-control">
                                            </div>
                                          </div>    
                                          </div>  
                                          <div class="row">
                                            <div class="col-md-6">                                                                              
                                              <button type="submit" class="btn btn-default buttonArea">Submit</button>
                                            </div>
                                          </div>

                                     </form>
                                </div>
                               
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            
<?php if(isset($popups) && count($popups)){
    foreach($popups as $popup){
    echo $popup;
}}?>
<script type="text/javascript">
$(document).ready(function(){
  setTimeout(function(){
    $('div.alert').hide('slow');
  },5000)
  $('#form').validate({
    rules:{
      phone:{
        number:true,
        minlength:6,
        maxlength:15,
      },
      pincode:{
        number:true,
        minlength:6,
        maxlength:6,
      }
    }
  })
  $('#changepassword').validate({
    rules:{      
      conpassword:{
        equalTo:'#profile_password'
      }
    }
  })
  $('.list-group a').click(function(){
    var currentClass = $('.list-group a.active').data('class');
    $('.dashboard.'+currentClass).hide();
    $('.list-group a').removeClass('active');
    $(this).addClass('active');
    var currentClass = $('.list-group a.active').data('class');
    $('.dashboard.'+currentClass).show();
  })
})
</script>