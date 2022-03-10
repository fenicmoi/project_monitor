<?php
error_reporting (E_ALL ^ E_NOTICE);
/*

ผู้ปรับปรุง : นายชลิต โปธา
โทรศัพท์ : 089-8384725
Email : mr_toypt@hotmail.com
http://www.cm2car.com
ตัวคอนฟิกในการควบคุมระบบเว็บไซต์ 


ผู้ปรับปรุง V 2  
นายสมศักดิ์  แก้วเกลี้ยง
email  : dataofphangnga@gmial.com
1.ปรับปรุง User Interface ด้วย bootstrap 3
2.ปรับปรุง Code ส่วนการเชื่อมต่อฐานข้อมูล
3.ตัดส่วนที่ไม่เกี่ยวข้อง
4.แก้ปัญหา Error  ลบข้อมูลไม่ได้


ผู้ปรับปรุง V 2.1   1 สิงหาคม 2562
นายสมศักดิ์  แก้วเกลี้ยง
แก้ไขปัญหาเรื่องการเพิ่มข้อมูลวาระงานไม่ได้  เนื่องจากการปรับปรุงหรือการ  update php ของเครื่องแม่ข่าย
*/



//หากมีการเรียกไฟล์นี้โดยตรง

if(preg_match('/config.in.php/',$_SERVER['PHP_SELF'])){
    Header("Location: index.php");
    die();
}

date_default_timezone_set('Asia/Bangkok'); 
define("MYDBMS","MYSQL"); 



//Web Config
define("WEB_TITLE","ระบบนัดหมายงานของผู้บริหาร จังหวัดพัทลุง"); 
define("WEB_KEYWORD","ระบบนัดหมายงานของผู้บริหาร จังหวัดพัทลุง"); 
define("WEB_URL","http://www.phatthalung.go.th") ; 
define("WEB_EMAIL","") ; 
define("TIMESTAMP",time()) ;
define("copyright","จังหวัดพัทลุง [พัฒนาโดยกลุ่มงานยุทธศาสตร์และข้อมูลเพื่อการพัฒนาจังหวัด]") ;
define("word","เมืองหนังโนราห์ อู่นาข้าว พราวน้ำตก แหล่งนกน้ำ ทะเลสาบงาม เขาอกทะลุ น้ำพุร้อน");
define("no_version","ver 2.1 update 04/08/2562");

//Calendar
define("USE_THAIYEAR", true); //แสดงผลเป็น พ.ศ. ใน calendar   true , false
define("SPACE_DAY",5);  # จำนวนวันที่คิดรถมาใหม่ หรือ update
define("TB_counter","counter");
define("TB_counthit","counter_hit");
define("TB_useronline","useronline");
define("TB_member","member");
define("TB_man","manager");
define("TB_pos","position");
define("TB_calendar","calendar");
define("TB_cface","face");
define("TB_carspic","carspic");
define("TB_color","color");
define("TB_ctype","carstype");
define("TB_about","about");
define("IPADDRESS",$IPADDRESS) ;

//ผู้ดูแลระบบไม่ผ่านสิทธิการใช้งาน
$PermissionFalse .= "<BR><BR>";
$PermissionFalse .= "<CENTER><A HREF=\"?op=admin&modules=main\"><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\"></A><BR><BR>";
$PermissionFalse .= "<FONT COLOR=\"#336600\"><B>ท่านไม่สามารถเข้าใช้งานส่วนนี้ได้</B></FONT><BR><BR>";
$PermissionFalse .= "<A HREF=\"?op=admin&modules=main\"><B>กรุณาติดต่อผู้ดูแลระบบ</B></A>";
$PermissionFalse .= "</CENTER>";
$PermissionFalse .= "<BR><BR>";

//ผู้ดูแลระบบไม่ผ่านสิทธิการใช้งาน
$PermissionFalse .= "<BR><BR>";
$PermissionFalse .= "<CENTER><A HREF=\"?op=admin&modules=main\"><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\"></A><BR><BR>";
$PermissionFalse .= "<FONT COLOR=\"#336600\"><B>ท่านไม่สามารถเข้าใช้งานส่วนนี้ได้</B></FONT><BR><BR>";
$PermissionFalse .= "<A HREF=\"?op=admin&modules=main\"><B>กรุณาติดต่อผู้ดูแลระบบ</B></A>";
$PermissionFalse .= "</CENTER>";
$PermissionFalse .= "<BR><BR>";



//ผู้ดูแลระบบไม่ผ่านสิทธิการใช้งาน
$PermisAccess .= "<BR><BR>";
$PermisAccess .= "<CENTER><IMG SRC=\"images/dangerous.png\" BORDER=\"0\"><BR><BR>";
$PermisAccess .= "<FONT COLOR=\"#336600\"><B>ท่านไม่สามารถเข้าใช้งานส่วนนี้ได้</B></FONT><BR><BR>";
$PermisAccess .= "<B>กรุณาติดต่อผู้ดูแลระบบ</B><br><br>";
$PermisAccess .= "<B><a href='?op=index'>Back to Main Page</a></B>";
$PermisAccess .= "</CENTER>";
$PermisAccess .= "<BR><BR><BR><BR><BR><BR>";





