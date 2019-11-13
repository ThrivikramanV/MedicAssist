<?php
if(isset($_POST['patid'])){
	require "../dbh.php";
    $sql="SELECT * FROM appointments";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
    	echo "Internal Server Error";
    	exit();
    }
else{
    if($result=mysqli_query($conn,$sql)){
        while ($row=mysqli_fetch_row($result)){
            if($_POST['patid']==$row[1]){
            	echo $row[3]." ".$row[4]." ".$row[5]." ".$row[6]." ".$row[7].";";
                }
            }

    	}
    }
}
?>