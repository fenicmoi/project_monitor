<?
include "chksession.php" ;
?>
<?
include "connect.php" ;
$sql1 = "select * from $tableuser where username='$sess_username' " ;
$result1 = mysql_db_query ($dbname, $sql1) ;
$r1 = mysql_fetch_array($result1) ;
$school = $r1 [school] ;
$status = $r1 [status] ;
mysql_close () ;

$id = $_GET ['id'] ;

if ($id=="") {
	header ("Location:deletebook.php") ;
	exit() ;
}

include "connect.php" ;

$sql = "select * from $tablenewbooks where id='$id' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array ($result) ;
 
 $bookfile = $r [bookfile] ;

if ($bookfile =="") {
 $sql2 = "delete from $tablenewbooks where id='$id' " ;
 $result2 = mysql_db_query ($dbname, $sql2) ;
} else {
 $sql2 = "delete from $tablenewbooks where id='$id' " ;
 $result2 = mysql_db_query ($dbname, $sql2) ;
unlink ("booksfile/".$bookfile) ;
}

mysql_close () ;

if ($result2) {

	//ลบคำตอบของหนังสือฉบับนี้
include "connect.php" ;
$sql = "delete from $tableanswer where bookid='$id' " ;
mysql_db_query ($dbname, $sql) ;
mysql_close () ;

	echo "<center><h2>ลบหนังสือออกจากระบบเรียบร้อยแล้ว</h2><br>" ;
	if ($status=="Yes1" or $status=="Yes") { 
		echo "<input type=\"button\" value=\"กลับหน้าลบหนังสือ\" onClick=\"window.location='deletebook.php'\" >" ;
	echo"<input type=\"button\" value=\"กลับหน้าหลัก\" onClick=\"window.location='index.php'\" ></center>";
	} else {
		echo"<input type=\"button\" value=\"ปิดหน้านี้\" onClick=\"javascript:window.close()\">" ;
	}
} else {
	echo"ไม่สามารถลบหนังสือได้" ;
}
?>