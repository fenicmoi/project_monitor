<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="https://fonts.googleapis.com/css?family=Taviraj:400,700" rel="stylesheet"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<?php
$parts="../../";
require_once $parts."includes/connect_conf.php";
require_once $parts."includes/config.in.php";
require_once($parts."class_files/class.mysql.php");
require_once($parts."class_files/date_class.php");
require_once($parts."class_files/other_class.php");
$db = New DB();
global $db ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
$cdate=$_GET['cdate'];
$manid=$_GET['manid'];

?>
<link rel="stylesheet" type="text/css" href="<?php echo $parts?>css/style_laout.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $parts?>css/style_text.css" />

<body>
<div class="well" style="width:730px">
	<?php 
    $res[man] = $db->select_query("SELECT * FROM ".TB_man." where manager_id='".$manid."' ",MYDBMS);
	$arr[man] = $db->fetch($res[man],MYDBMS);
	?>
	
	<div><center><img class="img-rounded" src='<?php echo $parts?>managerPic/<?php	echo $arr[man][manager_pic];?>' width='80'></center></div>
		<center>
		<font class='f-blue-big'><I><?php	echo $arr[man][manager_pname];?><?php	echo $arr[man][manager_name];?>  
		<?php	echo $arr[man][manager_sname];?></I></font>
		<br><font class='f-green-b'><I><?php	echo $dataOth->pos_($arr[man][manager_pos],$parts);?></I></font>
		<br><font class='f-red1-b'>วัน <?php	echo $conDate->DateConvertSH4($cdate,$parts);?></font>
		</center>
	
</div>
	<table class="table table-bordered" width="700">
		<tr height=25>
			<td width="30" align='center' class='data-f1'>ที่</td>
			<td width="100" align='center' class='data-f1'><font class='title-table'>เวลา</font></td>
			<td width="420" align='center' class='data-f2'><font class='title-table'>รายการ</font></td>
		</tr>  

	<?php
	$sql="SELECT * FROM ".TB_calendar." where manager_id='".$manid."' and ( calendar_stdate <= '".$cdate."' and calendar_endate >= '".$cdate."' ) order by calendar_sttime";
    $res[mc] = $db->select_query($sql,MYDBMS);
	while($arr[mc] = $db->fetch($res[mc],MYDBMS)){
		$rec_num++;?>
					<tr>   
						 <td  align='center' valign='top' class='data-c1'><?php echo $rec_num?></td> 
						 <td  align='center' valign='top' class='data-c1'><?php	echo substr($arr[mc][calendar_sttime],0,5);?> - <?php	echo substr($arr[mc][calendar_entime],0,5);?> </td>

						 <td  align='left' valign='top' class='data-c4'>
						 <font class='f-blue-b'><?php	echo $arr[mc][calendar_title];?></font><br>
						 <font class='f-red1-u'>รายละเอียด</font> : <?php	echo $arr[mc][calendar_detail];?><br>
						 <font class='f-red1-u'>สถานที่</font> : <?php	echo $arr[mc][calendar_location];?> </td> 
					</tr>
		
		
		
		
		
<?php	}?> 
 



</div>
</body>