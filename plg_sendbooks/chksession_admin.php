<?
session_start ( ) ;
$sess_userid = $_SESSION [sess_userid] ;
$sess_username = $_SESSION [sess_username] ;
//echo "$sess_userid" ;
//exit() ;
if ($sess_userid <> session_id ( )  or  $sess_username == ""   ) {
	header ("Location:login.php") ;
	exit () ;
}
?>