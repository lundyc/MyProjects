<?php
if ($_GET['register'] == 1) {
?>
<table width="100%" border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td height="32" background="images/layout/module_header_bg.jpg"><span class="style5">Error </span><span class="style6"> Register to get access to all the exclusive content!</span> </td>
</tr>
</table>
<center>
<img src="images/layout/register.jpg" />
</center>


<?php
} else {
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td class="listing2_header">
<span class="style5">Error </span><span class="style6">404</span>
</td>
</tr>
</table>

<p>
The page you have requested on this web server no longer exists, or has been moved to a new location. This error message may have occurred for a number of reasons:
</p>

<ul>
<li>The file may have been moved to a new location</li>
<li>The file may have been deleted because it is out of date</li>
<li>The link contained within an external website may be incorrect or out of date</li>
<li>You may have entered an incorrect URL into your browser</li>
<li>Our website may be experiencing problems</li>
</ul>
		
<p>If you believe that we have caused the error please let us know by contacting us at the following email address: admin@spb-fb.co.uk.</p>
<p>Please provide full details on the problems you have experienced and the URL that are trying to access.</p>
<p>You may be able to locate the information you require by entering a query into the search facility provided on this page.</p>

<?php
}
?>