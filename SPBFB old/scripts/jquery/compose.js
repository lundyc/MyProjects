$(function() {
  $('.error').hide();	

$("#submit_btn").click(function() {
    $('.error').hide();

var senditto = $("#senditto").val();
		if (senditto == "") {
      $("label#senditto_error").show();
      $("input#senditto").focus();
      return false;
    }

		var subject = $("#subject").val();
		if (subject == "") {
      $("label#subject_error").show();
      $("input#subject").focus();
      return false;
    }
		var content = $("textarea#content	").val();
		if (content == "") {
      $("label#content_error").show();
      $("textarea#content").focus();
      return false;
    }
			
		$.ajax({
      type: "POST",
      url: "ajax/sendmsg.php",
      data: 'senditto='+ $("#senditto_hidden").val() + '&subject=' + subject + '&content=' + content,
	  
      success: function() {
$('#sendmsg_form').html("<div id='senditto_msg'></div>");
$('#senditto_msg').html("<img id='checkmark' src='themes/images/admin/tick.png' height='50' width='50' /> Your message has been set").hide().fadeIn(1000);
   
   $('#randomer').fadeOut(1500, function() {
			window.location = "index.php?view=mypanel&action=inbox";							  
	});
   
   }
	  
     });
    return false;
	});
});

$(document).ready(function(){ 
	$("#senditto").focus();	   
});