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
$saleStatus=$subdata[1];
$car_id=$subdata[2];

	?>
						<a href='?op=cars&modules=editcars&carid=<?php echo $arr[car][cars_id]?>'>แก้ไข</a>&nbsp;&nbsp;
<?php if($saleStatus=="Not"){
		$db->update_db(TB_cars,array(
			"status"=>"1",
		)," cars_id='".$car_id."' ",MYDBMS);
	?>
	<a href='#' onclick="updateSale('<?php echo $car_id?>')"  title='รถคันนี้ยังไม่ได้ขาย'>ขาย</a>
<?php }else if($saleStatus=="Sale"){
		$db->update_db(TB_cars,array(
			"status"=>"2",
		)," cars_id='".$car_id."' ",MYDBMS);
		?> 
		<a href='#' onclick="updateNotSale('<?php echo $car_id?>')" title='รถคันนี้ขายแล้ว'>ยังไม่ขาย</a>
<?php }?>
<?php $db->closedb (MYDBMS);     
							
					#		select personal.*,
?>