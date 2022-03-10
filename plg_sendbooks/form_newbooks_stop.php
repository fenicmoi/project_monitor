<?
include "chksession.php" ;
include "lang-thai.php";
?>
<?
include "connect.php" ;
$sql = "select * from $tableuser where username='$sess_username' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array($result) ;
$school = $r [school] ;
$status = $r [status] ;
mysql_close () ;
if ($status=="No" or $status=="public") {
header ("Location:login.php") ;
	exit () ;
}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="th">
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link rel="stylesheet" href="include/sujane_style.css" type="text/css">
<title>ส่งหนังสือจาก<? echo _NAME ;?></title>
<script language="JavaScript">
<!--
function doCheck(which) {
if(which.checked==true) {
//alert("OK !!! ");
document.form2.school.disabled=false;
document.form2.school.focus();
} else {
//alert("Not OK !!! ");
document.form2.school.disabled=true;
}
}
// -->
</script>
</head>

<body>
<h2 align="center">ส่งหนังสือใหม่จาก<? echo _NAME ;?></h2>
<DIV align="center">
  <CENTER>
  <TABLE border="1" cellpadding="3" cellspacing="1" style="border-collapse: collapse" bordercolor="#C0C0C0" width="780">
    <FORM method="POST" name="form2" action="newbooks.php" enctype="multipart/form-data">
  <TR>
        <TD width="24%" align="center"><B><FONT color="#CC33FF">จาก</FONT></B></TD>
        <TD width="76%">&nbsp;<?=$school?><INPUT TYPE="hidden" name="from" value="<?=$school?>"></TD>
      </TR>
      <TR>
        <TD width="24%" align="center" rowspan="3"><B><FONT color="#CC33FF">ถึง</FONT></B></TD>
        <TD width="76%">
        <FONT color="#9933FF">
        <INPUT type="radio" value="ทุกหน่วยงานในสังกัด" name="sendto" ><SPAN lang="en-us">
        </SPAN>ทุกหน่วยงาน</FONT></TD>
      </TR>
      <TR>
        <TD width="76%"><FONT color="#9933FF">
        <INPUT type="radio" value="หน่วยงาน" name="sendto" onclick="doCheck(this);"> หน่วยงาน</FONT><SPAN lang="en-us"><FONT color="#9933FF">
        <INPUT type="text" name="school" size="60" disabled></FONT></SPAN></TD>
      </TR>
      <TR>
        <TD width="76%"><FONT color="#9933FF">
        <INPUT type="radio" value="ผู้ดูแลระบบ" name="sendto"> ผู้ดูแลระบบ</FONT></TD>
      </TR>
            <TR>
        <TD width="24%" align="center"><B><FONT color="#CC33FF">เรื่อง</FONT></B></TD>
        <TD width="76%">&nbsp;<INPUT type="text" name="subject" size="72"></TD>
      </TR>
      <TR>
        <TD width="24%" align="center"><B><FONT color="#CC33FF">ข้อความ</FONT></B></TD>
        <TD width="76%">&nbsp;<TEXTAREA rows="8" name="message" cols="70"></TEXTAREA></TD>
      </TR>
      <TR>
        <TD width="24%" align="center"><B><FONT color="#CC33FF">ระบบตอบรับ</FONT></B></TD>
        <TD width="76%"><INPUT type="checkbox" name="reply" value="ON">
        <SPAN lang="th"><FONT color="#0000ff">
        (คลิกเลือกกรณีที่ต้องการให้มีฟอร์มเพื่อการตอบกลับจากหน่วยงาน)</FONT></SPAN> </TD>
      </TR>
      <TR>
        <TD width="24%" align="center"><B><FONT color="#CC33FF">ไฟล์หนังสือ</FONT></B></TD>
        <TD width="76%">&nbsp;<INPUT type="file" name="bookfile" size="49"><BR>
&nbsp;<FONT face="MS Sans Serif" color="#FF0000" size="2"><SPAN style="font-size: 10pt">(</SPAN><SPAN style="font-size: 10pt" lang="th">เฉพาะไฟล์
        </SPAN><FONT size="2">doc</FONT><FONT size="2">, pdf, <SPAN lang="en-us">
        xls, </SPAN>zip, gif, jpg ขนาดไม่เกิน 500 Kb)</FONT></FONT></TD>
      </TR>
       </TABLE>
  </CENTER>
</DIV>
<P align="center">
  <INPUT type="submit" value="ส่งหนังสือ"> <INPUT type="reset" value="ตั้งค่าใหม่"> <input type=button value='กลับหน้าหลัก' onClick=window.location='index.php'  ></P>
</FORM>
 <center>
<? include "include/footer.html" ;?>
	</center>
</body>

</html>