<?php
//2. perform database query
$query = "SELECT * FROM subjects WHERE visible=1";
$query.= " ORDER BY position ASC"; 

$result=mysqli_query($connection, $query);
if(!result){
die("databse query failed.");
}
?>
