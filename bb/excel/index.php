<?php
include_once ("_mysqli.php");

/*

// start
// get last Friday of the month and count back to the Tuesday

$timestamp1 = strtotime('last fri of this month -2 days -1 month');

// end
// get last Friday of the month and count back to the Tuesday

$timestamp2 = strtotime('last fri of this month -3 days');

// echo date('D F j, Y', $timestamp1) . ' - ' . date('D F j, Y', $timestamp2);

*/
?>
<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="layout.css">
<title>Piperhill Ltd - Payroll</title>

</head>
    <body>
<div id="container">
<header>
<nav>		
		<ul>
		<li><A HREF="#table0">Payroll</A></li>
		<li><A HREF="#table1">History</A></li>
		<li><A HREF="#emp">Employees</A></li>
		<li><A HREF="#settings">Settings</A></li>
		</ul>
</nav>	
<nav>		
		<ul>
		<?php
$query_get_sheets = "SELECT `SheetID`, `Title` FROM `sheets` ORDER BY `SheetID`";
$res_get_sheets = $mysqli->query($query_get_sheets);

while ($sheets = $res_get_sheets->fetch_assoc())
	{
?>
		<li><A HREF="./?SheetID=<?php
	echo $sheets['SheetID']; ?>"><?php
	echo $sheets['Title']; ?> </A></li>
			<?php
	}

?>
				<li><A HREF="#table0">+</A></li>
		</ul>
</nav>
</header>

<div id="main">
		<?php
$query2 = "SELECT * FROM  `sheets` ";
$query2.= (isset($_GET['SheetID'])) ? "WHERE `SheetID` = '" . $_GET['SheetID'] . "'" : "ORDER BY  `sheets`.`SheetID` DESC LIMIT 0 , 1";
$res_query2 = $mysqli->query($query2);

