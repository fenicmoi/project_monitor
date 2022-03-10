<?
include "chksession.php" ;
include "lang-thai.php" ;
?>
<?
include "connect.php" ;
$sql1 = "select * from $tableuser where username='$sess_username' " ;
$result1 = mysql_db_query ($dbname, $sql1) ;
$r1 = mysql_fetch_array($result1) ;
$school = $r1 [school] ;
$status = $r1 [status] ;
mysql_close () ;
if ($status=="No") {
header ("Location:login.php") ;
	exit () ;
}
//echo"$sess_username" ;
//exit() ;


// ข้อมูลหนังสือ
$pageid = $_GET ['pageid'] ;


include "connect.php" ;
$sql = "select * from $tablenewbooksfromschool2";
$result = mysql_db_query ($dbname, $sql) ;
 $totalrecord = mysql_num_rows ($result) ;

$pagesize =20;
$totalpage = (int) ($totalrecord / $pagesize);
if (($totalrecord % $pagesize) != 0) {
		$totalpage += 1;
}
if (isset($pageid)) {
	$start = $pagesize * ($pageid -1);
}
else {
		$pageid = 1;
		$start = 0;
}
$sql = "select * from $tablenewbooksfromschool2 ORDER BY id DESC LIMIT $start, $pagesize;";
$result = mysql_db_query ($dbname, $sql) ;

?>
<HTML>

