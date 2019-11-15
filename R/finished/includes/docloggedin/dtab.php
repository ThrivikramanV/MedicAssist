<?php
if(!isset($_POST['sign-in']))
header("Location:../logout.php");

if(isset($_COOKIE['prescript'])){
      require "../dbh.php";
      $delfile=$_COOKIE['prescript'];
      $id=$_COOKIE['patid'];
      $sql="DELETE FROM prescriptions WHERE filename='$delfile' AND idnumber='$id'";
      if($conn->query($sql)==TRUE){} 
      $link="../prescriptions/".$id."/".$delfile;
      unlink($link);
      setcookie("prescript","",time()-3600);
      setcookie("patid","",time()-3600); 
}

if(isset($_POST["file-upload"])){
require "../dbh.php";
$root= "../prescriptions".'/'.$_POST["patid"].'/';
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
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType!='pdf')
{
    echo "<script>alert('Sorry, only JPG, JPEG,PDF,and PNG files are allowed')</script>";
    $check = 0;
}
if ($check == 0) {
    echo "<script> alert('Sorry, your file was not uploaded')</script>";
}
else{
  if(move_uploaded_file($_FILES["upfile"]["tmp_name"], $target_file)){
    $sql="INSERT INTO prescriptions(idnumber,docname,dateupload,filename,timeupload) VALUES(?,?,?,?,?)";
    $patientid=$_POST['patid'];
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location:../login.pat.php?error=sqlerror");
        exit();
    }
    else{
        $dat=date('Y-m-d');
        $name=$_POST['docfname'];
        date_default_timezone_set("Asia/Kolkata");
        $tim=date('h:i:sa');
        $fil=basename($_FILES["upfile"]["name"]);
        mysqli_stmt_bind_param($stmt,"sssss",$patientid,$name,$dat,$fil,$tim);
        mysqli_stmt_execute($stmt);
        echo "<script> alert('File Uploaded Successfully')</script>";
        }
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="dstyle.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style type="text/css">
    .docbox {
    position: relative;
    left: 10px; 
    width: 82%;
    height: 60px;
    background-color: #c7c7c7;
    cursor: pointer;
    padding: 3px 0 0 5px;
    margin: 15px 0px 15px 0;
}
    </style>
</head>

<body>

    <header>
        <div class="id1">
            <div id="sticky-header" class="main-id1">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-5 col-lg-4">
                            <div class="logo">
                                <a href="index.html">
                                    <img src="../img/logo.jpg" alt="" width="80">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3" style="background-color:#ff6f00">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a class="active" href="../logout.php">Home</a></li>
                                        <li><a class="active" style="cursor:pointer" onclick="origdisp()">Back</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3" style="font-size: 18px;">
                            Hi <span id="docname"><?php echo $_POST["docfname"] ?></span> !
                        </div>
                        <div class="col-xl-1 col-lg-1 d-none d-lg-block">
                            <div class="Appointment">
                                <div class="book_btn d-none d-lg-block">
                                    <a href="../logout.php">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="container">
        <div class="row" style="position: relative;top: 20px;">
        </div>
    </div>
    <div class="container">
        <div class="row" style="position: relative;top: 20px;display:none" id="recordtab">
        </div>
    </div>
    <div id="tabmenu" style="display:none">
    <button class="tab" id="red" onclick="dispp()">Prescriptions</button>
    <button class="tab" id="green" onclick="dispr()">Patient Records</button>
    </div>
  <span id="colorbar" style="display:none"></span>

  <div class="sidenav" style="display:none">

    <span class="navHead">Prescriptions</span>

    <div class="opts">
      Upload
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" id="upload">
        <input type="file" name="upfile" id="fileupload" accept="image/*" />
        <input name="file-upload" style="display:none">
        <input name="sign-in" style="display:none" />
        <input type="text" name="patid" id="pid" value="" style="display:none"/>
        <input type="text" name="docfname" value='<?php echo $_POST["docfname"] ?>' style="display:none">
      </form>
    </div>
    <br>
    <div class="opts" id="remove">
      Remove
    </div>
    <br>
  </div>

  <div class="doclisthead" style="display:none">
    <div class="file">File</div>
    <div class="time">Time of upload</div>
    <div class="doclistheadline"></div>
    <br>
  </div>

  <div class="doclist"></div>

  <div id="id01" class="modal">  
  <form class="modal-content animate" action="">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="" alt="Avatar" class="avatar" id="eimage">
    </div>
  </form>
</div>




  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
    <script>
      var patid,cname,infostr,arr=[],rarry=[];
      function getallinfo(){
      var nxtp= new XMLHttpRequest()
      nxtp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
          infostr=this.responseText;
          infostr=infostr.split("\n") 
        }
      }
      nxtp.open("POST","getlist.php",true);
      nxtp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      nxtp.send("getlist=1&patientid="+patid+"&doctor="+'<?php echo $_POST["docfname"] ?>'); 
    }
    function displayFiles(infostr) {
    infostr=infostr.split(" ");
    var time=infostr[1]+"\xa0\xa0\xa0"+infostr[3];
    var filename=infostr[2];
    var newelement = document.createElement("div");
    newelement.className = "docbox";
    newelement.id = filename;
    newelement.innerHTML = String.raw`
    <div class="custom-control custom-radio">
    <img src="../prescriptions/`+infostr[0]+`/`+filename+`" style="width:50px;height:50px;background-size:cover" alt="`+filename+`"/>
    <input type="radio" class="custom-control-input" name="rad" value="` + filename + `" id="` + filename + `rad" onclick="event.stopPropagation()">
    <label class="custom-control-label" for="` + filename + `rad" style="color:black;font-size:22px;" onclick="event.stopPropagation()">` + filename + `</label>
    </div>
    <span style="position:absolute;font-size:20px;top:7px;right:20px;">` + time + `</span>`;
    arr.push(newelement)
    document.getElementsByClassName("doclist")[0].appendChild(newelement);
  }
   
    function apprappoint(){
    var xtpd=new XMLHttpRequest();
    xtpd.onreadystatechange=function(){
       if(this.readyState==4 && this.status==200){
          document.getElementsByClassName(cname)[0].innerHTML="Status: "+this.responseText;
       }
    }
    var dname='<?php echo $_POST["docfname"];?>'
    xtpd.open("POST","update.php",true);
    xtpd.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xtpd.send("approve=1&patientid="+patid+"&doctor="+'<?php echo $_POST["docfname"] ?>');
    }
    function rejectappoint(){
    var xtpd=new XMLHttpRequest();
    xtpd.onreadystatechange=function(){
       if(this.readyState==4 && this.status==200){
          document.getElementsByClassName(cname)[0].innerHTML="Status: "+this.responseText;
       }
    }
    var dname='<?php echo $_POST["docfname"];?>'
    xtpd.open("POST","reject.php",true);
    xtpd.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xtpd.send("approve=1&patientid="+patid+"&doctor="+'<?php echo $_POST["docfname"] ?>'); 
    }

    function appointadder(pname,hospital,dateofappoint,timeofappoint,id,status,count){
      var newelement=document.createElement("div")
      newelement.className="col-xl-4 col-md-6 col-lg-4"
      newelement.addEventListener("mouseover",function(){patid=id;cname=count})
      newelement.innerHTML = String.raw`
            <div class="single_department1">
                <div class="department_thumb">
                    <button type="button" class="btn btn-info" onclick="disp()">View</button>
                    <button type="button" class="btn btn-primary" onclick="apprappoint()">Approve</button>
                    <button type="button" class="btn btn-danger"  onclick="rejectappoint()">Reject</button>
                    <div id="dp1">`+"PatientName:"+pname+`</div>
                    <div id="dp">`+"ID: "+id+`<div>
                    <div id="dp">`+"Hospital: "+hospital+`</div>
                    <div id="dp">`+"DOA:"+dateofappoint+`</div>
                    <div id="dp">`+"TIME:"+timeofappoint+`</div>
                    <div id="dp" class=`+count+`>`+"Status: "+status+`</div>
                </div>
            </div>`;
      document.getElementsByClassName("row")[1].appendChild(newelement);
    }
    var xtpd=new XMLHttpRequest();
    xtpd.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      var datetxt=this.responseText;
      datetxt=datetxt.split("\n")
      for(let i=0;i<datetxt.length-1;i++){
        let info=datetxt[i].split(" ")
        appointadder(info[0],info[3],info[1],info[2]+":00",info[4],info[5],"pat"+i)
      }
      }
  }
    var dname='<?php echo $_POST["docfname"];?>'
    xtpd.open("POST","appointinfo.php",true);
    xtpd.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xtpd.send("docname="+dname);
    function disp(){
      document.getElementsByClassName("row")[2].style.display="none"  
      document.getElementsByClassName("doclist")[0].style.display="block"  
      document.getElementsByClassName("container")[1].style.display="none";
      document.getElementById("red").style.backgroundColor="red"
      document.getElementById("colorbar").style.backgroundColor="red"
      document.getElementById("tabmenu").style.display="block";
      document.getElementById("colorbar").style.display="block";
      document.getElementsByClassName("sidenav")[0].style.display="block";
      document.getElementsByClassName("doclisthead")[0].style.display="block";
      getallinfo()
      setTimeout(function (){
        for(let i=0;i<infostr.length-1;i++){
            displayFiles(infostr[i])
      }},100)
      lfunc()
      setTimeout(function(){
        for(let i=0;i<lfiles.length-1;i++)
        displayrecords(lfiles[i])},100) 

    }
    function origdisp(){
      document.getElementsByClassName("container")[1].style.display="block";
      document.getElementById("tabmenu").style.display="none";
      document.getElementById("colorbar").style.display="none";
      document.getElementsByClassName("sidenav")[0].style.display="none";
      document.getElementsByClassName("doclisthead")[0].style.display="none";
      for(let i=0;i<rarry.length;i++)
        document.getElementById("recordtab").removeChild(rarry[i])
      for(let i=0;i<arr.length;i++)
      document.getElementsByClassName("doclist")[0].removeChild(arr[i]);
      arr=[]
      rarry=[]
    }

