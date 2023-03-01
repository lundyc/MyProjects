<?php
echo "<pre>";
$filename = "Expanded WISR (34124) 2017-09-26.html";

$input = @file_get_contents("uploads/". $filename) or die("Could not access file: $address");
$line = preg_replace('/(&nbsp;|<br>)+/', ' ',$input);

if(preg_match('/<td valign="top">.*<\/td>/', $line, $first_match)) {
	if(preg_match_all('/(\s+\w*\s*\-*\.*\(*\w*\)*\s)(kg|ct|l)+(\s*\d*\.+\d*){5}/i', $first_match[0], $second_match)) {
		
		foreach($second_match[0] as $v) {
			$list = explode(" ", preg_replace('/(kg|ct|l)+(\s*\d*\.+\d*){3}/i','',$v));
			echo "N: " . $list[1] . " - Left: " . $list[3] . " - Used: " . $list[4] . "<br>";
		}
	}
}






echo "<br>";



	

if ($file = fopen("uploads/". $filename, "r")) {
		
    while(!feof($file)) {
		
        $line = fgets($file);
		$line = preg_replace('/(&nbsp;|<br>)+/', ' ',$line);	
		$pieces = explode(" ", $line);	
		
		foreach( $pieces as $key => $value ) {
			$testData[$key] = $pieces[$key];
			// Week Ending Date
			if($pieces[$key] == 'To' && $pieces[$key+1] == 'Date' ) {
			echo "Date: " .date("Y-m-d", strtotime($pieces[$key+2]))."<br>";
			}
			// COST OF GOODS
			if ($pieces[$key] == '[**]COST') {
			echo "Cost of Goods: " . $pieces[$key+3]; 
			}
			// Net Sales
			if ($pieces[$key] == "[!]NET" && $pieces[$key+1] == "SALES") {
			echo "<br>Net Sales: " . $pieces[$key+2] . "<br>";
			break;
			}	
			
			// Grab Product
			//echo "O = " . preg_grep("/(\d*\.?\d*)+\s*(\w*\s*\w*)\s*(kg|ct|l)\s*(\d*\.?\d*){5}/", $pieces) ."<br>";
		}
    }
    fclose($file);
}	
?>