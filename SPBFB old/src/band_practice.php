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
      <h2>Next Band Practice</h2>
    <div class="featBanner">
	
<?php
$r = mysql_fetch_array(mysql_query("SELECT * FROM `next_practice` WHERE id = '1'"));

?>
<div style="font-size:21px; font-weight:700; text-transform:uppercase; padding-bottom:6px;">
<?php echo date("l", $r['date']); ?>
</div>
<div style="font-size: 16px; font-weight:bold;"><?php echo date("jS F Y", $r['date']); ?></div>
<div style="font-size: 14px; font-weight:bold;">@ <?php echo date("g:i a", $r['date']); ?></div>

	</div>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>

