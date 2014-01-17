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
//get the values from $_POST
$m_name="edit m";
$pos = 4;
$visi =1;
$query = "INSERT INTO subjects(menu_name, position, visible)
		VALUES('{$m_name}','{$pos}','{$visi}')";

$result=mysqli_query($connection, $query);
if(!$result){
die("databse query failed . ". mysqli_error($connection));
}
else {
	//success --> redirect to some page
	echo "Success";
}
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
