<?php 
$googlelink = "https://maps.google.co.in/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265";
?>

			<!----start-content----->
			<div class="content">
				<div class="wrap">
					<!---start-contact---->
					<div class="contact">
						<div class="section group">				
				<div class="col span_1_of_3">
					<div class="contact_info">
			    	 	<h3>Find Us Here</h3>
			    	 		<div class="map">
					   			<iframe width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265&amp;output=embed"></iframe><br><small><a href="<?php echo $googlelink; ?>" style="color:#666;text-align:left;font-size:12px">View Larger Map</a></small>
					   		</div>
      				</div>
      			<div class="company_address">
				     	<h3>Company Information :</h3>
						<p>3/2 270 Burnfeild Road</p>
						<p>Mansewood</p>
						<p>Glasgow</p>
				   		<p>Phone: 07758325669</p>

				 	 	<p>Email: <span>william@mobile-smiles.co.uk</span></p>
				   		<p>Follow on: <span>Facebook</span>, <span>Twitter</span></p>
				   </div>
				</div>				
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h3>Contact Us</h3>
					<?php 
					if (isset($_POST['submit'])) {
						
						if (empty($_POST['name'])) {
							echo "Please enter your name.<br>";
						} elseif (empty($_POST['email'])) {
							echo "Please enter your email.<br>";
						} elseif (empty($_POST['mobile'])) {
							echo "Please enter your Mobile Number.<br>";
						} elseif (empty($_POST['message'])) {
							echo "Please enter your message.<br>";
					} else {
						$message = "Name: " . htmlentities($_POST['name']) ."\r\n";
						$message .= "Email: " . htmlentities($_POST['email']) . "\r\n";
						$message .= "Mobile: " . htmlentities($_POST['mobile']) . "\r\n";
						$messatge .= "\r\n\r\n";
						$message .= htmlentities($_POST['message']);
						
						$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
						
						mail("colin@lundy.me.uk", "Website - Contact Us", $message, $headers);

					}	
					} else {
					?>
						<form method="POST">
					    	<div>
						    	<span><label>NAME</label></span>
						    	<span><input name="name" type="text" value=""></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input name="email" type="text" value=""></span>
						    </div>
						    <div>
						     	<span><label>MOBILE.NO</label></span>
						    	<span><input name="mobile" type="text" value=""></span>
						    </div>
						    <div>
						    	<span><label>MESSAGE</label></span>
						    	<span><textarea name="message"> </textarea></span>
						    </div>
						   <div>
						   		<span><input name="submit" type="submit" value="Submit"></span>
						  </div>
					    </form>
						<?php 
					}
					?>
				    </div>
  				</div>				
			  </div>
					</div>
					<!---End-contact---->
				<div class="clear"> </div>
				</div>
			<!----End-content----->
