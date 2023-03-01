 $(document).ready(function() {
   $("#staff_name").focus();

   $("#form").on("submit", function() {
     var error = 0;
     $("#staff_name").removeClass("input_error");
     $("#bread").removeClass("input_error");
     $("#flatbread").removeClass("input_error");

     if ($.trim($('#staff_name').val()) == "") {
       $('#staff_name').addClass("input_error");
       error = 1;
     }
     if ($.trim($('#bread').val()) == "") {
       $('#bread').addClass("input_error");
       error = 1;
     }
     if ($.trim($('#flatbread').val()) == "") {
       $('#flatbread').addClass("input_error");
       error = 1;
     }

     if (error == 0) {

       $(function() {
         var content = $('input').val();
		
		 
         $('.price').keyup(function() {
           if ($(this).val() != content) {
             content = $(this).val();
             $("#submit_but").show();
             $(".messagepop").hide();
           }
         });

         $('#staff_name').keyup(function() {
           if ($(this).val() != content) {
             content = $(this).val();
             $("#submit_but").show();
             $(".messagepop").hide();
           }
         });

         $('#bread').keyup(function() {
           if ($(this).val() != content) {
             content = $(this).val();
             $("#submit_but").show();
             $(".messagepop").hide();
           }
         });

         $('#flatbread').keyup(function() {
           if ($(this).val() != content) {
             content = $(this).val();
             $("#submit_but").show();
             $(".messagepop").hide();
           }
         });
       });

           var sum = 0;
       $('.price').each(function(i, n) {
         if ($(n).val() != '') {
           sum = sum + parseFloat($(n).val());
         }
       });

		var total_amount = sum.toFixed(2);
		var cash_drop = (total_amount - 200).toFixed(2)
	
       $(".total_amount").html(total_amount);
       $(".cash_drop").html(cash_drop);
	   $(".bread_total").html($("#bread").val());
	   $(".flatbread_total").html($("#flatbread").val());
	   
       $("#submit_but").hide();
       $(".messagepop").show();
	   
	     $.post("post.php", $("#form").serialize(), function(data) {
		
     });
	   
     }

   

     return false;
   });
 });
