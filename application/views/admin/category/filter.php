<?php if(count($filter)){
	foreach($filter as $fil){
?>
<div class="form-group">
    <label class="col-sm-2 control-label" for="<?php echo $fil->filter.'_'.$fil->id ?>"><?php echo $fil->filter ?></label>                                            <div class="col-sm-6">
        <input type="text" class="form-control" id="<?php echo $fil->filter.'_'.$fil->id ?>" value="" name="filter[<?php echo $fil->id ?>]">
    </div>
</div>
<?php } } ?>