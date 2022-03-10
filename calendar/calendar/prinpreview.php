<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>รายการนัดหมายผู้บริหาร</title>
	<link href="https://fonts.googleapis.com/css?family=Taviraj:400,700" rel="stylesheet"> 
	 <style>
		body{ 
			font-family: 'Taviraj', serif;
		}
	 </style>

<?php
ob_start(); // ทำการเก็บค่า html นะครับ
$parts="../";
include ("../mpdf/mpdf.php"); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
require_once $parts."includes/connect_conf.php";
require_once $parts."includes/config.in.php";
include ($parts."class_files/class.mysql.php");
include ($parts."class_files/date_class.php");
include ($parts."class_files/other_class.php");
include ($parts."class_files/user_class.php");

header("Content-type:text/html; charset=UTF-8");                
header("Cache-Control: no-store, no-cache, must-revalidate");               
header("Cache-Control: post-check=0, pre-check=0", false);    

$db = New DB();

global $db ;

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);

 $cdate=$_GET['cdate'];

 $manager_id=$_GET['manager_id'];



?>

<!-- <link rel="stylesheet" type="text/css" href="<?php echo $parts?>css/style_laout.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $parts?>css/style_text.css" /> -->
<title></title>

<body>
<?php



if($_GET['smonth'] && $_GET['syear'])

