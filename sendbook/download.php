<?
include "chksession.php" ;
?>
<?
$id = $_GET ['id'] ;

if ($id == "") {
	header ("Location:bookfromschool.php") ;
	exit () ;
}
//echo"$id" ;
//exit () ;
include "connect.php" ;
$sql1 = "select * from $tableuser where username='$sess_username' " ;
$result1 = mysql_db_query ($dbname, $sql1) ;
$r1 = mysql_fetch_array($result1) ;
$school = $r1 [school] ;
$status = $r1 [status] ;
mysql_close () ;

//echo"$school<BR>$status" ;
//exit () ;

if ($status == "public" ) {
header ("Location:login.php") ;
	exit () ;
}
$download = date("j/n/Y:G.i.s") ;
include "connect.php" ;
$sql2 = "select * from  $tablenewbooksfromschool where id='$id' " ;
$result2 = mysql_db_query ($dbname, $sql2) ;
$r2 = mysql_fetch_array ($result2) ;
	$bookfile = $r2[bookfile] ;
	$nreply = $r2 [nreply] ;

if ($school=="อำนวยการ") {
		if ($nreply == "" ) { //งเขียนการเปิดตครั้งแรก
$sql = "update $tablenewbooksfromschool set nreply='$download' where id='$id' ";
$result = mysql_db_query ($dbname, $sql) ;

	header ("Location:booksfilefromschool/$bookfile") ;

		}  else {//งถ้าเคยเปิดอ่านแล้ว
	header ("Location:booksfilefromschool/$bookfile") ;
		}

} else { //ถ้าไม่ใช่อำนวยการเปิดอย่างเดียว
	header ("Location:booksfilefromschool/$bookfile") ;
}
mysql_close () ;

?>