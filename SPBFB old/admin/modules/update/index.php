<div class='homepage_pane_border'>
<div class='homepage_section'>Update MYSQL Database</div>
<table width='100%' cellspacing='0' cellpadding='4' id='common_actions'>
<tr>
<td width='33%' valign='top'>
<?php
$lines = file('database.sql');

// Loop through our array, show HTML source as HTML source; and line numbers too.
foreach ($lines as $line_num => $line) {
   echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
}
?>
</td>

</tr>
</table>
</div>
