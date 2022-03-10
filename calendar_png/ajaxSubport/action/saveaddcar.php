<?php session_start();
  header( "Expires: Sat, 1 Jan 2005 00:00:00 GMT" );
  header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" );
  header( "Cache-Control: no-cache, must-revalidate" );
  header( "Pragma: no-cache" );
  header( "content-type: application/x-javascript; charset=UTF-8" );
$parts="../../";
require_once $parts."includes/connect_conf.php";
require_once $parts."includes/config.in.php";
require_once($parts."class_files/class.mysql.php");
$db = New DB();
global $db ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);

#print_r($_POST);
echo ">>".$_FILES[carpic1][tmp_name];