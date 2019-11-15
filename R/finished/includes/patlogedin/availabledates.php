<?php
if(isset($_POST['date'])){
	require "../dbh.php";
    $mainarray=array();
	$doctype=$_POST['date'];
    $sql="SELECT * FROM appointments";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
    	echo "Internal Server Error";
    	exit();
    }
else{
    if($result=mysqli_query($conn,$sql)){
        $arr=array('9','10','11','12','13','14','15','16','17');
        $temp=array();
        while ($row=mysqli_fetch_row($result)){
            if($_POST['date']==$row[4] && $_POST['doc']==$row[3]){
                    array_push($temp,$row[5]);
                }
            }
            $arr=array_diff($arr, $temp);
            foreach ($arr as $key => $value) {
                echo $value." ";

    	}
    }
}
}
?>