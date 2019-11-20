<?php
if(isset($_POST['sign-in']))
{
  require "../dbh.php";
  $id=$_POST['patid'];
  if(isset($_COOKIE['file'])){
      $delfile=$_COOKIE['file'];
      $sql="DELETE FROM records WHERE filename='$delfile' AND idnumber='$id'";
      if($conn->query($sql)==TRUE){} 
      $link="../records/".$_POST['patid']."/".$_COOKIE['file'];
      unlink($link);
  }
  if(isset($_COOKIE['appointment'])){
    $apid=$_COOKIE['appointment'];
    $apid=explode(':', $apid);
    $apid=trim($apid[0]);
    $mysql="DELETE FROM appointments WHERE patid='$id' AND docname='$apid'";
    $conn->query($mysql);
  }
  setcookie("appointment","",time()-3600);
  setcookie("file","",time()-3600); 
  $filearray=array();
  $root= "../records".'/'.$_POST["patid"].'/';
  $city="SELECT city FROM patients WHERE patidlogin='$id'";
  $stmt=mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt,$city)){
    header("Location:../signpatient.php?error=sqlerror");
    exit();   
  }
  else{
      if($result=mysqli_query($conn,$city)){
        $row=mysqli_fetch_row($result);
        $city=$row[0];
        mysqli_free_result($result);
    }
  }


  $records="SELECT * FROM records WHERE idnumber='$id'";
  $stmt=mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt,$records)){
    header("Location:../signpatient.php?error=sqlerror");
    exit();   
  }
  else{
      if($result=mysqli_query($conn,$records)){
        while ($row=mysqli_fetch_row($result)){
            $str=$row[2]." ".$row[3]." ".$row[4];
            array_push($filearray,$str);
      }
      mysqli_free_result($result);
    }
  }
  $filearray=implode(';',$filearray);
  echo sprintf('<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="pstyle.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>.department_thumb {
    padding: 50px 0 10px 0;
}
</style>
</head>
<body>
  <header>
    <div class="id1">
      <div id="sticky-header" class="main-id1">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-xl-4 col-lg-3">
              <div class="logo">
                <a href="index.html">
                  <img src="logo.jpg" alt="" width="80">
                </a>
              </div>
            </div>
            <div class="col-xl-4 col-lg-5"></div>
            <div class="col-xl-3 col-lg-3" style="font-size: 18px;">
              Hi <span id="patname">%s</span>! <br> Patient ID: <span id="patid">%s</span>
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

  <div id="tabmenu">

    <button class="tab" id="red" onclick="dispm()" style="background-color:red">Medical Records</button>
    <button class="tab" id="green" onclick="dispa()">Appointments</button>
    <button class="tab" id="blue" onclick="dispp()">Doctor\'s Prescriptions</button>

  </div>

  <span id="colorbar" style="background-color:red"></span>

  <div class="sidenav">

    <span class="navHead">Reports</span>

    <div class="opts">
      Upload
      <form action="file.php" method="POST" enctype="multipart/form-data" id="upload">
        <input type="file" name="upfile" id="upfile" accept="image/*" />
        <input type="text" name="patid" value="%s" style="display:none"/>
        <input type="text" name="patfname" value="%s" style="display:none"/>
      </form>
    </div>
    <br>
    <div class="opts" id="remove">
      Remove
    </div>
    <br>
    <div class="opts" id="download">
      Print
    </div>

  </div>

  <div class="doclisthead">
    <div class="file">File name</div>
    <div class="time">Time of upload</div>
    <div class="doclistheadline"></div>
    <br>
  </div>

  <div class="doclist"></div>


  <span id="colorbar"></span>

  <div class="sidenav" style="display:none">

    <span class="navHead">Appointments</span>

    <div class="opts" onclick="booked()">
      New
    </div>
    <br>
    <div class="opts" onclick="exists()">
      Existing
    </div>
    <br>
    <div class="opts" id="delappoint">
      Cancel
    </div>

  </div>

  <div class="bookform" style="display:none">
    <form id="book" method ="POST" action="appoint.php" style="display:none">
      <div class="form-row">
        <div class="form-group col-xl-2">
          <label for="date">Date</label>
          <input class="form-control" type="date" name="apointdate" id="date" onchange="checkdate()">
        </div>
        <div class="form-group col-xl-2">
          <label for="city">City</label>
          <input class="form-control" type="text" name="city" value="%s"/>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-xl-2">
          <label for="hospital">Hospital</label>
          <select class="form-control" id="hospital" name="hospital">
          </select>
        </div>
        <div class="form-group col-xl-2">
          <label for="spec">Specialization</label>
          <select class="form-control" id="spec" name="doctype" onchange="loaddoc()">
                <option value="Allergists" selected="selected">Allergists</option>
                <option value="Anesthesiologists">Anesthesiologists</option>
                <option value="Cardiologists">Cardiologists</option>
                <option value="Colon and Rectal Surgeons">Colon and Rectal Surgeons</option>
                <option value="Critical Care Medicine Specialists">Critical Care Medicine Specialists</option>
                <option value="Dermatologists">Dermatologists</option>
                <option value="Endocrinologists">Endocrinologists</option>
                <option value="Emergency Medicine Specialists">Emergency Medicine Specialists</option>
                <option value="Gastroenterologists">Gastroenterologists</option>
                <option value="Hematologists">Hematologists</option>
                <option value="Nephrologists">Nephrologists</option>
                <option value="Neurologists">Neurologists</option>
                <option value="Obstetricians and Gynecologists">Obstetricians and Gynecologists</option>
                <option value="Ophthalmologists">Ophthalmologists</option>
                <option value="Osteopaths">Osteopaths</option>
                <option value="Osteopaths">Pathologists</option>
                <option value="Radiologists">Radiologists</option>
                <option value="Rheumatologists">Rheumatologists</option>
                <option value="Urologists">Urologists</option>          
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-xl-3">
          <label for="doctors">Doctors Available</label>
          <select class="form-control" id="doctors" onchange="changedoc()" name="availdoctor">
          <option value="">Select Below</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-xl-3">
          <label for="time">Time Slots</label>
          <select class="form-control" id="time" name="appointime">
      
          </select>
        </div>
      </div>
    <input type="text" value="%s" name="patid" style="display:none"/>
    <input type="text" value="%s" name="patfname" style="display:none"/>
      <button type="submit" name="appoint-submit" class="btn btn-outline-success" style="position:relative;left:220px;">Book</button>
    </form>
    <div id="existing" style="position:fixed;width:1510px;left:265px;">
      <div class="doclisthead">
        <div class="file">Doctor name</div>
        <div class="time">Time of appointment</div>
        <div class="doclistheadline"></div>
        <br>
      </div>
    </div>
  </div>

   <img src="appointment.jpg" id="bookimg" style="display:none">

    <div class="container" id="prescript" style="display:none">
        <div class="row" style="position: relative;top: 70px;">
        </div>
    </div>



  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <script>
  window.onload=function(){
    var xtp=new XMLHttpRequest()
    xtp.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
        var msg=this.responseText;
        msg=msg.split(";")
        for(let i=0;i<msg.length-1;i++){
            let info=msg[i].split(" ")
            var filename=info[0]+" "+info[1] 
            var time=info[3]+":00\xa0\xa0\xa0"+info[2]
            var newelement = document.createElement("div");
            newelement.className = "docbox";
            newelement.id = filename;
            newelement.addEventListener("click",downloadClick);
            newelement.innerHTML = String.raw`
            <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" name="radap" value="` + filename + `" id="` + filename + `rad" onclick="event.stopPropagation()">
            <label class="custom-control-label" for="` + filename + `rad" style="color:black;font-size:22px;" onclick="event.stopPropagation()">` + filename + `</label>
            </div>
            <b>Status: `+info[4]+`</b>
            <span style="position:absolute;font-size:20px;top:7px;right:20px;">` + time + `</span>`;
            document.getElementById("existing").appendChild(newelement);
        }
    }
  }
  xtp.open("POST","bookedinfo.php",true);
  xtp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xtp.send("patid="+document.getElementById("patid").innerHTML)
  }
    function dispm(){
      document.getElementsByClassName("doclist")[0].style.display="block";
      document.getElementById("prescript").style.display="none";
      document.getElementsByClassName("bookform")[0].style.display="none";
      document.getElementsByClassName("sidenav")[0].style.display="block";
      document.getElementsByClassName("navHead")[0].style.display="block";
      document.getElementsByClassName("sidenav")[1].style.display="none";
      document.getElementsByClassName("navHead")[1].style.display="none";
      document.getElementById("bookimg").style.display="none";
      document.getElementById("red").style.backgroundColor = "red";
      document.getElementById("colorbar").style.backgroundColor = "red";
      document.getElementById("green").style.backgroundColor = "#555";
      document.getElementById("blue").style.backgroundColor = "#555"; 
      document.getElementsByClassName("doclisthead")[0].style.display="block"
      for(let i=0;i<rarry.length;i++){
        document.getElementsByClassName("row")[0].removeChild(rarry[i])
      }
      rarry=[]
    }
    function dispa(){
      document.getElementsByClassName("doclist")[0].style.display="none";
      document.getElementById("prescript").style.display="none";
      document.getElementsByClassName("sidenav")[0].style.display="none";
      document.getElementsByClassName("navHead")[0].style.display="none";
      document.getElementsByClassName("sidenav")[1].style.display="block";
      document.getElementsByClassName("navHead")[1].style.display="block";
      document.getElementById("bookimg").style.display="block"
      if(!(document.getElementById("existing").style.display=="none"))
      document.getElementById("bookimg").style.display="none"
      else
      document.getElementById("bookimg").style.display="block"
      document.getElementById("green").style.backgroundColor = "green";
      document.getElementById("colorbar").style.backgroundColor = "green";
      document.getElementById("red").style.backgroundColor = "#555";
      document.getElementById("blue").style.backgroundColor = "#555";
      document.getElementsByClassName("bookform")[0].style.display="block";
      document.getElementsByClassName("doclisthead")[0].style.display="none"
      for(let i=0;i<rarry.length;i++){
        document.getElementsByClassName("row")[0].removeChild(rarry[i])
      }
      rarry=[]
    }

    function dispp(){
      document.getElementsByClassName("doclisthead")[0].style.display="none";
      document.getElementsByClassName("doclist")[0].style.display="none";
      document.getElementById("red").style.backgroundColor = "#555";
      document.getElementById("green").style.backgroundColor = "#555";
      document.getElementById("bookimg").style.display="none"
      document.getElementsByClassName("bookform")[0].style.display="none";
      document.getElementsByClassName("sidenav")[0].style.display="none";
      document.getElementsByClassName("sidenav")[1].style.display="none";
      document.getElementById("blue").style.backgroundColor = "blue";
      document.getElementById("colorbar").style.backgroundColor = "blue";
      document.getElementById("prescript").style.display="block";
      var lfiles;
      function lfunc(){
      var lxtpd=new XMLHttpRequest();
      lxtpd.onreadystatechange=function(){
      if(this.readyState==4 && this.status==200){
      lfiles=this.responseText
      lfiles=lfiles.split("\n")
      }
      }
    lxtpd.open("POST","prescript.php",true);
    lxtpd.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    lxtpd.send("patientid="+document.getElementById("patid").innerHTML);
    }  
    lfunc()
    setTimeout(function(){
      for(let i=0;i<lfiles.length-1;i++)
      displayrecords(lfiles[i],i)
      },100)
  }
  var imgsrc,rarry=[],mainid;
  function displayrecords(a,val){
      a=a.split(" ")
      val=val
      var rootpath="../prescriptions/"+a[0]+"/"+a[4]
      var newelement=document.createElement("div")
      newelement.className="col-xl-4 col-md-6 col-lg-4"
      newelement.addEventListener("mouseover",function(){imgsrc=rootpath;mainid=val})
      newelement.innerHTML = String.raw`
            <div class="single_department1">
                <div class="department_thumb" style="margin-top:80px;padding-top:5px;">
                    <button class="btn btn-info" onclick="downfile()"><a href="" class="myclass" download>Download</a></button>
                    <div id="dp"><b>`+"File Name: "+`</b>`+a[4]+`</div>
                    <div id="dp"><b>`+"Time Of Upload: "+`</b>`+a[5]+`</div>
                    <div id="dp"><b>`+"Date Of Upload: "+`</b>`+a[3]+`</div>
                    <div id="dp>`+"File: "+`</div>
                </div>
            </div>`;
      rarry.push(newelement)
      document.getElementsByClassName("row")[0].appendChild(newelement);
  }
