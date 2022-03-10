<?
include "chksession.php" ;
include "function.php" ;
include "lang-thai.php" ;
?>
<?
$id = $_GET ['id'] ;

if ($id=="") {
	header ("Location:index.php") ;
}

include "connect.php" ;
$sql = "SELECT *  from $tablenewbooks where id='$id' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array ($result) ;
		$id = $r [id] ;
		$from = $r [sendfrom] ;
		$sendto = $r [sendto] ;
		$subject = $r [subject] ;
		$message = $r [message] ; $message = nl2br(htmlspecialchars($message)) ;
		$reply = $r [reply] ;
		$sendtimestamp = $r [sendtimestamp] ;
		$timestamp24 = $r [timestamp24] ;
		$bookfile = $r [bookfile] ;
		$nview = $r [nview] ;

		$nview = $nview+1 ;
		$bookid=sprintf("%06d", $id) ; //รหัสหนังสือ

		$sendday = date ("Y-m-d", $sendtimestamp) ;
		$thaiday=displaydate($sendday) ;  //วันปัจจบัน (ภาษาไทย)
		$send_t = date ("G.i.s", $sendtimestamp) ;

	mysql_close() ;
	//user Details
include "connect.php" ;
$sql = "select * from $tableuser where username='$sess_username' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array($result) ;
$school = $r [school] ;
$status = $r [status] ;
//echo "$status" ;
//exit () ;

mysql_close () ;

include "connect.php" ;
$sql3 = "select * from $tableanswer where bookid='$id' and name='$school'" ;
$result3 = mysql_db_query($dbname, $sql3) ;
$streply = mysql_num_rows ($result3) ;
mysql_close () ;
		?>

<HTML>

