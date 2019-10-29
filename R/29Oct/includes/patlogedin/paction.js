//Patient name and ID
// document.getElementById("patname").textContent = "PatientName";
// document.getElementById("patid").textContent = "PAT789";

var url = window.location.pathname;
var filename = url.substring(url.lastIndexOf('/') + 1);
if (filename == "ptab1.html") {
	var r = document.getElementById("red");
	r.style.backgroundColor = "red";
	var cb = document.getElementById("colorbar");
	cb.style.backgroundColor = "red"; 
}
else if (filename == "ptab2.html") {
	var g = document.getElementById("green");
	g.style.backgroundColor = "green";
	var cb = document.getElementById("colorbar");
	cb.style.backgroundColor = "green";
}
else if (filename == "ptab3.html") {
	var b = document.getElementById("blue");
	b.style.backgroundColor = "blue";
	var cb = document.getElementById("colorbar");
	cb.style.backgroundColor = "blue";
}

function displayFiles() {
	//put this in a for loop. This is to display all the files present in the database at the beginning. Required variables - time of
	//upload - hour, min, date, month, year, filename.
	var time = hours.toString() + ":" + min.toString() + "\xa0\xa0\xa0" + date.toString() + "/" + month.toString() + "/" + year.toString();
	var newelement = document.createElement("div");
	newelement.className = "docbox";
	newelement.id = filename;
	newelement.addEventListener('click',downloadClick);
	newelement.innerHTML = String.raw`
		<div class="custom-control custom-radio">
		<input type="radio" class="custom-control-input" name="rad" value="` + filename + `" id="` + filename + `rad" onclick="event.stopPropagation()">
		<label class="custom-control-label" for="` + filename + `rad" style="color:black;font-size:22px;" onclick="event.stopPropagation()">` + filename + `</label>
		</div>
		<span style="position:absolute;font-size:20px;top:7px;right:20px;">` + time + `</span>`;

	document.getElementsByClassName("doclist")[0].appendChild(newelement);
}
//displayFiles();

var input = document.getElementById('fileupload');
input.addEventListener('change', uploadFile);
function uploadFile(event) {
	// store the variables listed below in the database along with the file
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
		newelement.addEventListener('click',downloadClick);
		newelement.innerHTML = String.raw`
			<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" name="rad" value="` + filename + `" id="` + filename + `rad" onclick="event.stopPropagation()">
			<label class="custom-control-label" for="` + filename + `rad" style="color:black;font-size:22px;" onclick="event.stopPropagation()">` + filename + `</label>
			</div>
			<span style="position:absolute;font-size:20px;top:7px;right:20px;">` + time + `</span>`;

		document.getElementsByClassName("doclist")[0].appendChild(newelement);
		//submitting the file
		//document.getElementById("upload").submit();
	}
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
					//remove the following file from the database
					var filename = radio.value;
					doclist.removeChild(remElm);
				}
			}
		}
	}
}

document.getElementById("download").addEventListener('click',downloadSelect);
function downloadClick (event) {
	//download the following file from the database
	var filename = this.id;
}
function downloadSelect (event) {
	var isChecked =  $('input:radio').is(':checked');
	if(!isChecked)
		alert("First select the document to download");
	else
	{
		var radios = document.getElementsByName('rad');
		for (var i = 0; i < radios.length; i++) 
		{
			var radio = radios[i];
			if (radio.checked)
			{	
				//download the following file from the database
				var filename = radio.value;
			}
		}
	}
}