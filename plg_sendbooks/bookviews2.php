<?
include "chksession.php" ;
?>
<?
include "connect.php" ;
$sql = "select * from $tableuser where username='$sess_username' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array($result) ;
$school = $r [school] ;
$status = $r [status] ;
mysql_close () ;
$ip = $_SERVER["REMOTE_ADDR"];
$id = $_POST ['id'] ;
$from = $_POST ['name'] ;
$bookfile = $_POST ['bookfile'] ;
$answer = $_POST ['answer'];
$anstimestamp = mktime(date("H"), date("i"),date("s"), date("m") ,date("d"), date("Y"))  ;	//timestamp เวลาปัจจุบัน 

//echo "$id<BR>$from<BR>$answer" ;
//exit () ;
If ($id=="" or $from=="" or $answer=="") {
	echo "<center><h2>กรุณากรอกข้อมูลให้ครบ</h2> <br><input type=\"button\" value=\"&nbsp;แก้ไข&nbsp;\" onClick=\"javascript:history.go(-1)\" ></center>" ;
exit () ;
} 

//ถ้า user เป็น Admin ไม่ต้องเขียนค่า
If ($status=="Yes1" or $status=="Yes") {
If ($bookfile<>"") {
		header ("Location:booksfile2/$bookfile") ;
	} else {
		header ("Location:bookview2.php?id=$id") ;
	}
	exit() ;
}
//หาค่าจำนวนคนตอบ
include "connect.php" ;
$sqlselect = "select * from $tableanswer2 where bookid='$id' Order BY id desc" ;
$resultselect = mysql_db_query($dbname, $sqlselect) ;
$num = mysql_num_rows ($resultselect) ;
$order = $num ;
mysql_close () ;
//เรียกค่าวันที่ส่งหนังสือ
include "connect.php" ;
$sql = "SELECT *  from $tablenewbooks2 where id='$id' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array ($result) ;
		$sendtimestamp = $r [sendtimestamp] ;
		$timestamp24 = $r [timestamp24] ;
		$sendto = $r [sendto] ;
mysql_close () ;

//ค่าเดือน ปี ที่ตอบ

$ans_m = date("n", $sendtimestamp) ;
$ans_y = date("Y", $sendtimestamp) + 543;
if ($sendto == "หน่วยงานทุกหน่วยงาน") {
// คำนวนระยะเวลาตอบหลังจากส่งหนังสือ
$h_pass = $anstimestamp - $timestamp24 ;
if ($h_pass <=0) {
	$h_pass = 0 ;
  } else {
	  $h_pass = 1 ;
  }
//คะแนน
if ($h_pass == 0) {
	$score = 300 - $order ;
} else {
	$score = 1 ;
	}
} else { //ถ้าหนังสือนี้ไม่มีคะแนน
	$score = 0 ;
}
//echo "$id<BR>$from<BR>$answer" ;
//exit() ;
include "connect.php" ;
$sqlselect = "select * from $tableanswer2 where bookid='$id' and name='$from' " ;
$resultselect = mysql_db_query($dbname, $sqlselect) ;
$num = mysql_num_rows ($resultselect) ;
if ($num==0){

$sql= "INSERT INTO $tableanswer2  VALUES (' ', '$id', '$from', '$answer', '$anstimestamp', '$ans_m', '$ans_y', '$score', '$ip') ";
$result= mysql_db_query ($dbname, $sql); 
mysql_close () ;
If ($result) {

include "connect.php" ;
$sql = "SELECT *  from $tablenewbooks2 where id='$id' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array ($result) ;
		$nreply = $r [nreply] ;

		$nreply = $nreply+1 ;

//echo"$nview" ;
//exit();
		$sql2 = "UPDATE $tablenewbooks2 set nreply='$nreply' where id='$id' " ;
		mysql_db_query ($dbname, $sql2) ;
		mysql_close() ;

	If ($bookfile<>"") {
		header ("Location:booksfile2/$bookfile") ;
	} else {
		header ("Location:bookview2.php?id=$id") ;
	}
} else{
	echo" <center><h2>ไม่สามารถบันทึกข้อมูลได้</h2> <br> <input type=\"button\" value=\"แก้ไขข้อมูล\" onClick=\"javascript:history.go(-1)\" ></center>";
}
 mysql_close ( );
} else {//ถ้ามีการตอบแล้ว
If ($bookfile<>"") {
		header ("Location:booksfile2/$bookfile") ;
	} else {
		header ("Location:bookview2.php?id=$id") ;
	}
}
?>