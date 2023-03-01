<?php
if (!$_SESSION['uid']) {
die(redirect("index.php",0));
}
?>
 <div class="module" id="randomer">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Compose a Message</h2>

<script src="scripts/jquery/jquery.autocomplete.js" type="text/javascript"></script>
<script src="scripts/jquery/compose.js" type="text/javascript"></script>

<div id="sendmsg_form">
<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">

<tr>
<td colspan="2" >
Just type in the Recipient's firstname to search through the members list</td>
</tr>

<tr>
<td width="21%">
<strong>Name</strong>
</td>
<td width="79%">
<label class="error" for="senditto" id="senditto_error">A name is required</label>
<input type="text" name="senditto" id="senditto" size="30" value="" class="text-input" autocomplete="off" />
<input type="hidden" name="senditto_hidden" id="senditto_hidden" value="" />
<script>
var options, a;
jQuery(function(){
  options = {
      serviceUrl: '/ajax/compose.php',
      width: 350,
      delimiter: /(,|;)\s*/,
      deferRequestBy: 0, //miliseconds
	  
	  onSelect: function(value, data){ 
	  $('#senditto_hidden').val(data);
	  },
    };
	

  a = $('#senditto').autocomplete(options);
});

</script>
</td>
</tr>

<tr>
<td width="21%"><strong>Subject</strong></td>
<td width="79%">
<label class="error" for="subject" id="subject_error">A subject is required</label>
<input type="text" name="subject" id="subject" size="30" value="" class="text-input" />
</td>
</tr>

<tr>
<td colspan="2">
      <label class="error" for="content" id="content_error">some content is required</label>
<textarea name="content" id="content" cols="60" rows="25" class="textarea-input" style="width: 99%; overflow:auto;"></textarea>
</td>
</tr>

<tr>
	<td colspan='2' style='text-align: center'>
<input type="submit" name="submit" class="button" id="submit_btn" value="Send Message" />
	</td>
</tr>

</table>

</form>
  </div>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>