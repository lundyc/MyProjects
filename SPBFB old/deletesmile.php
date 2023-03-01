<?php
include_once("_mysql.php");

$link = mysql_connect($host, $user, $pwd);
mysql_select_db($db) or die('ERROR: Can not connect to database "'.$db.'"');

if (isset($_POST['submit'])) {
//mysql_query("UPDATE `smilies` SET `code` = '".$_POST['code']."', `url` = '".$_POST['image']."' WHERE id =".$_GET['id']." LIMIT 1 ;");
?>
<div style="text-align:center;">
Deleted
</div>

<script type="text/javascript">
setTimeout('parent.$.fancybox.close()', 2000);  
</script>
<?php
} else {

$q = mysql_query("SELECT * FROM `smilies` WHERE id = '".$_GET['id']."'");
$r = mysql_fetch_array($q);
?>

<script language="text/javascrpt">
$('.fancyclose').click(function(){ 
parent.top.$('#fancy_close').trigger('click'); 
}); 
</script>

<form id="smile" method="post" action=""> 

<table>

<tr>
<td colspan="2" class="center">
Are you sure you want to delete this smiley?<br />

<input type="submit" name="submit" value="Yes" /> <input type="button" name="close" class="fancyclose" value="No" /></td>
</tr>
</table>

</form>
<?php
}
?>