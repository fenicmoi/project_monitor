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

$data=$_GET['data'];
$subdata=explode(":||:",$data);
$gen_id=$subdata[1];

	?>
					<select name='cars_face' class='input-select' onchange='showaddface(this.value)'>
					<option value=''>-- เลือกโฉม --</option>
					<option value='add'>-- เพิ่มโฉม --</option>
					<?php
						$res[face] = $db->select_query("select * from ".TB_cface." where gen_id='".$gen_id."' order by face_name",MYDBMS);
						while($arr[face] = $db->fetch($res[face],MYDBMS)){
							?><option value='<?php echo $arr[face][face_id]?>'><?php echo $arr[face][face_name]?></option><?
						}?></select>
<?php $db->closedb (MYDBMS);     
							
					#		select personal.*,
?>