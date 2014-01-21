<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connect.php");?>
<?php require_once("../includes/functions.php");?>
<?php include("../includes/layout/header.php"); ?>
<?php find_selected_menu() ?>
	<div id="main">
	<nav id="navigation"> 
		<?php echo navigation(); ?><br/>
			</nav>
	<section id="page">
	<?php echo message(); ?>
	<?php if($current_subject) {?>
		<h2>Manage Subject</h2>
			<?php echo $current_subject["menu_name"];?><br/>
			<a href="edit_subject.php?subject=<?php echo $current_subject["id"];?>">Edit <?php echo $current_subject["menu_name"];?></a><br/>
			
		<?php } elseif ($current_page){?>
			<h2>Manage Page</h2>
			<?php	 echo $current_page["menu_name"];?>
			<?php } else { ?>
				<?php echo "Please select: ";?>
				<?php }?>
				
		
	</section>
	</div>	
<?php include("../includes/layout/footer.php"); ?>
