<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>

<style type="text/css">
.today {
font-family:Geneva,Helvetica,Arial,sans-serif;
font-size:8pt;
vertical-align:top;
background-color:#FFCC00;
color:#000000;
}
.todaynotcounted {
font-family:Geneva,Helvetica,Arial,sans-serif;
font-size:8pt;
vertical-align:top;
background-color:#DFBC00;
color:#000000;
}
.sunday {
font-family:Geneva,Helvetica,Arial,sans-serif;
font-size:8pt;
vertical-align:top;
background-color:#ffe0e0;
color:#000000;
}
.saturday {
font-family:Geneva,Helvetica,Arial,sans-serif;
font-size:8pt;
vertical-align:top;
background-color:#ffe0e0;
color:#000000;
}
.holiday {
font-family:Geneva,Helvetica,Arial,sans-serif;
font-size:8pt;
vertical-align:top;
background-color:#EBCCCC;
color:#000000;
}
.event {
font-family:Geneva,Helvetica,Arial,sans-serif;
font-size:8pt;
vertical-align:top;
background-color:#FFCC00;
color:0000000;
}
.eventnotcounted {
font-family:Geneva,Helvetica,Arial,sans-serif;
font-size:8pt;
vertical-align:top;
background-color:#F2A000;
color:#000000;
}
.weekday {
font-family:Geneva,Helvetica,Arial,sans-serif;
font-size:8pt;
vertical-align:top;
background-color: #D5EAFF;
color:#000000;
}
.weekdaynotcounted {
font-family:Geneva,Helvetica,Arial,sans-serif;
font-size:8pt;
vertical-align:top;
background-color:#D0E0EA;
color:#000000;
}
.vacation {
font-family:Geneva,Helvetica,Arial,sans-serif;
font-size:8pt;
vertical-align:top;
background-color:#becde8;
}
.meeting {
font-family:Geneva,Helvetica,Arial,sans-serif;
font-size:8pt;
vertical-align:top;
background-color:#ffb7b7;
}
.public {
font-family:Geneva,Helvetica,Arial,sans-serif;
font-size:8pt;
vertical-align:top;
background-color:#FFCC00;
}
.private {
font-family:Geneva,Helvetica,Arial,sans-serif;
font-size:8pt;
vertical-align:top;
background-color:#cdcdcd;
}

#links {
text-align: center;
padding: 5px;
background-image:url("themes/spbfb/images/aboutbkgd.png");
text-decoration:none;
}

#links a {
	text-decoration: none;
}

#links span {
padding-right: 10px;
padding-left: 10px;
border-right: 2px solid #656766;
}
</style>

<body onLoad="MM_preloadImages('images/misc/control_rewind_blue.png','images/misc/control_fastforward_blue.png')">

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2 style="margin-bottom: 0;">Upcoming Events</h2>

<!--start Overview-->

<?php
define('ADAY', (60*60*24)); 
$datearray = getdate();

$year = (empty($_GET['year'])) ? $datearray['year'] : addslashes($_GET['year']);
$month = (empty($_GET['month'])) ? $datearray['mon'] : addslashes($_GET['month']);

$start = mktime(0,0,0,$month,1,$year);
$firstdayarray = getdate($start);
$days_in_month = date("t", $start);

$months = array('', 'January','February','March','April','May','June', 'July','August','September','October','November','December');
$days = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

$month_name = $months[$month];
$todays_date = date("j");
$todays_month = date("n");
$todays_year = date("Y");

if($month == 12){
    $next_month = 1;
    $next_year = $year+1;
} else {
    $next_month = $month+1;
    $next_year = $year;
}

if($month == 1){
    $prev_month = 12;
    $prev_year = $year-1;
} else {
    $prev_month = $month-1;
    $prev_year = $year;
}

?>
<div id="links">
<a href="./?view=events&month=<?php echo $prev_month; ?>&year=<?php echo $prev_year; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('prev1','','images/misc/control_rewind_blue.png',1)" title="Previous Month"><img src="images/misc/control_rewind.png" name="prev1" width="16" height="16" border="0" id="prev1" /> Previous Month </a> -

<a href="./?view=events&month=<?php echo $next_month; ?>&year=<?php echo $next_year; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('next1','','images/misc/control_fastforward_blue.png',1)" title="Next Month"><img src="images/misc/control_fastforward.png" name="next1" width="16" height="16" border="0" id="next1" /> Next Month </a> -

<a href="./?view=events"><img src="images/misc/house.png" border="0"> Back to Today</a></div>

<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td width="33%" valign="top">
<table border="0" cellspacing="2" cellpadding="1" width="100%">
<tr>
<th colspan="3" class="contenthead">
<?php echo $month_name. " " .$year; ?>
</th>
</tr>
<?php