$data .= "<BR><BR>";
$data .= "<CENTER><IMG SRC=\"images/admin/i-groups.png\" BORDER=\"0\"><BR><BR>";
$data .= "<FONT class='f-red-b'>รหัสลับไม่ถูกต้อง </FONT><BR><BR>";
$data .= "<B>กรุณากรอกข้อมูลใหม่ค่ะ</B>";
$data .= "<meta http-equiv=\"refresh\" content=\"1 ; URL='?'; charset=utf-8\"></CENTER>";
$data .= "<BR><BR>";
define("PermisSecurityCode",$data);			

$data = "<BR><BR>";
$data .= "<CENTER><IMG SRC=\"images/checkin.png\" BORDER=\"0\"><BR><BR>";
$data .= "<FONT class='f-red-b'>Add Data Complete</FONT><BR><BR>";
$data .= "<B>Please Wait</B>";
$data .= "<BR><BR>";
$data .= "<meta http-equiv=\"refresh\" content=\"1 ; URL='?job=listdata'; charset=utf-8\"></CENTER>";

define("AddComp",$data);			


$data = "<BR><BR>";
$data .= "<CENTER><IMG SRC=\"images/checkin.png\" BORDER=\"0\"><BR><BR>";
$data .= "<FONT class='f-red-b'>บันทึกข้อมูลเรียบร้อยแล้ว</FONT><BR>";
$data .= "<FONT class='f-green-big'>ขอบคุณเป็นอย่างสูง ที่ให้ความร่วมมือ</FONT><BR><BR>";
$data .= "<B>Please Wait</B>";
$data .= "<BR><BR>";
define("AddComp1",$data);			



$data = "<BR><BR>";
$data .= "<CENTER><IMG SRC=\"images/checkin.png\" BORDER=\"0\"><BR><BR>";
$data .= "<FONT class='f-red-b'>Update Data Complete</FONT><BR><BR>";
$data .= "<B>Please Wait</B>";
$data .= "<BR><BR>";
$data .= "<meta http-equiv=\"refresh\" content=\"1 ; URL='?job=listdata&page_c=$page'; charset=utf-8\"></CENTER>";
define("UpdateComp",$data);			



$data = "<BR><BR>";
$data .= "<CENTER><IMG SRC=\"images/checkin.png\" BORDER=\"0\"><BR><BR>";
$data .= "<FONT class='f-red-b'>Update Data Complete</FONT><BR><BR>";
$data .= "<B>Please Wait</B>";
$data .= "<BR><BR>";
define("UpdateComp1",$data);			



$data="";
$data .= "<BR><BR>";
$data .= "<CENTER><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"><BR><BR>";
$data .= "<FONT class='f-red-b'>ท่านได้เข้าสู่ระบบเรียบร้อยแล้ว</FONT><BR><BR>";
$data .= "<B>กรุณารอสักครู่ค่ะ</B>";
$data .= "<meta http-equiv=\"refresh\" content=\"1 ; URL='?op=member'; charset=utf-8\"></CENTER>";
$data .= "<BR><BR>";
define("LoginComp",$data);									



$data="";
$data .= "<BR><BR>";
$data .= "<CENTER><IMG SRC=\"images/admin/i-groups.png\" BORDER=\"0\"><BR><BR>";
$data .= "<FONT class='f-red-b'>ท่านได้เข้าสู่การจัดการข้อมูลของลูกค้า เรียบร้อยแล้ว</FONT><BR><BR>";
$data .= "<B>กรุณารอสักครู่ค่ะ</B>";
$data .= "<meta http-equiv=\"refresh\" content=\"1 ; URL='?op=index'; charset=utf-8\"></CENTER>";
$data .= "<BR><BR>";
define("LoginCompMan",$data);									



$data="";
$data .= "<BR><BR>";
$data .= "<CENTER><IMG SRC=\"images/admin/i-logout.png\" BORDER=\"0\"><BR><BR>";
$data .= "<FONT class='f-red-b'>ชื่อเข้าใช้หรือรหัสผ่านไม่ถูกต้อง  </FONT><BR><BR>";
$data .= "<B>กรุณากรอกข้อมูลใหม่ค่ะ</B>";
$data .= "<meta http-equiv=\"refresh\" content=\"1 ; URL='?'; charset=utf-8\"></CENTER>";
$data .= "<BR><BR>";
define("PermisLogin",$data);			


$data="";
$data .= "<BR><BR>";
$data .= "<FONT class='f-red-b'>ลบข้อมูลรถเรียบร้อยแล้ว</FONT><BR><BR>";
$data .= "<B>กรุณารอสักครู่ ระบบกำลังปรับปรุงข้อมูล</B>";
$data .= "<meta http-equiv=\"refresh\" content=\"1 ; URL='?job=listdata&page_c=".$_GET['page_c']."'; charset=utf-8\"></CENTER>";
$data .= "<BR><BR>";
define("DeltComp",$data);			



?>