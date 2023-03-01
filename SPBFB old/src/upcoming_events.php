<?php
// -------------------------------------------------------------------------//
// Saltcoats Protestant Boys FB - PHP Portal                                                  //
// http://www.spb-fb.co.uk                                                //
// -------------------------------------------------------------------------//
// This program is free software. you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License.           //
// -------------------------------------------------------------------------//

if ($_GET['view'] != "upcoming") {
?>
 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2 style="margin-bottom: 0px;">Upcoming Events</h2>
<table width="100%">
  <?php
$query = mysql_query("SELECT  `start_date` ,  `start_time` ,  `ID` ,  `title` ,  `where` 
FROM  `new_events` 
WHERE STATUS =  'Upcoming'
ORDER BY  `start_date` ASC 
LIMIT 5");
$rows = mysql_num_rows($query);

if ($rows == 0) {
echo '<tr><td align="center">no upcoming events</td></tr>';
}

while ($r = mysql_fetch_array($query)) {
$date 	= date("D jS F", strtotime($r['start_date'])); 
$time 	= date("g:i a", strtotime($r['start_time'])); 

?>
  <tr>
    <td class="subtitle" colspan="2">
	<a href="./?view=events&action=details&EventID=<?php echo $r['id']; ?>" style="text-decoration:none;">
	<?php echo ucfirst($r['title']); ?>
    </a>
    </td>
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
    <td colspan="2" class="row2"><?php echo ucfirst($r['where']); ?></td>
    </tr>
    
  
  <?php
}
?>
  </table>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>

<?php
}
?>
