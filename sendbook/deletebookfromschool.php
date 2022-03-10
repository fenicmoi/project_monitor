<?
include "chksession.php" ;
?>
<?
$id = $_GET ['id'] ;

if ($id=="") {
	header ("Location:deletebook.php") ;
	exit() ;
}

include "connect.php" ;

$sql = "select * from $tablenewbooksfromschool  where id='$id' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array ($result) ;
 
 $bookfile = $r [bookfile] ;

 $sql2 = "delete from $tablenewbooksfromschool where id='$id' " ;
 $result2 = mysql_db_query ($dbname, $sql2) ;
unlink ("booksfilefromschool/".$bookfile) ;

mysql_close () ;
if ($result2) {
	echo "<center><h2>ลบหนังสือออกจากระบบเรียบร้อยแล้ว</h2><br> <input type=\"button\" value=\"กลับหน้าทะเบียนหนังสือส่งจากหน่วยงาน\" onClick=\"window.location='bookfromschool.php'\" > <input type=\"button\" value=\"กลับหน้าหลัก\" onClick=\"window.location='index.php'\" ></center>";
} else {
	echo"ไม่สามารถลบหนังสือได้" ;
}
?>