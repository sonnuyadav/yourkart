<div class="innerContainer">
	<div class="row">
	<div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="<?php echo base_url() ?>">Home</a></li>
          <li class="active"><?php echo $combo->title?></li>
        </ul>
        <div class="innerContainerContent comboOffer">
            <div class="col-md-12"><h1><?php echo $combo->title?></h1></div>
            <div class="content">
                <div class="row">
                    <?php if(count($combo)){ ?>                        
                        <div class="col-md-12 comboSection">
                           <img src="<?php echo getLarge($combo->image) ?>" />
                            <br/>
                        </div>
                    <?php if(!empty($combo->pro_images)){
                        foreach(explode(',',$combo->pro_images) as $pimages){?>                        
                        <div class="col-md-6 comboSection">
                            <img src="<?php echo getLarge($pimages) ?>" />
                        </div>
                    <?php } } }  ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>