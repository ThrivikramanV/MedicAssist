<?php
if(isset($_POST['signup-submit'])){
    require "dbh.php";
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $name=$fname." ".$lname;
    $email=$_POST['mail'];
    $password=$_POST['pwd'];
    $passwordRepeat=$_POST['pwd-repeat'];
    $phone=$_POST['phone'];
    $hospitals=$_POST['hospitals'];
    $areas=implode(';',$_POST['specs']);
    $nhospitals=$_POST['no_of_hospitals'];
    $sql = "SELECT docemail FROM doctors WHERE docemail=?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
    	header("Location:../docsignup.php?error=sqlerror");
    	exit();
    }
    	else{
            mysqli_stmt_bind_param($stmt,"s",$email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck=mysqli_stmt_num_rows($stmt);
            if($resultcheck>0){
            echo "<script>alert('User Already Exists Please Sign In To Continue')</script>";
            echo "<script>window.location.href='signdoctor.php'</script>";
            //header("Location:../docsignup.php?error=emailtaken");
            exit();
            }
    		else{
    			$sql="INSERT INTO doctors(docfname,docphone,docemail,doc_no_of_hospitals,doc_areas_of_specialization,password,hospitals) VALUES(?,?,?,?,?,?,?)";
    			$stmt=mysqli_stmt_init($conn);
    			if(!mysqli_stmt_prepare($stmt,$sql)){
    				header("Location:../docsignup.php?error=sqlerror");
    				exit();
    			}
    			else{
    				$hashpwd=password_hash($password, PASSWORD_DEFAULT);
    				mysqli_stmt_bind_param($stmt,"sssssss",$name,$phone,$email,$nhospitals,$areas,$hashpwd,$hospitals);
    				mysqli_stmt_execute($stmt);
                    echo "<script>alert('Account Created Successfully Please Login To Continue')</script>";
                    echo "<script>window.location.href='signdoctor.php'</script>";
    				// header("Location:../docsignup.php?signup=success");
    				exit();	
    			}

    	}

    }
mysqli_stmt_close($stmt);
mysqli_close($conn);
}
else{
   header("Location:../docsignup.php");
   exit();	
}
?>