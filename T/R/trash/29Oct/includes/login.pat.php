<?php
if (isset($_POST['login-submit'])) {
	require "dbh.php";
	$patid=$_POST['patid'];
	$password=$_POST['patpwd'];
	if(empty($patid)||empty($password)){
        echo "<script>alert('Empty Fields Detected Please Fill It Out')</script>";
        echo "<script>window.location.assign='signpatient.php'</script>";
		//header("Location:../index.php?error=emptyfields");
		exit();	
	}
	else{
		$sql="SELECT * FROM patients WHERE patidlogin=? OR password=?"; 
		$stmt=mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
		header("Location:../index.php?error=sqlerror");
		exit();		
		}
		else{
			mysqli_stmt_bind_param($stmt,"ss",$patid,$patid);
			mysqli_stmt_execute($stmt);
			$result=mysqli_stmt_get_result($stmt);
			if($row=mysqli_fetch_assoc($result)){
				$pwdcheck=password_verify($password,$row['password']);
				if($pwdcheck==false){
                    echo "<script>alert('Wrong Password')</script>";
                    echo "<script>window.location.assign='signpatient.php'</script>";
                    //header("Location:../index.php?error=wrongpassword");
					exit();
				}
				else if($pwdcheck==true){
					session_start();
					$_SESSION['patid']=$row['patid'];
					//header("Location:../loginpatient.php"); echo final display
					echo sprintf("<form name='myform' method='POST' action='patlogedin/ntab1.php'>
          <input type='text' name='patid' value='%s' style='display:none' />
          <input type'submit' name='sign-in' style='display:none' />
          <script>document.forms['myform'].submit()</script>
          ",$patid);
					exit();
				}
				else{
                    echo "<script>alert('Wrong Password')</script>";
                    echo "<script>window.location.assign='signpatient.php'</script>";
					//header("Location:../index.php?error=wrongpassword");
					exit();
				}
			}
			else{
                // echo "<script>alert('Account Does Not Exist Please Create One')</script>";
                // echo "<script>window.location.assign='signup.pat.php'</script>";
				//header("Location:../index.php?error=accountdoesnotexist");
				exit();
			}
		}
	}
}
else{
	header("Location:../index.php");
   	exit();	
}