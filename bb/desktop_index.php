<?php
/*
Layout for Normal Desktop's ect
*/
?>
<!doctype html><html lang="en">
<head>
<meta charset="utf-8">

<title>North Ayrshire Boys Brigade</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=4">
<meta name="description" content="description here mate !!!">
<meta name="author" content="Colin Lundy">

<?php
if ($_SERVER['HTTP_HOST'] == "localhost") {
echo '<script src="jquery.min.js"></script>';
} else {
echo '<script src="http://code.jquery.com/jquery.min.js"></script>';
}
?>

<link rel="stylesheet" href="layout-mini.php" media="screen">
</head>

<body>

<div id="container">
<div id="wrap">
<header><img src="/images/white_logo.png"></img></header>
<nav id="test">
<ul>
<li><a href="/?page=news">News</a></li>
<li><a href="/?page=contact">Contact</a></li>
<li><a href="/?page=gallery">Gallery</a></li>
<li><a href="/?page=event">Events</a></li>
<li><a href="/?page=football">Football</a></li>
<li><a href="/?page=tpb">Bowling</a></li>
<li><a href="/?page=championship">Championship</a></li>
</ul>
</nav>
<?php
//if (isset($_SESSION['userID'])) {
//echo '<li style="float:right;"><a href="/?event=logout">Logout</a></li>';

//$isadmin = $mysqli->query("SELECT `admin` FROM `members` WHERE `id` = '".$_SESSION['userID']."';");
//$level = $isadmin->fetch_assoc();

//if ($level['admin'] == 1) {
//echo '<li style="float: right;"><a href="/control">Control Panel</a></li>';
//}

//}
?>

<div id="main">
<div id="content">
<?php 
$page = (empty($_GET['page'])) ? 'news' : $_GET['page'];
$invalide = array('/','/\/',':','.');
$page = str_replace($invalide,' ',$page);
	  
$file = "modules/" . $page . "/index.php";  

if (!empty($_GET['action'])) 
$file = "modules/" . $page . "/".  str_replace($invalide,' ', $_GET['action']) .".php";

if (!file_exists($file)) 
$page = "modules/news/index.php";

include_once($file);
?> 
</div>

<?php 
/*
<div id="sideBar">
if (isset($_SESSION['userID'])) {
//include_once("modules/blocks/logged_in.php");
include_once("modules/blocks/shoutbox.php");
} else {
//include_once("modules/blocks/login.php"); 
//include_once("modules/blocks/shopping_cart.php");
//include_once("modules/blocks/upcoming_events.php");
//include_once("modules/blocks/band_practice.php"); 
}
// </div>
*/
?>

</div>
</div>
<footer>
&copy; <?php echo date("Y"); ?> North Ayrshire Boys Brigade. <br>
Design by Colin Lundy - Code by Colin Lundy.
</footer>
</div>
</body>
</html>