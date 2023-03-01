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
<script type="text/javascript" src="scripts/dropdowncontent.js"></script>

<script language="javascript" type="text/javascript">
function addtext(code) {
document.shoutbox.message.value += ' '+code;
document.shoutbox.message.focus(); 
dropdowncontent.hidediv('subcontent2');
}
</script>

<style>
	.shoutbox {
		height: 390px; overflow: auto; word-wrap:break-word; width:65%;
	}
</style>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2 style="margin-bottom: 0px;">Shout Box</h2>

<div id="onlineusersarea" style="float: right; width:35%;"></div>
<div id="list" class="shoutbox"></div>

<form id="shout" name="shoutbox" method="post">

<div style="padding: 2px; display:block">

<table width="100%" border="0" cellpadding="1" cellspacing="0">
<tr>
<td width="95%" rowspan="2">
<textarea type="text" name="message" id="message" style="width: 95%; height: 80px; overflow: auto; border: 1 px solid blue;"></textarea></td>
<td width="5%" align="center" valign="top">

<a href="" id="contentlink" rel="subcontent2"><img src="images/icones/biggrin.gif" /></a> </p>
<DIV id="subcontent2" style="position:absolute; visibility: hidden; border: 2px solid #999; background-color: lightyellow; width: 400px; height: 300px; padding: 5px;">

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

<script type="text/javascript">
dropdowncontent.init("contentlink", "left-top", 300, "click");

var saveData = function() {
$('shout').set('send', {
url: 'mootools/sendshout.php',

onComplete: function(){
doRefresh();
}

}).send();
};

$('message').addEvent('keydown', function(event){
  if (event.key == 'enter' && !event.shift) {

if ($('message').value.length > 0) {

saveData();
event.preventDefault();	
$('message').set('value', '');
} else {
	alert("Please Enter something....");
}
  }
});
</script>
</td>
</tr>
</table>
</div>
</form>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>

