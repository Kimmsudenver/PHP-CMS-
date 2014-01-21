<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connect.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/validation.php");?>

	<?php find_selected_menu(); ?>
	

	<?php  	// perform validation before continue
	if(isset($_POST['submit'])){
	//process the form
		
		//validation
		$required_field= array("menu_name","position","visible");
		validate_presence($required_field);
		
		$field_maxlength=array("menu_name" =>30);
		validate_max_length($field_maxlength);
		
		if(empty($errors)){		

		//these are values from post
		$id=$current_subject["id"];
		$menu_name=$_POST["menu_name"];
		$position=(int) $_POST["position"];
		$visible =(int) $_POST["visible"];
		//2.perform database query
		$menu_name=mysqli_real_escape_string($connection, $menu_name);
		$query="update subjects set 
				menu_name= '{$menu_name}',
				position={$position},
				visible={$visible}
				where id={$id}
				limit 1";
		$result=mysqli_query($connection, $query);
		
		if($result && mysqli_affected_rows($connection)==1){
		//success
		$_SESSION["message"]="subject edited";
		redirect_to("manage_content.php");
		}
		else{
				//failed
				$message="subject edited failed";
				
			}
		}
	}
	
	?>
	<?php include("../includes/layout/header.php"); ?>
	<div id="main">
	<nav id="navigation"> 
		<?php echo navigation(); ?>
	</nav>
	<section id="page">
		<?php 
		if(!empty($message)){
			echo "<div class=\"message\">". $message. "</div> ";
			//$message=null;
			}
		?>
		<?php 
		//$error=errors();
		echo form_errors($errors);
		?>
		
		
		<h2>Edit Subject :<?php echo $current_subject["menu_name"];?></h2>
		<form action="edit_subject.php?subject=<?php echo $current_subject["id"]?>" method="post">
		<label>Subject Name:
		<input type="text" name="menu_name" value="<?php echo $current_subject["menu_name"];?>" />
		</label>
		<br/>
		<label>Position:
		<select name="position">
			<?php 
			$subject_set=find_all_subjects();
			$subject_count=mysqli_num_rows($subject_set);
			for($count=1; $count<=$subject_count;$count++){
				echo "<option value=\"{$count}\" ";
				
				if($current_subject["id"]==$count) echo " selected";
				echo">{$count}</option>";
				}
			?>
		</select></label>
		<br/>
		<label> Visible: 
			<input type="radio" name="visible" value="0"
			<?php if($current_subject["visible"]==0) echo " checked"?>/> NO
			&nbsp;
			<input type="radio" name="visible" value="1"
			<?php if($current_subject["visible"]==1) echo " checked"?>/>Yes
		</label>	
		<input type="submit" name="submit" value="Edit Subject" />
			</form>
			<br/>
			<a href="manage_content.php">Cancel</a><br/><br/>
			<a href="edit_subject.php?subject=<?php echo $current_subject["id"];?>" onclick="return confirm('Are you sure?');">Delete <?php echo $current_subject["menu_name"];?></a>
	
	</section>
	</div>	
<?php include("../includes/layout/footer.php"); ?>

