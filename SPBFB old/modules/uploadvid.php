<?php
if (!$_SESSION['uid']) {
die(redirect("index.php",0));
}
?>

<script type="text/javascript" src="scripts/swfobject.js"></script>
<script type="text/javascript" src="scripts/jquery.uploadify.v2.1.0.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$("#uploadify").uploadify({
		'uploader'       : 'scripts/uploadify.swf',
		'script'         : 'scripts/uploadify.php',

		'cancelImg'      : 'cancel.png',
		'folder'         : 'uploads/videos',
		'queueID'        : 'fileQueue',
		'auto'           : true,
		'multi'          : true,		
		
		'scriptData': {'CAT_ID': '<?php echo addslashes($_GET['name']); ?>'},
		'displayData': 'percentage',
      	'buttonText': 'Choose File(s)',
		

		
		'onComplete' : function(event, queueID, fileObj, response, data) {
			
			res = response.substr(0,5);
			
			if (res == "Error") {
				alert(response);
			} else {
				$('#filesUploaded').append('<div class="viewimg">'+response+'</div>');
				
		//	$('#filesUploaded').append('<div class="viewimg"><img src="../../uploads/thumbs/'+response+'"/></div>'); 
			}
			
		}
	});
});
</script>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Upload a Video</h2>
      
<div style="text-align:center; padding-top: 8px;">
<input type="file" name="uploadify" id="uploadify" />
</div>

<div id="fileQueue"></div>
<div id="filesUploaded"></div>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>