function ajaxFunction(){
	var ajaxRequest;

	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				//browsers all not support, rare case
				alert("Your browser broke!");
				return false;
			}
		}

	}
	return ajaxRequest;
}

function showData() {
	htmlRequest = ajaxFunction();
	if (htmlRequest==null){ // If it cannot create a new Xmlhttp object.
		alert ("Browser does not support HTTP Request");
		return;
	} 

	htmlRequest.onreadystatechange = function(){
		if(htmlRequest.readyState == 4){
	//		alert(htmlRequest.responseText);
			
		document.getElementById("show_attendance").innerHTML =  htmlRequest.responseText;
		}
	}
	htmlRequest.open("GET", "showattendance.php", true);
	htmlRequest.send(null);
}


// this will be to save wot ever u click on ...
function saveData(attend, userid, pracid){
	htmlRequest = ajaxFunction();
	if (htmlRequest==null){ // If it cannot create a new Xmlhttp object.
		alert ("Browser does not support HTTP Request");
		return;
	} 
	
	var url = 'attendance.php?attend=' + attend + '&UserID=' + userid + '&PracID=' + pracid;

	htmlRequest.open('GET', url, true);
	htmlRequest.send(null); 
	
	var table_id = userid + '_' + pracid;
	
if (attend == "No") {
var bgcolor = "#EC4A4A";
} else if (attend == "Yes") {
var bgcolor = "#88BCF0";
} else if (attend == "Apology") {
var bgcolor = "#CCCCCC";
} else {
var bgcolor = '';
}

var table = document.getElementById(table_id);

if (attend == "Delete") {
table.style.backgroundColor = '';
table.innerHTML = '<a onclick="saveData(\'Yes\', \''+userid+'\', \''+pracid+'\');" ><img src="y.png" border="0" title="Yes" /></a> <a onclick="saveData(\'No\', \''+userid+'\', \''+pracid+'\');" ><img src="n.png" border="0" title="No" /></a> <a onclick="saveData(\'Apology\', \''+userid+'\', \''+pracid+'\');" ><img src="a.gif" border="0" title="Apology" /></a>';
} else {


/*
else {
table.style.backgroundColor = bgcolor;
table.innerHTML = ' ';
table.onclick = saveData('Delete', userid, pracid);
}
*/

table.style.backgroundColor = bgcolor;
table.innerHTML = ' ';
}

} 

showData();