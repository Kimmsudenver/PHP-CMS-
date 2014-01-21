<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connect.php");?>
<?php require_once("../includes/functions.php");?>

<?php

$current_subject=find_subject_by_id($_GET["subject"]);
if(!$current_subject) {redirect_to("manage_content.php");}
$id=$current_subject["id"];
$page_set=find_pages_for_subjects($id);
if(mysqli_num_rows($page_set)>0){
	$_SESSION["message"]="Can not delete subjects with existing subset";
	redirect_to("manage_content.php?subject={$id}");
	}
$query= "delete from subjects where id= {$id} limit 1";
$result= mysqli_query($connection, $query)
if($result && mysqli_affected_rows($connection)==1)
{//sucess
	$_SESSION["message"]="Subject deleted";
	redirect_to("manage_content.php");
}
else{//failed
	$_SESSION["message"]="Failed to delete subject";
	redirect_to("manage_content.php?subject={$id}");
	}
?>
