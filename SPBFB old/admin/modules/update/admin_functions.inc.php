<?php
function isactive() {
$timestamp = time();
$timeout = $timestamp-120;

mysql_query("REPLACE INTO `online_users` SET `UserID`='".$_SESSION['uid']."', `page` = '".$_SERVER['QUERY_STRING']."', `lastview` = '".$timestamp."', `ip` = '".ip2long(getip())."';");
mysql_query("DELETE FROM `online_users` WHERE `lastview` < $timeout");

}

function checkquotes($input) {
return (!get_magic_quotes_gpc()) ? trim(addslashes(htmlentities($input, ENT_QUOTES))) : $input;
}

function freeRTE_Preload($content) {
	// Strip newline characters.
	$content = str_replace(chr(10), " ", $content);
	$content = str_replace(chr(13), " ", $content);
	// Replace single quotes.
	$content = str_replace(chr(145), chr(39), $content);
	$content = str_replace(chr(146), chr(39), $content);
	
	$content = str_replace(chr(39), "&#39", $content);
	// Return the result.
	return $content;
}

function redirect($url, $tps)
{
    $temps = $tps * 1000;

    echo "<script type=\"text/javascript\">\n"
    . "<!--\n"
    . "\n"
    . "function redirect() {\n"
    . "window.location='" . $url . "'\n"
    . "}\n"
    . "setTimeout('redirect()','" . $temps ."');\n"
    . "\n"
    . "// -->\n"
    . "</script>\n";
} 

function buttonBB($BBtext) {
?>



<select name="addbbcode20" onChange="bbfontstyle('[color=' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + ']', '[/color]');this.selectedIndex=0;">
      <option style="color:black; background-color: #FAFAFA" value="#444444" class="genmed"  selected>Default</option>
      <option style="color:darkred; background-color: #FAFAFA" value="darkred" class="genmed">Dark Red</option>
      <option style="color:red; background-color: #FAFAFA" value="red" class="genmed">Red</option>
      <option style="color:orange; background-color: #FAFAFA" value="orange" class="genmed">Orange</option>
      <option style="color:brown; background-color: #FAFAFA" value="brown" class="genmed">Brown</option>
      <option style="color:yellow; background-color: #FAFAFA" value="yellow" class="genmed">Yellow</option>
      <option style="color:green; background-color: #FAFAFA" value="green" class="genmed">Green</option>
      <option style="color:olive; background-color: #FAFAFA" value="olive" class="genmed">Olive</option>
      <option style="color:cyan; background-color: #FAFAFA" value="cyan" class="genmed">Cyan</option>
      <option style="color:blue; background-color: #FAFAFA" value="blue" class="genmed">Blue</option>
      <option style="color:darkblue; background-color: #FAFAFA" value="darkblue" class="genmed">Dark Blue</option>
      <option style="color:indigo; background-color: #FAFAFA" value="indigo" class="genmed">Indigo</option>
      <option style="color:violet; background-color: #FAFAFA" value="violet" class="genmed">Violet</option>
      <option style="color:black; background-color: #FAFAFA" value="black" class="genmed">Black</option>
    </select>
  &nbsp;
  <select name="addbbcode27" onChange="bbfontstyle('[size=' + this.form.addbbcode27.options[this.form.addbbcode27.selectedIndex].value + ']', '[/size]');this.selectedIndex=0;">
    <option value="0" selected class="genmed">Font size</option>
    <option value="7" class="genmed">Tiny</option>
    <option value="9" class="genmed">Small</option>
    <option value="12" class="genmed">Normal</option>
    <option value="18" class="genmed">Large</option>
    <option  value="24" class="genmed">Huge</option>
  </select>
  &nbsp;
    
    
<input title="Bold" type="button" class="form_button" name="addbbcode0" value="" style="background-image: url(images/bbcode/text_bold.png); height:16px; width: 16px; border: 0px; " onClick="bbstyle(0, '<?php echo $BBtext; ?>')" />

<input title="Italic" type="button" class="form_button" name="addbbcode2" value="" style="background-image: url(images/bbcode/text_italic.png); height:16px; width: 16px; border: 0px; " onClick="bbstyle('2', '<?php echo $BBtext; ?>')" />
      
 <input title="Underline" type="button" class="form_button" name="addbbcode4" value="" style="background-image: url(images/bbcode/text_underline.png); height:16px; width: 16px; border: 0px; " onClick="bbstyle(4, '<?php echo $BBtext; ?>')" />
 
  <input title="StrikeOut" type="button" class="form_button" name="addbbcode24" value="" style="background-image: url(images/bbcode/text_strikethrough.png); height:16px; width: 16px; border: 0px; " onClick="bbstyle(24, '<?php echo $BBtext; ?>')" />
  
  
 &nbsp;
<input title="Align Left" type="button" class="form_button" name="addbbcode18" value="" style="background-image: url(images/bbcode/text_align_left.png); height:16px; width: 16px; border: 0px; " onClick="bbstyle(18, '<?php echo $BBtext; ?>')" />
<input title="Align Center" type="button" class="form_button" name="addbbcode20" value="" style="background-image: url(images/bbcode/text_align_center.png); height:16px; width: 16px; border: 0px; " onClick="bbstyle(20, '<?php echo $BBtext; ?>')" />
<input title="Align Right" type="button" class="form_button" name="addbbcode22" value="" style="background-image: url(images/bbcode/text_align_right.png); height:16px; width: 16px; border: 0px; " onClick="bbstyle(22, '<?php echo $BBtext; ?>')" />
<input title="List Bullets" type="button" class="form_button" name="addbbcode10" value="" style="background-image: url(images/bbcode/text_list_bullets.png); height:16px; width: 16px; border: 0px; " onClick="bbstyle(10, '<?php echo $BBtext; ?>')" />

<input title="Quote" type="button" class="form_button" name="addbbcode6" value="" style="background-image: url(images/bbcode/quote.png); height:16px; width: 16px; border: 0px; " onClick="bbstyle(6, '<?php echo $BBtext; ?>')" />
<input title="Code" type="button" class="form_button" name="addbbcode8" value="" style="background-image: url(images/bbcode/code.png); height:16px; width: 16px; border: 0px; " onClick="bbstyle(8, '<?php echo $BBtext; ?>')" />

<input title="URL" type="button" class="form_button" name="addbbcode16" value="" style="background-image: url(images/bbcode/link.png); height:16px; width: 16px; border: 0px; " onClick="bbstyle(16, '<?php echo $BBtext; ?>')" />

<input title="Image" type="button" class="form_button" name="addbbcode14" value="" style="background-image: url(images/bbcode/image.png); height:16px; width: 16px; border: 0px; " onClick="bbstyle(14, '<?php echo $BBtext; ?>')" />
<?php
} 

function smiley($textarea)
{
?>
<table width="100" border="0" cellspacing="0" cellpadding="5">
<?PHP
	$columns = "20";
	$rows = "1";
	$i = 0;

	$sql = mysql_query("SELECT * FROM smilies ORDER BY id");
	while ($sm = mysql_fetch_array($sql)){

	($i % $columns) ? $row = FALSE : $row = TRUE;
	if ($i && $row) {echo '</tr></tr>';}
	$i++;
?>	
<td>

<a href="#" onclick="newicon('<?php echo $sm['url']; ?>', '<?php echo $sm['name']; ?>', '<?php echo $textarea; ?>')">
<img src="images/icones/<?php echo $sm['url']; ?>" border="0" title="<?php echo $sm['name']; ?>">
</a>
</td>
<?php
}
?>

</tr>
	</table>
<?php 
} 
?>