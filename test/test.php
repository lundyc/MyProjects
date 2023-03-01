<?php
if (isset($_GET['action'])) {
	
function printIssue()
{
	$your_printer_name = "EPSON LX-300";
	$handle=printer_open($your_printer_name);
//set the font characteristics here
	$font_face = "Draft Condensed";
	$font_height = 20;
	$font_width = 6;
$font=printer_create_font($font_face,$font_height,$font_width,PRINTER_FW_THIN,false,false,false,0);
printer_select_font($handle,$font);
printer_write($handle,"My PDF file content below");
//here loop through your pdf file and print the line by line or else get the entire content inside the string at once and print
$your_pdf_file = "somethng.pdf";
	if(!eof($file_handle))
	{
		//do something
		printer_write($handle,$name);
	}
	printer_delete_font($font);
	printer_close($handle);
}

return "success";
} else {
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML>
   <HEAD>
      <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=windows-1252">
      <TITLE></TITLE>
      <META NAME="GENERATOR" CONTENT="OpenOffice 4.1.1  (Win32)">
      <META NAME="AUTHOR" CONTENT="Subway Irvine">
      <META NAME="CREATED" CONTENT="20160113;16014398">
      <META NAME="CHANGEDBY" CONTENT="Subway Irvine">
      <META NAME="CHANGED" CONTENT="20160219;9114890">
      <!-- Doc.Information -->
      <!-- Printed: by Subway Irvine on 19/02/2016, 09:11:35 -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script>
         $(document).ready(function(){
         	function formatCurrency(total) {
             var neg = false;
             if(total < 0) {
                 neg = true;
                 total = Math.abs(total);
             }
             return (neg ? "-&pound;" : '&pound;') + parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
         }
         	
             $("button").click(function(e){
         		$('.defaultInput').removeClass('error');
				   e.preventDefault();
         		
         		if ($('#employee').val() == '') {
         		$('#employee').addClass('error');
         		alert("Please enter your name.");
         		return false;
         		} else
         		
         		if ($('#bread').val() == '') {
         			 $('#bread').addClass('error');
         		alert("Please enter the bread count.");
         		return false;
         		} else 
         		
         		if ($('#flatbread').val() == '') {
         			 $('#flatbread').addClass('error');
         			alert("Please enter the Flatbread count.");
         			return false;
         		} else {	
         		$('.defaultInput').removeClass('error');
                 $("button").hide();
         		
         		   var total = 0;
             $('.sum').each(function() {
                 total += Number($(this).val());
             });
         	
         	
         	
         	var change = 0;
         	if (total > 200) {
         		change = total - 200;		
         	}
         	
			    $.ajax({
                url: "index.php?action=save",
                type: 'post',
                dataType: 'json',
                data: $("#myform").serialize(),
                success: function(data) {
					$("#total").append(formatCurrency(total));
                    	$("#cashdrop").append(formatCurrency(change));
                }
        });
			
         
         	}
             });
         });
      </script>
      <STYLE>
         <!-- 
            BODY,DIV,TABLE,THEAD,TBODY,TFOOT,TR,TH,TD,P,input { font-family:"Arial"; font-size: 16pt; }
             -->
         .defaultInput
         {
         width: 100%;
         }
         .error
         {
         border:1px solid red;
         }
         table {
         width: 100%;
         padding: 0;
         margin: 5;
         }
         td { width: 50%; }
         .stotal { font-size: 20pt; font-weight: bold;}
      </STYLE>
   </HEAD>
   
   <form name="myform" id="myform" method="post">
   <table>
      <tr>
         <td style="width: 25% !important; font-weight: bold;" BGCOLOR="#FFFF99">Name</td>
         <td style="width: 25% !important;"><input id="employee" type="text" name="employee" class="defaultInput"></td>
         <td style="width: 25% !important; font-weight: bold;" BGCOLOR="#FFFF99">Bread Count</td>
         <td style="width: 25% !important;"><input id="bread" type="text" name="bread" class="defaultInput"></td>
      </tr>
      <tr>
         <td colspan="2"></td>
         <td style="width: 25% !important; font-weight: bold;" BGCOLOR="#FFFF99">FlatBread Count</td>
         <td style="width: 75% !important;"><input id="flatbread" type="text" name="flatbread" class="defaultInput"></td>
      </tr>
   </table>
   <table>
      <tr>
         <td ALIGN=CENTER BGCOLOR="#FFFF99">CASH</td>
         <td ALIGN=CENTER BGCOLOR="#FFFF99">AMOUNT</td>
      </tr>
      <tr>
         <td align="center">&pound;50.00</TD>
         <td><input class="sum" type="text" name="50q" id="50q"></td>
      </tr>
      <tr>
         <td align="center">&pound;20.00</TD>
         <td><input class="sum"  type="text" name="20q" id="20q"></td>
      </tr>
      <tr>
         <td align="center">&pound;10.00</TD>
         <td><input class="sum"  type="text" name="10q"></td>
      </tr>
      <tr>
         <td align="center">&pound;5.00</TD>
         <td><input class="sum"  type="text" name="5q"></td>
      </tr>
      <tr>
         <td align="center">&pound;1.00</TD>
         <td><input class="sum" type="text" name="1q"></td>
      </tr>
      <tr>
         <td align="center">&pound;0.50</TD>
         <td><input class="sum" type="text" name="50p"></td>
      </tr>
      <tr>
         <td align="center">&pound;0.20</TD>
         <td><input class="sum" type="text" name="20p"></td>
      </tr>
      <tr>
         <td align="center">&pound;0.10</TD>
         <td><input class="sum" type="text" name="10p"></td>
      </tr>
      <tr>
         <td align="center">&pound;0.05</TD>
         <td><input class="sum" type="text" name="5p"></td>
      </tr>
      <tr>
         <td align="center">&pound;0.02</TD>
         <td><input class="sum" type="text" name="2p"></td>
      </tr>
      <tr>
         <td align="center">&pound;0.01</TD>
         <td><input class="sum" type="text" name="1p"></td>
      </tr>
      <tr>
         <td align="center">Change Fund</TD>
         <td><input class="sum" type="text" name="change"></td>
      </tr>
   </table>
   <table >
      <tr>
         <td class="stotal" style="border-top: 1px solid black;" align="center">Total</TD>
         <td class="stotal" style="border-top: 1px solid black;" id="total">
            <button style="font-size: 30pt; font-weight: bold; padding: 12pt;" name="save">VIEW TOTAL</button>
         </td>
      </tr>
      <tr>
         <td></td>
      </tr>
      <tr>
         <td class="stotal" align="center">Cash Drop</TD>
         <td class="stotal" id="cashdrop"></td>
      </tr>
   </table>
   
   </form>
   <!-- ************************************************************************** -->
   </BODY>
</HTML>
<?php
}
?>