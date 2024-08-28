<?php 
 $conn=mysqli_connect("localhost","root","","niki5");
 if(!$conn)
 {
               die("connect failed:".mysqli_connect_error());
	  }
$sql="CREATE TABLE faculty(id VARCHAR(10),name VARCHAR(20),designation(30),specialisaton varchar(35),registernumber varchar(15))";
if(mysqli_query($conn,$sql))
{
	echo "tables created successfully";
	}
 else
 {
	echo "error creating tables".mysqli_error($conn); 
 }
 mysqli_close($conn);
 ?>
