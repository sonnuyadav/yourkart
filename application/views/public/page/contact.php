
<div class="innerContainer">
	<div class="row">
	<div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="<?php echo base_url() ?>">Home</a></li>
          <li class="active">Contact us</li>
        </ul>
        <div class="innerContainerContent">
            <div class="col-md-12"><h1>Contact us</h1></div>
            <div class="content">
                <div class="col-md-6">
                <?php echo isset($_SESSION['success_msg']) ? '<div class="alert alert-success">'.$_SESSION['success_msg'].'</div>' : '' ?>
                    <form id="form" action="<?php echo base_url('contact_form') ?>" method="post">
                     <div class="form-group">
                      <input required type="text" name="name" class="form-control" id="usr" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                      <input required type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                      <input required type="text" name="phone" class="form-control" id="phone"  placeholder="Enter your phone">
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" name="message" rows="3" id="comment"  placeholder="Enter your message"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block active">Submit</button>
                    </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <!--<p style="text-transform:uppercase;"><strong>Our office</strong></p>							
                        <p>Global Products Shopping Pvt. Ltd.</p>
                        <p>708,7th Floor,Maruti Plaza</p><p>Sanjay Palace, Agra-282002 </p>-->								
                        <p><strong><?php echo getThemeValue('title')?></strong></p>
                        <p><strong>Call On:-</strong> <?php echo getThemeValue('admin_mobile')?></p>
                        <!--<p><strong>Fax:-</strong> 0562-2601457</p>-->					
                        <p><strong>Email:-</strong> <?php echo getThemeValue('admin_email')?></p>
                        <p class="social">
                        	<a href="<?php echo getThemeValue('facebook_url')?>"><i class="fa fa-facebook-square"></i></a>
                        	<a href="<?php echo getThemeValue('twitter_url')?>"><i class="fa fa-twitter-square"></i></a>
                        	<a href=""><i class="fa fa-youtube-square"></i></a>
                        	<a href="<?php echo getThemeValue('linkedin_url')?>"><i class="fa fa-linkedin-square"></i></a>
                        	<a href="<?php echo getThemeValue('google_url')?>"><i class="fa fa-google-plus-square"></i></a>
                        </p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#form').validate();
})
</script>           