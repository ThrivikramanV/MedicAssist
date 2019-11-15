<?php
if(isset($_POST['appoint-submit'])){
	require "../dbh.php";
    $time=$_POST['appointime'];
    $date=$_POST['apointdate'];
    $status="pending";
    $city=$_POST['city'];
    $hosp=$_POST['hospital'];
    $specs=$_POST['doctype'];
    $availdoc=$_POST['availdoctor'];
    $sql="SELECT patid FROM appointments";
    $id=$_POST['patid'];
    $patname=$_POST['patfname'];
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo sprintf("
        <form action='ntab.php' method='POST' name='myform'>
        <input type='text' value='%s' name='patid' style='display:none'/>
        <input type='text' value='%s' name='patfname' style='display:none'/>
        <input name='sign-in' />
        </form>
        <script>
        document.forms['myform'].submit()
        </script>
        ",$_POST['patid'],$_POST['patfname']);
    }
    else{
        $sql="INSERT INTO appointments(patid,patname,docname,appdate,apptime,status,city,hospitals) VALUES(?,?,?,?,?,?,?,?)";
         $stmt=mysqli_stmt_init($conn);
         if(!mysqli_stmt_prepare($stmt,$sql)){
        echo sprintf("
        <form action='ntab.php' method='POST' name='myform'>
        <input type='text' value='%s' name='patid' style='display:none'/>
        <input type='text' value='%s' name='patfname' style='display:none'/>
        <input name='sign-in' />
        </form>
        <script>
        document.forms['myform'].submit()
        </script>
        ",$_POST['patid'],$_POST['patfname']);
        
         }
        else{
            mysqli_stmt_bind_param($stmt,"ssssssss",$id,$patname,$availdoc,$date,$time,$status,$city,$hosp);
            mysqli_stmt_execute($stmt);
            echo sprintf("
        <form action='ntab.php' method='POST' name='myform'>
        <input type='text' value='%s' name='patid' style='display:none'/>
        <input type='text' value='%s' name='patfname' style='display:none'/>
        <input name='sign-in' />
        </form>
        <script>
        alert('Appointment Booked Successfully')
        document.forms['myform'].submit()
        </script>",$_POST['patid'],$_POST['patfname']);
        }
        }
    }