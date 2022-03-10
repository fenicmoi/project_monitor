<?
include "chksession.php" ;
?>
<?
include "connect.php" ;
$sql1 = "select * from $tableuser where username='$sess_username' " ;
$result1 = mysql_db_query ($dbname, $sql1) ;
$r1 = mysql_fetch_array($result1) ;
$status1 = $r1 [status] ;
mysql_close () ;

if ($status1 <> "Yes1") {
header ("Location:login.php") ;
	exit () ;
}

$delid = $_GET ['delid'] ;

//echo "$delid" ;
//exit() ;
if ($delid=="" ) {
	header ("Location:login.php") ;
	exit () ;
}
include "connect.php" ;
$sql = "delete from $tableuser where username='$delid' " ;
mysql_db_query ($dbname, $sql) ;
mysql_close () ;

	echo "<center><h2>ลบผู้ใช้ออกจากระบบเรียบร้อยแล้ว</h2><br> <input type=button value='กลับหน้าผู้ใช้งานระบบ' onClick=window.location='userdetail.php'></center>";
	
	?>