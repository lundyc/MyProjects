			<!----start-content----->
			<div class="content">
				<div class="wrap">
					<div class="services">
						<div class="service-content">
							<h3>Latest News</h3>
							
<?php
	$query = "SELECT `id`, DATE_FORMAT(`date`, '%W, %M %Y') as `fdate`, (SELECT `realname` FROM `profile` WHERE `poster` = `mid`) as `posterID`, 
				`title`, `MainBody`, `poster` FROM `news` ORDER BY `date` DESC , `OrderBy` DESC limit 10;";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

		if ($result->num_rows == 0) {
			echo "<center>There is currently no news in our database. Please try again later</center>";
		} else {
			$i = 1;
			while($r = $result->fetch_assoc()) {
				echo "<ul>\n";
				echo "<li><span>". $i .".</span></li>\n";
				echo "<li>";
				echo "<p>";
				echo '<a href="#">MANUFACTURING &amp; INDUSTRIAL</a>';
				echo "Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui.";
				echo "</p>";
				echo "</li>";
				echo '<div class="clear"> </div>';
				echo "</ul>";
				$i++;
			}
		}
?>
						</div>
						<div class="services-sidebar">
							<h3>WE PROVIDE</h3>
							 <ul>
							  	<li><a href="#">Lorem ipsum dolor sit amet</a></li>
							  	<li><a href="#">Conse ctetur adipisicing</a></li>
							  	<li><a href="#">Elit sed do eiusmod tempor</a></li>
							  	<li><a href="#">Incididunt ut labore</a></li>
							  	<li><a href="#">Et dolore magna aliqua</a></li>
							  	<li><a href="#">Ut enim ad minim veniam</a></li>
							  	<li><a href="#">Quis nostrud exercitation</a></li>
							  	<li><a href="#">Ullamco laboris nisi</a></li>
							  	<li><a href="#">Ut aliquip ex ea commodo</a></li>
							  	<li><a href="#">Ut enim ad minim veniam</a></li>
					 		 </ul>
<?php
/* TO GET USED LATER
					 		 <h3>ARCHIVES</h3>
					 		 <ul>
					 		 	<li><a href="#">JAN, 2013</a></li>
					 		 	<li><a href="#">FEB, 2013</a></li>
					 		 	<li><a href="#">MAR, 2013</a></li>
					 		 	<li><a href="#">APRIL, 2013</a></li>
					 		 </ul>
*/
?>							 
						</div>
						<div class="clear"> </div>
					</div>
				<div class="clear"> </div>
				</div>
			<!----End-content----->
