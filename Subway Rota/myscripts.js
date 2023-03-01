$(document).ready(function(){
	$('#print').click(function() {
		$('#nav').hide();
		window.print();
		$('#nav').show();
		return false;
	});
	
	$('td .time').bind('click', function () {
	    $(this).hide().next('form').show();
	});


	$('.save').bind('click', function (e) {
        var $elem = $(this).parent();
	    e.preventDefault();
		
	    $.ajax({
	        url: 'save.php',
	        type: 'post',
	        dataType: 'json',
	        data: $(this.form).serialize(),

	        complete: function (data) {
	            $elem.hide().prev('span').html(data.responseText).show();
	        }
	    });
	});
});