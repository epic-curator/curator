<?php
function echoArray($arr){
	foreach($arr as $value){
		if(is_array($value))
			echoArray($value);
		else
			echo "$value\n";
	}
}
?>
