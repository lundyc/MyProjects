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
      <h2 style="margin-bottom: 0px;">Guestbook</h2>
      
      <div style="float: right;"><a href="./?view=guestbook&sign=1">Sign our Guestbook</a></div>
      <br />
    
<?php
$q = "SELECT `author`, `message` FROM `guestbook` WHERE `status` = '1' ORDER BY `date` DESC LIMIT 5";
$query = mysql_query($q);


while ($r = mysql_fetch_array($query)) {
echo $r['author'] . " says:<br>";
echo $r['message'];
echo "<br><br>";
}
?>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>