if ($res_query2->num_rows == 0)
	{
	echo "<div align='center'>No store</div>";
	}
  else
	{
	$sheet = $res_query2->fetch_assoc();
	$start_date_query = "SELECT  DATE_FORMAT(`start_date`, '%a, %D %b %Y') as `startdate` FROM  `weeks` WHERE `SheetID` = '" . $sheet['SheetID'] . "' GROUP BY  `SheetID`";
	$start_date_res = $mysqli->query($start_date_query);
	$start_date = $start_date_res->fetch_assoc();
	$end_date_query = "SELECT DATE_FORMAT(`end_date`, '%a, %D %b %Y') as `enddate` FROM  `weeks` WHERE `SheetID` = '" . $sheet['SheetID'] . "' ORDER BY  `WeekID` DESC LIMIT 1";
	$end_date_res = $mysqli->query($end_date_query);
	$end_date = $end_date_res->fetch_assoc();
	echo "<H1><EM>" . $start_date['startdate'] . " - " . $end_date['enddate'] . "</EM></H1>";
	$num_rows_query = "SELECT DATE_FORMAT(`start_date`, '%d/%m') as `start_short`, DATE_FORMAT(`end_date`, '%d/%m') as `end_short`, `WeekID`, `start_date`, `end_date` FROM `weeks` WHERE `SheetID` = '" . $sheet['SheetID'] . "'";
	$num_row_result = $mysqli->query($num_rows_query);
	$num_rows = $num_row_result->num_rows;
	$total_hours = array();
?>

<TABLE WIDTH="99%" FRAME=VOID CELLSPACING=0 COLS=17 RULES=NONE BORDER=0>
	<COLGROUP=
	<COL WIDTH=152>
	<COL WIDTH=108>
	<COL WIDTH=38>
	<COL WIDTH=115>
	<COL WIDTH=38>
	<COL WIDTH=122>
	<COL WIDTH=38><COL WIDTH=118><COL WIDTH=38>
	<COL WIDTH=98><COL WIDTH=38><COL WIDTH=166><COL WIDTH=94><COL WIDTH=124><COL WIDTH=81>
	<COL WIDTH=127>
	<COL WIDTH=142>
	</COLGROUP>
	<TBODY>
		<TR>
			<TD WIDTH=152 HEIGHT=19 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF"><br /></FONT></B></TD>
<?php
	$total_holidays = array();
	$total_staff_hours = array();
	for ($i = 1; $i <= $num_rows; $i++)
		{
		$total_hours[$i] = 0;
		$total_holidays[$i] = 0;
		$total_staff_hours[$i] = 0;
?>	
			<TD WIDTH=108 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF">Week <?php
		echo $i; ?></FONT></B></TD>
			<TD WIDTH=38 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF">H <?php
		echo $i; ?></FONT></B></TD>
<?php
		}

?>						
			<TD WIDTH=166 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF">Total Hours Worked</FONT></B></TD>
			<TD WIDTH=94 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF">Holidays</FONT></B></TD>		
		</TR>
		<TR>
			<TD HEIGHT=17 ALIGN=RIGHT BGCOLOR="#CCCCFF" SDVAL="6" SDNUM="2057;"></TD>
<?php
	$dates2 = array();
	$weeks = array();
	$d = 1;
	while ($dates = $num_row_result->fetch_assoc())
		{
		$dates2[$d] = $dates['WeekID'];
		$weeks[$d] = array(
			"start_date" => $dates['start_date'],
			"end_date" => $dates['end_date']
		);
		$d++;
?>				
			<TD ALIGN=CENTER BGCOLOR="#CCCCFF" SDNUM="2057;0;DD/MM/YY"><?php
		echo $dates['start_short'] . " &ndash; " . $dates['end_short']; ?></TD>
			<TD ALIGN=CENTER BGCOLOR="#CCCCFF" SDNUM="2057;0;DD/MM/YY"><br /></TD>
			
<?php
		}

?>			
			
			<TD ALIGN=CENTER BGCOLOR="#CCCCFF"><br /></TD>
			<TD ALIGN=CENTER BGCOLOR="#CCCCFF"></TD>	
		</TR>
		<?php
	$query_get_staff = "SELECT `StaffID`, `Name` FROM `staff` ORDER BY `StoreID`";
	$res_get_staff = $mysqli->query($query_get_staff);
	while ($staff = $res_get_staff->fetch_assoc())
		{
?>
					<TR>
			<TD HEIGHT=17 ALIGN=LEFT BGCOLOR="#EEEEEE"><?php
		echo $staff['Name']; ?></TD>
<?php
		for ($i = 1; $i <= $num_rows; $i++)
			{
			$query_get_hours = "SELECT `hours` FROM `rota` WHERE `StaffID` = '" . $staff['StaffID'] . "' AND `WeekID` = '" . $dates2[$i] . "';";
			$res_get_hours = $mysqli->query($query_get_hours);
			$h = $res_get_hours->fetch_assoc();
			$total_hours[$i]+= $h['hours'];
			$query_get_holidays = "SELECT COUNT(*) as `holi`
FROM `requests`
WHERE 
(`StaffID` = '" . $staff['StaffID'] . "')
AND
((
`From_date` >= '" . $weeks[$i]['start_date'] . "'
AND `To_date` <= '" . $weeks[$i]['end_date'] . "'
)
OR (
`To_date` >= '" . $weeks[$i]['start_date'] . "'
AND `From_date` <= '" . $weeks[$i]['end_date'] . "'
));";
			$res_get_holidays = $mysqli->query($query_get_holidays);
			$hols = $res_get_holidays->fetch_assoc();
			$total_holidays[$staff['StaffID']]+= $hols['holi'];
			$total_staff_hours[$staff['StaffID']] += $h['hours'];
?>			
			<TD ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="44.02" SDNUM="2057;0;0.00"><?php
			echo $h['hours']; ?></TD>
			<TD ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="3" SDNUM="2057;0;0"><?php
			echo $hols['holi']; ?></TD>
<?php
			}

?>			
			<TD ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="103.67" SDNUM="2057;0;0.00"><?php echo $total_staff_hours[$staff['StaffID']]; ?></TD>
			<TD ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="7" SDNUM="2057;"><FONT COLOR="#000000"><?php
		echo $total_holidays[$staff['StaffID']]; ?></FONT></TD>

		</TR>
		<?php
		}

?>
		<TR>
			<TD STYLE="border-top: 1px solid #000000" HEIGHT=17 ALIGN=CENTER BGCOLOR="#EEEEEE">Total Hours</TD>
<?php
	for ($i = 1; $i <= $num_rows; $i++)
		{
?>			
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="178.74" SDNUM="2057;0;0.00"><?php
		echo $total_hours[$i]; ?></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER BGCOLOR="#EEEEEE" SDNUM="2057;0;0.00"><br /></TD>

<?php
		}
?>			
			
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="523.87" SDNUM="2057;0;0.00">523.87</TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER BGCOLOR="#DDDDDD" SDVAL="25" SDNUM="2057;0;0">25</TD>
		</TR>
	</TBODY>
</TABLE>
<?php
	}
?>
        </div>
        <div class="clear"></div>
      </div>
    </body>