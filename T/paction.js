var url = window.location.pathname;
var filename = url.substring(url.lastIndexOf('/') + 1);
if (filename == "ptab1.html") {
	var r = document.getElementById("red");
	r.style.backgroundColor = "red";
}
else if (filename == "ptab2.html") {
	var g = document.getElementById("green");
	g.style.backgroundColor = "green";
}
else if (filename == "ptab3.html") {
	var b = document.getElementById("blue");
	b.style.backgroundColor = "blue";
	}


var element = document.getElementById('remove');
element.addEventListener('click', remdoc);

function remdoc() {
	var con = confirm("Are you sure that you want to remove this file?");
	if(con)
	{
		var c = 0;
		var docs = document.getElementsByName('rad');
		var doclist = document.getElementsByClassName("doclist")[0];
		for (var i = 0; i < docs.length; i++) {
			var box = docs[i];
			var remElm1 = docs[i].parentNode;
			var remElm2 = docs[i].parentNode.nextSibling;
			if (box.checked) {
				doclist.removeChild(remElm1);
				doclist.removeChild(remElm2);
				c += 1;
			}
		}
		if (c == 0)
			alert("First select the documents to remove");
	}
}

var input = document.getElementById('fileupload');
input.addEventListener('change', showFileName);
function showFileName(event) {
	var filename = input.value.substring(input.value.lastIndexOf('\\') + 1);
	if(filename!="")
	{
		var d = new Date();
		var date = d.getDate().toString() + "/" + (d.getMonth()+1).toString() + "/" + d.getFullYear().toString();
		var newelement = document.createElement("div");
		newelement.className = "docbox";
		newelement.style="position:relative;";
		newelement.innerHTML = "<input type=\"radio\" name=\"rad\" style=\"width:20px;height:20px;\">  " + filename.fontsize(5) + "<span style=\"position:absolute;font-size:20px;top:7px;right:20px;\">" + date + "</span>";
		document.getElementsByClassName("doclist")[0].appendChild(newelement);
		var brk = document.createElement("div");
		brk.innerHTML = "<br>";
		document.getElementsByClassName("doclist")[0].appendChild(brk);
	}
}