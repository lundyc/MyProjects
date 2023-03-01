<table width="100%" cellpadding="0" cellspacing="0" border="1">
<tr>
<td class="tdTops">To Do List </td>
</tr>

<tr>
<td class="tdRowGrey">

<table width="100%" border="0" cellspacing="2" cellpadding="0">
 
<tr>
<td width="40" align="center" rowspan="2">&nbsp;</td>
<td width="100%" colspan="2">
<strong>Contact Us</strong>
</td>
</tr>

<tr>
<td colspan="2">
The contact Us page needs to be on the website with a Contact Form sending to its own section in the website, also maybe have it email the admins saying there is someone wanting to be contacted. This section could have categories for different departments.
</td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2">
<strong>Assigned to: </strong>Lundy
</td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2">
<strong>Completion:</strong> 25%
</td>
</tr>

<tr>
<td>&nbsp;</td>
<td colspan="2" align="left"><hr size="1" width="25%" /></td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2">
<strong>Start Date: </strong>Wednesday 14th January 2009 ~ 12:52pm</td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2">
<strong>Expected Completion: </strong>Saturday 31th January 2009 ~ 11:00pm</td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2"><strong>Task Status: </strong> - <span style="color:#009900;">Active</span></td>
</tr>

<tr>
<td height="10" colspan="3"><hr size="1" width="100%" /></td>
</tr>


<tr>
<td width="40" align="center" rowspan="2">&nbsp;</td>
<td width="100%" colspan="2">
<strong>New Reports Page</strong>
</td>
</tr>

<tr>
<td colspan="2">
Please finish up the New Reports page, adding in the Video's and Pictures section, also look into how the images and videos are managed in the admin section....<br />
<br />
Add in the show hide bit for users who are logged in to view the Comments posted by other members
</td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2">
<strong>Assigned to: </strong>Lundy
</td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2">
<strong>Completion:</strong> 50%
</td>
</tr>

<tr>
<td>&nbsp;</td>
<td colspan="2" align="left"><hr size="1" width="25%" /></td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2">
<strong>Start Date: </strong>Wednesday 14th January 2009 ~ 1:00pm</td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2">
<strong>Expected Completion: </strong>Saturday 28th Febuary 2009 ~ 11:00pm</td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2"><strong>Task Status: </strong> - <span style="color:#009900;">Active</span></td>
</tr>

<tr>
<td height="10" colspan="3"><hr size="1" width="100%" /></td>
</tr>

<tr>
<td width="40" align="center" rowspan="2">&nbsp;</td>
<td width="100%" colspan="2">
<strong>Upcoming Events Page</strong>
</td>
</tr>

<tr>
<td colspan="2">
Need to change the way that the guys in the band can post messages. Maybe make it so they can post more than one entry
</td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2">
<strong>Assigned to: </strong>Lundy
</td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2">
<strong>Completion:</strong> 50%
</td>
</tr>

<tr>
<td>&nbsp;</td>
<td colspan="2" align="left"><hr size="1" width="25%" /></td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2">
<strong>Start Date: </strong>Wednesday 14th January 2009 ~ 1:00pm</td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2">
<strong>Expected Completion: </strong>Saturday 28th Febuary 2009 ~ 11:00pm</td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2"><strong>Task Status: </strong> - <span style="color:#009900;">Active</span></td>
</tr>

<tr>
<td height="10" colspan="3"><hr size="1" width="100%" /></td>
</tr>

</table>
<br />
<br />

<table width="100%" border="0" cellspacing="2" cellpadding="0">
<?php
$q = mysql_query("SELECT `todoID`, `todoTitle`, `todoDesc`, `user`, `percent`, `startDate`, `endDate`, `priority` FROM `todolist` ORDER BY `startDate` DESC") or die(mysql_error());
while(list($todoID,$tdTitle,$tdDesc,$usr,$percent,$sd,$ed,$p) = mysql_fetch_row($q)){
					
//priority
if($p == "H"){ $img = "highPriority.gif"; }
if($p == "M"){ $img = "midPriority.gif"; }			
if($p == "L"){ $img = "lowPriority.gif"; }				
?>    
<tr>
<td width="40" align="center" rowspan="2">
<img src="img/<?php echo $img; ?>" width="33" height="33">
</td>
<td width="100%" colspan="2">
<strong><?php echo $tdTitle; ?></strong>
</td>
</tr>

<tr>
<td colspan="2">
<?php echo $tdDesc; ?>
</td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2">
<strong>Assigned to: </strong><?php echo idtoname($usr); ?>
</td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2">
<strong>Completion:</strong> <?php echo $percent; ?>% (<a href="update_todo_list.php?todo=<?php echo $todoID; ?>" target="content">update</a>)
</td>
</tr>

<tr>
<td>&nbsp;</td>
<td colspan="2" align="left"><hr size="1" width="25%" /></td>
</tr>

<tr>
<td align="center">&nbsp;</td>
<td colspan="2">
<strong>Start Date: <?php echo date("l jS of F Y",$sd); ?></strong>
</td>
                    </tr>
                    <tr>
                      <td align="center">&nbsp;</td>
                      <td colspan="2"><strong>Expected Completion: <?php echo date("l jS of F Y",$ed); ?></strong></td>
                    </tr>
                    <tr>
                      <td align="center">&nbsp;</td>
                      <td colspan="2"><strong>Task Status: </strong> - <span style="color:#009900;">Active</span></td>
                    </tr>
                    <tr>
                      <td height="10" colspan="3"><hr size="1" width="100%" /></td>
                    </tr>
				<?php
					}
				?>
                  </table></td>
            </table>