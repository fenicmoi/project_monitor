<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

$parts="../";

require_once $parts."includes/connect_conf.php";

require_once $parts."includes/config.in.php";

require_once($parts."class_files/class.mysql.php");

require_once($parts."class_files/date_class.php");

require_once($parts."class_files/other_class.php");

require_once($parts."class_files/user_class.php");

$db = New DB();

global $db ;

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);

 $cdate=$_GET['cdate'];

 $manager_id=$_GET['manager_id'];



?>

<link rel="stylesheet" type="text/css" href="<?php echo $parts?>css/style_laout.css" />

<link rel="stylesheet" type="text/css" href="<?php echo $parts?>css/style_text.css" />

<title>กำหนดนัดหมาย ภารกิจ ผู้บริหารจังหวัดพังงา</title>

<body style='background: #FFF;'>



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



	if($manager_id){

	?>&nbsp;<img src='../images/printButton.png' onclick='javascript:window.print()' title='พิมพ์หน้านี้'>

			<table cellspacing="0" cellpadding="0" border='0' class='data-tb3' width="800">

				  <tr height=25>

				   <td align='center' colspan='4'><font class='f-blue-big1'>วาระผู้บริหารจังหวัดพังงา</font>

				   <?php if($manager_id){

						$res[man] = $db->select_query("SELECT * FROM ".TB_man." where manager_id='".$manager_id."' ",MYDBMS);

						$arr[man] = $db->fetch($res[man],MYDBMS);

					?>

				 <div class='man-pic'>

					<?php if($arr[man][manager_pic]) echo "<img src='".$parts."managerPic/".$arr[man][manager_pic]."' width='90' border='0'>"; else echo "<img src='images/man.jpg' border='0'>";?>

				</div> 

				   <font class='f-green-big'><?php echo $arr[man][manager_pname].$arr[man][manager_name]." ".$arr[man][manager_sname];?></font><br><font class='f-green-b'>( <?php echo $dataOth->pos_($arr[man][manager_pos],$parts);?> )</font>

				<?php }?>

				   <br><font class='f-red1-big'>ประจำเดือน <?php echo $conDate->DateConvertSH1($stDate,$parts);?>  </font><br><br></td>

				  </tr>  

				  <tr height=25>

				   <td align='center' colspan='4'><font class='f-black'>แร่หมื่นล้าน  บ้านกลางน้ำ  ถ้ำงามตา  ภูผาแปลก  แมกไม้จำปูน  บริบูรณ์ด้วยทรัพยากร</font></td>

				  </tr>  

		‎

				  <tr height=25>

				   <td width="150" align='center' class='data-f1'><font class='title-table'>วันที่ เวลา</font></td>

				   <td width="290" align='center' class='data-f1' ><font class='title-table'>ภารกิจ</font></td>

				   <td width="180" align='center' class='data-f1' ><font class='title-table'>สถานที่</font></td>

				   <td width="180" align='center' class='data-f2'><font class='title-table'>เจ้าของเรื่อง‎ / <br>หมายเลขโทรศัพท์‎</font></td>

				  </tr>  

				<?php

					$rec_num=0;

				#$sql="SELECT * FROM ".TB_calendar." where  and '".NOWDATESH."' <= calendar_endate ORDER BY calendar_stdate,calendar_sttime,calendar_entime";



				$sql="SELECT * FROM ".TB_calendar." WHERE manager_id='".$manager_id."' and (( calendar_stdate between '".$stDate."' and '".$enDate."') or ( calendar_endate between '".$stDate."' and '".$enDate."') or ( calendar_stdate < '".$stDate."' and calendar_endate> '".$enDate."')) order by manager_id,calendar_stdate";

				$res[calen] = $db->select_query($sql,MYDBMS);

				while($arr[calen] = $db->fetch($res[calen],MYDBMS)){

					$rec_num++;

				?>

					<tr <?php if(($rec_num%2)==0) echo "class='data-s'";?>>   

						 <td  align='center' valign='top' class='data-c1'><?php echo $conDate->DateConvertSH5($arr[calen][calendar_stdate],$parts);?> <?php if(strtotime($arr[calen][calendar_endate]." 00:00:00")!=strtotime($arr[calen][calendar_stdate]." 00:00:00")) echo " - ".$conDate->DateConvertSH5($arr[calen][calendar_endate],$parts);?><br>

						 <?php echo substr($arr[calen][calendar_sttime],0,5);?> <?php /*echo substr($arr[calen][calendar_entime],0,5);*/ ?>



						 </td> 

						 <td  align='left' valign='top' class='data-c1'><b><?php echo $arr[calen][calendar_title];?></b><br><?php echo $arr[calen][calendar_detail ];?></td> 

						 <td  align='left' valign='top' class='data-c1'><?php echo $arr[calen][calendar_location];?></td> 

  					   <td  valign='top' align='left' class='data-c4'><?php echo $arr[calen][calendar_own ];?></td>

					</tr>

				<?php } #while?>

				</table>

<?php }else if(!$manager_id){

				?>&nbsp;<img src='../images/printButton.png' onclick='javascript:window.print()' title='พิมพ์หน้านี้'>

				<table cellspacing="0" cellpadding="0" border='0' class='data-tb3' width="800">

				  <tr height=25>

				   <td align='center' colspan='4'><font class='f-blue-big1'>วาระงานผู้บริหารจังหวัดพังงา</font>

				   <br><font class='f-red1-big'>ประจำเดือน <?php echo $conDate->DateConvertSH1($stDate,$parts);?>  </font><br><br></td>

				  </tr>  

				  <tr height=25>

				   <td align='center' colspan='4'><font class='f-black-b'>แร่หมื่นล้าน  บ้านกลางน้ำ  ถ้ำงามตา  ภูผาแปลก  แมกไม้จำปูน  บริบูรณ์ด้วยทรัพยากร<</font></td>

				  </tr>  

		‎

				  <tr height=25>

				   <td width="150" align='center' class='data-f1'><font class='title-table'>วันที่ เวลา</font></td>

				   <td width="300" align='center' class='data-f1' ><font class='title-table'>ภารกิจ</font></td>

				   <td width="170" align='center' class='data-f1' ><font class='title-table'>สถานที่</font></td>

				   <td width="180" align='center' class='data-f2'><font class='title-table'>เจ้าของเรื่อง‎ / <br>หมายเลขโทรศัพท์‎</font></td>

				  </tr>  

				<?php

				$rec_num=0;

				$sql="SELECT * FROM ".TB_calendar." WHERE (( calendar_stdate between '".$stDate."' and '".$enDate."') or ( calendar_endate between '".$stDate."' and '".$enDate."') or ( calendar_stdate < '".$stDate."' and calendar_endate> '".$enDate."')) order by manager_id,calendar_stdate";

				$res[calen] = $db->select_query($sql,MYDBMS);

				while($arr[calen] = $db->fetch($res[calen],MYDBMS)){

					$rec_num++;

					if($arr[calen][manager_id]!=$mmid){

							$res[man] = $db->select_query("SELECT * FROM ".TB_man." where manager_id='".$arr[calen][manager_id]."' ",MYDBMS);

							$arr[man] = $db->fetch($res[man],MYDBMS);





							?><tr><td colspan='4' class='data-c4' bgcolor='#F0F0F0'>&nbsp;<font class='f-black-big1'><?php echo $arr[man][manager_pname].$arr[man][manager_name]." ".$arr[man][manager_sname];?></font>&nbsp;&nbsp;&nbsp;<font class='f-black-b'>( <?php echo $dataOth->pos_($arr[man][manager_pos],$parts);?> )</font></td></tr>

					<?php }?>



					<tr >   

						 <td  align='center' valign='top' class='data-c1'><?php echo $conDate->DateConvertSH5($arr[calen][calendar_stdate],$parts);?> <?php if(strtotime($arr[calen][calendar_endate]." 00:00:00")!=strtotime($arr[calen][calendar_stdate]." 00:00:00")) echo " - ".$conDate->DateConvertSH5($arr[calen][calendar_endate],$parts);?><br>

						 <?php echo substr($arr[calen][calendar_sttime],0,5);?> <?php /*echo substr($arr[calen][calendar_entime],0,5);*/ ?>



						 </td> 

						 <td  align='left' valign='top' class='data-c1'><b><?php echo $arr[calen][calendar_title];?></b><br><?php echo $arr[calen][calendar_detail ];?></td> 

						 <td  align='left' valign='top' class='data-c1'><?php echo $arr[calen][calendar_location];?></td> 

  					   <td  valign='top' align='left' class='data-c4'><?php echo $arr[calen][calendar_own ];?></td>

					</tr>

				<?php 

						$mmid=$arr[calen][manager_id];

					} #while?>

				</table>

				<?php }?>