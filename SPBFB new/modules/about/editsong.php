<div class="module"><div class="mb"><h2>
<a style="float: right;" href="javascript:history.back(-1);">Back</a>
Edit Song</h2>

<?php
if ($_POST['action'] == "doadd") {

$title = htmlentities($_POST['title']);
$hymm = (isset($_POST['hymm'])) ? 'yes' : 'no';

if (isset($_POST['filename'])) { 
$filename = $_POST['filename'];
} elseif (isset($_FILES['filename']) && $_FILES['filename']['error'] == 0) { { 

	$fileName = $_FILES['filename']['name'];
    $tmpName = $_FILES['filename']['tmp_name'];
    $fileSize = $_FILES['filename']['size'];
    $fileType = $_FILES['filename']['type'];
	$uploadDir = 'userfiles/mp3/';
	
if ($fileType != 'audio/mpeg' && $fileType != 'audio/mpeg3' && $fileType != 'audio/mp3' && $fileType != 'audio/x-mpeg' && $fileType != 'audio/x-mp3' && $fileType != 'audio/x-mpeg3' && $fileType != 'audio/x-mpg' && $fileType != 'audio/x-mpegaudio' && $fileType != 'audio/x-mpeg-3') {
        echo('<script>alert("Error! You file is not an mp3 file. Thank You.")</script>');
    } else if ($fileSize > '10485760') {
        echo('<script>alert("File should not be more than 10mb")</script>');
    } else if ($rep == 'Say something about your post...') {
    $rep == '';
    } else {
    // get the file extension first
    $ext = substr(strrchr($fileName, "."), 1); 
	
    // make the random file name
	$search = array('\'', '/', ' ', '__', '\\');
	$replace = array('', '', '_', '_', '');
	
	$_POST['title'] = strtolower(trim($_POST['title']));
	
	$randName = str_replace($search, $replace, $_POST['title']);
    $filePath = $uploadDir . $randName. '.' .$ext;

	if(file_exists($filePath)) unlink($filePath);
	
   $result = move_uploaded_file($tmpName, $filePath);
    if (!$result) {
        echo "Error uploading file";
    exit;
    }
	
}
}

}

//$filename = $randName .".". $ext;
$filename = ((isset($_FILES['filename']['name'])) && (!empty($_FILES['filename']['name']))) ? $randName. '.' .$ext : $_POST['filename'];

$query = "UPDATE `song` SET  `name` =  '".$title."', `file` =  '".$filename."', `hymm` = '".$hymm."' WHERE  `song`.`songID` =".$_GET['songID'].";";
if (!$mysqli->query($query)) {
    echo "INSERT failed: (" . $mysqli->errno . ") " . $mysqli->error;
} 
	
	echo "<p>This song has been edited.</p>";
?>
<script>
	window.setTimeout(function() {
    window.location.href = '/about?InfoID=6';
}, 2000);
</script>
<?php
} else {
$query = "SELECT `songID`, `name`, `file`, `hymm` FROM  `song` WHERE `songID` = '".$_GET['songID']."' ";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$r = $result->fetch_assoc();
?>

<script>
$(document).ready(function() {

	$('#cancelb').click(function() {
		$('#uploadfile').hide();
		$('#filename').hide();
		$('#filename_text').hide();
		$('#selectfromserver').hide();
		$('#selectaction').show();
	});

	$('#localfile').click(function(){
		$('#selectaction').hide();
		$('#upload_file').html('<input name="filename" id="uploadfile" type="file" style="padding: 2px; width: 75%;"  />');
		$('#uploadfile').show();
	});

	$('#fromserver').click(function(){
		$('#selectaction').hide();
		$('#local_file').html('<input name="filename" id="filename" type="hidden" value="" style="padding: 2px; width: 75%;"  />');
		$('#filename').show();
		$('#filename_text').show();
		$('#selectfromserver').show();
	});

	$(".insert").click(function () {
		$('#filename_text').show();
		var insertText = $(this).text();
		$('#filename').val(insertText);
		$('#filename_text').html(insertText);
	});

});

</script>

<style>
#filename, #uploadfile, #selectfromserver, #filename_text {
display: none;
}
.insert { 
margin-bottom: 5px;
padding-left: 5px; 
text-decoration: underline;
}

.insert:hover, .select:hover {
cursor: pointer;
}

.select { 
text-decoration: underline;
}
</style>

<form action="/about?action=editsong&songID=<?php echo $_GET['songID']; ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="doadd">

<b style="padding-right: 12px;">Title:</b> 
<input name="title" id="title" type="text" value="<?php echo $r['name']; ?>" style="padding: 2px; width: 75%;"  />
<br /><br />

<b style="padding-right: 12px">Filename:</b>
<span id="filename_text"><?php echo (empty($r['file'])) ? 'none selected' : $r['file']; ?></span>

<span id="local_file"></span>
<span id="upload_file"></span>

<span id="selectaction">
<?php echo $r['file']. " "; ?>
<span id="localfile" class="select">Upload from my Computer</span> -  
<span id="fromserver" class="select">Select from Server</span>
</span>

<br><br>

<b>A hymm?:</b>
<input type="checkbox" name="hymm" value="yes" style="background: none; border: 2px solid black;" <?php echo ($r['hymm'] == "yes") ? 'checked' : ''; ?>> <small>tick for a Yes.</small>
<br><br>

<div style="text-align: center; margin-top: 4px;">
<input type='submit' value='Update Song' class='realbutton' accesskey='s'> <input type="button" name="Cancel" value="Cancel" id="cancelb" /> 
</div>

<span id="selectfromserver">
<div class="subtitle">
Uploaded Songs</div>

<?php 
if ($handle = opendir('userfiles/mp3')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
		?>
		<div id="<?php echo $entry; ?>" class="insert"><?php echo $entry; ?></div>
		 <?php
        }
    }
    closedir($handle);
}
?>
</span>
</form>	  
<?php
}
?>
</div></div>