<?
include "../auth.php";
include "./userauth.php";
include "../functions.php";
include "./rates_functions.php";

	if( $PHP_AUTH_USER != 'administrator' ){ 
		header('Location: authfail.html');
	}


$start_date = make_date( $start_year, $start_month, $start_day );
$end_date = make_date( $end_year, $end_month, $end_day );

if( $act=="delete" ){
	include "../check_date.php";
	echo "OK";
	$query = "LOCK TABLES Bookings WRITE";
	mysql_query( $query ) or die("$query<br> ".mysql_error());
	
	$query = "UPDATE Bookings SET is_deleted=1 WHERE end_date<=$end_date AND end_date>=$start_date";
	mysql_query( $query ) or die("$query<br> ".mysql_error());

	$query = "UNLOCK TABLES";
	mysql_query( $query ) or die("$query<br> ".mysql_error());

	oplog( "Delete reservations ending from $start_day/$start_month/$start_year to $end_day/$end_month/$end_year" );
	
	header("Location: $PHP_SELF?");
	exit;
}
include "./header.php";
?> 

<tr><td valign=top>

<? 

include "./menu.php"  ;
?>

</td>

<td valign=top>
<table cellSpacing=10 width=100% border=0>
<tr><td>

<FONT size=5 color=#cc9900>&nbsp;<B><? print TEXT_DEL_RESERV ?></B></FONT>
<p>
Set the range for departure dates
<p>
<? 
	$DO_NOT_SHOW_ROOMS = 1;
	include "./rates_common_date.php"; 
?>

<input type="hidden" name="act" value="delete">

<? include "./rates_common_date_fin.php"; ?>

</td><tr></table>

</td></tr>


<? include "../footer.php" ; ?>

