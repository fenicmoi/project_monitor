<?
include "chksession.php" ;
?>
<?
$id = $_GET ['id'] ;
if ($id=="") {
	header ("Location:login.php") ;
	exit () ;
}

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

include "connect.php" ;
$sql = "SELECT *  from $tablenewbooks where id='$id' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array ($result) ;
		$id = $r [id] ;
		$from = $r [sendfrom] ;
		$sendto = $r [sendto] ;
		$subject = $r [subject] ;
		$sendtimestamp = $r [sendtimestamp] ;
		$vbookid=sprintf("%06d", $id) ;
	mysql_close () ;
	
	$send_d = date ("j", $sendtimestamp) ;
$send_m = date ("n", $sendtimestamp) ;
	if ($send_m == 1) {
		$send_m = "ม.ค." ;
	} elseif ($send_m == 2) {
		$send_m = "ก.พ." ;
	} elseif ($send_m == 3) {
		$send_m = "มี.ค." ;
	} elseif ($send_m == 4) {
		$send_m = "เม.ษ." ;
	} elseif ($send_m == 5) {
		$send_m ="พ.ค." ;
	}elseif ($send_m == 6) {
		$send_m="มิ.ย." ;
	}elseif ($send_m == 7) {
		$send_m="ก.ค." ;
	}elseif ($send_m == 8) {
		$send_m="ส.ค." ;
	}elseif ($send_m == 9) {
		$send_m="ก.ย." ;
	}elseif ($send_m == 10) {
		$send_m="ต.ค." ;
	}elseif ($send_m == 11) {
		$send_m="พ.ย." ;
	}elseif ($send_m == 12) {
		$send_m="ธ.ค." ;
	}
$send_y = date ("Y", $sendtimestamp) + 543 ;
$send_t = date ("G.i.s", $sendtimestamp) ;

//timestamp of now
$nowtimestamp = mktime(date("H"), date("i"),date("s"), date("m") ,date("d"), date("Y"))  ;	//timestamp เวลาปัจจุบัน 
$timepass=  $nowtimestamp-$sendtimestamp ;
$h_pass1=$timepass/3600 ;
 $hour = explode("." ,$h_pass1) ;
 $h_pass= $hour[0] ;


//echo"$timepass" ;
//exit() ;
$now_m = date ("n") ;
	if ($now_m == 1) {
		$now_m = "ม.ค." ;
	} elseif ($now_m == 2) {
		$now_m = "ก.พ." ;
	} elseif ($now_m == 3) {
		$now_m = "มี.ค." ;
	} elseif ($now_m == 4) {
		$now_m = "เม.ษ." ;
	} elseif ($now_m == 5) {
		$now_m ="พ.ค." ;
	}elseif ($now_m == 6) {
		$now_m="มิ.ย." ;
	}elseif ($now_m == 7) {
		$now_m="ก.ค." ;
	}elseif ($now_m == 8) {
		$now_m="ส.ค." ;
	}elseif ($now_m == 9) {
		$now_m="ก.ย." ;
	}elseif ($now_m == 10) {
		$now_m="ต.ค." ;
	}elseif ($now_m == 11) {
		$now_m="พ.ย." ;
	}elseif ($now_m == 12) {
		$now_m="ธ.ค." ;
	}


?>
<html>
<head><title>รายชื่อหน่วยงานที่ยังไม่ตอบรับหนังสือ</title>
<link rel="stylesheet" href="include/pat_style.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<meta http-equiv="Content-Language" content="th">
</head>
<body>
<P align="center">
<SPAN lang="th"><FONT size="4" color="#800000" style="font-size: 14pt">
รายชื่อหน่วยงานที่ยังไม่ตอบรับหนังสือ </FONT> </SPAN></P>
<DIV align="center">
  <CENTER>
  <TABLE border="1" cellpadding="2" style="border-collapse: collapse" bordercolor="#CF9CFE" width="600" id="AutoNumber1">
    <TR>
      <TD width="22%" align="center"><FONT color="#000080">