var input = document.getElementById("fileupload");
input.addEventListener("change", uploadFile);
function uploadFile(event) {
    document.getElementById("pid").value=patid
    document.getElementById("upload").submit()
  }
var rem = document.getElementById('remove');
rem.addEventListener('click', removeDoc);
function removeDoc() 
{
  var isChecked =  $('input:radio').is(':checked');
  if(!isChecked)
    alert("First select the document to remove");
  else
  {
    var con = confirm("Are you sure that you want to remove the selected file?");
    if(con)
    {
      var radios = document.getElementsByName('rad');
      var doclist = document.getElementsByClassName("doclist")[0];
      for (var i = 0; i < radios.length; i++) 
      {
        var radio = radios[i];
        var remElm = radio.parentNode.parentNode;
        if (radio.checked)
        { 
          var filename = radio.value;
          document.cookie="prescript="+filename
          document.cookie="patid="+patid
          doclist.removeChild(remElm);
        }
      }
    }
  }
}
   var lfiles;
  function lfunc(){
  var lxtpd=new XMLHttpRequest();
  lxtpd.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      lfiles=this.responseText
      lfiles=lfiles.split("\n")
    }
  }
  lxtpd.open("POST","lastinfo.php",true);
  lxtpd.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  lxtpd.send("patientid="+patid);
  } 
  var imgsrc;
  function displayrecords(a){
      a=a.split(" ")
      var rootpath="../records/"+a[0]+"/"+a[3]
      var newelement=document.createElement("div")
      newelement.className="col-xl-4 col-md-6 col-lg-4"
      newelement.addEventListener("mouseover",function(){imgsrc=rootpath})
      newelement.innerHTML = String.raw`
            <div class="single_department1">
                <div class="department_thumb">
                    <button class="btn btn-info" onclick="enlarge()">View</button>
                    <div id="dp1">`+"PatientId: "+a[0]+`</div>
                    <div id="dp">`+"Filename: "+a[3]+`</div>
                    <div id="dp">`+"Time Of Upload: "+a[1]+`</div>
                    <div id="dp">`+"Date Of Upload: "+a[2]+`</div>
                    <div id="dp>`+"File: "+`</div>
                </div>
            </div>`;
      rarry.push(newelement)
      document.getElementsByClassName("row")[2].appendChild(newelement);
    }

  function enlarge(){
    document.getElementById("eimage").src=imgsrc;
    document.getElementById('id01').style.display='block'
    document.getElementById('id01').style.width="auto;"
  }
