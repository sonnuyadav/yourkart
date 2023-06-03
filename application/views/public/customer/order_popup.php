
<!---POP SECTION START-->
<div class="modal fade" id="myModal_<?php echo $id?>" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="width:75%;"><?php echo $invoice_id ?></h4>
        </div>
        <div class="modal-body">
          <div class="row">
            
            <div class="col-md-12">
                <?php if(count($orderItems)){ ?>
                    <table class="table">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Item Price</th>
                        <th>Qty</th>
                        <th>Total Price</th>
                    </tr>
              <?php  foreach($orderItems as $items){ ?>

                
                    <tr>
                        <td><img src="<?php echo getThumb($items->item_image) ?>" /></td>
                        <td><?php echo $items->item_name ?></td>
                        <td><?php echo $items->item_price ?></td>
                        <td><?php echo $items->qty ?></td>
                        <td><?php echo $items->item_price*$items->qty ?></td>
                    </tr>
            <?php   }
            echo '</table>';
            } else { ?>
                <div class="alert alert-warning">No order items</div>
            <?php }?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<!--POP SECTION END-->
