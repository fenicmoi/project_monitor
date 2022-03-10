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
$selectid = $_GET ['selectid'] ;
if ($selectid=="" ) {
	header ("Location:login.php") ;
	exit () ;
}

include "connect.php" ;
$sql = "select * from $tableuser where username='$selectid' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array($result) ;
$username = $r [username]; 
$password = $r [password] ;
$id_smis = $r [id_smis] ;
$school = $r [school] ;
$status = $r [status] ;
$code = $r [code] ;
$name = $r [admin_name] ;
$position = $r [position] ;
$privateno = $r [pri_no] ;
$officenumber = $r [off_no] ;
mysql_close () ;

?>
<html>

<head>
<meta http-equiv="Content-Language" content="th">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<title>รายละเอียดข้อมูลผู้ใช้</title>
</head>

<body>

<h3 align="center"><font color="#800080">รายละเอียดผู้ใช้งานระบบสารบรรณ</font></h3>
<div align="center">
  <center>  <form method="POST" action="edit.php">
  <table border="1" cellpadding="3" style="border-collapse: collapse" bordercolor="#111111" width="800">
    <tr>
      <td width="149" align="right"><font color="#9966FF"><b><span lang="en-us">
      <font color="#FF0000">*</font> Username</span></b></font></td>
      <td width="785">
    
       <input type="hidden" name="username" size="29" value="<?=$username?>"><?=$username?></td>
    </tr>
    <tr>
      <td width="149" align="right"><font color="#9966FF"><b><span lang="en-us">
      <font color="#FF0000">*</font> Password</span></b></font></td>
      <td width="785">
      <input type="text" name="password" size="29" value="<?=$password?>">&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td width="149" align="right"><font color="#9966FF"><b><span lang="en-us">
      ID_Smis</span></b></font></td>
      <td width="785">
      <input type="text" name="id_smis" size="29" value="<?=$id_smis?>">&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td width="149" align="right"><font color="#9966FF"><b>โรงเรียน/กลุ่ม</b></font></td>
      <td width="785">
      <input type="text" name="school" size="29" value="<?=$school?>">&nbsp;</td>
    </tr>
    <tr>
      <td width="149" align="right"><font color="#9966FF"><b> <span lang="en-us"><font color="#FF0000">*</font></span> สถานะการใช้งาน</b></font></td>
      <td width="785">
	  <? if ($status=="Yes1"){
		  $chk1="selected";
	   }else if($status=="Yes"){
		  $chk2="selected";
		   }else if($status=="No"){
		  $chk3="selected";
		   }else if($status=="public"){
		  $chk4="selected";
		   }
		  ?>
      <select size="1" name="status">
	<option value="Yes1" <?=$chk1?>>ผู้ดูแลระบบ</option>
	<option value="Yes" <?=$chk2?>>กลุ่มงานในสำนักงานจังหวัด</option>
	<option value="No" <?=$chk3?>>หน่วยงานในสังกัด</option>
	<option value="public" <?=$chk4?>>หน่วยงานอื่นๆ</option>
	</select>&nbsp;</td>
    </tr>
    <tr>
      <td width="149" align="right"><font color="#9966FF"><b> <span lang="en-us"><font color="#FF0000"></font></span> รหัสลับ</b></font></td>
      <td width="785">
      <input type="text" name="code" size="29" value="<?=$code?>"><span lang="en-us">
      </span><font size="2" color="#008080">ถ้าช่องรหัสลับเป็นค่าว่าง
      หมายถึงยังไม่มีการกำหนดรหัสลับ (ไม่มีข้อมูลผู้ดูแลระบบ)</font></td>
    </tr>
    <tr>
      <td width="149" align="right"><font color="#9966FF"><b>ผู้ดูแลระบบ</b></font></td>
      <td width="785">
      <input type="text" name="name" size="29" value="<?=$name?>">&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td width="149" align="right"><font color="#9966FF"><b>ตำแหน่ง</b></font></td>
      <td width="785">
      <input type="text" name="position" size="29" value="<?=$position?>">&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td width="149" align="right"><font color="#9966FF"><b>โทรศัพท์มือถือ/บ้าน</b></font></td>
      <td width="785">
      <input type="text" name="privateno" size="29" value="<?=$privateno?>">&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td width="149" align="right"><font color="#9966FF"><b>โทรศัพท์ที่ทำงาน</b></font></td>
      <td width="785">
      <input type="text" name="officenumber" size="29" value="<?=$officenumber?>">&nbsp;&nbsp;</td>
    </tr>
  </table>      
  </center>
</div>
<p align="center">
           <input type="submit" value="บันทึกข้อมูล" > </p></form>
 <center>
<? include "include/footer.html" ;?>
</center>
</body>

</html>
