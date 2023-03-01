<style type="text/css">
.left-element {
float: left; 
width: 75%; 
   } 

.right-element {
float: left;
text-align: center;
width: 25%; 
   } 

</style>

<div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb2">
      <h2 class="about">Smilies Manager</h2>


<div class="left-element">Some help text here </div>
<div class="right-element"><a class="fancybox" href="addsmile.php">Add Smiley</a></div>



<?php
$q = mysql_query("SELECT * FROM `smilies`");

echo '<table style="width: 100%; padding: 2px; margin: 2px;">';
while ($r = mysql_fetch_array($q)) { 

echo "<tr>";
echo '<td style="width: 10%;">' . $r['code'] . '</td>';
echo '<td style="width: 25%;"><img src="images/icones/' . $r['url'] . '" /> '.$r['url'].'</td>';
echo '<td style="width: 25%;"><a href="editsmile.php?id='.$r['id'].'" class="fancybox">edit</a> - <a href="deletesmile.php?id='.$r['id'].'" class="fancybox">delete</a></td>';
echo "</tr>";
}
echo "</table>";

?>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>
