<?php
if(isset($_POST['patid'])){
require "../dbh.php";
$root= "../records".'/'.$_POST["patid"].'/';
$target_dir = $root;
$target_file = $target_dir . basename($_FILES["upfile"]["name"]);
$check = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["upload"])) {
    $check = getimagesize($_FILES["upfile"]["tmp_name"]);
    if($check === false) {
        echo "<script>alert('File is not an image')</script>";
        $check = 0;
    }
}
if (file_exists($target_file)) {
    echo "<script>alert('Sorry, file already exists')</script>";
    $check = 0;
}
if ($_FILES["upfile"]["size"] > 2048000) {
    echo "<script>alert('Sorry, your file is too large.File Size Should Be Less Than 2MB')</script>";
    $check = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType!='pdf') {
    echo "<script>alert('Sorry, only JPG, JPEG,PDF,and PNG files are allowed')</script>";
    $check = 0;
}
if ($check == 0) {
    echo sprintf("<body><form method='POST' action='ntab.php' id='form1'>
        <input type='text' value=%s style='display:none' name='patid'/>
        <input type='text' value=%s style='display:none' name='patfname' />
        <input name='sign-in' style='display:none'/>
        </form>
        <script>
        alert('Sorry, your file was not uploaded')
        document.getElementById('form1').submit()
        </script><body> 
        ",$_POST['patid'],$_POST['patfname']);
} else {
    if (move_uploaded_file($_FILES["upfile"]["tmp_name"], $target_file)) {
        $sql="INSERT INTO records(idnumber,timeupload,dateupload,filename) VALUES(?,?,?,?)";
        $patientid=$_POST['patid'];
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location:../login.pat.php?error=sqlerror");
                exit();
        }
        else{
            $dat=date('Y-m-d');
            date_default_timezone_set("Asia/Kolkata");
            $tim=date('h:i:sa');
            $id=$_POST['patid'];
            $fil=basename($_FILES["upfile"]["name"]);
            mysqli_stmt_bind_param($stmt,"ssss",$id,$tim,$dat,$fil);
            mysqli_stmt_execute($stmt);
        }
        echo sprintf("<script>
            alert('The File %s has Been Uploaded')
            </script>",basename( $_FILES["upfile"]["name"]));
        echo sprintf("<body><form method='POST' action='ntab.php' id='form1'>
        <input type='text' value=%s style='display:none' name='patid'/>
        <input type='text' value=%s style='display:none' name='patfname' />
        <input name='sign-in' style='display:none'/>
        </form>
        <script>
        document.getElementById('form1').submit()
        </script><body> 
        ",$_POST['patid'],$_POST['patfname']);
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file')</script></h1>";
    }
}
mysqli_close($conn);
}   
else{
    header("Location:../login.pat.php");
}   