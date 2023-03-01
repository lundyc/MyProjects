<?php
// -------------------------------------------------------------------------//
// Saltcoats Protestant Boys FB - PHP Portal                                                  //
// http://www.spb-fb.co.uk                                                //
// -------------------------------------------------------------------------//
// This program is free software. you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License.           //
// -------------------------------------------------------------------------//
?>

 <!-- Start Navigation -->
<div id="topNav">
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="./?view=about">About Us</a></li>
<li><a href="./?view=shop">Shop</a></li>
<li><a href="./?view=events">Events</a></li>
<li><a href="./?view=events&amp;action=reports">Reports</a></li>
<li><a href="./?view=media">Media</a></li>
<li><a href="./?view=guestbook">Guestbook</a></li>
</ul>
</div>
 <!-- End Navigation -->
 
<?php
if (isset($_SESSION['uid'])) {

$mail = mysql_num_rows(mysql_query("SELECT `id` FROM `msgs` WHERE `to` = '".$_SESSION['uid']."' AND status='unread'"));

$part1 = "Mail (";
$part2 = ")&nbsp;<small>&#9660;</small>";

$e = ($mail > 0) ? "<b style='color: #ea5454;'>".$part1 . $mail . $part2. "</b>" : $part1.$mail.$part2;
?>
<div id="topnav2">
<ul id="leftNav">

<?php
if (level($_SESSION['uid']) > 1) 
echo '<li><a href="admin/index.php">Admin Panel</a></li>';
?>

<li><a href="./?view=mypanel">My Panel</a></li>
<li><a href="http://www.hotmail.com" target="_blank">SPB Webmail</a></li>
<li><a href="./?view=mypanel&amp;action=inbox" id="nav0" onmouseover="msglobalnav.toggle('0',true);" onmouseout="msglobalnav.toggle('0',false);"><?php echo $e; ?></a></li>

<li><a href="" id="nav1" onmouseover="msglobalnav.toggle('1',true);" onmouseout="msglobalnav.toggle('1',false);">
		Profile&nbsp;<small>&#9660;</small>
	</a>
</li>

<li>
	<a href="" id="nav3" onmouseover="msglobalnav.toggle('3',true);" onmouseout="msglobalnav.toggle('3',false);">
		Photos&nbsp;<small>&#9660;</small>
	</a>
</li>

<li>
	<a href="" id="nav2" onmouseover="msglobalnav.toggle('2',true);" onmouseout="msglobalnav.toggle('2',false);">
		Users&nbsp;<small>&#9660;</small>
	</a>
</li>

</ul>

<ul id="rightNav">
<li><a href="#">My Account</a></li>
<li><a href="logout.php">Sign Out</a></li>
</ul>

</div>


<div id="subnav">
<ul id="subNav0" onmouseover="msglobalnav.subToggle('0',true);" onmouseout="msglobalnav.subToggle('0',false);">

<li>
<a href="index.php?view=mypanel&amp;action=inbox">Inbox</a>
</li>

<li>
<a href="index.php?view=mypanel&amp;action=sendmessage">Compose</a>
</li>
 
<li class="last">
<a href="index.php?view=mypanel&amp;action=outbox">Outbox</a>
</li>

</ul>

<ul id="subNav1" onmouseover="msglobalnav.subToggle('1',true);" onmouseout="msglobalnav.subToggle('1',false);">

<li>
<a href="./?view=mypanel&amp;action=profile&amp;id=<?php echo $_SESSION['uid']; ?>">My Profile</a>
</li>

<li>
<a href="./?view=mypanel&amp;action=editprofile">Edit Profile</a>
</li>

<li>
<a href="./?view=mypanel&amp;action=editimage">Edit Image</a>
</li>


<li class="last">
<a href="./?view=mypanel&amp;action=changepassword">Change Password</a>
</li>

</ul>

<ul id="subNav2" onmouseover="msglobalnav.subToggle('2',true);" onmouseout="msglobalnav.subToggle('2',false);">
<li><a href="./?view=mypanel&amp;action=onlineusers">Online Users</a></li>
<li><a href="./?view=mypanel&amp;action=phonebook">Phone Book</a></li>
<li class="last"><a href="./?view=mypanel&amp;action=browse">Browser</a></li>
</ul>

<ul id="subNav3" onmouseover="msglobalnav.subToggle('3',true);" onmouseout="msglobalnav.subToggle('3',false);">

<li>
<a href="">Upload Picture</a>
</li>

<li class="last">
<a href="./?view=mypanel&amp;action=myuploads">My Uploads</a>
</li>

</ul>
</div>

 <?php
 }
 ?>
 
 
