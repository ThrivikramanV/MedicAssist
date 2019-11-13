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
    	$name="SELECT patfname FROM patients WHERE patidlogin='$patid'";
    if($result=mysqli_query($conn,$name)){
      while ($row=mysqli_fetch_row($result)){
        $patfname=$row[0];
      }
      mysqli_free_result($result);
    }
		$stmt=mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
		header("Location:../index.html?error=sqlerror");
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
                    echo "<script>window.location.href='signpatient.php'</script>";
                    //header("Location:../index.php?error=wrongpassword");
					exit();
				}
				else if($pwdcheck==true){
					session_start();
					$_SESSION['patid']=$row['patid'];
					echo sprintf("<form name='myform' method='POST' action='patlogedin/ntab.php'>
          <input type='text' name='patid' value='%s' style='display:none' />
          <input type='text' name='patfname' value='%s' style='display:none' />
          <input name='sign-in' style='display:none' />
          <script>document.forms['myform'].submit()</script>
          ",$patid,$patfname);
					exit();
				}
				else{
                    echo "<script>alert('Wrong Password')</script>";
                    echo "<script>window.location.href='signpatient.php'</script>";
					//header("Location:../index.php?error=wrongpassword");
					exit();
				}
			}
			else{
                   echo "<script>alert('Account Does Not Exist Please Create One')</script>";
                   echo "<script>window.location.href='signup.pat.php'</script>";
				//header("Location:../index.php?error=accountdoesnotexist");
				exit();
			}
		}
	}
}
else{
	header("Location:../index.html");
   	exit();	
}