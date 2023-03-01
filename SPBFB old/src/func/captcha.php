<?php
class Captcha {
	
	var $hash;
	var $length = 5;
	var $type;
	var $noise = 100;

	function captcha() {
		if(function_exists('imagecreate')) $this->type='g';
		else $this->type='t';
		$this->type='g';
	}
	
	function create_captcha() {

		$this->hash = md5(time().rand(0, 10000));

		$captchastring='';
		
		if($this->type=='g') {

			$imgziel = imagecreatetruecolor(($this->length*20), 15);
			$bgcolor = imagecolorallocate($imgziel, 255, 255, 255);
			$fontcolor = imagecolorallocate($imgziel, 50, 50, 50);
			$xziel = imagesx($imgziel); 
			$yziel = imagesy($imgziel); 
			imagefilledrectangle($imgziel, 0, 0, $xziel, $yziel, $bgcolor);

			for($i=0;$i<$this->length;$i++) {
				$int=rand(0,9);
				$captchastring.=$int;
				imagestring($imgziel, rand(3,5), $i*20, 0, $int, $fontcolor);
			}		
			
			for($i=0;$i<$this->noise;$i++) {
				imagesetpixel($imgziel, rand(6,$xziel), rand(0,$yziel), $fontcolor);
			}
			
			imagejpeg($imgziel, 'tmp/'.$this->hash.'.jpg');
			$captcha = '<img src="tmp/'.$this->hash.'.jpg" border="0" alt="Security Code">';
			
		} elseif($this->type=='t') {
			
			for($i=0;$i<$this->length;$i++) {
				$captcha .= rand(0,9);			
			}	
			$captchastring=$captcha;
		}
		mysql_query("INSERT INTO `captcha` (`hash`, `captcha`, `deltime`) VALUES ('".$this->hash."', '".$captchastring."', '".(time()+(3*60))."');");
		return $captcha;		
	}
	
	function get_hash() {
		
		return $this->hash;
		
	}
	
	function check_captcha($input,$hash) {
		if(mysql_num_rows(mysql_query("SELECT hash FROM `captcha` WHERE captcha='".$input."' AND hash='".$hash."'"))) {
			mysql_query("DELETE FROM `captcha` WHERE captcha='".$input."' AND hash='".$hash."'");
			$file='tmp/'.$hash.'.jpg';
			if(file_exists($file)) @unlink($file);
			return true;
		}
		else return false;
	}
	
	function clear_oldcaptcha() {
		$ergebnis=mysql_query("SELECT hash FROM `captcha` WHERE deltime<".time());
		while($ds=mysql_fetch_array($ergebnis)) {
			$file='tmp/'.$ds['hash'].'.jpg';
			if(file_exists($file)) @unlink($file);
		}	
		mysql_query("DELETE FROM `captcha` WHERE deltime<".time());
	}
}
?>