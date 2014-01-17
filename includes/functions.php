<?php
function redirect_to($new_location){
	header("Location: ". $new_location);
	exit;	
	}
	
	


	
function confirm_query($result_set){
	if(!$result_set) die("databse query failed.");
}


function form_errors($errors=array()){	
	$output="";
	if(!empty($errors)){
		$output.="<div class=\"error\">";
		$output.="Please fix following errors : ";
		$output.="<ul>";
		foreach($errors as $key => $error){
			$output.="<li>{$error}</li>";			
		}
			$output.="</ul></div>";
		}
		return $output;
}



function find_all_subjects(){
	global $connection;
	//2. perform database query
	$query = "SELECT * FROM subjects WHERE visible=1";
	$query.= " ORDER BY position ASC"; 
	$subject_set=mysqli_query($connection, $query);
	confirm_query($subject_set);
	return $subject_set;
	
	}

function find_pages_for_subjects($subject_id){
	global $connection;
	
	$query = "SELECT * FROM pages WHERE visible=1 and 
				subject_id ={$subject_id} ";
	$query.= "ORDER BY position ASC"; 
	$page_set=mysqli_query($connection, $query);
	confirm_query($page_set);
	return $page_set;

}
function navigation(){
	$output="<ul>";    
	$subject_set=find_all_subjects();	
	//3. use return data (if any)
	while($subject= mysqli_fetch_assoc($subject_set)){
	//output data from each row
			$output.="<li>";
			$output.="<a href=\"manage_content.php?subject=";
			$output.=urlencode($subject["id"]);
			$output.= "\">". $subject["menu_name"] ."</a>";
			$page_set= find_pages_for_subjects($subject["id"]);
			$output.="<ul class=\"pages\">";
			 while($page = mysqli_fetch_assoc($page_set)){ 
				 $output.= "<li>";
				$output.="<a href=\"manage_content.php?page=";
				$output.=urlencode($page["id"]);
				$output.="\">";
				$output.= $page["menu_name"]; 
				$output.="</a></li>";	
				} 
		//4. release returned data
		mysqli_free_result($page_set);
		$output.="</ul>";
		$output.="</li>";
		 }	
		//4. release returned data
		mysqli_free_result($subject_set);
		$output.="</ul><br/>
				<a href=\"new_subject.php\">+ Add a subject</a>";	
		return $output;
	}
function find_subject_by_id($subject_id){
	global $connection;
	$subject_id=mysqli_real_escape_string($connection, $subject_id);
	//2. perform database query
	$query = "SELECT * FROM subjects where id={$subject_id}";
	$query.= " limit 1"; 
	$subject_set=mysqli_query($connection, $query);
	confirm_query($subject_set);
	$subject=mysqli_fetch_assoc($subject_set);
	return $subject ? $subject :null;
		
	}

function find_page_by_id($page_id){
	global $connection;
	$page_id=mysqli_real_escape_string($connection, $page_id);
	//2. perform database query
	$query = "SELECT * FROM pages where id={$page_id}";
	$query.= " limit 1"; 
	$page_set=mysqli_query($connection, $query);
	confirm_query($page_set);
	$page=mysqli_fetch_assoc($page_set);
	return $page ? $page :null;
		
	}


//find the menu selected and save in global $current_page or subject
function find_selected_menu(){
	global $current_page;
	global $current_subject;
	if(isset($_GET["subject"])){
		$current_subject= find_subject_by_id($_GET["subject"]);
		$current_page=null;
	}
	elseif(isset($_GET["page"])){
		$current_page=find_page_by_id($_GET["page"]);
		$current_subject=null;
	}
	else{
		$current_subject=null;
		$current_page=null;
		}
		
		
	}


?>
