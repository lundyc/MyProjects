<?php
include "header.php";

session_start();
if (($_SESSION['perm'] < "3"))  {
echo "<font color='#$col_text'>"; die ('You are not authorised to access this section');
}



$max= @mysql_query ("SELECT MAX(news_id) AS maxid FROM news");
	$ID = mysql_fetch_array($max);
	$maxid = $ID['maxid'];
	







?>

<html>

<head>
<title>News Image</title>
</head>


<body>
<center>
<font color="#<?php echo $col_text ?>">


News image can be no larger than 400*400 and no bigger than 100K.
<br>
(File type must be jpeg or gif)
<BR><BR>
<form name="form1" method="post" action="" enctype="multipart/form-data">

<input type="file" name="imagefile">
<br><br>

<input type="submit" name="Submit" value="Submit"> 
<BR><BR>


<?php

if(isset($_POST['Delete']))
{
$getFilePath = "images/news/" . $oldname; //location of file on server
unlink($getFilePath);  //deletes the file on the server
 
$query = "UPDATE news SET news_image = 'none' WHERE news_id = '$fileId'";
@mysql_select_db($db_name) or die( "Unable to select database");
mysql_query($query); 
?> <meta HTTP-EQUIV="Refresh" CONTENT="0; URL=main.php"> <?php

}

if(isset($_POST['Submit']))
{
//If the Submitbutton was pressed do:

 $imagedata = getimagesize($_FILES['imagefile']['tmp_name']);
$width = $imagedata[0];
$height = $imagedata[1]; 

?><BR><?php
$filename = "".$_FILES['imagefile']['name']."";
$dbQuery = "SELECT news_image "; 
$dbQuery .= "FROM news WHERE news_image = '$filename' "; 
$result = mysql_query($dbQuery) or die("Couldn't get file list");
$num=mysql_numrows($result);

if ("$num" >= '1') {
echo "filename already exists, please rename file before uploading";
}
else{

?><BR><BR><?php
echo "picture width "; echo "$width ";
echo "picture height "; echo "$height ";
?><BR><?php

if (($_FILES['imagefile']['size'] <= 100000) && ($width <= 400) && (height <= 400) && ($_FILES['imagefile']['type'] == 'image/jpeg' || $_FILES['imagefile']['type'] == 'image/pjpeg' || $_FILES['imagefile']['type'] == 'image/gif')) 
{

copy ($_FILES['imagefile']['tmp_name'], "images/news/".$_FILES['imagefile']['name'])
    or die ("Could not copy"); 



$query = "UPDATE news SET news_image = '$filename' WHERE news_id = '$maxid'";
@mysql_select_db($db_name) or die( "Unable to select database");
mysql_query($query); 

echo "$filename";
echo "$fileId";
?> <meta HTTP-EQUIV="Refresh" CONTENT="0; URL=main.php"> <?php

        } 


else {
            echo "";
            echo "Could Not Copy, Wrong Filetype, filesize too big or picture dimensions too big (".$_FILES['imagefile']['name'].")";
        }
} 

}
?> </form> 


</body>



