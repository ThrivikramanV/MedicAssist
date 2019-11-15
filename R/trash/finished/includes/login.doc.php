<?php
if (isset($_POST['login-submit'])) {
	require "dbh.php";
	$docmail=$_POST['docmail'];
	$password=$_POST['docpwd'];
	if(empty($docmail)||empty($password)){
        echo "<script>alert('Empty Fields Detected Please Fill It Out')</script>";
        echo "<script>window.location.assign='singdoctor.php'</script>";
		//header("Location:../index.php?error=emptyfields");
		exit();	
	}
	else{
		$sql="SELECT * FROM doctors WHERE docemail=? OR password=?";
		$name="SELECT docfname FROM doctors WHERE docemail='$docmail'";
		if($result=mysqli_query($conn,$name)){
     	 	while ($row=mysqli_fetch_row($result)){
        		$docfname=$row[0];
      		}
      		mysqli_free_result($result);
      	}
		$stmt=mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
		header("Location:../index.php?error=sqlerror");
		exit();		
		}
		else{
			mysqli_stmt_bind_param($stmt,"ss",$docmail,$docmail);
			mysqli_stmt_execute($stmt);
			$result=mysqli_stmt_get_result($stmt);
			if($row=mysqli_fetch_assoc($result)){
				$pwdcheck=password_verify($password,$row['password']);
				if($pwdcheck==false){
        		echo "<script>alert('Wrong Password')</script>";
        		echo "<script>window.location.href='signdoctor.php'</script>";
					// header("Location:../index.php?error=wrongpassword");
					exit();
				}
				else if($pwdcheck==true){
					session_start();
					$_SESSION['docid']=$row['docid'];
        			echo sprintf("<form name='myform' method='POST' action='docloggedin/dtab.php'>
          <input type='text' name='docfname' value='%s' style='display:none' />
          <input name='sign-in' style='display:none' />
          <script>document.forms['myform'].submit()</script>
          ",$docfname);
					exit();
				}
				else{
        		echo "<script>alert('Wrong Password')</script>";
        		echo "<script>window.location.href='signdoctor.doc.php'</script>";
				exit();
				}
			}
			else{
                echo "<script>alert('Account Does Not Exist Please Create One')</script>";
                echo "<script>window.location.href='signup.doc.php'</script>";
				// header("Location:../index.php?error=accountdoesnotexist");
				exit();
			}
		}
	}
}
else{
	header("Location:../index.html");
   	exit();	
}