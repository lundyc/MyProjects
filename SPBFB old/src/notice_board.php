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

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2 style="margin-bottom: 0px;">Notice Board</h2>
<?php
$links = array("./?view=media&type=video", "./?view=about&InfoID=3", "./?view=guestbook");
$imgs = array("spbfb-tv.jpg", "new_members.png", "guestbook.png");

$i = array_rand($imgs);
?>
<a href="<?php echo $links[$i]; ?>">
<img src="uploads/adverts/<?php echo $imgs[$i]; ?>" alt="" width="228" height="228" /></a>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>

