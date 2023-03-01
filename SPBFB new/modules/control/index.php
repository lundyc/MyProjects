<?php
if (!isset($_SESSION['userID'])) {
die("YOU ARE NOT LOGGED IN");
} else {

$isadmin = $mysqli->query("SELECT `admin` FROM `members` WHERE `id` = '".$_SESSION['userID']."';");
$level = $isadmin->fetch_assoc();

if ($level['admin'] != 1) {
die("YOU DO NOT HAVE ACCESS");
} else {
?>
<div class="module"><div class="mb" id='news'>
<h2>CONTROL PANEL</h2>	  

<style>
	ul#display-inline-block-example,
	ul#display-inline-block-example li {
		margin: 0 auto;
		padding: 0;
	}

	ul#display-inline-block-example li {
		display: inline-block;
		margin: 0 5px 5px 0;
	}
	
	ul#display-inline-block-example li a {
		display: block;
		
		padding: 5px;
		width: 80px;
		min-height: 50px;
			
		vertical-align: center;
		text-align: center;
		
		left: 50%;
		
		border: 1px solid #cccccc;
		background: #FFFFFF;
			
		text-decoration: none;
	}	
		
	ul#display-inline-block-example li a:hover {
		background: #B3B5B5;
		color: #234B76;
		border: 1px solid #234B76;
		font-weight: bold;
	}
</style>

<ul id="display-inline-block-example">
	<li><a href="/news?action=admin"><img src="/images/control/newspaper.png"><br />NEWS</a></li>
	<li><a href=""><img src="/images/control/script_yellow.png"><br />ABOUT US</a></li>
	<li><a href=""><img src="/images/control/calendar.png"><br />EVENTS</a></li>
	<li><a href=""><img src="/images/control/shop.png"><br />SHOP</a></li>
	<li><a href=""><img src="/images/control/music.png"><br />MEDIA</a></li>
	<li><a href=""><img src="/images/control/user.png"><br />MEMBERS</a></li>
	<li><a href=""><img src="/images/control/newspaper.png"><br />SPARE ICON</a></li>
	
	<li><a href=""><img src="/images/control/newspaper.png"><br />SPARE ICON</a></li>
	<li><a href=""><img src="/images/control/newspaper.png"><br />SPARE ICON</a></li>
	<li><a href=""><img src="/images/control/newspaper.png"><br />SPARE ICON</a></li>
</ul>

</div></div>
<?php
}

}
?>
