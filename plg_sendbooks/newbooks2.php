<?
//เรียกตัวแปรจากฟอร์ม
$from = $_POST ['from'];
$sendto = $_POST ['sendto'] ;
$school = $_POST ['school'] ;
If ($sendto  == "โรงเรียน" and $school=="") {//ถ้ามีการเลือกส่งระบุโรงเรียนให้ใช้ค่าจากในตัวแปร $school
echo "<center><h2>กรุณาระบุชื่อโรงเรียน</h2> <br><input type=\"button\" value=\"&nbsp;แก้ไข&nbsp;\" onClick=\"javascript:history.go(-1)\" ></center>" ;
exit () ;
} elseif ($sendto  == "โรงเรียน" and $school<>"") {
	$sendto= "โรงเรียน" . $school ;
}
$subject = $_POST ['subject'] ;
$message = $_POST ['message'] ;
$reply = $_POST ['reply'] ;
$sendtimestamp = mktime(date("H"), date("i"),date("s"), date("m") ,date("d"), date("Y"))  ;	//timestamp เวลาปัจจุบัน 
$timestamp24 = mktime(date("H"), date("i"),date("s"), date("m") ,date("d")+1, date("Y"))  ;	//timestamp เวลาปัจจุบัน 


$bookfile = $_FILES ['bookfile'] ['tmp_name'] ;
$bookfile_name = $_FILES ['bookfile'] ['name'] ;
$bookfile_size = $_FILES ['bookfile'] ['size'] ;
$bookfile_type = $_FILES ['bookfile'] ['type'] ;
$booksizelimit = 500*1024 ;

 //echo"$subject<BR>$message" ;
 //exit() ;
//ตรวจสอบค่าว่าง
if ( $sendto=="" or $subject=="" or $message=="" ) {
echo "<center><h2>กรุณากรอกข้อมูลให้ครบ</h2> <br><input type=\"button\" value=\"&nbsp;แก้ไข&nbsp;\" onClick=\"javascript:history.go(-1)\" ></center>" ;
exit () ;
} 
if ($bookfile_size > $booksizelimit ) { //ตรวจสอบขนาดไฟล์
	echo "<center><h2>ไฟล์หนังสือมีขนาดเกิน 500 Kb ไม่อนุญาตให้ส่ง</h2> <br><input type=\"button\" value=\"แก้ไขข้อมูล\" onClick=\"javascript:history.go(-1)\" ></center>" ;
exit () ;
} 

include "connect.php" ;
$sql = "select * from $tablenewbooks2  Order By id DESC" ;
$result= mysql_db_query ($dbname, $sql) ;
$num = mysql_num_rows ($result) ;
$r = mysql_fetch_array ($result) ;
If ($num==0) {
	$id = 0 ;
} else {
	$id = $r [id] ;
}
$id = $id + 1 ;

mysql_close () ;

//ถ้ามีการส่งไฟล์ ให้คัดลอกไปยัง booksfile และเพิ่มข้อมูลหนังสือใหม่
if ($bookfile <> "") { 
 $array_last = explode("." ,$bookfile_name) ;
 $c =count ($array_last) - 1 ;
 $lastname = strtolower ($array_last [$c] ) ;
 //เฉพาะไฟล์ doc, pdf, xls, zip, gif, jpg,  ขนาดไม่เกิน 500 Kb
 if ($lastname =="doc" or $lastname =="pdf" or $lastname =="xls" or $lastname =="zip" or $lastname =="jpg" or $lastname =="gif" ) {
	 $filename = date("Y").date("m").date("d").date("H").date("i").date("s").".".$lastname ; //ชื่อไฟล์หนังสือ

	 copy ($bookfile, "booksfile2/".$filename)  ; 
include "connect.php" ;

 $sql= "INSERT INTO $tablenewbooks2 (`id`,`sendfrom`,`sendto`,`subject`,`message`,`reply`, `sendtimestamp`, `timestamp24`, `bookfile`,`nview`,`nreply`) VALUES ('$id', '$from', '$sendto', '$subject', '$message', '$reply', '$sendtimestamp', '$timestamp24', '$filename','','') ";
$result= mysql_db_query ($dbname, $sql); 
If ($result) {
	echo" <center><h2>บันทึกข้อมูลเรียบร้อยแล้ว</h2> <br> <input type=\"button\" value=\"กลับหน้าหลัก\" onClick=\"window.location='index2.php'\"></center> ";
} else{
	echo" <center><h2>ไม่สามารถบันทึกข้อมูลได้</h2> <br> <input type=\"button\" value=\"แก้ไขข้อมูล\" onClick=\"javascript:history.go(-1)\" ></center>";
}
 mysql_close ( );
 unlink ($bookfile) ;
	 }else {
	 echo "<center><h2>เฉพาะไฟล์ doc, pdf, xls, zip, gif, jpg,  ขนาดไม่เกิน 500 Kb เท่านั้น</h2><br><input type=\"button\" value=\"แก้ไขข้อมูล\" onClick=\"javascript:history.go(-1)\" ></center>" ;
exit () ;
	 }
	//ถ้าไม่มีการส่งไฟล์ให้เขียนค่ารายละเอียดหนังสือ
 } else {
	 include "connect.php" ;
	  $sql= "INSERT INTO $tablenewbooks2 (`id`,`sendfrom`,`sendto`,`subject`,`message`,`reply`, `sendtimestamp`, `timestamp24`, `bookfile`,`nview`,`nreply`) VALUES ('$id', '$from', '$sendto', '$subject', '$message', '$reply', '$sendtimestamp', '$timestamp24', '$filename','','') ";
$result= mysql_db_query ($dbname, $sql); 
mysql_close ( );
If ($result) {
	echo" <center><h2>บันทึกข้อมูลเรียบร้อยแล้ว</h2> <br> <input type=\"button\" value=\"กลับหน้าหลัก\" onClick=\"window.location='index.php'\"></center> ";
} else{
	echo" <center><h2>ไม่สามารถบันทึกข้อมูลได้</h2> <br> <input type=\"button\" value=\"แก้ไขข้อมูล\" onClick=\"javascript:history.go(-1)\" ></center>";
 }
 }
?>