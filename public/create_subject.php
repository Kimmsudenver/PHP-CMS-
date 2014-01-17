<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connect.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/validation.php");?>
<?php
if(isset($_POST['submit'])){
//process the form
//these are values from post
	$menu_name=$_POST["menu_name"];
	$position=(int) $_POST["position"];
	$visible =(int) $_POST["visible"];
	
	
	//validation
	$required_field= array("menu_name","position","visible");
	validate_presence($required_field);
	
	$field_maxlength=array("menu_name" =>30);
	validate_max_length($field_maxlength);
	
	if(!empty($errors)){
		$_SESSION["errors"]=$errors;
		redirect_to("new_subject.php");
	}

	
	//2.perform database query
	$menu_name=mysqli_real_escape_string($connection, $menu_name);
	$query="insert into subjects (menu_name, position,visible)
			 values ('{$menu_name}',{$position}, {$visible} )";
	$result=mysqli_query($connection, $query);
	
	if($result){
	//success
	$_SESSION["message"]="subject created";
	redirect_to("manage_content.php");
	}
	else{
			//failed
			$_SESSION["message"]="subject created failed";
			redirect_to("new_subject.php");
		}
}

else{
	redirect_to("new_subject.php");
	}





?>
<?php
//5. close database connection
if(isset($connection)) { mysqli_close($connection);}
?>
