<?php session_start();
  header( "Expires: Sat, 1 Jan 2005 00:00:00 GMT" );
  header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" );
  header( "Cache-Control: no-cache, must-revalidate" );
  header( "Pragma: no-cache" );
  header( "content-type: application/x-javascript; charset=UTF-8" );
$parts="../../";
$data=$_GET['data'];
$subdata=explode(":||:",$data);
$imgName=$subdata[1];
?><img src="../<?php echo $imgName?>">