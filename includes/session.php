<?php 
session_start(); 

function message(){
if(isset($_SESSION["message"])){
		$ouput= "<div class=\"message\">";
		$ouput.=  htmlentities($_SESSION["message"]);
		$ouput.=  "</div>";
		
		//clear message after use
		$_SESSION["message"]=null;
		return $output;
}
}

function errors(){
if(isset($_SESSION["errors"])){
		$error=$_SESSION["errors"];
		//clear message after use
		$_SESSION["errors"]=null;
		return $error;
}
}



?>
