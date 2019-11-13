<?php
if(isset($_POST["down-submit"])){
	echo sprintf("
		<head><link rel='stylesheet' href='css/bootstrap.min.css'></head>
		<body>
		<img src='../records/%s/%s' style='width:%s;height:%s'/>
		<div id='data' style='display:flex'>
		<button class='btn btn-primary' onclick='printer()' style='position:relative;padding:18px 300px 18px 300px'><strong>PRINT</strong></button>
		<button class='btn btn-danger' onclick='goback()' style='position:relative;left:20px;padding:18px 270px 18px 270px'><strong>CANCEL / GO BACK</strong></button>
		</div>
		<form method='POST' action='ntab.php' id='form1'>
        <input type='text' value=%s style='display:none' name='patid'/>
        <input type='text' value=%s style='display:none' name='patfname' />
        <input name='sign-in' style='display:none'/>
        </form>
        <script>
        function printer(){
        	document.getElementById('data').style.display='none';
        	window.print()
        	document.getElementById('data').style.display='block';
        }
        function goback(){
        	document.forms['form1'].submit()
        }
        </script>
		</body>
		",$_POST['patid'],$_POST['filename'],"100%","90%",$_POST['patid'],$_POST['patfname']);

}
else{
	echo "<script>alert('Sorry There Was An Error Displaying Your File')</script>";
}

?>