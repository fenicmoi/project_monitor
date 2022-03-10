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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/sujane_style.css" type="text/css">
<title>ระบบรับส่ง<? echo _NAME ;?></title>
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
<h2 align="center">ระบบรับส่ง<? echo _NAME ;?></h2>
<DIV align="center">
  <CENTER>
  <TABLE border="1" cellpadding="3" cellspacing="1" style="border-collapse: collapse" bordercolor="#C0C0C0" width="780">
    <FORM method="POST" name="form2" action="newbooks.php" enctype="multipart/form-data">
  <TR>
        <TD width="24%" align="center"><B><FONT color="#CC33FF">�ҡ</FONT></B></TD>
        <TD width="76%">&nbsp;<?=$school?><INPUT TYPE="hidden" name="from" value="<?=$school?>"></TD>
      </TR>
      <TR>
        <TD width="24%" align="center" rowspan="3"><B><FONT color="#CC33FF">�֧</FONT></B></TD>
        <TD width="76%">
        <FONT color="#9933FF">
        <INPUT type="radio" value="�ء˹��§ҹ��ѧ�Ѵ" name="sendto" ><SPAN lang="en-us">
        </SPAN>�ء˹��§ҹ</FONT></TD>
      </TR>
      <TR>
        <TD width="76%"><FONT color="#9933FF">
        <INPUT type="radio" value="˹��§ҹ" name="sendto" onclick="doCheck(this);"> ˹��§ҹ</FONT><SPAN lang="en-us"><FONT color="#9933FF">
        <INPUT type="text" name="school" size="60" disabled></FONT></SPAN></TD>
      </TR>
      <TR>
        <TD width="76%"><FONT color="#9933FF">
        <INPUT type="radio" value="�������к�" name="sendto"> �������к�</FONT></TD>
      </TR>
            <TR>
        <TD width="24%" align="center"><B><FONT color="#CC33FF">����ͧ</FONT></B></TD>
        <TD width="76%">&nbsp;<INPUT type="text" name="subject" size="72"></TD>
      </TR>
      <TR>
        <TD width="24%" align="center"><B><FONT color="#CC33FF">��ͤ���</FONT></B></TD>
        <TD width="76%">&nbsp;<TEXTAREA rows="8" name="message" cols="70"></TEXTAREA></TD>
      </TR>
      <TR>
        <TD width="24%" align="center"><B><FONT color="#CC33FF">�к��ͺ�Ѻ</FONT></B></TD>
        <TD width="76%"><INPUT type="checkbox" name="reply" value="ON">
        <SPAN lang="th"><FONT color="#0000ff">
        (��ԡ���͡�óշ���ͧ�������տ�������͡�õͺ��Ѻ�ҡ˹��§ҹ)</FONT></SPAN> </TD>
      </TR>
      <TR>
        <TD width="24%" align="center"><B><FONT color="#CC33FF">���˹ѧ���</FONT></B></TD>
        <TD width="76%">&nbsp;<INPUT type="file" name="bookfile" size="49"><BR>
&nbsp;<FONT face="MS Sans Serif" color="#FF0000" size="2"><SPAN style="font-size: 10pt">(</SPAN><SPAN style="font-size: 10pt" lang="th">੾�����
        </SPAN><FONT size="2">doc</FONT><FONT size="2">, pdf, <SPAN lang="en-us">
        xls, </SPAN>zip, gif, jpg Unlimit)</FONT></FONT></TD>
      </TR>
       </TABLE>
  </CENTER>
</DIV>
<P align="center">
  <INPUT type="submit" value="��˹ѧ���"> <INPUT type="reset" value="��駤������"> <input type=button value='��Ѻ˹����ѡ' onClick=window.location='index.php'  ></P>
</FORM>
 <center>
<? include "include/footer.html" ;?>
	</center>
</body>

</html>