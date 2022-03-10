<?
include "chksession.php" ;
?>
<?
$id = $_GET ['id'] ;

if ($id=="") {
	header ("Location:deletebook2.php") ;
	exit() ;
}

include "connect.php" ;

$sql = "select * from $tablenewbooks2 where id='$id' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array ($result) ;
 
 $bookfile = $r [bookfile] ;

if ($bookfile =="") {
 $sql2 = "delete from $tablenewbooks2 where id='$id' " ;
 $result2 = mysql_db_query ($dbname, $sql2) ;
} else {
 $sql2 = "delete from $tablenewbooks2 where id='$id' " ;
 $result2 = mysql_db_query ($dbname, $sql2) ;
unlink ("booksfile2/".$bookfile) ;
}

mysql_close () ;

if ($result2) {

	//ลบคำตอบของหนังสือฉบับนี้
include "connect.php" ;
$sql = "delete from $tableanswer2 where bookid='$id' " ;
mysql_db_query ($dbname, $sql) ;
mysql_close () ;

	echo "<center><h2>ลบหนังสือออกจากระบบเรียบร้อยแล้ว</h2><br> <input type=\"button\" value=\"กลับหน้าลบหนังสือ\" onClick=\"window.location='deletebook2.php'\" > <input type=\"button\" value=\"กลับหน้าหลัก\" onClick=\"window.location='index2.php'\" ></center>";
} else {
	echo"ไม่สามารถลบหนังสือได้" ;
}
?>