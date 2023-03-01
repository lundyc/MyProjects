<!doctype html>
<html lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Subway Irvine</title>
<base href="http://www.lundy.me.uk/subway/" target="_blank">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=4">
<meta name="description" content="Subway Irvine">
<meta name="author" content="Colin Lundy">

<link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css" />
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/font-awesome.min.css">

<script src="js/jquery.js"></script>
<script src="js/jquery.mobile-1.4.5.min.js"></script>

 <script type="text/javascript">
	// Find matches
	var mql = window.matchMedia("(orientation: portrait)");

	// If there are matches, we're in portrait
	if (mql.matches) {
	    // Portrait orientation
	    $('.mobile_display').hide();
	} else {
	    $('.mobile_display').show();
	}

	// Add a media query change listener
	mql.addListener(function (m) {
	    if (m.matches) {
	        // Changed to portrait
	        $('.mobile_display').hide();

	    } else {
	        // Changed to landscape
	        $('.mobile_display').show();
	    }
	});
</script>
	
	</head>
	
	<body>

<div class="demo-wrapper" data-role="page">

   <div class="panel left" data-role="panel" data-position="left" data-display="push" id="panel-01">

            <ul>
			<li class="newsfeed"><a title="Home" href="/?page=news">News</a></li>
			<li class="contactus"><a title="Contact" href="/?page=contact">Contact</a></li>
			<li class="gallery"><a href="/?page=gallery">Gallery</a></li>
			<li class="calendar"><a href="/?page=event">Events</a></li>
			<li class="report"><a href="/?page=football">Football</a></li>
			<li class="bowling"><a href="/?page=tpb">Bowling</a></li>
			<li class="champ"><a href="/?page=championship">Championship</a></li>
            </ul>

        </div>

		<div class="header" data-role="header">
		<?php
if (isset($_SESSION['logged_in'])) {
?>
			<span class="open left"><a href="#panel-01">&#61641;</a></span>
			<?php			
}
?>
            <span class="title">Subway Irvine</span>
		</div>
		
		   <div class="content" data-role="content">
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
			</div>
	</div>
</body>
</html>