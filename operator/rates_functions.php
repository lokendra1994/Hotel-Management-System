<?
function check_rate_date_spec( $start_date, $end_date, $corp_id = 0  ) {

  $query = "SELECT rate_id FROM Rates
			WHERE 
				special_desc_id=0
			AND (
				$start_date<=end_date AND $start_date>=start_date
			OR
				$end_date<=end_date AND $end_date>=start_date
			OR
				$start_date<=start_date AND $end_date>=end_date)";
  if( $corp_id ) $query .= " AND corporate_id=$corp_id";
  $res = mysql_query( $query )
	 or die("$query<br>".mysql_error());
  $row = mysql_fetch_row( $res );
  return $row[0];
}

function check_rate_date_corporate( $start_date, $end_date, $corp_id  ) {

  $query = "SELECT rate_id FROM Rates
			WHERE 
				special_desc_id=0
			AND (
				$start_date<=end_date AND $start_date>=start_date
			OR
				$end_date<=end_date AND $end_date>=start_date
			OR
				$start_date<=start_date AND $end_date>=end_date)
	 		AND corporate_id=$corp_id";
  $res = mysql_query( $query )
	 or die("$query<br>".mysql_error());
  $row = mysql_fetch_row( $res );
  return $row[0];
}

function check_rate_date_public( $start_date, $end_date ) {

  $query = "SELECT rate_id FROM Rates
			WHERE 
				special_desc_id=0 AND corporate_id=0
			AND (
				$start_date<=end_date AND $start_date>=start_date
			OR
				$end_date<=end_date AND $end_date>=start_date
			OR
				$start_date<=start_date AND $end_date>=end_date)";
  $res = mysql_query( $query )
	 or die("$query<br>".mysql_error());
  $row = mysql_fetch_row( $res );
  return $row[0];
}

function params_spec( $spec_id ){
	$query = "SELECT * FROM Rates WHERE rate_id=$spec_id";
	$res = mysql_query($query)
		 or die("$query".mysql_error());
	$row = mysql_fetch_array($res);
	list( $start_year, $start_month, $start_day ) = explode( "-", $row['start_date']);
	list( $end_year, $end_month, $end_day ) = explode( "-", $row['end_date']);
	$query_str = 
		 "start_year=$start_year&start_month=$start_month&start_day=$start_day".
		 "&end_year=$end_year&end_month=$end_month&end_day=$end_day".
		 "&singles=".$row['singles']."&doubles=".$row['doubles'].
		 "&twins=".$row['twins']."&triples=".$row['triples'].
		 "&executives=".$row['executives']."&spec_id=".$row['special_desc_id'].
		 "&corp_id=".$row['corporate_id'];
	return $query_str;
}

?>