{

		$stDate=$_GET['syear']."-".sprintf("%02d",$_GET['smonth'])."-01";

		$sumDayMonth=$conDate->format_date1(strtotime($stDate),'t');  # จำนวนวันของเดือน

		$enDate=$_GET['syear']."-".sprintf("%02d",$_GET['smonth'])."-".$sumDayMonth;

}else{

		$startYear=$conDate->format_date1(TIMESTAMP,'Y');

		$startDay=$conDate->format_date1(TIMESTAMP,'Y-M');

		$startMonth=$conDate->format_date1(TIMESTAMP,'M')*1;

		$startDayTimeStamp=strtotime($startDay."-01 00:00:00");

		$thisDay=$conDate->format_date1(TIMESTAMP,'d')*1;

		$sumDayMonth=$conDate->format_date1($startDayTimeStamp,'t');  # จำนวนวันของเดือน

		$stDate=$startYear."-".sprintf("%02d",$startMonth)."-01";

		$enDate=$startYear."-".sprintf("%02d",$startMonth)."-".$sumDayMonth;

}



	if($manager_id){?>

			<table  cellspacing="0" cellpadding="1" border="1" style="width:1100px;">
				  <tr>
				   <td  align='center' colspan='4'><h2><?php echo WEB_TITLE;?></h2>
				   <?php if($manager_id){
						$res[man] = $db->select_query("SELECT * FROM ".TB_man." where manager_id='".$manager_id."' ",MYDBMS);
						$arr[man] = $db->fetch($res[man],MYDBMS);
					?>
				 <div class='man-pic'>
					<?php if($arr[man][manager_pic]) echo "<img src='".$parts."managerPic/".$arr[man][manager_pic]."' width='90' border='0'>"; else echo "<img src='images/man.jpg' border='0'>";?>
				</div> 
				   <h3><?php echo $arr[man][manager_pname].$arr[man][manager_name]." ".$arr[man][manager_sname];?></h3>
				  <font class='f-green-b'>( <?php echo $dataOth->pos_($arr[man][manager_pos],$parts);?> )</font>

				<?php }?>
				   <br><h3>ประจำเดือน <?php echo $conDate->DateConvertSH1($stDate,$parts);?></h3> <br></td>
				  </tr>  

				  <tr style="background: #FF0" >
				   <td   height="25" align='center' colspan='4'><h4><?php echo word;?></h4></td>
				  </tr>  
				  <tr style="background: #ccc" height=25>
					<td width="70" align='center' ><h5>วันที่ เวลา</h5></td>
					<td width="300" align='center'  ><h5>ภารกิจ</h5></td>
					<td width="100" align='center'  ><h5>สถานที่</h5></td>
					<td width="120" align='center' ><h5>เจ้าของเรื่อง‎ / โทร.</h5></td>
				  </tr>  

				<?php
				$rec_num=0;
				$sql="SELECT c.*,m.manager_order FROM ".TB_calendar." AS c
				      INNER JOIN manager as m ON m.manager_id = c.manager_id  WHERE m.manager_id='".$manager_id."' and (( calendar_stdate between '".$stDate."' and '".$enDate."') or ( calendar_endate between '".$stDate."' and '".$enDate."') or ( calendar_stdate < '".$stDate."' and calendar_endate> '".$enDate."')) order by manager_order,calendar_stdate";

				$res[calen] = $db->select_query($sql,MYDBMS);
				while($arr[calen] = $db->fetch($res[calen],MYDBMS)){
					$rec_num++;?>
					<tr>   
						 <td  align='center' valign='top'>
							 <h5>
								<?php echo $conDate->DateConvertSH5($arr[calen][calendar_stdate],$parts);?> 
								<?php if(strtotime($arr[calen][calendar_endate]." 00:00:00")!=strtotime($arr[calen][calendar_stdate]." 00:00:00")) echo " - ".$conDate->DateConvertSH5($arr[calen][calendar_endate],$parts);?><br>
								<?php echo substr($arr[calen][calendar_sttime],0,5);?> <?php /*echo substr($arr[calen][calendar_entime],0,5);*/ ?>
							</h5>
						</td> 
						 <td  align='left' valign='top'>
							 <h5>
								 <b><?php echo $arr[calen][calendar_title];?></b><br><?php echo $arr[calen][calendar_detail ];?>
							 </h5>
						</td> 
						 <td  align='left' valign='top'><h5><?php echo $arr[calen][calendar_location];?></h5></td> 
  					    <td  valign='top' align='left'><h5><?php echo $arr[calen][calendar_own ];?></h5></td>
					</tr>

				<?php } #while?>

				</table>
				<h5><?php echo no_version;?></h5>

<?php }else if(!$manager_id){   //กรณีไม่ได้เลือกใคร  ให้แสดงผลทั้งหมด

				?>
				<table cellspacing="0" cellpadding="1" border="1" style="width:1100px;">
				  <tr>
					<td height="25" align='center' colspan='4'>
						<h3><?echo WEB_TITLE;?></h3>
						<h4>ประจำเดือน <?php echo $conDate->DateConvertSH1($stDate,$parts);?> </h4><br>
					</td>
				  </tr>  
				  <tr style="background: #FF0">
				   	<td height="25" align='center' colspan='4'><h4><?php echo word;?></h4></td>
				  </tr>  

				<tr style="background: #ccc">
					<td height="25" width="70" align='center' ><h4>วันที่:เวลา</h4></td>
					<td width="300" align='center'  ><h4>ภารกิจ</h4></td>
					<td width="100" align='center'  ><h4>สถานที่</h4></td>
					<td width="120" align='center' ><h4>เจ้าของเรื่อง‎ / โทร.</h4></td>
				</tr>  

				<?php
				$rec_num=0;

				$sql="SELECT c.* FROM ".TB_calendar." AS c 
					  INNER JOIN manager AS m ON m.manager_id = c.manager_id WHERE (( calendar_stdate between '".$stDate."' and '".$enDate."') or ( calendar_endate between '".$stDate."' and '".$enDate."') or ( calendar_stdate < '".$stDate."' and calendar_endate> '".$enDate."')) order by manager_order,calendar_stdate";
				//print $sql;
				$res[calen] = $db->select_query($sql,MYDBMS);

				while($arr[calen] = $db->fetch($res[calen],MYDBMS)){
					$rec_num++;
					if($arr[calen][manager_id]!=$mmid){
							$res[man] = $db->select_query("SELECT * FROM ".TB_man." where manager_id='".$arr[calen][manager_id]."' ",MYDBMS);
							$arr[man] = $db->fetch($res[man],MYDBMS);?>
					<tr style="background: #80ffff">
						<td height="25" colspan='4'>
							<h4>&nbsp;<?php echo $arr[man][manager_pname].$arr[man][manager_name]." ".$arr[man][manager_sname];?>&nbsp;&nbsp;&nbsp;( <?php echo $dataOth->pos_($arr[man][manager_pos],$parts);?> )</h4>
						</td>
					</tr>

					<?php }?>
					<tr>   
						<td  align='center' valign='top'>
							<?php echo $conDate->DateConvertSH5($arr[calen][calendar_stdate],$parts);?> 
							<?php if(strtotime($arr[calen][calendar_endate]." 00:00:00")!=strtotime($arr[calen][calendar_stdate]." 00:00:00")) echo " - ".$conDate->DateConvertSH5($arr[calen][calendar_endate],$parts);?><br>
						 	<?php echo substr($arr[calen][calendar_sttime],0,5);?> <?php /*echo substr($arr[calen][calendar_entime],0,5);*/ ?>
						</td> 
						<td  align='left' valign='top'><?php echo $arr[calen][calendar_title];?><br><?php echo $arr[calen][calendar_detail ];?></td> 
						<td  align='left' valign='top'><?php echo $arr[calen][calendar_location];?></td> 
  					    <td  valign='top' align='left'><?php echo $arr[calen][calendar_own ];?></td>
					</tr>
				<?php 
						$mmid=$arr[calen][manager_id];
					} #while?>
				</table>
				<h5><?php echo no_version;?></h5>
				<?php }?>

<?php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', ''); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>