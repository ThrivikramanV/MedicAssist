<?php
if(isset($_POST["getlist"])){
	require "../dbh.php";
	$id=$_POST['patientid'];
	$name=$_POST['doctor'];
	$sql="SELECT * FROM prescriptions WHERE idnumber='$id' AND 	docname='$name'";
	$stmt=mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
   		echo "Internal Server Error";
   	exit();
	}
	else{
		if($result=mysqli_query($conn,$sql)){
           	while ($row=mysqli_fetch_row($result)){
                    echo $row[1]." ".$row[3]." ".$row[4]." ".$row[5]."\n";
                }   
            }
		}
}	
?>