<?php
if(isset($_POST['doc'])){
	require "../dbh.php";
	$docname=$_POST['doc'];
    $sql="SELECT * FROM doctors";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
    	echo "Internal Server Error";
    	exit();
    }
    else{
        if($result=mysqli_query($conn,$sql)){
            while ($row=mysqli_fetch_row($result)){
                if($row[1]==$docname)
                    echo $row[7];
                }   
            }
    	}
    }
?>