<?php
if (level($_SESSION['uid']) >= 4) {
?>

<script type="text/javascript" src="scripts/attendance.js"></script>

<script language="javascript">
function toggleLayer( whichLayer )
{  
var elem, vis;  if( document.getElementById ) 
elem = document.getElementById( whichLayer );  
else if( document.all ) 
elem = document.all[whichLayer];  
else if( document.layers ) 
elem = document.layers[whichLayer]; 
vis = elem.style;  

if(vis.display==''&&elem.offsetWidth!=undefined&&elem.offsetHeight!=undefined)    vis.display = (elem.offsetWidth!=0&&elem.offsetHeight!=0)?'block':'none';  
vis.display = (vis.display==''||vis.display=='block')?'none':'block';
}
</script>

<div class='help-box' style="display:" id="fo_content_mem_">
 <img src='images/tabs_main/icon_help.png' alt='help' />
  <h2>
  	<div>Manage Members Attendance </div>
  </h2>

WHERE YOU THERE? !!!<br />
well where you ?? 
<br />
<br />
hmmmmmmmmmm I dont think you where !!!
</div>
<br >



<div class='tableheaderalt'>Attendance Overview</div>

<div id="show_attendance"></div>
<?php
} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
?>