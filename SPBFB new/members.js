   $('.updateo').click(function(){
      $('.myclassname .name').hide();
      $('.myclassname .form').show();
      return false;
   });
   
      $('#savenow').click(function(){
	  $('form#officers').submit();
     // $('.myclassname .name').show();
     // $('.myclassname .form').hide();
      return false;
   });
   
   $('#shoutform textarea').bind('keydown', function(e) {   
if (e.keyCode == 13 && !e.shiftKey) {

if ($('#shoutform textarea').val().length > 0) {

$.ajax({
type: "POST", 
url: "sendshout.php", 
data: "message=" + $('#message').val(),							
							
complete: function(data){
clearTimeout(timerID);
waitForMsg2();
}

});

e.preventDefault();	
$('#shoutform textarea').val('');
}else {
	alert("Please enter a message!!");
}

}

});

/// Online Users
function waitForMsg(){
$.ajax({            
	   type: "GET",            
	   url: "onlineusers.php",           
	   async: true,            
	   cache: false,            
	   
	   success: function(data){ 
	$('#onlinecontent').html(data);
	clearTimeout('waitForMsg()');
	   setTimeout('waitForMsg()',  10000);           
	   },           
	   
	   error: function(XMLHttpRequest, textStatus, errorThrown){ $('#messages').html("ERROR: " + textStatus);   
  	clearTimeout('waitForMsg()');
	   setTimeout('waitForMsg()',  10000);    
	   }       
	   
	   });    
};


var lastTime = 0;
var timerID;
function waitForMsg2(){

$.getJSON("get_shouts.php", {
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
setTimeout(waitForMsg2, 10000);
})
};