<SPAN lang="th">ลำดับที่ </SPAN></FONT></TD>
      <TD width="78%">&nbsp;<FONT SIZE="" COLOR="#CC00CC">#<?=$vbookid?></FONT></TD>
    </TR>
    <TR>
      <TD width="22%" align="center"><FONT color="#000080"><SPAN lang="th">
      เรื่อง</SPAN></FONT></TD>
      <TD width="78%">&nbsp;<FONT SIZE="" COLOR="#CC0066"><?=$subject?></FONT></TD>
    </TR>
    <TR>
      <TD width="22%" align="center"><FONT color="#000080"><SPAN lang="th">
      ส่งถึง</SPAN></FONT></TD>
      <TD width="78%">&nbsp;<FONT SIZE="" COLOR="#3366FF"><?=$sendto?></FONT></TD>
    </TR>
    <TR>
      <TD width="22%" align="center"><FONT color="#000080"><SPAN lang="th">
      จากกลุ่ม</SPAN></FONT></TD>
      <TD width="78%">&nbsp;<FONT SIZE="" COLOR="#660066"><?=$from?></FONT>&nbsp;&nbsp;<FONT SIZE="" COLOR="#CC3366">ส่งเมื่อ &nbsp;<?=$send_d?>&nbsp;<?=$send_m?><?=$send_y?>&nbsp;เวลา&nbsp;<?=$send_t?>&nbsp;น.</FONT></TD>
    </TR>
  </TABLE>
 
  </CENTER>
 
</DIV><br>
<DIV align="center">
  <CENTER>
  <?
  include "connect.php" ; //ตรวจสอบจำนวนคำตอบ
		$sql3 = "select * from $tableanswer where bookid='$id' " ;
		$result3 = mysql_db_query ($dbname, $sql3) ;
		$no_of_answer = mysql_num_rows($result3) ;
		
include "connect.php" ; //ตรวจสอบจำนวน User
$sql4 = "select * from $tableuser where status='No' " ;
$result4 = mysql_db_query ($dbname, $sql4) ;
$no_of_user = mysql_num_rows($result4) ;

$unreply = $no_of_user- $no_of_answer ;
		
		?>
		<FONT SIZE="" COLOR="#3366FF" style="font-size: 12pt" >จำนวนหน่วยงานที่ยังไม่ตอบรับหนังสือฉบับนี้ <FONT SIZE="" COLOR="#996633">(ณ วันที่ <?=date("j")?>&nbsp;<?=$now_m?>&nbsp;<?=date("Y")+543?>&nbsp;เวลา&nbsp;<?=date ("G:i:s") ?>น.)</FONT> จำนวน</FONT>&nbsp;<B><FONT SIZE="" style="font-size: 12pt" COLOR="#FF0033"><?=$unreply?></FONT></B>&nbsp;<FONT SIZE="" COLOR="#3366FF" style="font-size: 12pt" >หน่วยงาน</FONT><BR><BR><CENTER><FONT SIZE="" COLOR="#FF0033"><B>ซึ่งผ่านไปแล้ว&nbsp;<?=$h_pass?>&nbsp;ชั่วโมง</B></FONT></CENTER><BR>
  <TABLE border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#808080" width="790" id="AutoNumber2">
     <TR>   
	 <?
 
include "connect.php" ;
$sql = "select * from $tableuser where status='No'" ;
$result = mysql_db_query ($dbname, $sql) ;
$totalrecord = mysql_num_rows($result) ;
$mlist =0 ;
$list=1 ;
$check=1;
while ($list<=$totalrecord && $r = mysql_fetch_array($result)) {

		$school = $r [school] ;
		include "connect.php" ;
		$sql2 = "select * from $tableanswer where bookid='$id' and name='$school' " ;
		$result2 = mysql_db_query ($dbname, $sql2) ;
		$answer = mysql_num_rows($result2) ;
	


				if ($answer<=0) {
$mlist = $mlist+1;

				?>
 
      <TD >&nbsp;<FONT SIZE="" COLOR="#660099"><?=$mlist?></FONT>.&nbsp;<FONT SIZE="" COLOR="#0000FF"><?=$school?></FONT></TD>
   
    <?if($check%4==0)
{
echo "</tr><tr>";
}
$check++;

    	}

$list++;
}
mysql_close() ;

?> </TR>
  </TABLE>
  </CENTER>
</DIV>
<center>
<? include "include/footer.html" ;
?>
	</center>

</body>
</html>