function dispp(){
      document.getElementsByClassName("container")[1].style.display="none";
      document.getElementById("red").style.backgroundColor="red"
      document.getElementById("colorbar").style.backgroundColor="red"
      document.getElementById("tabmenu").style.display="block";
      document.getElementById("colorbar").style.display="block";
      document.getElementsByClassName("sidenav")[0].style.display="block";
      document.getElementsByClassName("doclisthead")[0].style.display="block";
      document.getElementsByClassName("doclist")[0].style.display="block"
      document.getElementsByClassName("tab")[1].style.backgroundColor="#555"
      document.getElementsByClassName("row")[2].style.display="none"
}
function dispr(){
      document.getElementsByClassName("tab")[0].style.backgroundColor="#555"
      document.getElementById("green").style.backgroundColor="green"
      document.getElementById("colorbar").style.backgroundColor="green"
      document.getElementsByClassName("container")[1].style.display="none";
      document.getElementById("tabmenu").style.display="block";
      document.getElementById("colorbar").style.display="block";
      document.getElementsByClassName("sidenav")[0].style.display="none";
      document.getElementsByClassName("doclisthead")[0].style.display="none"; 
      document.getElementsByClassName("doclist")[0].style.display="none"
      document.getElementsByClassName("row")[2].style.display="block"
}
</script> 