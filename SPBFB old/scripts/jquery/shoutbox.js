/// Online Users
function waitForMsg(){
$.ajax({            
	   type: "GET",            
	   url: "ajax/onlineusers.php",           
	   async: true,            
	   cache: false,            
	   
	   success: function(data){ 
	$('#onlinecontent').html(data);
	clearTimeout('waitForMsg()');
	   setTimeout('waitForMsg()',  2000);           
	   },           
	   
	   error: function(XMLHttpRequest, textStatus, errorThrown){ $('#messages').html("ERROR: " + textStatus);   
  	clearTimeout('waitForMsg()');
	   setTimeout('waitForMsg()',  2000);    
	   }       
	   
	   });    
};

var lastTime = 0;
var timerID;
function waitForMsg2(){
	$.getJSON("ajax/new_shoutbox.php", {
			  time: lastTime
			  }, 
			  
			  function(response){ 

			     $.each(response, function(i,item){
                             if ( ! $('#msg'+item.id).length ){
		var string = '<div class="post" id="msg' + item.id + '">'
				  + '<span class="PostTime">'+ item.date +'</span>'
				  + '<span class="PostDate">'+ item.date_posted +'</span>'
				  + '<span class="PostNick" style="'+ item.nick_color +'">'+item.nick_name+':</span>'
				  + '<div class="PostMsg">'+item.message+'</span>'
				  +'</div>';
  }
  
  if ($('.post').length > 0 && lastTime > 0){  
  	$('.post:first').before(string).fadeIn('slow');	
  } else {
	$('#shoutcontent').append(string).fadeIn('slow');
  }
  
$('#msg'+item.id).fadeIn('slow');
  
  				 });

lastTime = $('#shoutcontent .post:first .PostTime').text();		 
setTimeout(waitForMsg2, 1000);
			  })
};

waitForMsg2();

$(document).ready(function(){ 
			waitForMsg(); 


$('#form textarea').bind('keydown', function(e) {   
if (e.keyCode == 13 && !e.shiftKey) {

if ($('#form textarea').val().length > 0) {

$.ajax({
type: "POST", 
url: "ajax/sendshout.php", 
data: "message=" + $('#message').val(),							
							
complete: function(data){
clearTimeout(timerID);
waitForMsg2();
}

});

e.preventDefault();	
$('#form textarea').val('');

}else {
	alert("Please enter a message!!");
}

}

});

});