<script type="text/javascript" src="scripts/jquery.js"></script>
<script src="scripts/jquery.effects.core.js"></script>
<script src="scripts/jquery.effects.slide.js"></script>

<?php
include_once("_mysql.php");

$link = mysql_connect($host, $user, $pwd);
mysql_select_db($db) or die('ERROR: Can not connect to database "'.$db.'"');

if (isset($_POST['submit'])) {
mysql_query("UPDATE `smilies` SET `code` = '".$_POST['code']."', `url` = '".$_POST['image']."' WHERE id =".$_GET['id']." LIMIT 1 ;");
?>
<div style="text-align:center;">
Updated
</div>

<script type="text/javascript">
setTimeout('parent.$.fancybox.close()', 2000);   
</script>
<?php
} else {

$q = mysql_query("SELECT * FROM `smilies` WHERE id = '".$_GET['id']."'");
$r = mysql_fetch_array($q);
?>

<script type="text/javascript">
$(document).ready(function(){
	$('div #icones').hide();							
	
	 $('#smiler').click(function(){		
	 $('#smile').hide("slide", { direction: "down" }, 100);
	 $('#icones').show("slide", { direction: "up" }, 200);		
	 });
	
	
		 $('img').click(function(){	
			$("#image_url").val('');	
			$("#image_url").val($(this).attr("title"));	
			$('#icones').hide("slide", { direction: "up" }, 100);		
			$('#smile').show("slide", { direction: "down" }, 300);
		});
});


</script>

<style>
#smile table {
	width: 100%;
	padding: 0; 
	margin: 0;
}

#smile a {
	text-decoration:underline;
	color: #222;
	cursor: pointer;
}

#smile a:hover {
	cursor: pointer;
	color: #5f6069;
}

#smile td {
	width: 50%;
	font-weight: bold;
}

#smile .center {
	text-align: center;
}

#icones {
	display: none;
}

.smile_img {
	padding-right: 4px;
	cursor: pointer;
}
</style>

<div id="icones">

<?php
$dirname = "images/icones";
$images = scandir($dirname);
$ignore = Array(".", "..");
foreach($images as $curimg){
	
if(!in_array($curimg, $ignore)) {
echo '<img class="smile_img" src="images/icones/'.$curimg.'" title="'.$curimg.'" border="0" />';
}

}
?>
</div>

<form id="smile" method="post" action=""> 

<table>
<tr>
<td>Current Icon:</td>
<td><img src="images/icones/<?php echo $r['url']; ?>" /></td>
</tr>

<tr>
<td>Image:</td>
<td><input id="image_url" type="text" value="" name="image" autocomplete="off" /> <a id="smiler" />Find</a></td>
</tr>

<tr>
<td>Keyboard Shortcut:</td>
<td><input type="text" value="<?php echo $r['code']; ?>" name="code" autocomplete="off" /> </td>
</tr>

<tr>
<td colspan="2" class="center"><input type="submit" name="submit" value="Save Smiley" /></td>
</tr>
</table>

</form>
<?php
}
?>