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


?>
<html>

<head>
<meta http-equiv="Content-Language" content="th">
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<title>รายละเอียด ผู้ใช้งานระบบ</title>
<link rel="stylesheet" href="include/pat_style.css" type="text/css">

<style fprolloverstyle>A:hover {color: #008080; font-style: italic; font-weight: bold}
</style>
</head>

<body vlink="#0000FF" alink="#0000FF">
<?
$keyword = $_POST ['keyword'] ;
?>
<h2 align="center">      <font size="4" style="font-size: 19pt" color="#CC0099"> 
รายละเอียด ผู้ใช้งานระบบ</font></h2>
<form method="POST" action="userdetail.php">
<p align="right">
  <font color="#008080"><A HREF="form_adduser.php" >เพิ่มผู้ใช้งาน</A>&nbsp;|| &nbsp;พิมพ์ชื่อหน่วยงาน หรือ รหัสหน่วยงาน
  <input type="text" name="keyword" size="26">
  <input type="submit" value="ค้นหา"><span lang="en-us"> </span>&nbsp;
  <a href="index.php">กลับหน้าหลัก</a></font></p>
</form>


<div align="center">
  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#C0C0C0" width="548">
    <tr>
      <td align="center" bgcolor="#000080" width="30"><font color="#FFFFFF"><b>
      ที่</b></font></td>
      <td align="center" bgcolor="#000080" width="244"><font color="#FFFFFF"><b>
      หน่วยงาน</b></font></td>
      <td align="center" bgcolor="#000080" width="148"><span lang="en-us">
      <font color="#FFFFFF"><b>Username</b></font></span></td>
      <td align="center" bgcolor="#000080" width="121"><font color="#FFFFFF"><b>ลบ</b></font></td>
	  </tr>
	  
	  <?
	  if ($keyword =="" ) {
	 $note = "<CENTER>กรุณาพิมพ์ชื่อหน่วยงานหรือ รหัสหน่วยงาน</CENTER>" ;
	  }
include "connect.php" ;
$sql2 = "select * from $tableuser where school like '%$keyword%' or username='$keyword' " ;
$result2 = mysql_db_query ($dbname, $sql2) ;
$num = mysql_num_rows ($result2) ;
if ($num==0) {
?>
	
   <TABLE>
     <TR>
     	<TD>  <FONT SIZE="" COLOR="#FF0000">ไม่พบข้อมูลที่ท่านต้องการ</FONT></TD>
     </TR>
     </TABLE>
 
	<?
	  } else {
$list=1;
  while ($list <=$num &&  $r = mysql_fetch_array($result2) )  { 
$username = $r [username] ;
$school = $r [school] ;


if ($list % 2 == 0) {
	$color = "#E4E4E4";
}
else {
	$color = "#F7F7F7";
}
	  ?>
<tr  bgcolor="<?=$color?>">
      <td align="center" width="30"><?=$list?>&nbsp;</td>
      <td align="left" width="244">&nbsp;&nbsp;&nbsp;<A HREF='detail.php?selectid=<?=$username?>' target="_blank"><?=$school?></A></td>
      <td align="center" width="148"><?=$username?>&nbsp;</td>
      <td align="center" width="121"><a href="delete.php?delid=<?=$username?>"  onclick="return confirm ('ต้องการลบ <?=$username?> ออกจากระบบ ?')">ลบ</a></td>
    </tr>
<?
			$list++;
}
mysql_close() ;
	  }
?>
	</table><br><center>
</div>
       <center>
<? include "include/footer.html" ;?>
	</center>
</body>

</html>