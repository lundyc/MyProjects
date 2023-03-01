<?php
// -------------------------------------------------------------------------//
// Saltcoats Protestant Boys FB - PHP Portal                                                  //
// http://www.spb-fb.co.uk                                                //
// -------------------------------------------------------------------------//
// This program is free software. you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License.           //
// -------------------------------------------------------------------------//
?>

<div id="header">

<div id="headerleft"></div>

<div id="headermain">

<div id="spbfb">
<a href="/"><img alt="Saltcoats Protestant Boys FB" src="themes/spbfb/images/header/logo.png" width="230" height="177"/></a></div>

<div id="partners">
<div id="btop">
</div>

<div class="daysleft">
<?php 
$r = mysql_fetch_array(mysql_query("SELECT * FROM `parades` WHERE STATUS = '0' ORDER BY `month` ASC LIMIT 1"));

$cdate = mktime($r['hour'], $r['minute'], 0, $r['month'], $r['day'], $r['year']);
$today = date("U");
$difference = $cdate - $today;
if ($difference < 0) { $difference = 0; }
$day = floor($difference/86400);
$days = str_split($day, 1);
$time = date("h:i a", mktime($r['hour'], $r['minute'], 0, $r['month'], $r['day'], $r['year']));

if ($day > 9) {
echo "<span title=\"There is only ".$day." days until the SPB shall be in ".$r['location'].", for the ".$r['name'].".\">";
echo "<img src='themes/spbfb/images/days/".$days[0].".png' width='30' height='42'>";
echo "<img src='themes/spbfb/images/days/".$days[1].".png' width='30' height='42'>";
echo "</span>";
} elseif (($day < 10) || ($day != 0)) {
echo "<span title=\"There is only ".$day." days until the SPB shall be in ".$r['location'].".\">";
echo "<img src='themes/spbfb/images/days/".$day.".png' width='30' height='42'>";
echo "</span>";
} else {
echo "<span title=\"At ".$time." the SPB is in ".$r['location'].".\">";
echo "<img src='themes/spbfb/images/days/".$day.".png' width='30' height='42'>";
echo "</span>";
}


?>
</div>
<div style="float: left; margin-left: 20px; margin-top: 0px;"><a href="http://www.pulseresources.org/MwA_Topsites/in/id=10.html" target="_blank" style="padding-left: 50px;"><img src="themes/spbfb/images/adverts/voteforus.png" width="158" height="70" style="border: 0px;" /></a></div>

<div style="float: left; margin-left: 20px; margin-top: 0px;"><a href="http://www.spiritoftheredhand.net/" target="_blank" style="padding-left: 50px;"><img src="themes/spbfb/images/adverts/redhand.png" width="57" height="68" style="border: 0px;" /></a></div>


<div style='clear: both;'></div>

</div>


<div id="extras" style="display: none;">
<div style="float: left; padding-right: 10px;">
<b>Members:</b> <a class="magenta" href="/members/">831,410</a><br/>
<b>Online:</b> <a class="magenta" href="/online/">6,516</a><br/>
<b>Groups:</b> <a class="magenta" href="/groups/">3,394</a><br/>
</div>
<div style="float: left">
<b>Videos:</b> <a class="magenta" href="/videos/">3,632</a><br/>
<b>Albums:</b> <a class="magenta" href="/albums/">7,055</a><br/>
<b>Files:</b> <a class="magenta" href="/files/">6,549</a><br/>
</div>
<div style="clear: both; margin-bottom: 10px;"></div>
<form method="get" action="/search/">
<input type="hidden" name="a" value="s"/>
<input name="u" size="12" maxlength="12" class="form"/>
<input type="submit" value="Search" class="form"/>
<a href='/feeds/' style='margin-left: 10px;'><img src="http://s.sk-gaming.com/image/rssbig.png" width="16" height="16" alt="RSS"/></a>
</form>

</div>
          

<div style="clear: both;"></div>

</div>
<div id="headerright"></div>

</div>
 