for($count=0;$count<$days_in_month; $count++) {
$dayarray = getdate($start);

if (($dayarray[mday] == $todays_date) && ($month == $todays_month) && ($year == $todays_year)) {
$class = "today"; 
} else { 

if ($dayarray['weekday'] == "Saturday") {
$class = "saturday";
}elseif ($dayarray['weekday'] == "Sunday") {
$class = "sunday";
} else {
$class = "weekday";
}

}

?>
<tr>
<td class="<?php echo $class; ?>">
<?php echo $dayarray[mday]; ?></td>
 <td class="<?php echo $class; ?>"><?php echo $dayarray['weekday']; ?></td>
<td align="left" width="210" class="<?php echo $class; ?>">
<?php
$day = $dayarray['mday'];
$event_starttime = mktime(0,0,1,$month, $dayarray[mday],$year);
$event_endtime = mktime(23,59,59,$month, $dayarray[mday],$year);
//echo $event_starttime;

$query = mysql_query("select `title`, `id` from `events` where status = '0' AND start_time > '".$event_starttime."' AND start_time < '".$event_endtime."'");
$rows = mysql_num_rows($query);

if ($rows > 0) {
?>

<table border="0" cellspacing="0" cellpadding="2" width="100%">
<?php
while ($r = mysql_fetch_array($query)) {
?>
<tr>
<td class="private">
o <a href="./?view=events&action=details&EventID=<?php echo $r['id']; ?>" title="">
<?php 
if (strlen($r['title']) > 22) { 
echo substr_replace($r['title'], '..', 22); 
} else {
echo $r['title']; 
}
?>
</a>
</td>
</tr>
<?php
}
?>
</table>

<?php
}
?>

</td>
</tr>
<?php
$start += ADAY;
}

if ($month == 12) {
$month = 1;
$year++;
} else {
$month = $month+1;
}

$month_name = $months[$month];

$start2 = mktime(0,0,0,$month,1,$year);
$firstdayarray2 = getdate($start2);
$days_in_month2 = date("t", $start2);
?>

</table>
</td>
<td width="33%" valign="top">
<table border="0" cellspacing="2" cellpadding="1" width="100%">
<tr>
<th colspan="3" class="contenthead">
<?php echo $month_name . " " .$year; ?>
</th>
</tr>
<?php
$second_month = $month+1;

for($count=0;$count<$days_in_month2; $count++) {
$dayarray = getdate($start2);

if (($dayarray[mday] == $todays_date) && ($month == $todays_month) && ($year == $todays_year)) {
$class = "today"; 
} else { 

if ($dayarray['weekday'] == "Saturday") {
$class = "saturday";
}elseif ($dayarray['weekday'] == "Sunday") {
$class = "sunday";
} else {
$class = "weekday";
}

}

?>
<tr>
<td class="<?php echo $class; ?>">
<?php echo $dayarray[mday]; ?></td>
 <td class="<?php echo $class; ?>"><?php echo $dayarray['weekday']; ?></td>
<td align="left" width="210" class="<?php echo $class; ?>">
<?php
$event_starttime = mktime(0,0,1,$month, $dayarray[mday],$year);
$event_endtime = mktime(23,59,59,$month, $dayarray[mday],$year);

$query2 = mysql_query("select `title`, `id` from `events` where status = '0' AND start_time > '".$event_starttime."' AND start_time < '".$event_endtime."'");
$rows = mysql_num_rows($query2);

if ($rows > 0) {
?>

<table border="0" cellspacing="0" cellpadding="2" width="100%">
<?php
while ($r2 = mysql_fetch_array($query2)) {
?>
<tr>
<td class="private">
o <a href="./?view=events&action=details&EventID=<?php echo $r2['id']; ?>" title="">
<?php 
if (strlen($r2['title']) > 22) { 
echo substr_replace($r2['title'], '...', 22); 
} else {
echo $r2['title']; 
}
?>
</a>
</td>
</tr>
<?php
}
?>
</table>

<?php
}
?>

</td>
</tr>
<?php
$start2 += ADAY;
}

if ($month == 12) {
$month = 1;
$year++;
} else {
$month = $month+1;
}

$month_name = $months[$month];

$start3 = mktime(0,0,0,$month,1,$year);
$firstdayarray3 = getdate($start3);
$days_in_month3 = date("t", $start3);
?>

</table>
</td>

<noscript>
<td width="33%" valign="top">

<table border="0" cellspacing="2" cellpadding="1" width="100%">
<tr>
<th colspan="3" class="contenthead">
<?php echo $month_name. " " .$year; ?>
</th>
</tr>
<?php
$third_month = $month+2;

for($count=0;$count<$days_in_month3; $count++) {
$dayarray = getdate($start2);

if (($dayarray[mday] == $todays_date) && ($month == $todays_month) && ($year == $todays_year)) {
$class = "today"; 
} else { 

if ($dayarray['weekday'] == "Saturday") {
$class = "saturday";
}elseif ($dayarray['weekday'] == "Sunday") {
$class = "sunday";
} else {
$class = "weekday";
}

}

?>
<tr>
<td class="<?php echo $class; ?>">
<?php echo $dayarray[mday]; ?></td>
 <td class="<?php echo $class; ?>"><?php echo $dayarray['weekday']; ?></td>
<td align="left" width="210" class="<?php echo $class; ?>">
<?php

$query3 = mysql_query("SELECT * FROM `events` WHERE `start_time` ='".$event_starttime."'AND status='0'");
$rows = mysql_num_rows($query3);

if ($rows > 0) {
?>

<table border="0" cellspacing="0" cellpadding="2" width="100%">
<?php
while ($r3 = mysql_fetch_array($query3)) {
?>
<tr>
<td class="public">
o <a href="./?view=events&action=details&EventID=<?php echo $r3['id']; ?>" title="">
<?php 
if (strlen($r3['title']) > 22) { 
echo substr_replace($r3['title'], '...', 22); 
} else {
echo $r3['title']; 
}
?>
</a>
</td>
</tr>
<?php
}
?>
</table>

<?php
}
?>

</td>
</tr>
<?php
$start2 += ADAY;
}
?>

</table>
</td>
</noscript>


</tr>
</table>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>