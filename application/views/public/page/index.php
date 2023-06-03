<div class="innerContainer">
 	<div class="row">
    	<div class="col-md-12">
            <ul class="breadcrumb">
              <li><a href="<?php echo base_url()?>">Home</a></li>
              <li class="active"><?php echo ucfirst($page->title)?></li>
            </ul>
            <div class="innerContainerContent">
                <h1><?php echo $page->title?></h1>
                <div class="content">
                <?php echo html_entity_decode($page->content)?> 
                </div>
            </div>
        </div>
    </div>