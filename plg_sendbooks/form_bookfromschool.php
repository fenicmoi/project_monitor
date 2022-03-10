<?
include "chksession.php" ;
include "lang-thai.php" ;
?>
<?
include "connect.php" ;
$sql = "select * from $tableuser where username='$sess_username' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array($result) ;
$school = $r [school] ;
$status = $r [status] ;
mysql_close () ;
if ($status=="public") {
header ("Location:login.php") ;
	exit () ;
}
?>

<html>
<head>
<title>ส่งหนังสือไปยัง<? echo _NAME ;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link rel="stylesheet" href="include/sujane_style.css" type="text/css">
</head>
<body topmargin="0" marginheight="0" marginwidth="0" bgcolor="#FFFFFF">
<div align="center">
  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" height="76" background="images/bg_b2.gif">
    <tr>
      <td width="100%" height="76">
      <p align="center"><font color="#FF00FF" size="4" style="font-size: 19pt"><b>ส่งหนังสือไปยัง<? echo _NAME ;?></font><br><BR>
      </b>
<input type=button value='ทะเบียนหนังสือส่งจากหน่วยงาน' onClick=window.location='bookfromschool.php' > </span></font>
      <br>
      <b><font color="#0000FF" size="2">
      (คลิกที่นี่หากต้องการดูรายการหนังสือที่หน่วยงานส่งไปยังสำนักงานจังหวัดพัทลุง )</font></b></td>
    </tr>
  </table>
    <br>
    
  <form action="newbookfromschool.php" method="post" enctype="multipart/form-data" name="form1">
    <input type="hidden" value="upload">
    <table width="796" border="0" cellspacing="0" cellpadding="0">
     
          <td width="796"> 
            
          <div align="center">
            <center> 
            
          <table width="786" border="1" style="border-collapse: collapse" bordercolor="#C0C0C0" cellpadding="0" cellspacing="0">
            <tr> 
              <td width="91" height="40" bgcolor="#D7D7FF" align="center">
              <font face="MS Sans Serif" size="2" color="#0000FF"><b>จาก :</b></font></td>
              <td width="692" height="40" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;<?=$school?>
              <font face="MS Sans Serif">
                <input type="hidden" name="fromname" size="25" maxlength="50" value="<?=$school?>">
              </font><font color="#FF0000" face="MS Sans Serif" size="2">
              (ชื่อหน่วยงานที่ส่ง ระบบกำหนดให้เอง)</font></td>
            </tr>
            <tr> 
              <td width="91" height="40" bgcolor="#D7D7FF" align="center">
              <span lang="th"><font color="#0000FF"><b>เลขหนังสือ</b></font></span></td>
              <td width="692" height="40" bgcolor="#FFFFFF" >
              <font color="#800000">
              <span lang="th">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;
              <span lang="th">
              <input type="text" name="bookno" size="30" value="ที่ "></span> </font>
              <span lang="th">
              <font color="#FF0000" face="MS Sans Serif" size="2">
              (เลขหนังสือฉบับที่ต้องการส่ง </font>
              <font color="#800000" face="MS Sans Serif" size="2">เช่น </font>
              <font color="#000080" face="MS Sans Serif" size="2">ที่ ศธ. 
              04097.123/20</font><font color="#FF0000" face="MS Sans Serif" size="2">)</font></span></td>
            </tr>
            <tr> 
              <td width="91" height="40" bgcolor="#D7D7FF" align="center">
              <font color="#0000FF"><b>
              เรื่อง</b></font><font face="MS Sans Serif" size="2" color="#0000FF"><b> 
              :</b></font></td>
              <td width="692" height="40" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <input type="text" name="subject" size="63" maxlength="100">&nbsp;
              <font face="MS Sans Serif" size="2" color="#FF0000">
              (ชื่อเรื่องหนังสือฉบับที่ต้องการส่ง)</font></td>
            </tr>
            <tr> 
              <td width="91" height="40" bgcolor="#D7D7FF" align="center">
              <b><font color="#0000FF">ไฟล์หนังสือ</font><font face="MS Sans Serif" size="2" color="#0000FF"> 
              :</font></b></td>
              <td width="692" height="40" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <input type="file" name="bookfile" size="30"> &nbsp;<font face="MS Sans Serif" size="2" color="#FF0000">(ให้คลิกที่ปุ่ม
              <span lang="en-us">Browse </span>
              เพื่อแนบไฟล์หนังสือที่ได้จัดพิมพ์และแปลงเป็นไฟล์
              <span lang="en-us">pdf </span>แล้ว)</font><font face="MS Sans Serif" size="2" color="#000000"><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (<span lang="th">เฉพาะไฟล์
              </span>xls, pdf, zip, gif, jpg ขนาดไม่เกิน 500 Kb)</font> </td>
            </tr>
            </table>
            </center>
          </div>
          </td>
        </tr>
      </table>
      <br>
      <input type="submit" value="ส่งหนังสือ" >
      <input type="reset" value="พิมพ์ใหม่">
    </form>
  </div>
<p align="center"><font size="2" face="MS Sans Serif">
  <a href="index.php">กลับหน้าทะเบียนหนังสือจาก<? echo _NAME ;?></a></font></p>
<center>
<? include "include/footer.html" ;?>
	</center>
</body>
</html>