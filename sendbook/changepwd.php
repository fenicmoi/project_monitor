<?
include "chksession.php" ;
?>
<?
 $name = $_POST ['name'] ;
 $position = $_POST ['position'] ;
 $privateno = $_POST ['privateno'] ;
 $officenumber = $_POST ['officenumber'] ;
 $code = $_POST ['code'] ;
 $newpass = $_POST ['newpass'] ;
 $newpass2 = $_POST ['newpass2'] ;

//echo"$newpass<BR>$newpass2" ;
//exit () ;
if ($name=="" or $code == "" or $position == "" or $privateno == "" or $officenumber == ""  or $code == "" or $newpass == "" or $newpass2 =="") {
	echo "<center><h2>กรุณากรอกข้อมูลให้ครบ</h2> <br><input type=\"button\" value=\"&nbsp;แก้ไข&nbsp;\" onClick=\"javascript:history.go(-1)\" ></center>" ;
exit () ;
} 

if ($newpass<>$newpass2) {
	echo "<center><h2>คุณกรอกรหัสผ่านใหม่ทั้ง 2  ครั้ง ไม่ตรงกัน</h2> <br><input type=\"button\" value=\"&nbsp;แก้ไข&nbsp;\" onClick=\"javascript:history.go(-1)\" ></center>" ;
exit () ;
} 


include "connect.php" ;
$sql = "select * from $tableuser where username='$sess_username' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array($result) ;
$oldcode = $r [code] ;
mysql_close () ;

if ($oldcode =="") {

include "connect.php" ;
$sql = "update  $tableuser set admin_name='$name', position='$position', pri_no='$privateno', off_no='$officenumber', code='$code', password='$newpass' where username='$sess_username' " ;

$result = mysql_db_query ($dbname, $sql) ;
	if ($result) {
		echo "<center><h2>บันทึกข้อมูลเรียบร้อยแล้วโปรดบันทึกข้อมูลเหล่านี้เอาไว้</h2> <BR>รหัสลับของท่านคือ : <B>$code</b> (ใช้ในการเปลี่ยนรหัสผ่านครั้งต่อไป)<BR>รหัสผ่านใหม่ของท่านคือ : <B>$newpass</B> (ใช้ในการเข้าสู่ระบบครั้งต่อไป<BR><BR><input type=\"button\" value=\"เข้าสู่ระบบใหม่อีกครั้ง\" onClick=\"window.location='logout.php'\"></center> ";
	} else {
		echo "<center><h2>ไม่สามารถบันทึกข้อมูลได้</h2> <br><input type=\"button\" value=\"กลับหน้าหลัก\" onClick=\"window.location='index.php'\"></center> ";
	}

} elseif ($oldcode<>"") {

				if ($oldcode<>$code) {
	echo "<center><h2>รหัสลับไม่ตรงกับที่ตั้งไว้ ไม่สามารถเปลี่ยนรหัสผ่านได้</h2> <br><input type=\"button\" value=\"&nbsp;แก้ไข&nbsp;\" onClick=\"javascript:history.go(-1)\" ></center>" ;

} else {

include "connect.php" ;
$sql = "update  $tableuser set admin_name='$name', position='$position', pri_no='$privateno', off_no='$officenumber', code='$code', password='$newpass' where username='$sess_username' " ;

$result = mysql_db_query ($dbname, $sql) ;
	if ($result) {
		echo "<center><h2>บันทึกข้อมูลเรียบร้อยแล้ว</h2> <br><input type=\"button\" value=\"กลับหน้าหลัก\" onClick=\"window.location='index.php'\"></center> ";
	} else {
		echo "<center><h2>ไม่สามารถบันทึกข้อมูลได้</h2> <br><input type=\"button\" value=\"กลับหน้าหลัก\" onClick=\"window.location='index.php'\"></center> ";
	}

}

}
?>