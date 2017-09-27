<?php 
$ref = explode(",",$_GET[ref]);
if($ref[1]=='') {
	$vref = 0;
}else{
	$vref = $ref[1];
}
?>
<label><input name="total_dp" type="text" id="total_dp" size="10" maxlength="10" value="<?php echo $vref;?>" <?php if($ref[1] == '') { ?>disabled="disabled"<?php } ?>/></label>