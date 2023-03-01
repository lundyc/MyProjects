<?php
error_reporting(0);
include_once("_mysqli.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Subway Irvine</title>

<style>
a {
    text-decoration: none;
	color: #000;
}

html, body { 
	font-family: Arial,Helvetica Neue,Helvetica,sans-serif; 
	padding-right: 1px;
}

#content, #menu {
	width: 100%;
	padding: 0;
	margin: 0;
	border-spacing: 0px;
    border-collapse: separate;
	border: 1px solid #000;
}

#content th, td { 
	padding: 0 15px 0 15px;
	text-align: left;
	border-bottom: 1px solid #000000;
}

#content tr:hover, #content tr:nth-child(odd):hover {
	background-color: #D9DCD6;
}

#content tr:nth-child(odd) {
	background-color: #f2f2f2
}

#content th {
    height: 40px;
	background-color: #3A7CA5;
	color: #FFF;
	font-weight: bold;
	text-align: center;
}

#content td, #menu td {
	height: 25px;
	vertical-align: center;
}

.center { 
	text-align: center;
}
</style>
</head>
	
<body>
<table id="menu">
<tr>
<td class="center"><a href="./?page=view_wisr">View WISR</a></td>
<td class="center"><a href="./?page=sales_and_cog">Sales and COG</a></td>
<td class="center"><a href="./?page=avg_usage">AVG Usage</a></td>
<td class="center"><a href="./?page=build_to">Build To</a></td>
<td class="center"><a href="./?page=order_sheet">Order Sheet</a></td>
</tr>
</table>

<?php 
$page = (empty($_GET['page'])) ? 'avg_usage' : $_GET['page'];
$invalide = array('/','/\/',':','.');
$page = str_replace($invalide,' ',$page);
	  
$file = $page . ".php";  

if (!file_exists($file)) 
$page = "avg_usage.php";

include_once($file);
?> 
</body>

</html>