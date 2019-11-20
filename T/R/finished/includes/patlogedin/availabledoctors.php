<?php
if(isset($_POST['doctype'])){
	require "../dbh.php";
    $mainarray=array();
	$doctype=$_POST['doctype'];
	$sql = "SELECT patid FROM appointments WHERE patid=?";
	$stmt=mysqli_stmt_init($conn);
 	if(!mysqli_stmt_prepare($stmt,$sql)){
		echo "Internal Server Error";
        exit();
	}
	else{
    	$sql="SELECT * FROM doctors";
    	$stmt=mysqli_stmt_init($conn);
        $ch=0;
    	if(!mysqli_stmt_prepare($stmt,$sql)){
    		echo "Internal Server Error";
    		exit();
    		}
    		else{
            if($result=mysqli_query($conn,$sql)){
                while ($row=mysqli_fetch_row($result)){
                    $check=explode(';',$row[5]);
                    if(in_array($doctype,$check)){
                        echo $row[1].";";
                        $ch=1;
                    }
                    }
                    if($ch){
                        echo "empty";   
                        mysqli_free_result($result);
                    }
                    }
    			}
	}

 }
?>