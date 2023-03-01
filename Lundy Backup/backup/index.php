<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script>
  $(document).ready(function () {
        $("#staff_name").focus();
 
   	$("#form").on("submit", function(){
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
		
		   var sum = 0;
    $('.price').each(function(i,n) {
		if ($(n).val() != '') { 
        sum += parseInt($(n).val(),10);
		}
    });
		
		$(".total_amount").html(sum);
		$(".cash_drop").html(sum-200);
		
		$("#submit_but").hide();
		$(".messagepop").show();
		
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

		} 
		
		 $.post("post.php", $("#form").serialize(), function(data) {
       // alert(data);
    });
		
		
		
		return false;
 	});
    });
</script>
<script>
(function($) {
    $.fn.enterAsTab = function(options) {
        var settings = $.extend({
            'allowSubmit': false
        }, options);
        $(this).find('input, select, textarea, button').live("keydown", {localSettings: settings}, function(event) {
            if (settings.allowSubmit) {
                var type = $(this).attr("type");
                if (type == "submit") {
                    return true;
                }
            }
            if (event.keyCode == 13) {
                var inputs = $(this).parents("form").eq(0).find(":input:visible:not(:disabled):not([readonly])");
                var idx = inputs.index(this);
                if (idx == inputs.length - 1) {
                    idx = -1;
                } else {
                    inputs[idx + 1].focus(); // handles submit buttons
                }
                try {
                    inputs[idx + 1].select();
                }
                catch (err) {
                   
                }
                return false;
            }
        });
        return this;
    };
})(jQuery);

$("#form").enterAsTab({ 'allowSubmit': true});
</script>

<script>
$(function() {
  $('.close').on('click', function() {
   $(".messagepop").hide();
    return false;
  });
});

$.fn.slideFadeToggle = function(easing, callback) {
  return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
};
</script>
<style>
#total, #cash_drop {
	/* display: none; */
}

input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
//Supports Mozilla
input[type=number] {
    -moz-appearance:textfield;
}

input:focus,
select:focus,
textarea:focus,
button:focus {
    outline: none;
}

#cash { 
width: 60%;
}
td {
	border: 0px;
	height: 30px;
}

input { 
border: 1px dashed #999999;
width: 100%;
height: 30px;
text-align: center;
}
.input_error {
border:.5pt solid #C00000;
  background:#FCE4D6;mso-pattern:#FCE4D6 none
}

body {
		color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
}

.blue {
	padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	background:#DDEBF7;
	mso-pattern:#DDEBF7 none;
	white-space:nowrap;
	}
	.time {padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;

	mso-font-charset:0;
	mso-number-format:"\[$-409\]h\0022\:\0022mm\0022\:\0022ss\0022 \0022AM\/PM\;\@";
	text-align:center;
	vertical-align: middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	}
	.xl77192621 {padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:"\0022 \0022\[$£-809\]\#\,\#\#0\.00\0022 \0022\;\0022-\0022\[$£-809\]\#\,\#\#0\.00\0022 \0022\;\0022 \0022\[$£-809\]\0022-\002200\0022 \0022\;\0022 \0022\@\0022 \0022";
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
	
	a.selected {
  background-color:#1F75CC;
  color:white;
  z-index:100;
}
html, body{ min-height: 100%; }

.messagepop {
    border: solid 1px black;
    position: fixed;
    left: 50%;
    top: 50%;
    background-color: white;
    z-index: 100;
    height: 65%;
    margin-top: -200px;
	display: none;
    width: 50%;
    margin-left: -300px;
}



.popuptab { 
width: 100%;
height: 100% !important;
border: 0;
font-size: 36pt;
}

#popuptab td { 
vertical-align: middle;
}

.messagepop a {
	text-decoration: none;
	color: #000;
}
</style>


<title>Test Page</title>
</head>

<body>
<div class="messagepop">
<table class="popuptab">
 <tr>
   <td colspan="3" class="blue"><strong>Total</strong></td>
  </tr>
 <tr id="total">
    <td width="15%" align="right" valign="middle">&pound;</td>
    <td width="56%" valign="middle" class="total_amount">&nbsp;</td>
  </tr>
   <tr>
   <td colspan="3" class="blue"><strong>Cash Drop</strong></td>
  </tr>
  <tr id="cash_drop">
    <td align="right" valign="middle">&pound;</td>
    <td valign="middle" class="cash_drop">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3" align="center" valign="middle"><a class="close" href="/">Cancel</a></td>
  </tr>

  </table>
