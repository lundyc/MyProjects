$(function() {
$("#submit_btn").click(function() {
			
		$.ajax({
      type: "POST",
      url: "ajax/sendmsg.php",
	  data: 'reply=yes&id=' + $("#msgid_hidden").val() + '&senditto='+ $("#senditto_hidden").val() + '&subject=' + $("#subject_hidden").val() + '&content=' + $("#msg_content").val(),
	  	  
      success: function(reply) {
$('#new_msg').html(reply).fadeIn(3000);

$('#msg_content').val('');
   }
	  
     });
    return false;
	});
});

$(document).ready(function(){ 
	$("#content").focus();	   
});