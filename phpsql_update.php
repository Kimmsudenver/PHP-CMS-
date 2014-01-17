<?php
//1. create a database connection
$host="localhost";
$user="lyndau";
$pass="lyndap";
$dbname="lynda";
$connection= mysqli_connect($host, $user, $pass, $dbname);
//Test if connection occured
if(mysqli_connect_errno()){
	die("database connection failed: ". mysqli_connect_error(). "(". mysqli_connect_errno(). ")"
		);
}
?>
<?php
//data from $_POST
$menu_n="edit here";
$pos =4;
$visi=1;
$id=2;
//2. perform database query
$query = "UPDATE subjects SET 
		menu_name ='{$menu_n}',
		position ={$pos},
		visible ={$visi} 
		 WHERE id={$id}";
$result=mysqli_query($connection, $query);
if(!$result){
die("databse update failed.");
}
if($result && mysqli_affected_rows($connection)==0) echo "none updated";
else echo "update success";
?>
<!doctype html>
<html lang="en">
<head>
<title> Databases</title>
</head>
<body>
	<?php
	//3. use return data (if any)
	while($subject= mysqli_fetch_assoc($result)){
		//output data from each row
	?>
		<li><?php echo $subject["menu_name"]; ?></li>
	<?php
	}
	?>
	<?php
	//4. release returned data
	mysqli_free_result($result);
	?>
</body>
</html>
<?php
//5. close database connection
 mysqli_close($connection);
?>
