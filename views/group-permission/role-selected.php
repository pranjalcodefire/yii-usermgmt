<?php 
	foreach($AuthItemRole as $key=>$value){
		if(in_array($value, $roleChild)){
			$selected = 'selected';
		}else{
			$selected = '';
		}
?>
<option <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
<?php } ?>