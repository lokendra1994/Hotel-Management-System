<?
	include "../../auth.php";
	include "../userauth.php";
	if( $PHP_AUTH_USER != 'administrator' ){ 
		header('Location: authfail.html');
	}

include "../../functions.php";
include "../../rooms_functions.php";
include "themes/header.php";


	
	if( $act == 'change' ) {
		$query = "UPDATE Settings SET text='$value' WHERE name='$var_name'";
		mysql_query( $query ) or die( "$query<br>".mysql_error );
		header("Location: $PHP_SELF?");
	}
	
	$query = "SELECT * FROM Settings";
	$res = mysql_query( $query ) or die( "$query<br>".mysql_error());

?>
<script language="JavaScript">
	function change( var_name, old_value ) {
		new_value = prompt("Enter new value for "+var_name, '');
		if(new_value == null || new_value == '') return;
			document.location="settings.php?act=change&var_name="+var_name+"&value="+new_value;
	}
</script>

		<table border=0 BGCOLOR=#c0c0c0>
		<tr><td bgcolor=navy><FONT class=a1 color=#ffffff>&nbsp;<B><? print TEXT_SETTINGS ?></B></FONT></td>
		<tr><td class=WIN>




<table border=1>
<?	while( $row = mysql_fetch_array( $res ) ) {
?>		<tr valign="top">
			<td align="right">
				<b><?echo $row['name'];?></b><br>
				<i><?echo $row['comment'];?></i>
			</td>
			<td>
				<?echo $row['text'];?>
			</td>
			<td>
				<xmp><?echo $row['text'];?></xmp>
			</td>
			<td>
				<a href="javascript:change( '<?echo $row['name'];?>','<?echo $row['text'];?>' )">Change</a>
			</td>
		</tr>
<?	}	?>
</table>

<? include "themes/footer.php" ?>