function downfile(){
  document.getElementsByClassName("myclass")[Number(mainid)].href=imgsrc;
}

    function booked(){
      document.getElementById("existing").style.display="none"
      document.getElementById("book").style.display="block"
      document.getElementById("bookimg").style.display="block"
    }
    function exists() {
    document.getElementById("bookimg").style.display="none"
    document.getElementById("book").style.display="none"
    document.getElementById("existing").style.display="block"
  }
document.getElementById("delappoint").addEventListener("click", removeappointment);

function removeappointment(){
  {
    var isChecked =  $("input:radio").is(":checked");
    if(!isChecked)
      alert("First select the Appointment To Cancel");
    else
    {
      var con = confirm("Are you sure that you want Cancel Your Appointment?");
    if(con)
    {
      var radios = document.getElementsByName("radap");
      var doclist = document.getElementById("existing");
      for (var i = 0; i < radios.length; i++) 
        {
        var radio = radios[i];
        var remElm = radio.parentNode.parentNode;
        if (radio.checked)
        { 
          var filename = radio.value;
          document.cookie="appointment="+filename
          doclist.removeChild(remElm);
        }
      }
    }
  }
}
}
    var files="%s"
    files=files.split(";")
    function displayFiles(infostr) {
    infostr=infostr.split(" ");
    var time=infostr[0]+"\xa0\xa0\xa0"+infostr[1];
    var filename=infostr[2];
    var newelement = document.createElement("div");
    newelement.className = "docbox";
    newelement.id = filename;
    newelement.addEventListener("click",downloadClick);
    newelement.innerHTML = String.raw`
    <div class="custom-control custom-radio">
    <img src="../records/%s/`+filename+`" style="width:50px;height:50px;background-size:cover" alt="`+filename+`"/>
    <input type="radio" class="custom-control-input" name="rad" value="` + filename + `" id="` + filename + `rad" onclick="event.stopPropagation()">
    <label class="custom-control-label" for="` + filename + `rad" style="color:black;font-size:22px;" onclick="event.stopPropagation()">` + filename + `</label>
    </div>
    <span style="position:absolute;font-size:20px;top:7px;right:20px;">` + time + `</span>`;
    document.getElementsByClassName("doclist")[0].appendChild(newelement);
  }
  for(let i=0;i<files.length;i++){
    if(files[0].length!==0)
    displayFiles(files[i]);
  }

  document.getElementById("remove").addEventListener("click", removeDoc);
  function removeDoc() 
  {
    var isChecked =  $("input:radio").is(":checked");
    if(!isChecked)
      alert("First select the document to remove");
    else
    {
      var con = confirm("Are you sure that you want to remove the selected file?");
    if(con)
    {
      var radios = document.getElementsByName("rad");
      var doclist = document.getElementsByClassName("doclist")[0];
      for (var i = 0; i < radios.length; i++) 
        {
        var radio = radios[i];
        var remElm = radio.parentNode.parentNode;
        if (radio.checked)
        { 

          var filename = radio.value;
          document.cookie="file="+filename
          doclist.removeChild(remElm);
        }
      }
    }
  }
}
document.getElementById("download").addEventListener("click",downloadSelect);
function downloadSelect (event) {
  var isChecked =  $("input:radio").is(":checked");
  if(!isChecked)
    alert("First select the document to Print");
  else
  {
    var radios = document.getElementsByName("rad");
    for (var i = 0; i < radios.length; i++) 
    {
      var radio = radios[i];
      if (radio.checked)
      { 
        var filename = radio.value;
        document.getElementById("filname").value=filename;
        document.forms["myform"].submit();
      }
    }
  }
}
function downloadClick (event) {
 var filename = this.id; 
}
var input = document.getElementById("upfile");
input.addEventListener("change", uploadFile);
function uploadFile(event) {
 var filename = input.files[0].name;
 var d = new Date();
 var hours = d.getHours();
 var min =  d.getMinutes();
 var date = d.getDate();
 var month = d.getMonth()+1;
 var year = d.getFullYear();

 if(filename!="")
 {   
   var time = hours.toString() + ":" + min.toString() + "\xa0\xa0\xa0" + date.toString() + "/" + month.toString() + "/" + year.toString();
   var newelement = document.createElement("div");
   newelement.className = "docbox";
   newelement.id = filename;
   newelement.addEventListener("click",downloadClick);
   newelement.innerHTML = String.raw`
     <div class="custom-control custom-radio">
     <input type="radio" class="custom-control-input" name="rad" value="` + filename + `" id="` + filename + `rad" onclick="event.stopPropagation()">
     <label class="custom-control-label" for="` + filename + `rad" style="color:black;font-size:22px;" onclick="event.stopPropagation()">` + filename + `</label>
     </div>
     <span style="position:absolute;font-size:20px;top:7px;right:20px;">` + time + `</span>`;

   document.getElementsByClassName("doclist")[0].appendChild(newelement);
   document.getElementById("upload").submit();
 }
}
</script>
<form action="download.php" method="POST" name="myform">
<input type="text" value="" name="filename" id="filname" style="display:none"/>
<input type="text" value="%s" name="patid" style="display:none"/>
<input type="text" value="%s" name="patfname" style="display:none"/>
<input name="down-submit" style="display:none"/>
</form>
',$_POST['patfname'],$_POST['patid'],$_POST['patid'],$_POST['patfname'],$city,$_POST['patid'],$_POST['patfname'],$filearray,$_POST['patid'],$_POST['patid'],$_POST['patfname']);
echo "<script>
var timecount=0,count=0
function checkdate(){
  for(let i=0;i<timecount;i++){
  let temp=document.getElementById('time'+i);
  if(temp)
  temp.outerHTML='';}
  var dat=document.getElementById('date').value
  dat=new Date(dat)
  var cdat=new Date()
  cdat=cdat.getFullYear()+'-'+(cdat.getMonth()+1)+'-'+cdat.getDate();
  cdat=new Date(cdat)
  if(dat.getDay()==0){
    alert('Doctor Unavailable On Sunday')
    for(let i=0;i<count;i++){
      if(document.getElementById('id'+i))
      document.getElementById('id'+i).outerHTML='';
      }    
  }
  else if(dat>=cdat && dat.getDay()!==0){
  var xtpd=new XMLHttpRequest();
  xtpd.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      var datetxt=this.responseText;
      datetxt=datetxt.split(' ')
      for(let i= 0;i<datetxt.length-1;i++){
        timecount++;
        var opt=document.createElement('option');
        opt.value=datetxt[i];opt.id='time'+i;
        var ntime=Number(datetxt[i])+1;
        opt.appendChild(document.createTextNode(datetxt[i]+':00'+'-'+ntime+':00'));
        document.getElementById('time').appendChild(opt)  
    }
    }
    }
  xtpd.open('POST','availabledates.php',true);
  xtpd.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  var dname=document.getElementById('doctors').value
  xtpd.send('date='+document.getElementById('date').value+'&doc='+dname);
  if(document.getElementById('spec').value!=''){
    var nxtp=new XMLHttpRequest()
    nxtp.onreadystatechange=function(){
      if(this.readyState==4 && this.status==200){
        for(let i=0;i<count;i++){
          if(document.getElementById('id'+i))
          document.getElementById('id'+i).outerHTML='';
        }  
        var msg=this.responseText
        msg=msg.split(';')
        for(let i=0;i<msg.length-1;i++){
          var opt=document.createElement('option');
          opt.value=msg[i];opt.id='id'+i;
          count++;
          opt.appendChild(document.createTextNode(msg[i]));
          document.getElementById('doctors').appendChild(opt)
        }
      }
    }
  nxtp.open('POST','availabledoctors.php',true);
  nxtp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  var val=document.getElementById('spec').value;
  nxtp.send('doctype='+val);
  }

  }
  else{
    for(let i=0;i<count;i++){
      if(document.getElementById('id'+i))
      document.getElementById('id'+i).outerHTML='';
      }
  }
  setTimeout(loadhosp,100)
}

