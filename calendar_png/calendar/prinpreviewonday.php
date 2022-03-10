
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>รายการนัดหมายผู้บริหาร</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
	<link href="https://fonts.googleapis.com/css?family=Taviraj:400,700" rel="stylesheet"> 
	 <style>
		body{ 
			font-family: 'Taviraj', serif;
		}
	 </style>
	
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



$sdate=$_GET['sdate'];



$endate=$_GET['endate'];



?>
</head>

<body>
	
	<center><button type="button" class="btn btn-large btn-danger" onclick='javascript:window.print()' title='พิมพ์หน้านี้'><i class="glyphicon glyphicon-print"></i> พิมพ์</button></center>
<?php
if($sdate){
	
	
	
	?>
			<table  width="100%" border=2>
				  <tr class="bg-success">
				   <td align='center' colspan='5'><h2 class="text-primary">วาระงานผู้บริหารจังหวัดพังงา</h2>
					<h4 class="text-info"><kbd>วัน</kbd> <?php echo $conDate->DateConvertSH4($sdate,$parts);


?>  
					<?php if($endate != $sdate){
	
	
	?>
							<kbd>ถึงวัน</kbd> <?php echo $conDate->DateConvertSH4($endate,$parts);


?>
					<?php
}


?></h4>
					
				   </td>
				  </tr>  
				  <tr class="bg-primary" >
				   <td><h5> วันที่:เวลา</h5></td>
				   <td align="center"><h5><b> ภารกิจ</b></h5></td>
				   <td align="center"><h5><b> สถานที่</b></h5></td>
				   <td align="center"><h5><b> เจ้าของเรื่อง‎/โทรศัพท์‎</b></h5></td>
				   <td align="center"><h5><b> หมายเหตุ<b></h5></td>
				  </tr>  
				<?php $rec_num=0;



#$sql="SELECT * FROM ".TB_calendar." where  and '".NOWDATESH."' <= calendar_endate ORDER BY calendar_stdate,calendar_sttime,calendar_entime";




$sql="SELECT * FROM ".TB_calendar." where (( calendar_stdate between '".$sdate."' and '".$endate."') or ( calendar_endate between '".$sdate."' and '".$endate."') or ( calendar_stdate < '".$sdate."' and calendar_endate> '".$endate."')) order by manager_id,calendar_stdate,calendar_sttime";



$res[calen] = $db->select_query($sql,MYDBMS);



while($arr[calen] = $db->fetch($res[calen],MYDBMS)){
	
	
	
	$rec_num++;
	
	
	
	if($arr[calen][manager_id]!=$mmid){
		
		
		
		$res[man] = $db->select_query("SELECT * FROM ".TB_man." where manager_id='".$arr[calen][manager_id]."' ",MYDBMS);
		
		
		
		$arr[man] = $db->fetch($res[man],MYDBMS);
		
		
		
		?>
		<tr class="bg-info">
			<td colspan='5'>&nbsp;
				<b><?php echo $arr[man][manager_pname].$arr[man][manager_name]." ".$arr[man][manager_sname];



?>&nbsp;&nbsp;&nbsp;( <?php echo $dataOth->pos_($arr[man][manager_pos],$parts);



?> )</b>
			</td>
		</tr>
		<?php
}


?>
		<tr >   
			<td>
			<?php echo $conDate->DateConvertSH5($arr[calen][calendar_stdate],$parts);



?> <?php if(strtotime($arr[calen][calendar_endate]." 00:00:00")!=strtotime($arr[calen][calendar_stdate]." 00:00:00")) echo " - ".$conDate->DateConvertSH5($arr[calen][calendar_endate],$parts);



?><br>
			<?php echo substr($arr[calen][calendar_sttime],0,5);



?> - 

						

<?php 



/*echo substr($arr[calen][calendar_entime],0,5);*/



?>
			</td> 
			<td><?php echo $arr[calen][calendar_title];



?><br><?php echo $arr[calen][calendar_detail ];



?>
			</td> 
			<td>
				<?php echo $arr[calen][calendar_location];


?>
			</td> 
  			<td>
			  <?php echo $arr[calen][calendar_own ];


?>
			</td>
			<td>
				<?php echo $arr[calen][calendar_remark ];


?>
			</td>
	</tr>
<?php 
$mmid=$arr[calen][manager_id];



}



#while?>

		</table>

<?php
}



?>



</body>
</html>