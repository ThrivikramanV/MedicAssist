<?php 
if(isset($_POST["docname"])){
require "../dbh.php";
$name=$_POST["docname"];
$sql="SELECT * FROM appointments WHERE docname='$name' ORDER BY appdate,apptime";
$stmt=mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
   	echo "Internal Server Error";
   	exit();
}
else{
	 if($result=mysqli_query($conn,$sql)){
        while ($row=mysqli_fetch_row($result)){
                echo $row[2]." ".$row[4]." ".$row[5]." ".$row[8]." ".$row[1]." ".$row[6]."\n";
            }   
        }
}
}
?>