function loaddoc(){
  var dat=document.getElementById('date').value
  if(dat=='')
    alert('Please Select A Date')
  else{
  dat=new Date(dat)
  if(dat.getDay()!==0){
  var xtp=new XMLHttpRequest();
  xtp.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      var msg=this.responseText;
        for(let i=0;i<count;i++){
          if(document.getElementById('id'+i))
          document.getElementById('id'+i).outerHTML='';
        }
      msg=msg.split(';')
      for(let i=0;i<msg.length-1;i++){    
      var opt=document.createElement('option');
      opt.value=msg[i];opt.id='id'+i;
      count++;
      opt.appendChild(document.createTextNode(msg[i]));
      document.getElementById('doctors').appendChild(opt)
    }
    }
  };
  xtp.open('POST','availabledoctors.php',true);
  xtp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  var val=document.getElementById('spec').value;
  xtp.send('doctype='+val);
  changedoc()
}
}
}
function changedoc(){
    for(let i=0;i<timecount;i++){
    if(document.getElementById('time'+i))
    document.getElementById('time'+i).outerHTML='';
    }
    var xtpd=new XMLHttpRequest();
    xtpd.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      var msg=this.responseText;
      msg=msg.split(' ')
      timecount=0
      for(let i=0;i<msg.length-1;i++){
        timecount++;
        var opt=document.createElement('option');
        opt.value=msg[i];opt.id='time'+i;
        var ntime=Number(msg[i])+1;
        opt.appendChild(document.createTextNode(msg[i]+':00'+'-'+ntime+':00'));
        document.getElementById('time').appendChild(opt)  
      }
    }
  }
  xtpd.open('POST','availabledates.php',true);
  xtpd.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  var dname=document.getElementById('doctors').value
  xtpd.send('date='+document.getElementById('date').value+'&doc='+dname);
  setTimeout(loadhosp,100)
  }
  var hospcount=0
  function loadhosp(){
    for(let i=0;i<hospcount;i++){
      if(document.getElementById('hosp'+i)){
        document.getElementById('hosp'+i).outerHTML=''
      }
    }
    var xtd=new XMLHttpRequest();
    xtd.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      var msg=this.responseText
      msg=msg.split(',')
      for(let i=0;i<msg.length;i++){
        hospcount++
        var opt=document.createElement('option');
        opt.value=msg[i];opt.id='hosp'+i;
        opt.appendChild(document.createTextNode(msg[i]));
        document.getElementById('hospital').appendChild(opt)  
      }
    }
    }
    xtd.open('POST','availablehospital.php',true);
    xtd.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    var dname=document.getElementById('doctors').value
    xtd.send('doc='+dname);
  }
</script></body></html>";
}
else
  header("Location:../login.pat.php");
?>