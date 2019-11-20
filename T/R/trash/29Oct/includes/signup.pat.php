<?php
if(isset($_POST['signup-submit'])){
    require "dbh.php";
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['mail'];
    $password=$_POST['pwd'];
    $passwordRepeat=$_POST['pwd-repeat'];
    $phone=$_POST['phone'];
    $uniqueid=rand(99,1000).strtoupper($fname[0].$fname[1].$fname[2]).rand(9,99);
    $sql = "SELECT patemail FROM patients WHERE patemail=?";
    $uid = "SELECT patidlogin FROM patients WHERE patidlogin=?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$uid)||!mysqli_stmt_prepare($stmt,$sql)){
    	header("Location:../patsignup.php?error=sqlerror");
    	exit();
    }
    	else{
    		mysqli_stmt_bind_param($stmt,"s",$email);
    		mysqli_stmt_execute($stmt);
    		mysqli_stmt_store_result($stmt);
    		$resultemail=mysqli_stmt_num_rows($stmt);
            $resultuid=1;
            while ($resultuid!=0){
            mysqli_stmt_bind_param($stmt,"s",$uniqueid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultuid=mysqli_stmt_num_rows($stmt);
            $uniqueid=rand(99,1000).strtoupper($fname[0].$fname[1].$fname[2]).rand(9,99);
            }
    		if($resultemail>0){
                echo "<script>alert('User Already Exists Please Sign In To Continue')</script>";
                echo "<script>window.location.assign='signpatient.php'</script>";
    		//header("Location:../patsignup.php?error=emailtaken");
    		exit();    		
    		}
    		else{
    			$sql="INSERT INTO patients(patfname,patlname,patemail,patphone,password,patidlogin) VALUES(?,?,?,?,?,?)";
    			$stmt=mysqli_stmt_init($conn);
    			if(!mysqli_stmt_prepare($stmt,$sql)){
    				header("Location:../patsignup.php?error=sqlerror");
    				exit();
    			}
    			else{
    				$hashpwd=password_hash($password, PASSWORD_DEFAULT);
    				mysqli_stmt_bind_param($stmt,"ssssss",$fname,$lname,$email,$phone,$hashpwd,$uniqueid);
    				mysqli_stmt_execute($stmt);
                    $msg='YOUR ID'.$uniqueid;
                    //mail($email,"From:Medic-Assist",$msg); use in 000webhost
                    echo "<script>alert('Account Created Successfully Your Id Has Been Sent To Your Mail Please Login To Continue')</script>";
                    echo "<script>window.location.assign='signpatient.php'</script>";
                    //header('Location:../index.php?signup=success');
    				exit();	
    			}

    	}

    }
mysqli_stmt_close($stmt);
mysqli_close($conn);
}
else{
   header("Location:../patsignup.php");
   exit();	
}
?>