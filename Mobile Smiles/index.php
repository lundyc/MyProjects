<?php
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() - 3600));
 if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
header('Content-type: text/html; charset=iso-8859-1');

session_start();

$page = (empty($_GET['page'])) ? 'main' : $_GET['page'];
$invalide = array('/','/\/',':','.');
$page = str_replace($invalide,' ',$page);
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
	<head>
		<title>Mobile Smiles</title>
		<meta name="description" content="description here !!!">
<meta name="author" content="Colin Lundy">
		
		<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/responsiveslides.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/responsiveslides.min.js"></script>
		  <script>
		    // You can also use "$(window).load(function() {"
			    $(function () {
			      // Slideshow 1
			      $("#slider1").responsiveSlides({
			        maxwidth: 2500,
			        speed: 600
			      });
			});
		  </script>
	</head>
	<body>
		<!---start-wrap---->
		
			<!---start-header---->
			<div class="header">
					<div class="top-header">
						<div class="wrap">
						<div class="top-header-left">
							<p><a href="tel:+44 7758325669">+44 7758325669</a></p>
						</div>
	<?php
	/*
						<div class="right-left">
							<ul>
								<li class="login"><a href="#">Login</a></li>
								<li class="sign"><a href="#">Sign up</a></li>
							</ul>
						</div>
	*/ 
?>	
						<div class="clear"> </div>
					</div>
				</div>
					<div class="main-header">
						<div class="wrap">
							<div class="logo">
								<a href="./"><img src="images/logo.png" title="Mobile Smiles"></a>
							</div>
							<div class="social-links">
								<ul>
									<li><a href="https://www.facebook.com/MobileSmileGlasgow/"><img src="images/facebook.png" title="facebook" /></a></li>
									<li><a href="https://twitter.com/Mobile_Smiles"><img src="images/twitter.png" title="twitter" /></a></li>
									<li><a href="https://www.instagram.com/mobilesmilesglasgow/?hl=en"><img src="images/feed.png" title="Rss" /></a></li>
									<div class="clear"> </div>
								</ul>
							</div>
							<div class="clear"> </div>
						</div>
					</div>
					<div class="clear"> </div>
					<div class="top-nav">
						<div class="wrap">
							<ul>
								<li <?php echo ($page == "main") ? 'class="active"' : ''; ?>><a href="index.php">Home</a></li>
								<li <?php echo ($page == "about") ? 'class="active"' : ''; ?>><a href="./?page=about">About</a></li>
								<li <?php echo ($page == "services") ? 'class="active"' : ''; ?>><a href="./?page=services">Services</a></li>
								<li <?php echo ($page == "faq") ? 'class="active"' : ''; ?>><a href="./?page=faq">FAQ</a></li>
								<li <?php echo ($page == "portfolio") ? 'class="active"' : ''; ?>><a href="./?page=portfolio">Portfolio</a></li>
								<li <?php echo ($page == "contact") ? 'class="active"' : ''; ?>><a href="./?page=contact">Contact</a></li>
								<div class="clear"> </div>
							</ul>
						</div>
					</div>
			</div>
			<!---End-header---->

<?php

	  
$file = "modules/" . $page . "/index.php";  

if (!empty($_GET['action'])) 
$file = "modules/" . $page . "/".  str_replace($invalide,' ', $_GET['action']) .".php";

if (!file_exists($file)) 
$page = "modules/news/index.php";

include_once($file);
?>			
			
			
			
			
		<!---start-footer---->
		<div class="footer">
			<div class="wrap">
				<div class="footer-grids">
<?php
/*
					<div class="footer-grid">
						<h3>OUR Profile</h3>
						 <ul>
							<li><a href="#">Lorem ipsum dolor sit amet</a></li>
							<li><a href="#">Conse ctetur adipisicing</a></li>
							<li><a href="#">Elit sed do eiusmod tempor</a></li>
							<li><a href="#">Incididunt ut labore</a></li>
							<li><a href="#">Et dolore magna aliqua</a></li>
							<li><a href="#">Ut enim ad minim veniam</a></li>
						</ul>
					</div>
					<div class="footer-grid">
						<h3>Our Services</h3>
						 <ul>
							<li><a href="#">Et dolore magna aliqua</a></li>
							<li><a href="#">Ut enim ad minim veniam</a></li>
							<li><a href="#">Quis nostrud exercitation</a></li>
							<li><a href="#">Ullamco laboris nisi</a></li>
							<li><a href="#">Ut aliquip ex ea commodo</a></li>
						</ul>
					</div>
					<div class="footer-grid">
						<h3>OUR FLEET</h3>
						 <ul>
							<li><a href="#">Lorem ipsum dolor sit amet</a></li>
							<li><a href="#">Conse ctetur adipisicing</a></li>
							<li><a href="#">Elit sed do eiusmod tempor</a></li>
							<li><a href="#">Incididunt ut labore</a></li>
							<li><a href="#">Et dolore magna aliqua</a></li>
							<li><a href="#">Ut enim ad minim veniam</a></li>
						</ul>
					</div>
*/
?>					
					<div class="footer-grid">
						<h3>Address</h3>
	<p>3/2 270 Burnfeild Road</p>
						<p>Mansewood</p>
						<p>Glasgow</p>

					</div>
								<div class="footer-grid">
						<h3>Contact</h3>
				   		<p>Phone: <span>07758325669</span></p>

				 	 	<p>Email: <span>william@mobile-smiles.co.uk</span></p>
					</div>
					
<div class="footer-grid">
<h3>Copyright <?php echo date("Y"); ?></h3>
<p>Design by: <span>W3layouts</span></p>
<p>Developed by: <span>CL Development</span></p>
</div>					
					
					
					
					<div class="clear"> </div>
				</div>
				<div class="clear"> </div>

			</div>
		</div>
		<!---End-footer---->
	</body>
</html>

