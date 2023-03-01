<?php 
$googlelink = "https://goo.gl/maps/ps2SgZbm3eC2";
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
					   			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2241.994568505943!2d-4.307849484979501!3d55.810694680568865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x488847c9ff2faa77%3A0xdffb45301f753653!2s270+Burnfield+Rd%2C+Glasgow+G43+1ED%2C+UK!5e0!3m2!1sen!2sus!4v1511902928576" width="100%" height="175" frameborder="0" style="border:0" allowfullscreen></iframe><br><small><a href="<?php echo $googlelink; ?>" style="color:#666;text-align:left;font-size:12px">View Larger Map</a></small>
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
						$message .= "\r\n\r\n";
						$message .= htmlentities($_POST['message']);
						
						mail("william@mobile-smiles.co.uk", "Website - Contact Us", $message);

						echo "Your message has been sent. We aim to reply to all enquiries within 24 hours";
						
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
