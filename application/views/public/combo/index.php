
<div class="innerContainer">
	<div class="row">
	<div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="<?php echo base_url() ?>">Home</a></li>
          <li class="active">Combo</li>
        </ul>
        <div class="innerContainerContent comboOffer">
            <div class="col-md-12"><h1>Combo</h1></div>
            <div class="content">
                <div class="row">
                    <?php if(count($combo)){
                        foreach($combo as $comb){ ?>
                            <div class="col-md-12 comboSection">
                                <a href="<?php echo base_url('combo/'.$comb->nicename) ?>"><img src="<?php echo getLarge($comb->image) ?>" /></a>
                            </div>
                            <div class="clearfix"></div>
                    	<?php   } } else{ ?>
                        <div class="col-md-12">No Combo</div>
                    <?php }?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
         