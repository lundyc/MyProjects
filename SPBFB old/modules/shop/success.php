<?php
// send notification email
	$subject = "[New Order] " . $_SESSION['orderId'];
	$email   = "shop@spb-fb.co.uk";
	//$message = "You have a new order. Check the order detail here \n http://" . $_SERVER['HTTP_HOST'] . WEB_ROOT . 'admin/order/index.php?view=detail&oid=' . $_SESSION['orderId'] ;
	$message = "A new order has been placed, please login to the admin panel to process this order.";
	
	mail($email, $subject, $message, "From: $email\r\nReturn-path: $email");
unset($_SESSION['orderId']);
?>

<div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb2">
      <h2 class="about">Shop</h2>
<p>&nbsp;</p><table width="500" border="0" align="center" cellpadding="1" cellspacing="0">
   <tr> 
      <td align="left" valign="top" bgcolor="#333333"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
               <td align="center" bgcolor="#EEEEEE"> <p>&nbsp;</p>
                        <p>Thank you for shopping with us! We will send the purchased 
                            item(s) immediately. To continue shopping please <a href="index.php">click 
                            here</a></p>
                  <p>&nbsp;</p></td>
            </tr>
         </table></td>
   </tr>
</table>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>
