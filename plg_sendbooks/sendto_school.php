<?
include "chksession.php" ;
?>
<?
include "lang-thai.php" ;
include "connect.php" ;
$sql = "select * from $tableuser where username='$sess_username' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array($result) ;
$school = $r [school] ;
$status = $r [status] ;
mysql_close () ;
if ($status=="Yes" or $status=="Yes1"or $status=="public") {
header ("Location:login.php") ;
	exit () ;
}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="th">
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link rel="stylesheet" href="include/sujane_style.css" type="text/css">
<title>ส่งหนังสือระหว่างหน่วยงานในสังกัด<? echo _NAME ;?></title>
</head>

<body>
<h2 align="center"><FONT color="#660099"  style="font-size:19pt">ส่งหนังสือระหว่างหน่วยงาน</FONT></h2><BR>
<CENTER><FONT style="font-size:16pt"COLOR="#FF0033">หนังสือที่ส่งระหว่างหน่วยงานจะไปแสดงที่หน้าแรกของระบบงานสารบรรณ
</FONT></CENTER><DIV align="center">
  <CENTER>
  <TABLE border="1" cellpadding="3" cellspacing="1" style="border-collapse: collapse" bordercolor="#C0C0C0" width="780">
    <FORM name="form1" method="POST" action="newbooks.php" enctype="multipart/form-data" onsubmit="return check()">
  <TR>
        <TD width="24%" align="center"><B><FONT color="#CC33FF">จาก</FONT></B></TD>
        <TD width="76%">&nbsp;<?=$school?><INPUT TYPE="hidden" name="from" value="<?=$school?>"></TD>
      </TR>
      <TR>
        <TD width="24%" align="center"><B><FONT color="#CC33FF">ถึง</FONT></B></TD>
        <TD width="76%">
        <FONT color="#9933FF">
        หน่วยงาน</FONT><SPAN lang="en-us"><FONT color="#9933FF">
		<INPUT type="hidden" value="หน่วยงาน" name="sendto">
        <INPUT type="text" name="school" size="60"></FONT></SPAN></TD>
      </TR>
            <TR>
        <TD width="24%" align="center"><B><FONT color="#CC33FF">เรื่อง</FONT></B></TD>
        <TD width="76%">&nbsp;<INPUT type="text" name="subject" size="72"></TD>
      </TR>
      <TR>
        <TD width="24%" align="center"><B><FONT color="#CC33FF">ข้อความ</FONT></B></TD>
        <TD width="76%">&nbsp;<TEXTAREA rows="8" name="message" cols="70"></TEXTAREA><INPUT type="hidden" name="reply" value="">
        <SPAN lang="th"></TD>
      </TR>
    
      <TR>
        <TD width="24%" align="center"><B><FONT color="#CC33FF">ไฟล์หนังสือ</FONT></B></TD>

        <TD width="76%">&nbsp;<INPUT type="file" name="bookfile" size="49"><BR>
&nbsp;<FONT face="MS Sans Serif" color="#FF0000" size="2"><SPAN style="font-size: 10pt">(</SPAN><SPAN style="font-size: 10pt" lang="th">เฉพาะไฟล์
        </SPAN><FONT size="2">&nbsp;pdf, <SPAN lang="en-us">
        xls, </SPAN>zip, gif, jpg ขนาดไม่เกิน 500 Kb)</FONT></FONT></TD>
      </TR>
       </TABLE>
  </CENTER>
</DIV>
<P align="center">
  <INPUT type="submit" value="ส่งหนังสือ"> <INPUT type="reset" value="ตั้งค่าใหม่"> <input type=button value='กลับหน้าหลัก' onClick=window.location='index.php'  ></P>
</FORM>
<script language="JavaScript">
<!--
function check()
{
      var v1 = document.form1.bookfile.value;
  
      
        if ( v1.length==0)
           {
           alert("กรุณาระบุไฟล์หนังสือด้วยครับ");
           document.form1.bookfile.focus();           
           return false;
           }
    
}

function emoticon(what)
{
	document.addboard.qDetail.value = document.addboard.elements.qDetail.value+" "+what;
	document.addboard.qDetail.focus();
}

function open_windows(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

//-->
</script>
 <center>
<? include "include/footer.html" ;?>
	</center>
</body>

</html>