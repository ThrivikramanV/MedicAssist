<?php
if(isset($_POST["approve"])){
	require "../dbh.php";
	$id=$_POST['patientid'];
	$name=$_POST['doctor'];
	$sql="UPDATE appointments SET status='Approved' WHERE patid='$id' AND docname='$name'";
	$stmt=mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
   		echo "Internal Server Error";
   	exit();
	}
	if($conn->query($sql))
		echo "Approved";
	else
		echo "Failed Please Try Again";
}
?>