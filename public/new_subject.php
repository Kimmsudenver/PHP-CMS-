<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connect.php");?>
<?php require_once("../includes/functions.php");?>
<?php include("../includes/layout/header.php"); ?>
<?php require_once("../includes/validation.php");?>


<?php find_selected_menu(); ?>
	<div id="main">
	<nav id="navigation"> 
		<?php echo navigation(); ?>
	</nav>
	<section id="page">
		<?php 
		echo message();
		?>
		<?php 
		$error=errors();
		echo form_errors($error);
		?>
		
		<h2>Create Subject</h2>
		<form action="create_subject.php" method="post">
		<label>Subject Name:
		<input type="text" name="menu_name" placeholder="subject name" />
		</label>
		<br/>
		<label>Position:
		<select name="position:">
			<?php 
			$subject_set=find_all_subjects();
			$subject_count=mysqli_num_rows($subject_set);
			for($count=1; $count<=$subject_count+1;$count++){
				echo "<option value=\"{$count}\">{$count}</option>";
				}
			?>
		</select></label>
		<br/>
		<label> Visible: 
			<input type="radio" name="visible" value="0"/> NO
			&nbsp;
			<input type="radio" name="visible" value="1"/>Yes
		</label>	
		<input type="submit" name="submit" value="Create Subject" />
			</form>
			<br/>
			<a href="manage_content.php">Cancel</a>
	
	</section>
	</div>	
<?php include("../includes/layout/footer.php"); ?>
