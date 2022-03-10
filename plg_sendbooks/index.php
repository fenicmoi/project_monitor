<?php
include "chksession.php" ;
?>
<?
include "lang-thai.php" ;
include "library/database.php" ;
$sql = "select * from user where username='$sess_username' " ;
$result = dbQuery($sql) ;
$exist = dbQuery($result) ;

if ($exist==0 ){
		header ("Location:login.php") ;
	exit () ;
}
$r = dbFetchArray($result) ;
$school = $r ['school'] ;
$status = $r ['status'] ;

if ($status== "public") {
	header ("Location:login.php") ;
	exit () ;
}

If ($status =="Yes1") {
		$showtext="�����ż����" ;
		$mlink ="userdetail.php" ;
} else {
		$showtext=" " ;
		$mlink="form_bookfromschool.php" ;
}



$keyword = $_POST ['keyword'] ;
$pageid = $_GET ['pageid'] ;

if ($keyword=="") {
$keyword=  $_GET ['keyword'] ;
}

if ($keyword<>"") {
$search="SELECT  *  FROM newbooks where subject like '%$keyword%' " ;
} else {
$search="SELECT *  FROM newbooks" ;
}

include "library/database.php" ;
$sql = "$search" ;
$result = dbQuery($sql) ;
 $totalrecordall = dbNumRows($result) ;
 $totalrecord = $totalrecordall ;

If($totalrecord >= 200) {
	$totalrecord=200 ;
}

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
$sql = "$search ORDER BY id DESC LIMIT $start, $pagesize;";
$result = dbQuery($sql) ;

?>
<HTML>

