<?php
if(isset($_POST['upload'])) {
$upload = $_FILES['sql'];

if($upload['name'] = "backup.sql") {

		//empty database
		$result = mysql_list_tables($db);

		while ($table = mysql_fetch_row($result)) safe_query("DROP TABLE `".$table[0]."`");

		move_uploaded_file($upload['tmp_name'], 'tmp/'.$upload['name']);
		$new_query = file('tmp/'.$upload['name']);
		foreach($new_query as $query) @mysql_query($query);
		@unlink('tmp/'.$upload['name']);
	echo "SQL-Import successful!";
	}


} else {
?>
<div class='help-box' style="display:" id="fo_content_mem_">
 <img src='images/tabs_main/icon_help.png' alt='help' />
  <h2>
  	<div>Manage Database</div>
  </h2>
 <p>
 	<br />
 	You can select to Import, Export or Optimize the database.
 	<br />
 	&nbsp; </p>
</div>
<br >

<a href="database.php?action=write">Backup Database</a> --- 

  <form method="post" action="" enctype="multipart/form-data">
backup file: <input name="sql" type="file"> <input type="submit" name="upload" value="Upload">

<br /><br />


<div class='tableheaderalt'>Database Overview </div>
<table cellpadding='4' cellspacing='0' width='100%'>
 <tr>
   <td class='tablesubheader' width='50%'>Table</td>
  <td class='tablesubheader' width='50%'>Status</td>
 </tr>

<?php
$result = mysql_list_tables($db);
while ($table = mysql_fetch_row($result)) {

$query = mysql_query("CHECK TABLE `".$table['0']."` ");
$r = mysql_fetch_array($query);

?>
 <tr>
   <td class='tablerow2'><?php echo $table['0']; ?></strong></td>
  <td class='tablerow2'><strong><?php echo $r['Msg_text']; ?></strong></td>
 </tr>
 <?php 
}
?>
</table>
<?php
}
?>