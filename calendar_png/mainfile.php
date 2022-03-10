<?php @session_start();
//หากมีการเรียกไฟล์นี้โดยตรง
if(preg_match('/mainfile.php/',$_SERVER['PHP_SELF'])){
    Header("Location: index.php");
	die();
}

if(!$_SESSION['USER_SID']){
	ob_start();
	$_SESSION['USER_SID'] =  session_id();
	session_write_close();
	ob_end_flush();
}
//ตรวจสอบว่ามีโมดูลหรือไม่ (โมดูล User)
function GETMODULE($name,$file){
	global $MODPATH, $MODPATHFILE ;
	if(!$name){$name = "index";}
	if(!$file){$file = "main";}
	$modpathfile="modules/".$name."/".$file.".php";
	if (file_exists($modpathfile)) {
		$MODPATHFILE = $modpathfile;
		$MODPATH = "modules/".$name."/";
	}else{ echo "<center><br><br>&nbsp;&nbsp;<img src='images/attention1.gif'>&nbsp;Modules Under construction...!<br><br></center>"; $MODPATHFILE ="nofile.php"; }
}



require_once($parts."class_files/date_class.php");
require_once($parts."class_files/pagecheck_class.php");
require_once($parts."class_files/user_class.php");
require_once($parts."class_files/other_class.php");
require_once($parts."class_files/picture_class.php");
require_once($parts."includes/config.in.php");
require_once($parts."includes/connect_conf.php");
require_once($parts."class_files/class.mysql.php");
require_once($parts."other_data/useronline.php");

 # วันที่ปัจจุบัน
define("NOWDATE",$conDate->format_date1(TIMESTAMP,'Y-M-d H:i:s'));
define("NOWDATESH",$conDate->format_date1(TIMESTAMP,'Y-M-d'));
define("NOWDATEM",$conDate->format_date1(TIMESTAMP,'Y-M'));
define("DANOW",$conDate->format_date1(TIMESTAMP,'d'));
define("MONOW",$conDate->format_date1(TIMESTAMP,'M'));
define("YENOW",$conDate->format_date1(TIMESTAMP,'Y'));
define("HNOW",$conDate->format_date1(TIMESTAMP,'H'));
$db = New DB();
/*	define("UserPri",$dataUser->userpri_($_SESSION['USER_LOGIN'],$_SESSION['USER_LOGIN_TYPE'],$parts));
if($_SESSION['USER_LOGIN'] && $_SESSION['USER_LOGIN_TYPE']){
	define("UserName",$dataUser->username_($_SESSION['USER_LOGIN'],$_SESSION['USER_LOGIN_TYPE'],$parts));
}
*/
switch($_SESSION['op1']){
	case "admin" : $opdata="User";break;
	case "user" : $opdata="User";break;
	case "about" : $opdata="About";break;
	case "survey" : $opdata="แบบสำรวจ";break;
	default : $opdata="Home";break;
}
switch($_SESSION['modules1']){
	case "index" : $modulesdata="User Main Page"; break;
	case "hotelprofile" : $modulesdata="Hotel Profile"; break;
	case "roomtype" : $modulesdata="Room Type Manage"; break;
	case "room" : $modulesdata="Room Management"; break;
	case "hoteldetail" : $modulesdata="Hotel Detail"; break;
	
	#default : $modulesdata="Main Page"; break;
}
switch($_SESSION['job1']){
	case "add" : $jobdata="เพิ่มข้อมูล"; break;
	case "edit" : $jobdata="ปรับปรุงข้อมูล"; break;
	case "delt" : $jobdata="ลบข้อมูล"; break;
	case "listdata" : $jobdata="แสดงข้อมูล"; break;
	default : $jobdata="แสดงข้อมูล"; break;
}
?>