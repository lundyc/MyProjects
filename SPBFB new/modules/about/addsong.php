<div class="module"><div class="mb"><h2>
<a style="float: right;" href="javascript:history.back(-1);">Back</a>
Add a Song</h2>
<?php
if ($_POST['action'] == "doadd") {

$title = htmlentities($_POST['title']);
$hymm = (isset($_POST['hymm'])) ? 'yes' : 'no';

if ($_FILES['filename']['error'] == 0) {
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
	
	$_POST['title'] = trim($_POST['title']);
	
	$randName = str_replace($search, $replace, $_POST['title']);
    $filePath = $uploadDir . $randName. '.' .$ext;
	
    $result = move_uploaded_file($tmpName, $filePath);
    if (!$result) {
        echo "Error uploading file";
    exit;
    }
}
}

$filename = ((isset($_FILES['filename']['name'])) && (!empty($_FILES['filename']['name']))) ? $randName. '.' .$ext : $_POST['filename'];

$query = "INSERT INTO `song` (`name`, `file`, `hymm`) VALUES ('".$title."', '".$filename."', '".$hymm."');";

if (!$mysqli->query($query)) {
    echo "INSERT failed: (" . $mysqli->errno . ") " . $mysqli->error;
} 
	
	echo "<p>This song has been added.</p>";
?>
<script>
	window.setTimeout(function() {
    window.location.href = '/about?InfoID=6';
}, 2000);
</script>
<?php
} else {
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
		$('#uploadfile').show();
	});

	$('#fromserver').click(function(){
		$('#selectaction').hide();
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
margin-bottom: 4px;
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

<form action="/about?action=addsong" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="doadd">

<b style="padding-right: 12px;">Title:</b> 
<input name="title" id="title" type="text" value="" style="padding: 2px; width: 75%;"  />
<br /><br />

<b style="padding-right: 12px">Filename:</b>
<span id="filename_text">none selected.</span>
<input name="filename" id="filename" type="hidden" value="" style="padding: 2px; width: 75%;"  />
<input name="filename" id="uploadfile" type="file" style="padding: 2px; width: 75%;"  />
<span id="selectaction">
<span id="localfile" class="select">Upload from my Computer</span> -  
<span id="fromserver" class="select">Select from Server</span>
</span>

<br><br>

<b>A hymm?:</b>
<input type="checkbox" name="hymm" value="yes" style="background: none; border: 2px solid black;"> <small>tick for a Yes.</small>
<br><br>

<div style="text-align: center; margin-top: 4px;">
<input type='submit' value='Add Song' class='realbutton' accesskey='s'> <input type="button" name="Cancel" value="Cancel" id="cancelb" /> 
</div>

<span id="selectfromserver">
<div class="subtitle">Uploaded Songs</div>

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