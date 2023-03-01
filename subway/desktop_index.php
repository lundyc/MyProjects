<?php
/*
Layout for Normal Desktop's ect
*/
?>
<!doctype html><html lang="en">
<head>
<meta charset="utf-8">

<title>Subway Irvine</title>
<base href="http://www.lundy.me.uk/subway/" target="_blank">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=4">
<meta name="description" content="Subway Irvine - Eat Fresh">
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
<header><img src="images/white_logo.png"></img></header>

<?php
if (isset($_SESSION['logged_in'])) {
?>
<nav>
<ul>
<li><a href="/?page=">Request Holiday</a></li>
<li><a href="/?page=">View Holidays</a></li>
</ul>
</nav>
<?php
} 
?>

<div id="main">
<?php 
$page = (empty($_GET['page'])) ? 'login' : $_GET['page'];
$invalide = array('/','/\/',':','.');
$page = str_replace($invalide,' ',$page);
	  
$file = "modules/" . $page . "/index.php";  

if (!empty($_GET['action'])) 
$file = "modules/" . $page . "/".  str_replace($invalide,' ', $_GET['action']) .".php";

if (!file_exists($file)) 
$page = "modules/login/index.php";

include_once($file);
?> 

<footer>
&copy; <?php echo date("Y"); ?> Subway Irvine. <br>
Design by Colin Lundy - Code by Colin Lundy.
</footer>
</div>
</div>
</body>
</html>