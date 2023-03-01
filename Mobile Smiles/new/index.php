<?php
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() - 3600));
 if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
header('Content-type: text/html; charset=iso-8859-1');

session_start();

$page = (empty($_GET['page'])) ? 'main' : $_GET['page'];
$invalide = array('/','/\/',':','.');
$page = str_replace($invalide,' ',$page);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Mobile Smiles.co.uk</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<div id="header">

						<!-- Logo -->
							<h1><a href="/">Mobile Smiles</a></h1>

						<!-- Nav -->
							<nav id="nav">
								<ul>
								<li <?php echo ($page == "main") ? 'class="current"' : ''; ?>><a href="index.php">Home</a></li>
								<li <?php echo ($page == "book") ? 'class="current"' : ''; ?>><a href="./?page=book">Book Now</a></li>
								<li <?php echo ($page == "services") ? 'class="current"' : ''; ?>><a href="./?page=services">Services</a></li>
								<li <?php echo ($page == "faq") ? 'class="current"' : ''; ?>><a href="./?page=faq">FAQ</a></li>
								<li <?php echo ($page == "portfolio") ? 'class="current"' : ''; ?>><a href="./?page=portfolio">Portfolio</a></li>
								<li <?php echo ($page == "contact") ? 'class="current"' : ''; ?>><a href="./?page=contact">Contact</a></li>
							</nav>

							<?php
							$file = "modules/" . $page . "/index.php";  

							if (!empty($_GET['action'])) 
							$file = "modules/" . $page . "/".  str_replace($invalide,' ', $_GET['action']) .".php";

							if (!file_exists($file)) 
							$page = "modules/news/index.php";

							include_once($file);
							?>	
					</div>
				</div>

			

			<!-- Footer -->
				<div id="footer-wrapper">
					<section id="footer" class="container">
						
							
				<?php
				
				/*
				<div class="row">
				<div class="8u 12u(mobile)">
								<section>
									<header>
										<h2>Blandit nisl adipiscing</h2>
									</header>
									<ul class="dates">
										<li>
											<span class="date">Jan <strong>27</strong></span>
											<h3><a href="#">Lorem dolor sit amet veroeros</a></h3>
											<p>Ipsum dolor sit amet veroeros consequat blandit ipsum phasellus lorem consequat etiam.</p>
										</li>
										<li>
											<span class="date">Jan <strong>23</strong></span>
											<h3><a href="#">Ipsum sed blandit nisl consequat</a></h3>
											<p>Blandit phasellus lorem ipsum dolor tempor sapien tortor hendrerit adipiscing feugiat lorem.</p>
										</li>
										<li>
											<span class="date">Jan <strong>15</strong></span>
											<h3><a href="#">Magna tempus lorem feugiat</a></h3>
											<p>Dolore consequat sed phasellus lorem sed etiam nullam dolor etiam sed amet sit consequat.</p>
										</li>
										<li>
											<span class="date">Jan <strong>12</strong></span>
											<h3><a href="#">Dolore tempus ipsum feugiat nulla</a></h3>
											<p>Feugiat lorem dolor sed nullam tempus lorem ipsum dolor sit amet nullam consequat.</p>
										</li>
										<li>
											<span class="date">Jan <strong>10</strong></span>
											<h3><a href="#">Blandit tempus aliquam?</a></h3>
											<p>Feugiat sed tempus blandit tempus adipiscing nisl lorem ipsum dolor sit amet dolore.</p>
										</li>
									</ul>
								</section>
							</div>
							<div class="4u 12u(mobile)">
								<section>
									<header>
										<h2>What's this all about?</h2>
									</header>
									<a href="#" class="image featured"><img src="images/pic10.jpg" alt="" /></a>
									<p>
										This is <strong>Dopetrope</strong> a free, fully responsive HTML5 site template by
										<a href="http://twitter.com/ajlkn">AJ</a> for <a href="http://html5up.net/">HTML5 UP</a> It's released for free under
										the <a href="http://html5up.net/license/">Creative Commons Attribution</a> license so feel free to use it for any personal or commercial project &ndash; just don't forget to credit us!
									</p>
									<footer>
										<a href="#" class="button">Find out more</a>
									</footer>
								</section>
							</div>
							</div>
				*/
				?>				
						
						<div class="row">
							<div class="4u 12u(mobile)">
								<section>
									<header>
										<h2>Our Services</h2>
									</header>
									<ul class="divided">
										<li>Mobile Teeth Whitening</li>
										<li>Professional Laser Teeth Whitening sessions</li>
										<li>Aftercare programs and advice</li>
									</ul>
								</section>
							</div>
							<div class="4u 12u(mobile)">
							
							</div>
							<div class="4u 12u(mobile)">
								<section>
									<header>
										<h2>Contact the Team</h2>
									</header>
									<ul class="social">
										<li><a class="icon fa-facebook" href="https://www.facebook.com/MobileSmileGlasgow/"><span class="label">Facebook</span></a></li>
										<li><a class="icon fa-twitter" href="https://twitter.com/Mobile_Smiles"><span class="label">Twitter</span></a></li>
										<li><a class="icon fa-instagram" href="https://www.instagram.com/mobilesmilesglasgow/?hl=en"><span class="label">Instagram</span></a></li>
	<?php /* 			<li><a class="icon fa-dribbble" href="#"><span class="label">Dribbble</span></a></li>
										<li><a class="icon fa-linkedin" href="#"><span class="label">LinkedIn</span></a></li>
										<li><a class="icon fa-google-plus" href="#"><span class="label">Google+</span></a></li>
										*/
										?>
									</ul>
									<ul class="contact">
										<li>
											<h3>Address</h3>
											<p>
												3/2 270 Burnfeild Road<br>Mansewood<br>Glasgow
											</p>
										</li>
										<li>
											<h3>Mail</h3>
											<p><a href="matio:william@mobile-smiles.co.uk">william@mobile-smiles.co.uk</a></p>
										</li>
										<li>
											<h3>Phone</h3>
											<p><a href="tel:07758325669">07758325669</a></p>
										</li>
									</ul>
								</section>
							</div>
						</div>
						<div class="row">
							<div class="12u">

								<!-- Copyright -->
									<div id="copyright">
										<ul class="links">
											<li>&copy; Mobile-Smiles. All rights reserved.</li><li>Design: <a href="http://www.lundy.me.uk">Lundy.me.uk</a></li>
										</ul>
									</div>

							</div>
						</div>
					</section>
				</div>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>