<HEAD>
<META http-equiv="Content-Language" content="th">
<META http-equiv="Content-Type" content="text/html; charset=windows-874">
<link rel="stylesheet" href="include/plg_style.css" type="text/css">
<TITLE>หนังสือลำดับที่ <?=$bookid?> </TITLE>
<STYLE fprolloverstyle>A:hover {color: #1B59EB; text-decoration: blink; font-weight: bold}
</STYLE>
</HEAD>


<body  leftmargin="0">

  <CENTER>
    <table border="5" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="750" bordercolorlight="#CACAFF" bordercolordark="#6600CC" bgcolor="#D9ECFF">
      <tr>
        <td width="100%">
        <p align="center"><FONT style="font-size: 16pt" COLOR="#660099">
        หนังสือราชการจาก<? echo _NAME ;?> และหน่วยงานในสังกัด</font></td>
      </tr>
    </table>
    </CENTER>
<br> 
  <DIV align="center">
    <CENTER>
<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#008080" width="800" height="98">
  <tr>
    <td width="100%" colspan="2" height="20"><FONT style="font-size: 10pt" COLOR="#000000">
    &nbsp;&nbsp;หนังสือลำดับที่ : <?=$bookid?> &nbsp;&nbsp;<FONT COLOR="#000000"> จากกลุ่ม/หน่วยงาน : <?=$from?></FONT> &nbsp;&nbsp; 
    <FONT COLOR="#000000">ส่งเมื่อ : <?=$thaiday?></FONT>&nbsp;<FONT COLOR="#000000">	เวลา <?=$send_t?> น.</FONT></td>
  </tr>
  <tr>
    <td width="100%" colspan="2" height="20"><FONT style="font-size: 10pt" COLOR="#000000">
<FONT COLOR="#000000">
   &nbsp;&nbsp;เรื่อง : <?=$subject?></FONT></td>
  </tr>
  <tr>
    <td width="100%" colspan="2" height="12"><FONT style="font-size: 10pt" COLOR="#000000">

    &nbsp;&nbsp;ถึง : <?=$sendto?> </font></td>
  </tr>
  <tr>
    <td width="11%" height="12" valign="top"><FONT style="font-size: 10pt" COLOR="#000000"><CENTER>
    ข้อความ </CENTER></FONT></td>
    <td width="89%" height="12">
    <table border="1" cellpadding="4" style="border-collapse: collapse" bordercolor="#C0C0C0" width="100%">
      <tr>
        <td width="100%"><FONT style="font-size: 10pt" COLOR="#008080">
<?=$message?></font>&nbsp;</td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td width="100%" colspan="2" align="right"><? if ($status == "No") { ?><FONT style="font-size: 10pt" COLOR="#000000"><? If ($streply==1) { echo "<IMG SRC='image/reply.gif' WIDTH=16 HEIGHT=16 BORDER=0 >หน่วยงาน".$school."ได้ตอบรับหนังสือฉบับนี้แล้ว" ; } else {echo "<IMG SRC='image/noreply.gif' WIDTH=16 HEIGHT=16 BORDER=0 >หน่วยงาน".$school."ยังไม่ได้ตอบรับหนังสือฉบับนี้" ; }?></font>
&nbsp;<?  } elseif  ($status=="Yes1" or $status=="Yes" or $school==$from) { ?> <input type="button" value="รายชื่อหน่วยงานที่ยังไม่ตอบรับหนังสือ" onClick="window.location='unreply.php?id=<?=$id?>'" > <?}?> <?if ( $school==$from) {?><input type="button" value="ลบหนังสือฉบับนี้" onClick="window.location='deletebooks_result.php?id=<?=$id?>'" ><? }?></td>
  </tr>
</table>

    </CENTER>
  </DIV>
<BR>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
  <tr>
    <td width="11%"></td>
    <td width="89%"><?If ($bookfile <>"") {?> <form action="bookviews.php" method="Post">
					<input type="hidden" name="name"value="<?=$school?>">
						<input type="hidden" name="answer" value="รับทราบ">
						<input type="hidden" name="id" value="<?=$id?>">
						<INPUT TYPE="hidden" name="bookfile" value="<?=$bookfile?>">
						 <input type="submit" value="Download หนังสือคลิกที่นี่">
						 </form><?} elseif ($reply<>"ON") {?> <form action="bookviews.php" method="Post">
					<input type="hidden" name="name"value="<?=$school?>">
						<input type="hidden" name="answer" value="รับทราบ">
						<input type="hidden" name="id" value="<?=$id?>">
						<INPUT TYPE="hidden" name="bookfile" value="<?=$bookfile?>">
						 <input type="submit" value="รับทราบคลิกที่นี่">
						 </form><?}?></td>
  </tr><? If ($reply=="ON") {?>
  <tr>
    <td width="100%" colspan="2">
    <p align="center"><b><font color="#FF00FF">ตอบรับด้วยข้อมูลเพิ่มเติมที่นี่</font></b></p>
    <div align="center">
      <center>
      <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#6600CC" width="451" height="149">
        <form method="POST" action="bookviews.php">
       <tr>
            <td width="60" height="20">
            <p align="center"><b><font color="#6600CC">จาก</font></b></td>
            <td width="373" height="20">&nbsp;<?=$school?><input type="hidden" name="name"value="<?=$school?>"><input type="hidden" name="id" value="<?=$id?>"></td>
          </tr>
          <tr>
            <td width="75" height="100">
            <p align="center"><font color="#6600CC"><b>ข้อความ</b></font></td>
            <td width="373" height="100">&nbsp;<textarea rows="5" name="answer" cols="55"></textarea></td>
          </tr>
          </table>
      </center>
    </div>
    <p align="center">
      <input type="submit" value="ส่งข้อมูล">
      <input type="reset" value="พิมพ์ใหม่"><br>
&nbsp;</p>
    </td>
  </tr> <?}?>
</table>
<?//อ่านค่าคำตอบ
include "connect.php" ;
$sqlselect = "select * from $tableanswer where bookid='$id' Order BY id desc" ;
$resultselect = mysql_db_query($dbname, $sqlselect) ;
$num = mysql_num_rows ($resultselect) ;
$order = $num ;
?>
<div align="center">
  <center>

  <? 
    $list=1;
  while ($list <=$num &&  $r = mysql_fetch_array($resultselect) )  { 
	  $name = $r [name] ;
	  $anstimestamp= $r [anstimestamp] ;
	  $answer = $r [answer] ; $answer = nl2br(htmlspecialchars($answer)) ;
	  $score = $r [score] ;
	  $ip = $r [ip] ;

	  $ansday = date ("Y-m-d", $anstimestamp) ;
      $ans_t = date ("G.i.s", $anstimestamp) ;
      $ansthaiday=displaydate($ansday) ;  //วันปัจจบัน (ภาษาไทย)

?>
  <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#808080" width="600">
    <tr>
      <td width="100%" bgcolor="#C7F1C7"><b>
      <font color="#808000" style="font-size: 10pt">คำตอบที่  <?=$order?> จากหน่วยงาน<?=$name?>
      </font></b></td>
    </tr>
    <tr>
      <td width="100%"><font color="#000000" style="font-size: 10pt"><?=$answer?></font>&nbsp;</td>
    </tr>
    <tr>
      <td width="100%"><b><font color="#008080" style="font-size: 10pt">เมื่อ <FONT SIZE="" COLOR="#6666CC"><?=$ansthaiday?></FONT> <FONT SIZE="" COLOR="#CC66CC">เวลา <?=$ans_t?> น.</FONT>   IP : <A HREF="http://www.checkdomain.com/cgi-bin/checkdomain.pl?domain=<?=$ip?>" title="คลิกเพื่อตรวจสอบ IP" target="_blank" style="text-decoration: none"><?=$ip?></A> <? if ($score <> 0 ) { echo "ได้ $score คะแนน" ;  } else { echo "" ; } ?>
      </font></b></td>
    </tr>
  </table>
  <BR>
  <?
			$list++ ;
			$order=$order-1 ;
}
mysql_close() ;

?>
  </center>
</div>
<center>
<? include "include/footer.html" ;?>
	</center>
</body>

</html>