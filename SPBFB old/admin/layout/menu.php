<div>
<!-- LEFT CONTEXT SENSITIVE MENU -->
<?php

if (level($_SESSION['uid']) >= 2) {
?>
<div class='menuouterwrap'>
<div class='menucatwrap'>
<img src='images/menu_title_bullet.gif' style='vertical-align:bottom' border='0' /> News Control 
</div>

<div class='menulinkwrap'>
&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='index.php?manager=news' style='text-decoration:none'>Manage News Articles</a>
</div>

<div class='menulinkwrap'>
&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='./?manager=news&amp;action=add' style='text-decoration:none'>Add a News Article</a></div>
</div>
<br />

<?php
}

if (level($_SESSION['uid']) >= 4) {
?>
<div class='menuouterwrap'>
<div class='menucatwrap'><img src='images/menu_title_bullet.gif' style='vertical-align:bottom' border='0' /> Band Information </div>

<div class='menulinkwrap'>&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='./?manager=info&action=edit&id=1' style='text-decoration:none'>Edit History</a></div>

<div class='menulinkwrap'>&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='./?manager=info&action=edit&id=2' style='text-decoration:none'>Edit Uniform</a></div>

<div class='menulinkwrap'>&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='./?manager=info&action=edit&id=3' style='text-decoration:none'>Edit Practice</a></div>

<div class='menulinkwrap'>&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='./?manager=info&action=edit&id=6' style='text-decoration:none'>Edit Constitution</a></div>

<div class='menulinkwrap'>&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='./?manager=info&action=playlist' style='text-decoration:none'>Edit Playlist</a></div>
</div>
<br />
<?php
}
if (level($_SESSION['uid']) >= 2) {
?>
<div class='menuouterwrap'>
<div class='menucatwrap'><img src='images/menu_title_bullet.gif' style='vertical-align:bottom' border='0' /> Events Control </div>
<div class='menulinkwrap'>&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;<a href='index.php?manager=events' style='text-decoration:none'>Manage Events </a></div>
<div class='menulinkwrap'>&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;<a href='./?manager=events&amp;action=add' style='text-decoration:none'>Add Event </a></div>

<div class='menucatwrap'><img src='images/menu_title_bullet.gif' style='vertical-align:bottom' border='0' /> Gallery Control </div>

<div class='menulinkwrap'>
&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='index.php?manager=gallery' style='text-decoration:none'>Manage Albums</a>
</div>
<div class='menulinkwrap'>
&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='./?manager=gallery&action=newalbum' style='text-decoration:none'>Add New Album </a>
</div>

<div class='menulinkwrap'>
&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='./?manager=gallery&action=upload' style='text-decoration:none'>Upload Photo</a>
</div>

<div class='menucatwrap'><img src='images/menu_title_bullet.gif' style='vertical-align:bottom' border='0' /> Multimedia Control </div>
<div class='menulinkwrap'>
&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='index.php?manager=videos' style='text-decoration:none'>Manage Video </a>
</div>

<div class='menulinkwrap'>
&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='index.php?manager=videos&action=upload' style='text-decoration:none'>Upload Video </a>
</div>
</div>


<br />
<?php
}
if (level($_SESSION['uid']) >= 3) {
?>

<div class='menuouterwrap'>
<div class='menucatwrap'><img src='images/menu_title_bullet.gif' style='vertical-align:bottom' border='0' /> Guestbook Control </div>
<div class='menulinkwrap'>
&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='index.php?manager=guestbook' style='text-decoration:none'>Manage Posts </a>
</div>
</div>
<br />
 <?php
 }

 if (level($_SESSION['uid']) >= 4) {
 ?> 
<div class='menuouterwrap'>
<div class='menucatwrap'><img src='images/menu_title_bullet.gif' style='vertical-align:bottom' border='0' /> Shop Control </div>

<div class='menulinkwrap'>
&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='#' style='text-decoration:none'>Manage Categories </a>
</div>

<div class='menulinkwrap'>
&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='#' style='text-decoration:none'>Manage Products </a>
</div>

<div class='menulinkwrap'>
&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='index.php?manager=shop' style='text-decoration:none'>Manage Orders </a>
</div>

</div>
<br />   
<?php
}

 if (level($_SESSION['uid']) > 4) {
 ?>
    
<div class='menuouterwrap'>
<div class='menucatwrap'><img src='images/menu_title_bullet.gif' style='vertical-align:bottom' border='0' /> Users and Groups</div>

 <div class='menulinkwrap'>
 &nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
 <a href='index.php?manager=members' style='text-decoration:none'>Manage Members</a>
 </div>

<div class='menulinkwrap'>
&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='index.php?manager=members&action=add' style='text-decoration:none'>Add New Member</a>
</div>

<div class='menulinkwrap'>
&nbsp;<img src='images/item_bullet.gif' border='0' alt='' valign='absmiddle'>&nbsp;
<a href='index.php?manager=members&action=groups' style='text-decoration:line-through;'>Manage User Groups</a>
</div>

  </div>
  <br />
  <?php
  }
  ?>
    <!-- / LEFT CONTEXT SENSITIVE MENU -->
  </div>