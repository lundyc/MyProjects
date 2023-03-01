<?php
$ext = explode(".", $_GET['img']);

if(array_search('jpg', $ext) OR array_search('JPG', $ext)) {
header ("Content-type: image/jpeg");
if (file_exists("uploads/media/images/" . $_GET['img'])){
$img_handle = imagecreatefromjpeg("uploads/media/images/" .$_GET['img'] ) or die(""); 
imagejpeg ($img_handle);
}

} elseif(array_search('png', $ext) OR array_search('PNG', $ext)) {

header ("Content-type: image/png");
if (file_exists("uploads/media/images/" . $_GET['img'])){
$img_handle = imagecreatefrompng("uploads/media/images/" .$_GET['img'] ) or die(""); 
imagepng ($img_handle);
}



}
?>