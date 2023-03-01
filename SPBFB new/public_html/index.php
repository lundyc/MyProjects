<?php 
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() - 3600));
 if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
header('Content-type: text/html; charset=iso-8859-1');
include("_mysqli.php"); 

// http://www.colourlovers.com/palette/2690607/Wisp

session_start();

if (isset($_GET['event']) && $_GET['event'] == 'logout') {
session_destroy();
header('Location: index.php');
} elseif (isset($_GET['event']) && $_GET['event'] == 'event_popup') {
$query = "SELECT  `ID`, 
DATE_FORMAT(`date`, '%W, %D %M %Y') as `format_date`,
DATE_FORMAT(`time`, '%l:%i %p') as `format_time`, 
`title`, `info` FROM  `new_events` WHERE `ID` = '".mysqli_real_escape_string($mysqli, $_GET['id'])."'";

$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
$r = $result->fetch_assoc();

echo '<div style="margin: 0 0 5px 0; padding-bottom: 5px; font-size: 18px;">'.$r['title'] . '</div>';

echo '<div style="margin: 0 0 5px 0; padding-bottom: 5px;">';
echo "Date: " . $r['format_date'] . "<br>";
echo "Time: " . $r['format_time'] . "<br>";
echo '</div>';

echo $r['info'];

//echo '<div style="float: right;"><a href="/event?id='.$r['ID'].'">View More</a></div>';
} else {

?>
<!doctype html><html lang="en">
<head>
<meta charset="utf-8">

<title>Saltcoats Protestant Boys FB (est 2005)</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=4">
<meta name="description" content="Saltcoats Protestant Boys FLute Band, based in North Ayrshire. EST 2005, blood and thunder">
<meta name="author" content="Colin Lundy">

<link rel="stylesheet" href="/layout-mini.php" media="screen">
<link rel="stylesheet" href="/layout-mini-mobile.php" media="handheld, only screen and (max-device-width:480px)">

<script type="text/javascript">
var CKEDITOR_BASEPATH = '/ckeditor/';
</script>
<script src="/ckeditor/ckeditor.js"></script>
</head>

<body>
<div class="popup_box"> 
   <span id="popup_content">loading....</span>
    <a class="popupBoxClose">Close</a>    
</div>

<div id="container">
<div id="wrap">
<header></header>

<nav id="test">
<ul>
<li><a href="/news">Home</a></li>
<li><a href="/about">About Us</a></li>
<li><a href="/event">Events</a></li>

<li><a href="/shop">Shop</a></li>
<li id="media"><a href="/media">Media</a></li>

<?php
if (isset($_SESSION['userID'])) {
echo '<li style="float:right;"><a href="">Logout</a></li>';

$isadmin = $mysqli->query("SELECT `admin` FROM `members` WHERE `id` = '".$_SESSION['userID']."';");
$level = $isadmin->fetch_assoc();

if ($level['admin'] == 1) {
echo '<li style="float: right;"><a href="/control">Control Panel</a></li>';
}

}
?>
</ul>
</nav>

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
<div id="sideBar">
<?php 
if (isset($_SESSION['userID'])) {
include_once("modules/blocks/logged_in.php");
// include_once("modules/blocks/shoutbox.php");
} else {
include_once("modules/blocks/band_practice.php"); 
include_once("modules/blocks/login.php"); 
include_once("modules/blocks/shopping_cart.php");
include_once("modules/blocks/upcoming_events.php");
}
?>
</div>
</div>
</div>

<footer>
&copy; <?php echo date("Y"); ?> Saltcoats Protestant Boys FLute Band. <br>
Design by Colin Lundy - Code by Colin Lundy.
</footer>
</div>

<?php
if ($_SERVER['HTTP_HOST'] == "localhost") {
echo '<script src="jquery.min.js"></script>';
} else {
echo '<script src="http://code.jquery.com/jquery.min.js"></script>';
}
?>


<script>
var deviceWidth = 0;
$(window).bind('resize', function () {
    deviceWidth = $('[data-role="page"]').first().width();
}).trigger('resize');

   $(document).ready( function() {

// $('html, body').animate({scrollTop: $("#test").offset().top}, 1000);

   


   
		$('.openpopup').click( function() {    
		$.get("index.php", { "_": $.now(),
		event: "event_popup", id: $(this).attr('id') })
		
		.done(function(data) {
			$('#popup_content').html(data);
		});
		
            $('.popup_box').fadeIn("slow");
            $("#container").css({ // this is just for style
                "opacity": "0.3"  
            });   
        });
		
        $('.popupBoxClose').click( function() {            
            $('.popup_box').fadeOut("slow");
			$('#popup_content').html('loading.....');
            $("#container").css({ // this is just for style        
                "opacity": "1"  
            }); 
        });

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};    


$('#login_submit').click( function(e) {

e.preventDefault();

var emailaddress = $("#email").val();
var password = $("#password").val();

if (emailaddress == '') { 
$("#msgbox").removeClass().addClass('messagebox').text('Please enter a valid email address').fadeIn(1000);

return false;
} else if(!isValidEmailAddress(emailaddress)) { 
$("#msgbox").removeClass().addClass('messagebox').text('Please enter a valid email address').fadeIn(1000);

return false;
} else if ($("#password").val() == '') {
$("#msgbox").removeClass().addClass('messagebox').text('Please enter a password').fadeIn(1000);

return false;
} else {


var datastring = 'event=login';
  $.ajax({
        url: 'submit.php',
        type: 'post',
		data: 'email=' + emailaddress + '&password=' + password,

	beforeSend:function(){
		$("#msgbox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
	},
	
	error: function(jqXHR, textStatus, errorThrown){
		alert(errorThrown);
	},
	
	success: function(data){
		
		if (data == 'ok') {
			location.reload();
		} else {
			$("#msgbox").removeClass().addClass('messagebox').text('<b>ERROR:</b> ' + data).fadeIn(1000);
		}
		
	}
    });

}  
return false; 
});
	
});
</script>

</body>
</html>
<?php
}
?>