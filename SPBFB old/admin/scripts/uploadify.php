<?php
include("../_mysql.php");
include("../_functions.php");
include("../_settings.php");

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = "/home/spbfb/public_html/uploads/gallery/tmp/";
	$ext = strtolower(substr($_FILES['Filedata']['name'], strrpos($_FILES['Filedata']['name'],".")));
	$newfilename = rand(time(), time()+rand(1,100)).$ext;
	$targetFile =  $targetPath . $newfilename;	
	
	move_uploaded_file($tempFile, $targetFile);					// this works 
	
	exec("chmod 0777 ../../uploads/gallery/tmp/". $newfilename . " 2>&1");
	
 switch ($_FILES['Filedata']['error'])
{     
    case 0:
             $msg = 1; 
             break;
     case 1:
              $msg = "The file is bigger than this PHP installation allows";
              break;
      case 2:
              $msg = "The file is bigger than this form allows";
              break;
       case 3:
              $msg = "Only part of the file was uploaded";
              break;
       case 4:
             $msg = "No file was uploaded";
              break;
       case 6:
             $msg = "Missing a temporary folder";
              break;
       case 7:
             $msg = "Failed to write file to disk";
             break;
       case 8:
             $msg = "File upload stopped by extension";
             break;
       default:
            $msg = "unknown error ".$_FILES['Filedata']['error'];
            break;
}

if ($msg != 1) {
echo "Error: ".$_FILES['Filedata']['error']." Error Info: ".$msg;
} else {

$scale = '640x480';
$thumb_scale = '150x112';
$imagename = '/home/spbfb/public_html/uploads/gallery/tmp/'. $newfilename;
$thumb = '/home/spbfb/public_html/uploads/gallery/thumbs/'. $newfilename;

exec("/usr/bin/convert -resize $scale $targetFile -thumbnail $thumb_scale $thumb", $return); 
exec("/usr/bin/convert $imagename -resize $scale\> $targetFile", $return2);
exec("mv $imagename /home/spbfb/public_html/uploads/gallery/". $newfilename, $return3);

if (file_exists("/home/spbfb/public_html/uploads/gallery/". $newfilename)) {
	
mysql_query("UPDATE `gallery_categories` SET `thumb` = '".$newfilename."' WHERE `cid` = '".$_REQUEST['CAT_ID']."' LIMIT 1 ;") or die("Error: " . mysql_error());
mysql_query("INSERT INTO `gallery` (`filename`, `category`, `added`) VALUES ('".$newfilename."', '".$_REQUEST['CAT_ID']."', '".date("Y-m-d")."')") or die("Error: " . mysql_error());

echo $newfilename; 
} else {
	echo "Error: The file cannot be found";
}

}

}
?>