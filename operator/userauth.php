<?

	function authenticate() {                                                     
		Header("WWW-Authenticate: Basic realm=\"Hotel Administration Zone(Login: administrator pass: administrator)\"");
		Header("HTTP/1.0 401 Unauthorized");                                       
		echo "Maybe next time...\n";                                               
		exit;                                                                      
	}                                                                            
	if(!isset($PHP_AUTH_USER) ) {                                                  
		authenticate();                                                             
	}                                                                               
	$user=$PHP_AUTH_USER;
	$res = mysql_query("SELECT * FROM Operators WHERE username='$PHP_AUTH_USER'")
		or die("SELECT: ".mysql_error() );
	$row = mysql_fetch_array( $res );
	if( $PHP_AUTH_PW != $row['password'] || $PHP_AUTH_USER == '') {
		authenticate();
	}
	$operator_id = $row['operator_id'];
	$is_can_delete = $row['can_delete'];

?>