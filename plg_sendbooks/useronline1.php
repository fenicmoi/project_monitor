<?
include "chksession.php" ;
?>
<?
session_start();
$session=session_id();
$time=time();

include "connect.php" ;
$sql = "select * from $tableuser where username='$sess_username' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array($result) ;
$school = $r [school] ;
$status = $r [status] ;
mysql_close () ;
//echo"$school" ;
//exit () ;
$time_check=$time-1200; //กำหนดเวลาในที่นี้ผมกำหนด 10 นาที
$onhostname = "localhost"; 
$onuser = "rayong1"; 
$onpassword = "sql159469"; 
$ondbname = "rayong1"; //กำหนด Database
$ontblname = "sb_user_online"; //กำหนดตารางที่เก็บข้อมูล
mysql_connect($onhostname, $onuser, $onpassword) or die("ติดต่อฐานข้อมูลไม่ได้");
mysql_select_db($ondbname) or die("เลือกฐานข้อมูลไม่ได้");
$session_db = mysql_query("select count(*) from $ontblname where session='$session'");
$session_check = mysql_result($session_db,0);
if ($session_check == "0") {
mysql_query("insert into $ontblname values ('$session','$time','$school')"); 
} else { 
mysql_query("update $ontblname set time='$time' where session='$session'"); 
} 
$count_user = mysql_query("select count(*) from $ontblname");
$user_online = mysql_result($count_user,0); 
echo "กำลังใช้งานอยู่ : $user_online คน"; //ทดสอบการแสดงผล ถ้านำไปใช้ให้ปิด หรือลบบรรทัดนี้ออกไป
mysql_query("delete from $ontblname where time<$time_check");
?> 