</div>

  
<form name="form" id="form" method="post" autocomplete="off">
<table cellpadding="0" cellspacing="2" id="cash">
<tr>
<td height=27 colspan="2" class="blue">Name</td>
<td colspan="2"><input name="staff_name" type="text" id="staff_name" value="" placeholder="Enter your Name" ></td>
    </tr>
  <tr class="blue">
    <td height="43" colspan="2">Cash</td>
    <td colspan="2">Count</td>
    </tr>
  <tr height=27 style='height:20.25pt'>
    <td width="7%" height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
    <td width="22%" class=xl77192621 style='height:20.25pt'>50.00</td>
    <td colspan="2" class=xl78192621><input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="50n" name="50n" ></td>
    </tr>
  <tr height=27 style='height:20.25pt'>
    <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
    <td class=xl77192621 style='height:20.25pt'>20.00</td>
    <td colspan="2" class=xl78192621><input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="20n" name="20n" ></td>
    </tr>
  <tr height=27 style='height:20.25pt'>
    <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
    <td class=xl77192621 style='height:20.25pt'>10.00</td>
    <td colspan="2" class=xl78192621><input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="10n" name="10n" ></td>
    </tr>
  <tr height=27 style='height:20.25pt'>
    <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
    <td class=xl77192621 style='height:20.25pt'>5.00</td>
    <td colspan="2" class=xl78192621><input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="5n" name="5n" ></td>
    </tr>
  <tr height=27 style='height:20.25pt'>
    <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
    <td class=xl77192621 style='height:20.25pt'>1.00</td>
    <td colspan="2" class=xl78192621><input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="1pound" name="1pound" ></td>
    </tr>
  <tr height=27 style='height:20.25pt'>
    <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
    <td class=xl77192621 style='height:20.25pt'>0.50</td>
    <td colspan="2" class=xl78192621><input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="50p" name="50p" ></td>
    </tr>
  <tr height=27 style='height:20.25pt'>
    <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
    <td class=xl77192621 style='height:20.25pt'>0.20</td>
    <td colspan="2" class=xl78192621><input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="20p" name="20p" ></td>
    </tr>
  <tr height=27 style='height:20.25pt'>
    <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
    <td class=xl77192621 style='height:20.25pt'>0.10</td>
    <td colspan="2" class=xl78192621><input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="10p" name="10p" ></td>
    </tr>
  <tr height=27 style='height:20.25pt'>
    <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
    <td class=xl77192621 style='height:20.25pt'>0.05</td>
    <td colspan="2" class=xl78192621><input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="5p" name="5p" ></td>
    </tr>
  <tr height=27 style='height:20.25pt'>
    <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
    <td class=xl77192621 style='height:20.25pt'>0.02</td>
    <td colspan="2" class=xl78192621><input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="2p" name="2p" ></td>
    </tr>
  <tr height=27 style='height:20.25pt'>
    <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
    <td class=xl77192621 style='height:20.25pt'>0.01</td>
    <td colspan="2" class=xl78192621><input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="1p" name="1p" ></td>
    </tr>
  <tr height=27 style='height:20.25pt'>
    <td height=27 colspan="2" align="center" style='height:20.25pt'>change</td>
    <td colspan="2" class=xl82192621>
      <input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="change" name="change" >
    </td>
    </tr>
  <tr>
    <td height="5" colspan="2">&nbsp;</td>
    <td colspan="2"></td>
  </tr>
  <tr height=27 style='height:20.25pt'>
    <td height=27 colspan="2" class=blue style='height:20.25pt'>Bread Count</td>
    <td colspan="2" class=xl15192621><input type="number" placeholder="0.00" min="0" max="10000" step="any" value="" id="bread" name="bread" ></td>
    </tr>
  <tr height=27 style='height:20.25pt'>
    <td height=27 colspan="2" class=blue style='height:20.25pt'>Flatbread</td>
    <td colspan="2" class=xl15192621><input type="number" placeholder="0.00" min="0" max="10000" step="any" value="" id="flatbread" name="flatbread" ></td>
    </tr>
 
  <tr height=27 style='height:20.25pt' id="submit_but">
    <td height=27 colspan="2" class=xl15192621 style='height:20.25pt'></td>
    <td colspan="2" class=xl15192621>
      <input type="submit" name="submit" id="submit" value="Submit"></td>
    </tr>
</table>
</form>
</body>
</html>