<?


include "connect.php" ;
$sql = "update  $tableuser set code='' where code='code' " ;

$result = mysql_db_query ($dbname, $sql) ;
	if ($result) {
		echo "<center><h2>บันทึกข้อมูลเรียบร้อยแล้ว</h2> <br><input type=\"button\" value=\"ปิดหน้าต่างนี้\" onClick=\"javascript:window.close()\" ></center> ";
	} else {
		echo "<center><h2>ไม่สามารถบันทึกข้อมูลได้</h2> <br><input type=\"button\" value=\"ปิดหน้าต่างนี้\" onClick=\"javascript:window.close()\" ></center> ";
	}?>