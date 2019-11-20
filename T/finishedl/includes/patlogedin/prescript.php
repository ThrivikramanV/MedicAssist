<?php 
if(isset($_POST["patientid"])){
require "../dbh.php";
$id=$_POST["patientid"];
$sql="SELECT * FROM prescriptions WHERE idnumber='$id'";
$stmt=mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
   	echo "Internal Server Error";
   	exit();
}
else{
	 if($result=mysqli_query($conn,$sql)){
        while ($row=mysqli_fetch_row($result)){
                echo $row[1]." ".$row[2]." ".$row[3]." ".$row[4]." ".$row[5]."\n";
            }   
        }
}
}
?>