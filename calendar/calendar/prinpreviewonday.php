
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>รายการนัดหมายผู้บริหาร</title>
	<link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet"> 
	<style>
		body{
			font-family: 'Prompt', sans-serif;
		}
	</style>
	
<?php
ob_start(); // ทำการเก็บค่า html นะครับ
$parts="../";


include ($parts."mpdf/mpdf.php"); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
require_once $parts."includes/connect_conf.php";
require_once $parts."includes/config.in.php";
include ($parts."class_files/class.mysql.php");
include ($parts."class_files/date_class.php");
include ($parts."class_files/other_class.php");
include ($parts."class_files/user_class.php");

  

$db = New DB();
global $db ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
$sdate=$_GET['sdate'];
$endate=$_GET['endate'];
?>
</head>

<body>
	
<?php
if($sdate){?>
			<table cellspacing="0" cellpadding="1" border="1" style="width:1100px;">
				  <tr>
				   <td align='center' colspan='5'>
					   <img src="../images/logo.gif" width="60" height="60">
					   <h1>วาระงานผู้บริหารจังหวัดพัทลุง</h1>
					<span style="font-size:30px;"><kbd>วัน</kbd> <?php echo $conDate->DateConvertSH4($sdate,$parts);?>  
						<?php 
							if($endate != $sdate){?>
								<kbd>ถึงวัน</kbd> <?php echo $conDate->DateConvertSH4($endate,$parts);?>
						<?php } ?>
				   </span>
				   </td>
				  </tr>  
				  <tr>
					<td style="font-size: 25px;"> วันที่:เวลา</td>
					<td style="font-size: 25px;" align="center"><h3><b> ภารกิจ</b></h3></td>
					<td style="font-size: 25px;" align="center"><h3><b> สถานที่</b></h3></td>
					<td style="font-size: 25px;" align="center"><h3><b> เจ้าของเรื่อง‎/โทรฯ</b></h3></td>
					<td style="font-size: 25px;"18 align="center"><h3><b> การแต่งกาย<b></h3></td>
				  </tr>  
				<?php $rec_num=0;

$sql="SELECT c.*,m.manager_order FROM ".TB_calendar." AS c 
	  INNER JOIN manager as m ON m.manager_id = c.manager_id 
	  WHERE  (
		  		( calendar_stdate between '".$sdate."' and '".$endate."') 
				  OR ( calendar_endate between '".$sdate."' and '".$endate."') 
				  OR ( calendar_stdate < '".$sdate."' and calendar_endate> '".$endate."'
				)
			) 
	  ORDER BY manager_order,calendar_stdate,calendar_sttime";
$res[calen] = $db->select_query($sql,MYDBMS);
while($arr[calen] = $db->fetch($res[calen],MYDBMS)){
	$rec_num++;
	if($arr[calen][manager_id]!=$mmid){
		$res[man] = $db->select_query("SELECT * FROM ".TB_man." where manager_id='".$arr[calen][manager_id]."' ",MYDBMS);
		$arr[man] = $db->fetch($res[man],MYDBMS);?>
		<tr style="font-size: 16px;background-color:yellow">
			<td colspan='5' height="20" >&nbsp;
				<h1><b><?php echo $arr[man][manager_pname].$arr[man][manager_name]." ".$arr[man][manager_sname];?>&nbsp;&nbsp;&nbsp;( <?php echo $dataOth->pos_($arr[man][manager_pos],$parts);?> )</b></h1>
			</td>
		</tr>
<?php } ?>
		<tr>   
			<td width="18%" style="font-size: 25px">
				<?php echo $conDate->DateConvertSH5($arr[calen][calendar_stdate],$parts);?>
				<?php 
					if(strtotime($arr[calen][calendar_endate]." 00:00:00")!=strtotime($arr[calen][calendar_stdate]." 00:00:00")) echo " - ".$conDate->DateConvertSH5($arr[calen][calendar_endate],$parts);?><br>
				<?php echo "เวลา:".substr($arr[calen][calendar_sttime],0,5);?>
				<?php  ?>
			</td> 
			<td>
				<span style="font-size:30px;"><?php echo $arr[calen][calendar_title];?><br><?php echo $arr[calen][calendar_detail ];?></span>
			</td> 
			<td style="font-size: 30px">
				<?php echo $arr[calen][calendar_location];?>
			</td> 
  			<td style="font-size: 30px">
			  <?php echo $arr[calen][calendar_own ];?>
			</td>
			<td style="font-size: 30px">
				<?php echo $arr[calen][calendar_remark ];?>
			</td>
	</tr>
<?php 
$mmid=$arr[calen][manager_id];
}  #while?>
		</table>
		<?php echo no_version;?>

<?php } ?>
</body>
</html>

<?php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', '',2,2.5,5); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>