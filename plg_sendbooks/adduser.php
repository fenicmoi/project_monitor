<?
include "chksession.php" ;
?>
<?
 $username = $_POST ['username'] ;
 $password = $_POST ['password'] ;
 $school = $_POST ['school'] ;
 $status = $_POST ['status'] ;

//echo"$newpass<BR>$newpass2" ;
//exit () ;
if ($username=="" or $password=="" or $school=="" or $status==""  ) {
	echo "<center><h2>กรุณากรอกข้อมูลที่จำเป็นให้ครบ (ที่มีเครื่องหมาย *)</h2> <br><input type=\"button\" value=\"&nbsp;แก้ไข&nbsp;\" onClick=\"javascript:history.go(-1)\" ></center>" ;
exit () ;
} 

include "connect.php" ;
$sql1 = "select * from $tableuser where username='$username' " ;
$result1 = mysql_db_query ($dbname, $sql1) ;
$num = mysql_num_rows ($result1) ;
if ($num<>0) {
echo "<center><h2>Username  <I>$username</I> มีคนใช้แล้ว</h2> <br><input type=\"button\" value=\"&nbsp;แก้ไข&nbsp;\" onClick=\"javascript:history.go(-1)\" ></center>" ;
exit () ;
} 
$sql = "Insert into $tableuser VALUES ('', '$username','$password', '$id_smis', '$school', '$status', '$code', '$name', '$position', '$privateno', '$officenumber') " ;

$result = mysql_db_query ($dbname, $sql) ;
	if ($result) {
		echo "<center><h2>บันทึกข้อมูลเรียบร้อยแล้ว</h2> <br><input type=button value='กลับหน้าผู้ใช้งานระบบ' onClick=window.location='userdetail.php'></center> ";
	} else {
		echo "<center><h2>ไม่สามารถบันทึกข้อมูลได้</h2> <br><input type=button value='กลับหน้าผู้ใช้งานระบบ' onClick=window.location='userdetail.php'></center> ";
	}?>