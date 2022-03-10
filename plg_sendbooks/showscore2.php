<?
include "lang-thai.php" ;
?>
<html>

<head>
<meta http-equiv="Content-Language" content="th">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link rel="stylesheet" href="include/pat_style.css" type="text/css">

<title>คะแนนการเข้าใช้งาน ระบบงานสารบรรณ <? echo _NAME ;?>
</title>
<style fprolloverstyle>A:hover {color: #800000; font-style: italic; font-weight: bold}
</style>
</head>

<body vlink="#0000FF" alink="#0000FF">
<?
$month =  $_POST ['selectmonth'] ;
$year = $_POST ['selectyear'] ;

if ($month=="" ) { 
$month = date("n") ;
}

if ($year=="") {
$year=  date("Y") +543 ;
}

//echo"$month<BR>$year" ;
//exit () ;
If ($month == 1) {
	$m1 ="selected" ;
}else	if ($month == 2) {
	$m2 ="selected" ;
}else	if ($month == 3) {
	$m3 ="selected" ;
}else	if ($month == 4) {
	$m4 ="selected" ;
}else	if ($month == 5) {
	$m5 ="selected" ;
}else	if ($month == 6) {
	$m6 ="selected" ;
}else	if ($month == 7) {
	$m7 ="selected" ;
}else	if ($month == 8) {
	$m8 ="selected" ;
}else	if ($month ==9 ) {
	$m9 ="selected" ;
}else	if ($month ==10 ) {
	$m10="selected" ;
}else	if ($month ==11 ) {
	$m11 ="selected" ;
}else	if ($month == 12) {
	$m12 ="selected" ;
}

?>
  <CENTER><font size="3" style="font-size: 19pt"color="#800080">คะแนนการเข้าใช้งาน ระบบงานสารบรรณ 
<? echo _NAME ;?></font></CENTER>
<form method="POST" action="showscore2.php">
<p align="center">
  <font color="#008080">คะแนนประจำเดือน&nbsp;
  <select size="1" name="selectmonth">
  <option value="1" <?=$m1?>>มกราคม</option>
  <option value="2" <?=$m2?>>กุมภาพันธ์</option>
  <option value="3" <?=$m3?>>มีนาคม</option>
  <option value="4" <?=$m4?>>เมษายน</option>
  <option value="5" <?=$m5?>>พฤษภาคม</option>
  <option value="6" <?=$m6?>>มิถุนายน</option>
  <option value="7" <?=$m7?>>กรกฎาคม</option>
  <option value="8" <?=$m8?>>สิงหาคม</option>
  <option value="9" <?=$m9?>>กันยายน</option>
  <option value="10" <?=$m10?>>ตุลาคม</option>
  <option value="11" <?=$m11?>>พฤศจิกายน</option>
  <option value="12" <?=$m12?>>ธันวาคม</option>
  </select>&nbsp; ปี พ.ศ.<input type="text" name="selectyear" size="12" value="<?=$year?>">
  <input type="submit" value="ดูคะแนน"></font></p>
</form>
<font color="#6600CC"><font size="2">
คะแนนคิดจากลำดับการตอบรับหนังสือภายในระยะเวลา&nbsp; 24 ชั่วโมง 
นับจากเวลาที่ส่งหนังสือ โดยโรงเรียนที่ตอบรับเป็นอันดับแรก จะได้ 300 คะแนน 
ลำดับต่อไปจะลดลง อันดับละ 1 คะแนน&nbsp; หลังจาก 24 
ชั่วโมงไปแล้วโรงเรียนที่ตอบรับ จะได้ 1 คะแนน (คิดคะแนนเฉพาะหนังสือที่ส่งถึงโรงเรียนทุกโรงเท่านั้น)</font><br>
</font><div align="center">
  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#C0C0C0" width="704">
    <tr>
      <td width="69" align="center" bgcolor="#000080"><font color="#FFFFFF"><b>ลำดับที่</b></font></td>
      <td width="366" align="center" bgcolor="#000080"><font color="#FFFFFF"><b>โรงเรียน</b></font></td>
      <td width="265" align="center" bgcolor="#000080"><font color="#FFFFFF"><b>คะแนนรวม</b></font></td>
	  </tr>
	  <?
	  include "connect.php" ;
	$sql = "SELECT name, sum(score) AS myscore FROM $tableanswer2 WHERE ans_m='$month' AND ans_y='$year' GROUP BY name ORDER BY myscore DESC";
	$result = mysql_db_query ($dbname, $sql) ;
	$totalrecord = mysql_num_rows ($result) ;

	If ($totalrecord ==0) {
		echo"<tr><td></td><td><CENTER><B><FONT  COLOR=#FF0000>ไม่มีข้อมูลของรายการที่เลือก</FONT></B></CENTER></td><td></td></tr>" ;
	}
	  $list=1;
    while ($list <=$totalrecord &&  $r = mysql_fetch_array($result) )  { 
	  $name = $r [name] ;
	  $score = $r [myscore] ;
?>
    <tr bgcolor="">
      <td width="69" align="center"><?=$list?></td>
      <td width="366" align="left">&nbsp;&nbsp;&nbsp;&nbsp;<?=$name?>&nbsp;</td>
      <td width="265" align="center"><?=$score?>&nbsp;</td>
    </tr>

	<?
$list++ ;
 }

  mysql_close () ;
	?>
  </table>
</div>
      <center>
<? include "include/footer.html" ;?>
	</center>

</body>

</html>