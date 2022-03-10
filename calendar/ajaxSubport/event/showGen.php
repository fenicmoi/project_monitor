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
$bran_id=$subdata[1];

	?>
					<select name='cars_gen' class='input-select' onChange='showaddgen(this.value)'>
					<option value=''>-- เลือกรุ่น --</option>
					<option value='add'>-- เพิ่มรุ่น --</option>
					<?php
						$res[gen] = $db->select_query("select * from ".TB_cgen." where bran_id='".$bran_id."' order by gen_name",MYDBMS);
						while($arr[gen] = $db->fetch($res[gen],MYDBMS)){
							?><option value='<?php echo $arr[gen][gen_id]?>'><?php echo $arr[gen][gen_name]?></option><?
						}?></select>
<?php $db->closedb (MYDBMS);     
							
					#		select personal.*,
?>