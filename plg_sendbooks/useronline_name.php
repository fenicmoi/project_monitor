<?
include "chksession.php" ;
?>
<?
include "lang-thai.php";
include "connect.php" ;
$sql = "select * from $tableuser where username='$sess_username' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array($result) ;
$school = $r [school] ;
$status = $r [status] ;
mysql_close () ;

ob_start();

require 'chat/libs/config.inc.php';

require 'chat/libs/ajax.php'; 
require 'chat/libs/mysql.php';
require 'chat/libs/function.php';
require 'chat/funcs/func_chat.php';

$sajax_request_type = "GET";
sajax_init();
sajax_export("chk_login");
sajax_handle_client_request();
ob_end_flush();
?>
<?

include "connect.php";
 $sqlonline ="select * from $ontblname" ;
 $result = mysql_query ($sqlonline) ;
 $totalrecord = mysql_num_rows ($result) ;
?>
<html>
<head>
<link rel="stylesheet" href="include/pat_style.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<meta http-equiv="Content-Language" content="th">
</head>
<body>
<p align="center"><b><font color="#000080" style="font-size: 14pt">
<SPAN lang="en-us">&nbsp;
</SPAN>รายชื่อผู้ที่กำลังใช้งานระบบสารบรรณ<SPAN lang="en-us">
</SPAN><br>
</font><font size="2" color="#800000">(</font><font size="2" color="#008080">จำนวน</font><font size="2" color="#800000"> <?=$totalrecord?> </font>
<font size="2" color="#008080">คน</font><font size="2" color="#800000">)</font></b></p>
<div align="center">
  <center>


<meta http-equiv='content-type' content='text/html; charset=tis-620'>
<script language='javascript'>
<!--
<? sajax_show_javascript(); ?>

function chkPwd_cb(e) {
	if(e == 1) {
		document.getElementById("report").innerHTML = 'Vertify ...';
		window.setTimeout("location.href='chat/chatroom/contents.php';",3000);
	}
	else {
		document.getElementById("report").innerHTML = e;
		document.getElementById("send").disabled = false;
	}
}

function chkPwd() {
	name = document.getElementById("name").value;
	x_chk_login(name,chkPwd_cb);
	document.getElementById("name").value = '';
	document.getElementById("send").disabled = true;
}

//-->
</script>
<table width='' height=''>
<form name='frm' method='post' action='#' onsubmit='chkPwd(); return false;'>
<tr>
<td><input type='hidden' name='name' id='name' value='<?=$school?>'> <input type='submit' name='send' id='send' value="เข้าสู่ห้องสนทนา" onclick='chkPwd(); return false'>
</td>
</tr>
<tr>
<td><div id='report' style='color:red'>* * * * *</div></td>
</tr>
</table>

<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#CACAFF" width="37%">
<?
	 $list=1;
  while ($list <=$totalrecord &&  $r = mysql_fetch_array($result) )  { 
	  $name = $r [online_name] ;

	  if ($list % 2 == 0) {
	$color = "#E4E4E4";
}
else {
	$color = "#F7F7F7";
}
	  ?>

  <tr  bgcolor="<?=$color?>">
    <td width="100%" align="left"><?=$list?>.&nbsp;<?=$name?></td>
  </tr>
  <?
			$list++;
}
mysql_close() ;

?>
</table></center>

</div>
<center>
<? include "include/footer.html" ;
?>
	</center>

</body>
</html>