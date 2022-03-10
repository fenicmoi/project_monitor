<?
include "chksession.php" ;
?>
<?
 $username = $_POST ['username'] ;
 $password = $_POST ['password'] ;
 $id_smis = $_POST ['id_smis'] ;
 $school = $_POST ['school'] ;
 $status = $_POST ['status'] ;
  $code = $_POST ['code'] ;
 $name = $_POST ['name'] ;
 $position = $_POST ['position'] ;
 $privateno = $_POST ['privateno'] ;
 $officenumber = $_POST ['officenumber'] ;


//echo"$newpass<BR>$newpass2" ;
//exit () ;
if ($username=="" or $password==""  or $status==""  ) {
	echo "<center><h2>กรุณากรอกข้อมูลที่มีเครื่องหมาย * ให้ครบ</h2> <br><input type=\"button\" value=\"&nbsp;แก้ไข&nbsp;\" onClick=\"javascript:history.go(-1)\" ></center>" ;
exit () ;
} 

include "connect.php" ;
$sql = "update  $tableuser set id_smis='$id_smis', school='$school', admin_name='$name', position='$position', pri_no='$privateno', off_no='$officenumber', code='$code', password='$password' , status='$status' where username='$username' " ;

$result = mysql_db_query ($dbname, $sql) ;
	if ($result) {
		echo "<center><h2>บันทึกข้อมูลเรียบร้อยแล้ว</h2> <br><input type=\"button\" value=\"ปิดหน้าต่างนี้\" onClick=\"javascript:window.close()\" ></center> ";
	} else {
		echo "<center><h2>ไม่สามารถบันทึกข้อมูลได้</h2> <br><input type=\"button\" value=\"ปิดหน้าต่างนี้\" onClick=\"javascript:window.close()\" ></center> ";
	}?>