<?php
include_once ("_config.php"); // lets connect to the database
include_once ("_functions.php"); // just stuff we will use later on
?>
 <!doctype html>
 <html>

   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Customizable Dynamic Quiz Basic Demo</title>
     <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" type="text/css" href="css/style.css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

	 <script src='https://kit.fontawesome.com/a076d05399.js'></script>
   </head>

   <body>
        <div id="demo-top-bar">
       <div id="demo-bar-inside">
         <h2 id="demo-bar-badge">
           <a href="./">The secret quiz club</a>
         </h2>
       </div>
     </div>
    <?php
		// Are you logged in?
		if (!isset($_SESSION['teamID']))
		{
	?>
     <div class="container">
       <h1 style="text-align: center;">Please enter your login details</h1>

       <form action="check_login.php" method="POST" id="login">
         <input name="username" class="input eighty" id="username" placeholder="Username" type="text" required>
         <input name="password" class="input eighty" id="password" placeholder="Password" type="password" required>
         <input name="login" class="input eighty" id="login2" type="submit" value="Login">
       </form>
     </div>
    <?php
		}
		else
		{
	?>
	
     <div id="fluid-wrap">
	 <ul>
       <?php
    if (isadmin($_SESSION['teamID']))
    {
?>
		<li><a href="./?page=main">Home</a></li>
         <li><a href="./?page=games">Games</a></li>
         <li><a href="./?page=teams">Teams</a></li>
      <?php
    }
?>
         <li><a href='/quiz/logout.php'>Logout</a></li>
       </ul>
     </div>

     <div id="main-content">
     <?php
$page = (empty($_GET['page'])) ? 'main' : $_GET['page'];
$invalide = array('/','/\/',':','.');
$page = str_replace($invalide,' ',$page);
	  
$file = "modules/" . $page . ".php";  

if (!file_exists($file)) 
$file = "modules/main.php";

include_once($file);

}
?>
     </div>
<?php
/*
     <footer>
       <p align="center">coded and made sexy by Colin Lundy</p>
     </footer>
*/
?>	 
   </body>

 </html>