<?php
include_once("_mysqli.php");
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
??
</header>

<div id="main">
		<?php
			$where = (isset($_GET['StoreID'])) ? "WHERE `StoreID` = '". $_GET['StoreID'] ."'" : '';
				
			$query_get_employee2 = "SELECT `EmpID`, `Name` FROM `employee` " . $where . " ORDER BY `StoreID`";
			$res_get_employee2 = $mysqli->query($query_get_employee2);
			
			if ($res_get_employee2->num_rows == 0) {
				echo "<div align='center'>No store</div>";
			} else {
			?>
<!-- ************************************************************************** -->
<H1><EM>
<?php
// start
// get last Friday of the month and count back to the Tuesday
$timestamp1 = strtotime('last fri of this month -2 days -1 month');


// end
// get last Friday of the month and count back to the Tuesday
$timestamp2 = strtotime('last fri of this month -3 days');

echo date('D F j, Y', $timestamp1) . ' - ' . date('D F j, Y', $timestamp2);
?>
</EM></H1>
<br>

<TABLE WIDTH="99%" FRAME=VOID CELLSPACING=0 COLS=17 RULES=NONE BORDER=0>
	<COLGROUP><COL WIDTH=152><COL WIDTH=108><COL WIDTH=38><COL WIDTH=115><COL WIDTH=38><COL WIDTH=122><COL WIDTH=38><COL WIDTH=118><COL WIDTH=38><COL WIDTH=98><COL WIDTH=38><COL WIDTH=166><COL WIDTH=94><COL WIDTH=124><COL WIDTH=81><COL WIDTH=127><COL WIDTH=142></COLGROUP>
	<TBODY>
		<TR>
			<TD WIDTH=152 HEIGHT=19 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF"><BR></FONT></B></TD>
			<TD WIDTH=108 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF">W 1</FONT></B></TD>
			<TD WIDTH=38 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF">H1</FONT></B></TD>
			<TD WIDTH=115 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF">Week 2</FONT></B></TD>
			<TD WIDTH=38 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF">H2</FONT></B></TD>
			<TD WIDTH=122 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF">Week 3</FONT></B></TD>
			<TD WIDTH=38 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF">H3</FONT></B></TD>
			<TD WIDTH=118 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF">Week 4</FONT></B></TD>
			<TD WIDTH=38 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF">H4</FONT></B></TD>
			<TD WIDTH=98 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF">Week 5</FONT></B></TD>
			<TD WIDTH=38 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF">H5</FONT></B></TD>
			<TD WIDTH=166 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF">Total Hours Worked</FONT></B></TD>
			<TD WIDTH=94 ALIGN=CENTER BGCOLOR="#336699"><B><FONT FACE="Arimo" COLOR="#FFFFFF">Holidays</FONT></B></TD>		
		</TR>
		<TR>
			<TD HEIGHT=17 ALIGN=RIGHT BGCOLOR="#CCCCFF" SDVAL="6" SDNUM="2057;"><FONT COLOR="#CCCCFF">6</FONT></TD>
			<TD ALIGN=CENTER BGCOLOR="#CCCCFF" SDNUM="2057;0;DD/MM/YY">25/05 &ndash; 31/05</TD>
			<TD ALIGN=CENTER BGCOLOR="#CCCCFF" SDNUM="2057;0;DD/MM/YY"><BR></TD>
			<TD ALIGN=CENTER BGCOLOR="#CCCCFF" SDNUM="2057;0;DD/MM/YY">01/06 -07/06</TD>
			<TD ALIGN=CENTER BGCOLOR="#CCCCFF" SDNUM="2057;0;DD/MM/YY"><BR></TD>
			<TD ALIGN=CENTER BGCOLOR="#CCCCFF" SDNUM="2057;0;DD/MM/YY">08/06 &ndash; 14/06</TD>
			<TD ALIGN=CENTER BGCOLOR="#CCCCFF" SDNUM="2057;0;DD/MM/YY"><BR></TD>
			<TD ALIGN=CENTER BGCOLOR="#CCCCFF" SDNUM="2057;0;DD/MM/YY"><BR></TD>
			<TD ALIGN=CENTER BGCOLOR="#CCCCFF" SDNUM="2057;0;DD/MM/YY"><BR></TD>
			<TD ALIGN=CENTER BGCOLOR="#CCCCFF" SDNUM="2057;0;DD/MM/YY"><BR></TD>
			<TD ALIGN=CENTER BGCOLOR="#CCCCFF" SDNUM="2057;0;DD/MM/YY"><BR></TD>
			<TD ALIGN=CENTER BGCOLOR="#CCCCFF"><BR></TD>
			<TD ALIGN=CENTER BGCOLOR="#CCCCFF" SDVAL="6" SDNUM="2057;0;@&quot; hours&quot;">6</TD>	
		</TR>
		<?php 
			while ($emp2 = $res_get_employee2->fetch_assoc()) {
		?>
					<TR>
			<TD HEIGHT=17 ALIGN=LEFT BGCOLOR="#EEEEEE"><?php echo $emp2['Name']; ?></TD>
			<TD ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="44.02" SDNUM="2057;0;0.00">44.02</TD>
			<TD ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="3" SDNUM="2057;0;0">3</TD>
			<TD ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="28.2" SDNUM="2057;0;0.00">28.20</TD>
			<TD ALIGN=CENTER BGCOLOR="#EEEEEE" SDNUM="2057;0;0"><BR></TD>
			<TD ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="31.45" SDNUM="2057;0;0.00">31.45</TD>
			<TD ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="4" SDNUM="2057;0;0">4</TD>
			<TD ALIGN=CENTER BGCOLOR="#EEEEEE" SDNUM="2057;0;0.00"><BR></TD>
			<TD ALIGN=CENTER BGCOLOR="#EEEEEE" SDNUM="2057;0;0"><BR></TD>
			<TD ALIGN=CENTER BGCOLOR="#EEEEEE" SDNUM="2057;0;0.00"><BR></TD>
			<TD ALIGN=CENTER BGCOLOR="#EEEEEE" SDNUM="2057;0;0"><BR></TD>
			<TD ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="103.67" SDNUM="2057;0;0.00">103.67</TD>
			<TD ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="7" SDNUM="2057;"><FONT COLOR="#000000">7</FONT></TD>

		</TR>
		<?php
			}
		?>
		<TR>
			<TD STYLE="border-top: 1px solid #000000" HEIGHT=17 ALIGN=CENTER BGCOLOR="#EEEEEE">Total Hours</TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="178.74" SDNUM="2057;0;0.00">178.74</TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER BGCOLOR="#EEEEEE" SDNUM="2057;0;0.00"><BR></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="179.99" SDNUM="2057;0;0.00">179.99</TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER BGCOLOR="#EEEEEE" SDNUM="2057;0;0.00"><BR></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="165.14" SDNUM="2057;0;0.00">165.14</TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER BGCOLOR="#EEEEEE" SDNUM="2057;0;0.00"><BR></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="0" SDNUM="2057;0;0.00">0.00</TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER BGCOLOR="#EEEEEE" SDNUM="2057;0;0.00"><BR></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="0" SDNUM="2057;0;0.00">0.00</TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER BGCOLOR="#EEEEEE" SDNUM="2057;0;0.00"><BR></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER BGCOLOR="#EEEEEE" SDVAL="523.87" SDNUM="2057;0;0.00">523.87</TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER BGCOLOR="#DDDDDD" SDVAL="25" SDNUM="2057;0;0">25</TD>
		</TR>
	</TBODY>
</TABLE>
<!-- ************************************************************************** -->
<?php
			}
?>
        </div>
        <div class="clear"></div>
      </div>
    </body>
	</html>
	<div align="left">
<?php
    show_source(__FILE__);   
?>	
