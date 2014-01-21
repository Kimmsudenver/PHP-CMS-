<?php
$errors=array();


//presence
function has_presence($value){
	return (isset($value) && $value!=="");
	}
//check if string exceed max length
function has_max_length($string, $max){
	return strlen($string) <=$max;
	}

//check if a string is include in a set
function has_included($string, $set){
	return in_array($string,$set);
	} 
	
// run through array and see if an item is too long
function validate_max_length($fields){
	global $errors;
	foreach($fields as $field =>$max){
		$value= trim($_POST[$field]);
		if(!has_max_length($value,$max))
				{$errors[$field]=ucfirst(str_replace("","_",$field))." is too long";}
	}
}

//validate if a field is left blank
function validate_presence($fields){
	global $errors;
	foreach($fields as $field){
		$value = trim($_POST[$field]);
		if(!has_presence($value))
			{$errors[$field]= ucfirst(str_replace("","_",$field)). " can not be blank";}
	}
}
?>
