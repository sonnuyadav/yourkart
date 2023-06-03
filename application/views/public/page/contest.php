
         <div class="innerContainer">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                      <li><a href="#">Home</a></li>
                      <li class="active">Contest</li>
                    </ul>
                    <div class="innerContainerContent">
                        <!--<div class="col-md-12"><h1 style="text-align:center;">Contest</h1></div>-->
                        <div class="content contest">
                            <div class="col-md-6">
                                <h1 class="heading">Contest</h5>
                                    <?php echo isset($_SESSION['success_msg']) ? '<div class="alert alert-success">'.$_SESSION['success_msg'].'</div>' : '' ?>
                                <form action="<?php echo base_url('contest_submit')?>" id="form"  method="post" >
                                 <div class="form-group">
                                  <label>Name <span class="red">*</span></label>
                                  <input required type="text" name="name" class="form-control" id="usr" placeholder="Enter your name">
                                </div>
                                <div class="form-group">
                                  <label>Email <span class="red">*</span></label>
                                  <input required type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
                                </div>
                                <div class="form-group">
                                  <label>Phone <span class="red">*</span></label>
                                  <input required type="text" name="phone" class="form-control" id="phone"  placeholder="Enter your phone">
                                </div>
                                <div class="form-group">
                                  <label>City <span class="red">*</span></label>
                                  <input required type="text" name="city" class="form-control" id="city"  placeholder="Enter your city">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block active">Submit</button>
                                </div>
                                </form>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <div class="bannerContainer">
                                    <h5 class="heading">Grand Prize</h5>
                                    <img src="<?php echo base_url($frontend_dir)?>/images/contest/Contest_Banner_1.gif" width="100%" height="200px">
                                </div>  
                                <div class="bannerContainer">
                                    <h5 class="heading">All Prizes</h5>
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                      <div class="carousel-inner" role="listbox">
                                        <div class="item active">
                                          <img src="<?php echo base_url($frontend_dir)?>/images/contest/Contest_Banner_2.gif" width="100%" height="200px">
                                        </div>
                                    
                                        <div class="item">
                                          <img src="<?php echo base_url($frontend_dir)?>/images/contest/Contest_Banner_3.gif" width="100%" height="200px">
                                        </div>
                                    
                                        <div class="item">
                                          <img src="<?php echo base_url($frontend_dir)?>/images/contest/Contest_Banner_4.gif" width="100%" height="200px">
                                        </div>
                                        <div class="item">
                                          <img src="<?php echo base_url($frontend_dir)?>/images/contest/Banner_global.gif" width="100%" height="200px">
                                        </div>
                                    
                                      </div>
                                      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                      </a>
                                      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                      </a>
                                    </div>
                                </div>                                                              
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
$(document).ready(function(){
    $('#form').validate({
        rules:{
            phone:{
                number:true,
                minlength:6,
                maxlength:15,
            }
        }
    });
})
</script>  