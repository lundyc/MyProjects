<?php
include("_mysql.php");
include("_functions.php");
include("_settings.php");
include("fckeditor/fckeditor.php") ;

require_once('fb_tools/config.php');
require_once('fb_tools/fb_simple_api_class.php');

systeminc('globals.inc');

error_reporting(0);
//checkloggedin();

$CAPCLASS = new Captcha;
$CAPCLASS->clear_oldcaptcha();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="description" content="Blood and Thunder Flute Band, North Ayrshire, est 2005" />
<meta name="keywords" content="flute band, saltcoats, protestant, boys, saltcoats protestant boys, saltcoats protestant boys flute band, SPB, SPBFB, SPB FB, Aryshire, Blood and Thunder" />
<meta name="robots" content="nofollow" />

<title><? echo PAGETITLE; ?></title>

<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="css/shop.css" rel="stylesheet" type="text/css" />

<!--[if IE]>
<link href="css/ie_changes.css" rel="stylesheet" type="text/css" />
<![endif]-->  
  
<!--[if gte IE 7]>
<link href="css/ie7_changes.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if lte IE 6]>
<link href="css/ie6_changes.css" rel="stylesheet" type="text/css" />
<![endif]-->

<?php
if (isset($_SESSION['uid'])) {
echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>';

echo '<script type="text/javascript">'."\n";
echo 'var UserID = '.$_SESSION['uid']. ";\n";
echo '</script>'. "\n";
echo '<script language="javascript" src="scripts/menu.js"></script>'."\n\n";

echo '<script type="text/javascript" src="scripts/dropdowncontent.js"></script>'."\n";
//echo '<script type="text/javascript" src="scripts/jquery.js"></script>'."\n";
echo '<script type="text/javascript" src="scripts/jquery/shoutbox.js"></script>'."\n";

echo '<script type="text/javascript" src="ckeditor/ckeditor.js?t=A1QD"></script>';

if ($site == "smile") {      
echo '<script type="text/javascript" src="scripts/jquery.mousewheel-3.0.2.pack.js"></script>';
echo '<script type="text/javascript" src="scripts/jquery.fancybox-1.3.0.pack.js"></script>';
echo '<link rel="stylesheet" type="text/css" href="css/jquery.fancybox-1.3.0.css" media="screen" />';	
echo '<script language="javascript" src="scripts/layout.js"></script>';
}

echo '<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />'."\n";
echo '<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />'."\n\n";

echo '<!--[if lte IE 7]>'."\n";
echo '<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />'."\n";
echo '<![endif]-->'."\n\n\n";

echo '<script type="text/javascript" src="jquery.jplayer.min.js"></script>'. "\n\n";

}
?>
</head>

<body>
<div id="fb-root"></div>
<script type="text/javascript">(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&amp;appId=156551617780357";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="container">
<div id="widthContainer">
<div id="wrap">

<div id="header"></div>

<div style="clear: both;"></div>
<div id="main">
<div class="bg">
<?php
systeminc("navigation");

echo (isset($_SESSION['uid'])) ? '<div id="sideBar3">' : '<div id="sideBar2">';

if (!isset($_SESSION['uid'])) {
systeminc("login");
systeminc("notice_board");
?>
<div class="fb-like" data-href="http://www.facebook.com/pages/Saltcoats-Protestant-Boys-FB/211484428927437" data-send="false" data-width="450" data-show-faces="false"></div>

<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="test@spb-fb.co.uk">
<input type="hidden" name="item_name" value="Donation to the SPB">
<input type="hidden" name="currency_code" value="GBP">
<input type="hidden" name="amount" value="1.00">
<input type="image" src="http://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0? name="submit" alt="Make payments with PayPal – it’s fast, free and secure!">
</form>
<?php
//systeminc("guestbook");
} else {
systeminc("shoutbox");
systeminc("upcoming_events");
}
?>
</div>

<?php
if (!isset($_SESSION['uid'])) {
?>
<div id="sideBar">
<?php
systeminc("band_practice");
systeminc("upcoming_events");
?>
</div>
<?php
}
?>

<div id="content">
<?php
if (empty($site)) $site = "news";
$invalide = array('/','/\/',':','.');
$site = str_replace($invalide,' ',$site);
	  
$file = "modules/" . $site . "/index.php";  

if (!empty($_GET['action'])) {
	$file = "modules/" . $site . "/".  str_replace($invalide,' ', $_GET['action']) .".php";
}

if (!file_exists($file)) { $site = "modules/news/index.php"; }

include_once($file);
?>
</div>

  
<div class="footer">
<a href="http://www.lundy.me.uk" target="_blank"><img src="themes/images/bottom/lundy.png" alt="Lundy.me.uk" border="0" /></a>
<br />
Copyright <b>Saltcoats Protestant Boys Flute Band</b>&copy; 2005-<?php echo date("Y");?> All Rights Reserved<br />
</div>
  
  </div>
    </div>
  </div>
  </div>
  </div>
</body>
</html>
<?php
mysql_close($link);
?>
