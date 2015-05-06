<?
	include "../auth.php";
	include "./userauth.php";
	include "../functions.php";

include "themes/header.php";

?>

                <TD 
                style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px" 
                width="100%" bgColor=#FFE0AD border="0" cellpadding="0" 
                cellspacing="0" align=center>
		<table border=0 BGCOLOR=#c0c0c0>
		<tr><td bgcolor=navy><FONT class=a1 color=#ffffff>&nbsp;<B><? print TEXT_ROOM_INVENTORY ?></B></FONT></td>
		<tr><td class=WIN>


 <form>
	<input type="button" value="Back" onClick="document.location='inventory.php';">
</form>
        

       	<? $res = mysql_query("SELECT inventory FROM Roomtypes where id='$room'");
 	while( $row = mysql_fetch_array( $res ) ) {
       		print type($room);			
		$invent=$row['inventory'];			
		print "</FONT><P>";		
	       }
	       ?>
	<script language="JavaScript">
	function openBrWindow(myUrl) {
		myWin= open(myUrl, "VisualEditor", 
		"width=750,height=500,status=no,toolbar=no,menubar=no, location=no");
    		
		}
	</script>
 	<form name="adminForm" action="inventory.php?room=<? print $room ?>&edit=<? print 1 ?>" method="post">
        <TABLE BORDER="0" ALIGN="CENTER">
	<TR ALIGN="CENTER">
	<TD><? print TEXT_ROOM_INVENTORY ?></TD>
	</TR>
	<TR ALIGN="CENTER">
	<TD><TEXTAREA NAME="content" cols=50 rows=10><? print $invent ?></TEXTAREA></TD>
	</TR>
	<TR>
	<TD><A HREF=editor.htm  onClick="openBrWindow('editor.htm'); return false";><? print TEXT_VISUAL_EDITOR ?></a></TD>
	</TR>
        <TR>
	<TD COLSPAN=6 ALIGN="CENTER"><BR><input type=submit value="Submit" >
	</form>			
	</TR>	
	</TABLE>

<? include "themes/footer.php" ?>