<HEAD>
<META http-equiv="Content-Language" content="th">
<META http-equiv="Content-Type" content="text/html; charset=windows-874">
<link rel="stylesheet" href="include/pat_style.css" type="text/css">
<TITLE>�к��Ѻ��˹ѧ����Ҫ���<? echo _NAME ;?></TITLE>
<STYLE fprolloverstyle>A:hover {color: #1B59EB; text-decoration: blink; font-weight: bold}
</STYLE>
</HEAD>

<BODY topmargin="0" leftmargin="0">
<?include "include/comment.php" ;?>
<TABLE border="0" cellpadding="3" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1" height="108">
  <TR>
    <TD width="100%" height="29" colspan="2"> 
      <DIV align="center">
        <CENTER>
        <TABLE border="0" style="border-collapse: collapse" width="750" id="AutoNumber3" bordercolorlight="#3366FF" bordercolordark="#6699FF" height="51">
          <TR>
            <TD width="100%" height="49"> 
      <p align="center"><b>
      <font size="4" style="font-size: 19pt" color="#0000cc"> 
        �к��Ѻ��˹ѧ����Ҫ��� <? echo _NAME ;?>
         
        </font></b></p>
            </TD>
          </TR>
        </TABLE>
        </CENTER>
      </DIV>
        </TD>
  </TR>
  <TR>
      </TR>
  <tr bgcolor="#CCFF66"><TD width="100%" height="9" colspan="2">
    <IMG border="0" src="image/login_icon.gif"  width="31" height="28"><FONT size="1" style="font-size: 9pt"> 
    <B><A HREF="logout.php" style="text-decoration: none">�͡�ҡ�к�</A>&nbsp;<? If ($status=="Yes1" or $status=="No") { echo"<img border=0  width=31 height=28><a href=\"$mlink\" style=\"text-decoration: none\">$showtext</a>" ; }?>&nbsp;<? if ($status=="No")  { ?><img border="0" src="image/register_icon.gif" width="31" height="28"><A HREF="sendto_school.php" style="text-decoration: none">��˹ѧ��������ҧ˹��§ҹ</A><? } ?> <img border="0" src="image/active_topics.gif" width="31" height="28">&nbsp;<A HREF="form_changepwd.php" style="text-decoration: none">����¹���ʼ�ҹ</A>&nbsp;&nbsp;<FONT  COLOR="#993300">�������</FONT> : <FONT COLOR="#003300"><?=$school?></FONT></B></TD>
  </TR><? If ($status=="Yes" Or $status=="Yes1") {
	  //��Ǩ�ͺ˹ѧ����觨ҡ˹��§ҹ

$sql3 = "select * from $newbooksfromschool  where nreply =''" ;
$result3 = dbQuery($sql3) ;
$schnewbook = dbNumRows($result3) ;

//echo"$schnewbook" ;
//exit() ;
		
 
	  ?>
  <TR>
    <TD width="100%" height="16" colspan="2">
	<table border="1" cellpadding="2" style="border-collapse: collapse" bordercolor="#FAF9F4" width="100%" height="47">
      <tr>
        <td width="14%" bgcolor="#99CC33" height="23">
       <IMG SRC="image/button_edit.png" WIDTH="12" HEIGHT="13" BORDER="0" ALT="">&nbsp;<font color="#FFFFFF" size="4" style="font-size: 13pt; font-weight:700">���͡����</font></td>
        <td width="16%" bgcolor="#99CC33" height="23" align="center">
        <p align="center">
        <input type=button value='��˹ѧ����Ҫ���' onClick=window.location='form_newbooks.php' style="float: left" ></td>
        <td width="11%" bgcolor="#99CC33" height="23" align="center">
        <input type=button value='ź˹ѧ���' onClick=window.location='deletebook.php' style="float: left" ></td>
        <td width="16%" bgcolor="#99CC33" height="23" align="center"><? if ($schnewbook <>0)  {?> <IMG SRC="image/hotfd.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT="">
        <b><a href='bookfromschool.php' style="text-decoration: none" title="��ǹ���Ŵ��ԡ�����"><font color="#FFCC00">˹ѧ������� <?=$schnewbook?> ��Ѻ </font></a></b><? } else {?><b><a href='bookfromschool.php' style="text-decoration: none"><FONT SIZE="" COLOR="#000000">�����˹ѧ�������</FONT></a></b><? } ?></td>
        <td width="43%" bgcolor="#99CC33" height="23">&nbsp;</td>
      </tr>

			<? 
	  //��Ǩ�ͺ˹ѧ����觨ҡ˹��§ҹ

$sql4 = "select * from $newbooksfromschool2  where nreply =''" ;
$result4 = dbQuery ($sql4) ;
$schnewbook4 = dbNumRows($result4) ;

//echo"$schnewbook" ;
//exit() ;

			
	  ?>
      <tr>

      </tr>
    </table>
	</TD>
  </TR><? }?>
  <TR>
     <TD width="71%" height="16"align="right"><?include "useronline.php" ;?>&nbsp;&nbsp;&nbsp;<A HREF="useronline_name.php" style="text-decoration: none" target="_blank">����ª��ͤ�ԡ�����</A>&nbsp;&nbsp;||&nbsp;&nbsp;<FONT SIZE="" COLOR="#CC0066">��ͧ��â����ŷ���繻Ѩ�غѹ</FONT> <FONT SIZE="" COLOR="#FF0000"><B>��سҤ�ԡ - -></B></FONT>
     <input type="button" value="��Ŵ˹�ҹ������" onClick="window.location='index.php'" ></TD>
     <FORM METHOD=POST ACTION="index.php"><TD width="29%" height="16"align="right">
     <INPUT TYPE="text" NAME="keyword" size="20" value="��������˹ѧ������ͤ��ҷ����" onClick="this.value=''">&nbsp;<INPUT TYPE="submit" value="����˹ѧ���"></TD></FORM>
  </TR>
</TABLE>
<TABLE border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#C0C0C0" width="100%" id="AutoNumber2" height="20">
  <TR> 
    <TD width="8%" align="center" background="image/table_bg_image.gif" height="21"> 
      <FONT color="#003300" size="2"><B>�ӴѺ���</B></FONT></TD>
    <TD width="28%" align="center" background="image/table_bg_image.gif" height="21"> 
      <FONT color="#003300" size="2"><B>����ͧ</B></FONT></TD>
    <TD width="24%" align="center" background="image/table_bg_image.gif" height="21"> 
      <FONT color="#003300" size="2"><B>�֧</B></FONT></TD>
    <TD width="17%" align="center" background="image/table_bg_image.gif" height="21"> 
      <FONT color="#003300" size="2"><B>�ҡ�����/˹��§ҹ</B></FONT></TD>
    <TD width="15%" align="center" background="image/table_bg_image.gif" height="21"> 
      <FONT color="#003300" size="2"><B>�ѹ������</B></FONT></TD>
    <TD width="4%" align="center" background="image/table_bg_image.gif" height="21"> 
      <FONT color="#003300" size="2"><B>��ҹ</B></FONT></TD>
    <TD width="4%" align="center" background="image/table_bg_image.gif" height="21"> 
      <FONT color="#003300" size="2"><B>�ͺ</B></FONT></TD>
  </TR>
  <?
  
  $list=1;
  while ($list <=$totalrecord &&  $r = dbFetchArray($result) )  { 
	  $id = $r['id'] ;
	  $from = $r['sendfrom'] ;
	  $sendto = $r['sendto'] ;
	  $subject = $r['subject'] ;
	  $sendtimestamp = $r ['sendtimestamp'] ;
	  $bookfile = $r['bookfile'] ;
	  $nview = $r ['nview'] ;
	  $nreply = $r ['nreply'] ;

	  $bookid=sprintf("%06d", $id) ; //����˹ѧ���
//��Ǩ�ͺ�����˹ѧ��ͷ�����Ҩҡ ˹��§ҹ �֧ ˹��§ҹ����������
//��˹���ҵ���ê��� ˹��§ҹ����Դ
$thisschool= "˹��§ҹ".$school ;

if ($sendto==$thisschool) {
$font1="#FF0066" ;
$font2="#FF0066" ;
$font3="#FF0099" ;
} else {
$font1="#CC00CC" ;
$font2="#6600CC" ;
$font3="#CC00CC" ;
}
if ($sendto=="�ء˹��§ҹ") {
$font1="#FF00FF" ;
$font2="#FF00FF" ;
$font3="#FF00FF" ;
}
if ($sendto=="�������к�") {
$font1="#8D8D8D" ;
$font2="#8D8D8D" ;
$font3="#8D8D8D" ;
}


$send_d = date ("j", $sendtimestamp) ;
$send_m = date ("n", $sendtimestamp) ;
	if ($send_m == 1) {
		$send_m = "�.�." ;
	} elseif ($send_m == 2) {
		$send_m = "�.�." ;
	} elseif ($send_m == 3) {
		$send_m = "��.�." ;
	} elseif ($send_m == 4) {
		$send_m = "��.�." ;
	} elseif ($send_m == 5) {
		$send_m ="�.�." ;
	}elseif ($send_m == 6) {
		$send_m="��.�." ;
	}elseif ($send_m == 7) {
		$send_m="�.�." ;
	}elseif ($send_m == 8) {
		$send_m="�.�." ;
	}elseif ($send_m == 9) {
		$send_m="�.�." ;
	}elseif ($send_m == 10) {
		$send_m="�.�." ;
	}elseif ($send_m == 11) {
		$send_m="�.�." ;
	}elseif ($send_m == 12) {
		$send_m="�.�." ;
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
    <TD width="8%" height="20"><IMG SRC="image/<?=$image?>.gif" WIDTH="15" HEIGHT="16" BORDER="0" ALT="">&nbsp;<FONT SIZE="" COLOR="<?=$font1?>">
      <?=$bookid?>
      </FONT></TD>
    <TD width="28%" height="20">&nbsp;<A HREF="bookviewsave.php?id=<?=$id?>"  title='��ԡ�����Դ��ҹ˹ѧ���' style="text-decoration: none" target="_blank">
      <?=$subject?>
      </A>&nbsp;
      <? if ($bookfile<>"") {echo"<IMG SRC=image/file.gif WIDTH=13 HEIGHT=10 BORDER=0 ALT='�����Ṻ'>" ; }?>
    </TD>
    <TD width="24%" height="20">&nbsp;<FONT SIZE="" COLOR="<?=$font2?>">
      <?=$sendto?>
      &nbsp;
      <? if ($sendto==$thisschool){ echo"<IMG SRC=\"image/updates.gif\" WIDTH=\"31\" HEIGHT=\"12\" BORDER=\"0\" >" ;}?>
      </FONT></TD>
    <TD width="17%" height="20">&nbsp;<FONT SIZE="" COLOR="<?=$font3?>">
      <?=$from?>
      </FONT></TD>
    <TD width="15%" height="20"><CENTER>
        <FONT SIZE="" COLOR="#6600CC"> 
        <?=$send_d?>
        &nbsp; 
        <?=$send_m?>
        &nbsp; 
        <?=$send_y?>
        </FONT>&nbsp;/&nbsp;<FONT SIZE="" COLOR="#990099"> 
        <?=$send_t?>
        &nbsp;<font color="#003300">�.</font></FONT>
</CENTER></TD>
    <TD width="4%" height="20"><CENTER>
        <B><FONT SIZE="" COLOR="#FF0033">
        <?=$nview?>
        </FONT></B></CENTER></TD>
    <TD width="4%" height="20"><CENTER>
        <FONT SIZE="" COLOR="#009900"><B>
        <?=$nreply ?>
        </B></FONT></CENTER></TD>
  </TR>
  <?
			$list++;
}


?>
</TABLE>
<hr>
<FONT SIZE="" COLOR="#CC00CC"><B><font color="#003300">�ʴ�˹ѧ��� 
<?=$totalrecord?>
��Ѻ����ش �ҡ�ӹǹ˹ѧ��ͷ����� 
<?=$totalrecordall?>
��Ѻ </font></B></FONT><FONT SIZE="" COLOR="#003300">(��ҹ����ö�׺��˹ѧ��ͷ�������ҡ��ͧ����˹ѧ��ʹ�ҹ��)</FONT><font color="#003300"><BR>
<span lang="th"><b><font face="MS Sans Serif">˹���� 
<?=$pagesize?>
��¡��</font></b></span><b> <font face="MS Sans Serif">˹�ҷ��</font> </b> 
<?
for ($i=1; $i<=$totalpage; $i++) {
	if ($i == $pageid) {
		echo "&nbsp;" .$i . "&nbsp;";
	}
	else {
		echo "&nbsp;[<a href=\"index.php?pageid=$i&keyword=$keyword\" style=\"text-decoration: none\">$i</a>]&nbsp;";
	}
 }
 ?>
</font>
<center>
  <? include "include/footer.html" ;?>
</center>
</BODY>

</HTML>