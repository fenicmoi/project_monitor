<?php 
//ส่วนของการประกาศ session เพื่อจัดการเมนู  

session_start();     
error_reporting(0);
error_reporting(E_ERROR | E_PARSE);

if($_GET[op]){      //ตรวจสอบประเภทของงาน
	$_SESSION['op1']=$_GET[op];     //ses op1 =op
	$_SESSION['job1']="";
	$_SESSION['modules1']="";
	$_SESSION['files1']="";
}

if($_GET[modules]){   //จัดการโมดูล
	$_SESSION['modules1']=$_GET[modules];
	$_SESSION['files1']="";
	$_SESSION['job1']="";
	$_SESSION["jobcase1"]="";
}

if($_GET[files]){      //จัดการไฟล์
	$_SESSION['files1']=$_GET[files];
}

if($_GET[job]){      //จัดการภาระงาน
	$_SESSION['job1']=$_GET[job];
}

if($_GET[jobcase]){   //จัดการประเภทงาน
	$_SESSION["jobcase1"]=$_GET[jobcase];
}

