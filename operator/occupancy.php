<?

	include "../auth.php";
	include "./userauth.php";
	include "../functions.php";
	include "themes/header.php";
 

	if ($edit==1)
	{	//oplog("Edit occupancy for per room");
		$i=1;
		while ($i<10)
		{  	
			$res=mysql_query("UPDATE Roomtypes SET adult='$a[$i]' where id='$i'");
			$res=mysql_query("UPDATE Roomtypes SET child='$c[$i]' where id='$i'");		
			if (!$res)
				mysql_error();	
		
			$i++;
		}
		
		
	}
       		$res = mysql_query("SELECT * FROM Roomtypes");
		$i=1;	
		while( $row = mysql_fetch_array( $res ) ) {
		
			$id[$i]=$row['id'];
			$name[$i]=$row['name'];
			$adult[$i]=$row['adult'];
        	        $child[$i]=$row['child'];
			$flag[$i]=$row['flag'];			
			$i++;

		}
	$k=$i;

	
?>
                <TD 
                style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px" 
                width="100%" bgColor=#FFE0AD border="0" cellpadding="0" 
                cellspacing="0" align=center>
		<table border=0 BGCOLOR=#c0c0c0>
		<tr><td bgcolor=navy><FONT class=a1 color=#ffffff>&nbsp;<B><? print TEXT_MAX_OCCUPANCY ?></B></FONT></td>
		<tr><td class=WIN>




<BR><BR>
<form name="f1" action="occupancy.php?edit=1" method="post">
<TABLE BORDER="0" ALIGN="CENTER">
	<TR ALIGN="CENTER">
		<TD></TD>
		<? $i=1;
		    while ($i<$k)
  	          { 
			if ($flag[$i]=='on') echo "<TD>", type($id[$i]),"</TD>"; 
			 $i++;} ?>	 
	
	</TR>
	<TR ALIGN="CENTER">
		<TD ALIGN="RIGHT"><B><? print TEXT_ADULT ?></B></TD>
		<? $i=1;
		    while ($i<$k)
  	          {
			if ($flag[$i]=='on') echo "<TD><INPUT NAME='a[$i]' VALUE='$adult[$i]'  SIZE=2 MAXLENGTH=1></TD>"; 
		        $i++;} ?>	 
	</TR>
	<TR ALIGN="CENTER">
		<TD></TD>
		<? $i=1;
		    while ($i<$k)
  	          {
			if ($flag[$i]=='on') echo "<TD>+</TD>";
		 	 $i++;} ?>	 
	</TR>
	<TR ALIGN="CENTER">
		<TD ALIGN="RIGHT"><B><? print TEXT_CHILD ?></B></TD>
		<? $i=1;
		    while ($i<$k)
  	          {
		      if ($flag[$i]=='on') echo "<TD><INPUT NAME='c[$i]' VALUE=$child[$i]   SIZE=2 MAXLENGTH=1></TD>";
		      $i++;} ?>	 
	</TR>

	<TR>
	<TD COLSPAN=6 ALIGN="CENTER"><BR><input type=submit value="Submit">
	</form>			
	</TR>	
</TABLE>

<? include "themes/footer.php" ?>
