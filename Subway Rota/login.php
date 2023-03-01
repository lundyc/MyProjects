<?php
session_start();

$link = mysqli_connect("localhost","lundy_subway","e039288466","lundy_subway") or die("Error " . mysqli_error($link));

if (isset($_POST['action']) && $_POST['action'] == "login") {

if (isset($_POST['login']) && empty($_POST['login'])) {
$error = '<div class="error">Please enter your User</div>';
} elseif (isset($_POST['password']) && empty($_POST['password'])) {
$error = '<div class="error">Please enter your Password</div>';
} else {
$error = '';

$admin_query = "SELECT `StaffID` FROM  `staff` WHERE `StaffID` = '".$_POST['login']."' AND `password` = '". $_POST['password'] ."';";
$admin = $link->query($admin_query);
$num_rows = $admin->num_rows;
$adminr = mysqli_fetch_array($admin, MYSQLI_ASSOC);

if ($num_rows > 0) {
$_SESSION['userID'] = $adminr['StaffID'];

header("location: index.php");
} else {
$error = '<div class="error">Please enter the correct details</div>';
}

}

}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/main.css?v=1">
<title>Staff Portal - Login</title>
</head>

<body>

<style type="text/css">
td { 
border-bottom: 0;
}

.header_bg {
background-color: #FFFFFF;
color: #35E3B;
text-align: center;
font-weight: bold;

box-sizing: border-box; 
display: inline-block; 
width: auto; 
max-width: 80%; 

border: 2px solid #79CC3C; 
border-radius: 5px; 
box-shadow: 0px 0px 8px #79CC3C; 
margin: 50px auto auto;
}
	
.header {
color: #D4E178;
size: 2.00em;
font-weight: bold;
}
	
input { 
border: 1px solid #CCCCCC; 
border-radius: 5px;
color: #666666; 
display: inline-block; 
font-size: 1.00em; 
padding: 5px; width: 100%; 
}
	
input[type="button"], input[type="reset"], input[type="submit"] { 
height: auto; 
width: auto; 
cursor: pointer; 
box-shadow: 0px 0px 5px #79CC3C; 
float: right; 
margin-top: 10px; 
}

table.center { 
margin-left:auto; 
margin-right:auto; 
}

.error { 
color: #D41313; 
font-size: 1.00em; 
}
</style>

<div style="text-align: center;">
<div class="header_bg">

<div style="background: #355E3B; border-radius: 5px 5px 0px 0px; padding: 15px;">
<span class="header">Enter your login and password</span>
</div>

<div style="padding: 15px">
<?php echo $error; ?>

<form method="post" action="" name="aform" id="aform">
<input type="hidden" name="action" value="login">

<table class='center'>
<tr><td>Login:</td><td><input type="text" name="login" value="<?php echo htmlentities($_POST['login']); ?>"></td></tr>
<tr><td>Password:</td><td><input type="password" name="password"></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" value="Login"></td></tr>
</table>

</form>
</div>

</div>
</div>
</body>
</html>
