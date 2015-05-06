<?
include "../../auth.php";
include "../userauth.php";
include "../../functions.php";


	if( $PHP_AUTH_USER != 'administrator' ){ 
		header('Location: authfail.html');
	}


$start_date = make_date( $start_year, $start_month, $start_day );
$end_date = make_date( $end_year, $end_month, $end_day );

if( $act=="delete" ){
	include "../../check_date.php";
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
include "themes/header.php";

?>
		<table border=0 BGCOLOR=#c0c0c0>
		<tr><td bgcolor=navy><FONT class=a1 color=#ffffff>&nbsp;<B><? print TEXT_DEL_RESERV ?></B></FONT></td>
		<tr><td class=WIN>


<p>
Set the range for departure dates
<p>
<? 
	$DO_NOT_SHOW_ROOMS = 1;
	include "../rates_common_date.php"; 
?>

<input type="hidden" name="act" value="delete">

<? include "../rates_common_date_fin.php"; ?>


<? include "themes/footer.php" ; ?>