<HEAD>
<META http-equiv="Content-Language" content="th">
<META http-equiv="Content-Type" content="text/html; charset=windows-874">
<link rel="stylesheet" href="include/sujane10_style.css" type="text/css">
<TITLE>ระบบงานสารบรรณ (ทะเบียนหนังสือส่งจากโรงเรียน)</TITLE>
<STYLE fprolloverstyle>A:hover {color: #1B59EB; text-decoration: blink; font-weight: bold}
</STYLE>
</HEAD>

<BODY topmargin="0" leftmargin="0" bgcolor="#FFECFF">

<TABLE border="0" cellpadding="3" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1" height="108">
  <TR>
    <TD width="100%" height="29" colspan="2"> 
      <DIV align="center">
        <CENTER>
        <TABLE border="3" style="border-collapse: collapse" bordercolor="#111111" width="750" id="AutoNumber3" bordercolorlight="#3366FF" bordercolordark="#6699FF" height="51" bgcolor="#D5E2FF">
          <TR>
            <TD width="100%" height="49"> 
      <p align="center"><b>
      <font size="4" style="font-size: 19pt" color="#CC0099"> 
        ระบบงานสารบรรณ <? echo _NAME ;?>
         
        </font></b></p>
            </TD>
          </TR>
        </TABLE>
        </CENTER>
      </DIV>
        </TD>
  </TR>
  <TR>
        <td width="100%" height="15" colspan="2">
        <p align="left">
        </td>
      </TR>
  <TR>
    <TD width="100%" height="9" bgcolor="#CF9CFE" colspan="2">
    <p align="center"><font color="#FF0000">
    <span style="font-size: 13pt; font-weight: 700"> (ทะเบียนหนังสือส่งจากโรงเรียนเอกชน)</span></font></TD>
  </TR>
  <TR>
     <TD width="71%" height="16"align="right">
          <input type="button" value="กลับหน้าหลัก" onClick="window.location='index2.php'" >
&nbsp;<input type="button" value="โหลดหน้านี้ใหม่" onClick="window.location='bookfromschool2.php'" ></TD>
  </TR>
</TABLE>
<TABLE border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#C0C0C0" width="100%" id="AutoNumber2" height="20">
  <TR>
    <TD width="6%" align="center" background="image/table_bg_image.gif" height="21">
    <FONT color="#993366" size="2"><B>ลำดับที่</B></FONT></TD>
    <TD width="13%" align="center" background="image/table_bg_image.gif" height="21">
    <font color="#993366"><b>เลขหนังสือ</b></font></TD>
    <TD width="28%" align="center" background="image/table_bg_image.gif" height="21">
    <font color="#993366"><b>เรื่อง</b></font></TD>
    <TD width="19%" align="center" background="image/table_bg_image.gif" height="21">
    <FONT color="#993366" size="2"><B>จากโรงเรียน</B></FONT></TD>
    <TD width="17%" align="center" background="image/table_bg_image.gif" height="21">
    <FONT color="#993366" size="2"><B>วันเวลาส่ง</B></FONT></TD>
    <TD width="14%" align="center" background="image/table_bg_image.gif" height="21">
    <font color="#993366"><b>วันเวลาที่ดาวน์โหลด</b></font></TD>
   <?if ($status == "Yes1") { ?> <TD width="3%" align="center" background="image/table_bg_image.gif" height="21">
    <font color="#993366">ลบ</B></FONT></TD> <? }?>
  </TR>
  <?
  
  $list=1;
  while ($list <=$totalrecord &&  $r = mysql_fetch_array($result) )  { 
	  $id = $r [id] ;
	  $from = $r [	fromname] ;
	  $subject = $r [subject] ;
	  $sendtimestamp = $r [sendtimestamp] ;
	  $bookno = $r [bookno] ;
	  $bookfile = $r [bookfile] ;
	  $nreply = $r [nreply] ;

	  $bookid=sprintf("%06d", $id) ; //รหัสหนังสือ


$send_d = date ("j", $sendtimestamp) ;
$send_m = date ("n", $sendtimestamp) ;
	if ($send_m == 1) {
		$send_m = "ม.ค." ;
	} elseif ($send_m == 2) {
		$send_m = "ก.พ." ;
	} elseif ($send_m == 3) {
		$send_m = "มี.ค." ;
	} elseif ($send_m == 4) {
		$send_m = "เม.ย." ;
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

if ($list % 2 == 0) {
	$color = "#E4E4E4";
}
else {
	$color = "#F7F7F7";
}
if ($nview == 0 ) {
	$image = "new" ;
} else {
	$image = "oldopen" ;
}
?>
<tr  bgcolor="<?=$color?>">
    <TD width="6%" height="20"><IMG SRC="image/<?=$image?>.gif" WIDTH="15" HEIGHT="16" BORDER="0" ALT="">&nbsp;<FONT SIZE="" COLOR="#CC00CC"><?=$bookid?></FONT></TD>
    <TD width="13%" height="20">&nbsp;<?=$bookno?></TD>
    <TD width="28%" height="20">&nbsp;<FONT SIZE="" COLOR="#6600CC"><? if ($from == $school or $status == "Yes1" or $status == "Yes") { ?><A HREF="download2.php?id=<?=$id?>"  title='คลิกเพื่อเปิดดาวน์โหลดหนังสือ' style="text-decoration: none" target="_blank"><?=$subject?></A><?} else {?><?=$subject?> <?}?>&nbsp;<? if ($bookfile<>"") {echo"<IMG SRC=image/file.gif WIDTH=13 HEIGHT=10 BORDER=0 ALT='มีไฟล์แนบ'>" ; }?></FONT></TD>
    <TD width="19%" height="20">&nbsp;<FONT SIZE="" COLOR="#CC00CC"><?=$from?></FONT></TD>
    <TD width="17%" height="20"><CENTER><FONT SIZE="" COLOR="#6600CC"><?=$send_d?>&nbsp;<?=$send_m?>&nbsp;<?=$send_y?></FONT>&nbsp;/&nbsp;<FONT SIZE="" COLOR="#990099"><?=$send_t?>&nbsp;น.</FONT></CENTER></TD>
    <TD width="14%" height="20"><CENTER><B><FONT SIZE="" COLOR="#00CC00"><?if ($nreply=="") { echo "ยังไม่ดาวน์โหลด" ; } else { echo"$nreply" ; } ?></FONT></B></CENTER></TD>
    <?if ($status == "Yes1") { ?> <TD width="3%" height="20"><CENTER><FONT SIZE="" COLOR="#009900"><A HREF="deletebookfromschool2.php?id=<?=$id?>" title="คลิกเพื่อลบหนังสือฉบับนี้" onclick="return confirm ('ต้องการลบหนังสือลำดับที่ <?=$bookid?> ออกจากระบบ ?')">
    <img src="image/delete.png" border=0 width="16" height="16"></A></FONT></CENTER></TD> <? } ?>
  </TR>
  <?
			$list++;
}
mysql_close() ;

?>
</TABLE>
<hr>
<span lang="th"><b><font face="MS Sans Serif" color="#800080">แสดงหน้าละ  <?=$pagesize?> รายการ</font><font face="MS Sans Serif" color="#808000"> </font></b></span><b>
<font face="MS Sans Serif" color="#800080">หน้าที่</font><font face="MS Sans Serif" color="#808000"> </font>

</b> 

 <?
for ($i=1; $i<=$totalpage; $i++) {
	if ($i == $pageid) {
		echo $i . "&nbsp;";
	}
	else {
		echo "[<a href=\"bookfromschool2.php?pageid=$i&keyword=$keyword\">$i</a>]&nbsp;";
	}
 }
 ?>
 <center>
<? include "include/footer.html" ;?>
	</center>
</BODY>

</HTML>