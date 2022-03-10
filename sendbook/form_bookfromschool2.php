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
if ($status=="No") {
header ("Location:login.php") ;
	exit () ;
}
?>

<html>
<head>
<title>ส่งหนังสือไx<? echo _NAME ;?></title>
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
<input type=button value='ทะเบียนหนังสือส่งจากโรงเรียน' onClick=window.location='bookfromschool2.php' > </span></font>
      </td>
    </tr>
  </table>
    <br>
    
  <form action="newbookfromschool2.php" method="post" enctype="multipart/form-data" name="form1">
    <input type="hidden" value="upload">
    <table width="778" border="0" cellspacing="0" cellpadding="0">
     
          <td width="778"> 
            
          <div align="center">
            <center> 
            
          <table width="697" border="1" style="border-collapse: collapse" bordercolor="#C0C0C0" cellpadding="0" cellspacing="0">
            <tr> 
              <td width="91" height="40" bgcolor="#D7D7FF" align="center">
              <font face="MS Sans Serif" size="2" color="#0000FF"><b>จาก :</b></font></td>
              <td width="603" height="40" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;<?=$school?>
                <input type="hidden" name="fromname" size="25" maxlength="50" value="<?=$school?>">
              </td>
            </tr>
            <tr> 
              <td width="91" height="40" bgcolor="#D7D7FF" align="center">
              <span lang="th"><font color="#0000FF"><b>เลขหนังสือ</b></font></span></td>
              <td width="603" height="40" bgcolor="#FFFFFF" >
              <span lang="th"><font color="#800000">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;
              <span lang="th">
              <input type="text" name="bookno" size="30" ></span></font></td>
            </tr>
            <tr> 
              <td width="91" height="40" bgcolor="#D7D7FF" align="center">
              <font color="#0000FF"><b>
              เรื่อง</b></font><font face="MS Sans Serif" size="2" color="#0000FF"><b> 
              :</b></font></td>
              <td width="603" height="40" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <input type="text" name="subject" size="63" maxlength="100">
              </td>
            </tr>
            <tr> 
              <td width="91" height="40" bgcolor="#D7D7FF" align="center">
              <b><font color="#0000FF">ไฟล์หนังสือ</font><font face="MS Sans Serif" size="2" color="#0000FF"> 
              :</font></b></td>
              <td width="603" height="40" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <input type="file" name="bookfile" size="30"> &nbsp;<font face="MS Sans Serif" size="2" color="#000000">(<span lang="th">เฉพาะไฟล์
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
  <a href="index2.php">กลับหน้าทะเบียนหนังสือจาก<? echo _NAME ;?></a></font></p>
<center>
<? include "include/footer.html" ;?>
	</center>
</body>
</html>