<div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2 style="margin-bottom: 0px;">Shout Box</h2>

<div id="onlinecontent"></div>  
<div id="shoutcontent"></div>
 

<div class="text_icones">

<span style="float: right;">
<a href="#" id="contentlink" rel="subcontent2"><img src="images/icones/silly.png" /></a>
</span>

<DIV id="subcontent2" class="icones">

<?php
$shout = mysql_query("SELECT `url`, `code` FROM smilies WHERE code != ''");
while($s = mysql_fetch_array($shout)) {
?>
<span style="padding-right: 4px;">
<a href="javascript:addtext('<?php echo $s['code']; ?>')"><img src="images/icones/<?php echo $s['url'];?>" border="0" /></a>
</span>
<?php
}
?>
</DIV>
<form method="post" name="shoutbox" id="form">
<textarea type="text" name="message" id="message" class="text_area"></textarea>
</form>

<script type="text/javascript">
dropdowncontent.init("contentlink", "left-top", 300, "click");

function addtext(code) {
document.shoutbox.message.value += ' '+code;
document.shoutbox.message.focus(); 
dropdowncontent.hidediv('subcontent2');
}
</script>

</div>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>