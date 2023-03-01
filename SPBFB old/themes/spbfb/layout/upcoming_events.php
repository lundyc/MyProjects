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

<div id="listing1_header"><span>Upcoming</span> Events</div>

<div class="listing1">
<table width="100%" cellspacing="0" class='ipbtable'>
  <?php
$query = mysql_query("SELECT * FROM `parades` WHERE STATUS = '0' ORDER BY `month` ASC LIMIT 3");
$rows = mysql_num_rows($query);

if ($rows == 0) {
echo "<tr><td align=\"center\">no upcoming events</td></tr>";
}

while ($r = mysql_fetch_array($query)) {
$date 	= date("D jS F", mktime(0, 0, 0, $r['month'], $r['day'], $r['year'])); 
$time 	= date("g:i a", mktime($r['hour'], $r['minute'], 0, $r['month'], $r['day'], $r['year'])); 

?>
  <tr>
    <td class="subtitle" colspan="2"><?php echo ucfirst($r['name']); ?></td>
    </tr>
  
  <tr>
    <td class="row1"><strong>Date:</strong></td>
    <td class="row2"><?php echo $date; ?></td>
    </tr>
  
  <tr>
    <td class="row1"><strong>Time:</strong></td>
    <td class="row2"><?php echo $time; ?></td>
    </tr>
  
  <tr>
    <td class="row1"><strong>Location:</strong></td>
    <td class="row2"><?php echo ucfirst($r['location']); ?></td>
    </tr>
  
  <?php
}
?>
  </table>
  </div>

<div style='clear: both;'></div>