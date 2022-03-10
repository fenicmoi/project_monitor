<?php @session_start();
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
	$manager_id=$_GET['manager_id'];
?>
<div class="well">
	<center>
	<h3>
		ตารางนัดหมายในปี <?php echo (YENOW+543)?> ของ <?php if(!$manager_id) echo "";?> 
		<?php echo $dataUser->man_($manager_id,$parts)?>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-success" href='calendar/prinpreviewyear.php?nyear=<?php echo YENOW?>&manager_id=<?php echo $manager_id?>' target='_blank'><img src='images/print_version.gif' border='0' >สั่งพิมพ์</a>	
	</h3>
	</center>
</div>
	
<div id='main'>
				<?php
				if(!$manager_id){    //ถ้ามีการเลือกผู้บริหาร
					$rec_num=0;
					$res[man] = $db->select_query("SELECT * FROM ".TB_man." WHERE status=0 ORDER BY manager_order",MYDBMS);
					echo "condi=".$condi1;
					while($arr[man] = $db->fetch($res[man],MYDBMS)){
						$rec_num++;
					?>
					<center>
					<div class='mandetail'>
							<div class='man-pic'>
								<a href='?manager_id=<?php echo $arr[man][manager_id]?>'><?php if($arr[man][manager_pic]) echo "<img width='120' height='150' class='img-rounded' src='managerPic/".$arr[man][manager_pic]."' width='90' border='0'>"; else echo "<img src='images/man.jpg' border='0'>";?></a>
							</div>
							<div class='man-name'>
								<?php echo $arr[man][manager_pname]?><?php echo $arr[man][manager_name]?> <?php echo $arr[man][manager_sname]?><br>ตำแหน่ง : <?php echo $dataOth->pos_($arr[man][manager_pos],$parts);?>
							</div>
					</div>
					</center>
					<?php } #while			
				}else if($manager_id){   //ถ้าไม่มีการเลือกผู้บริหาร
	
					$startYear=$conDate->format_date1(TIMESTAMP,'Y');
					$startDay=$conDate->format_date1(TIMESTAMP,'Y-M');
					$startMonth=$conDate->format_date1(TIMESTAMP,'M')*1;
					$startDayTimeStamp=strtotime($startDay."-01 00:00:00");
					$thisDay=$conDate->format_date1(TIMESTAMP,'d')*1;
					$sumDayMonth=$conDate->format_date1($startDayTimeStamp,'t');  # จำนวนวันเดือน
					$stDate=$startYear."-01-01";
					$enDate=$startYear."-12-31"; ?>
					<table cellspacing="0" cellpadding="0" border=1 class='data-tb3'>
							<tr height=25>
								<td width="160" align='center' class='data-f1'><font class='title-table'>วัน เวลา</font></td>
								<td width="540" align='center' class='data-f1'><font class='title-table'>รายการ</font></td>
								<td width="150" align='center' class='data-f2'><font class='title-table'>เจ้าของเรื่อง</font></td>
							</tr>  
							<?php
							$rec_num=0;

							$sql="SELECT * FROM ".TB_calendar." WHERE manager_id='".$manager_id."' and (( calendar_stdate between '".$stDate."' and '".$enDate."') or ( calendar_endate between '".$stDate."' and '".$enDate."') or ( calendar_stdate < '".$stDate."' and calendar_endate> '".$enDate."')) ";
							$res[calen] = $db->select_query($sql,MYDBMS);

							while($arr[calen] = $db->fetch($res[calen],MYDBMS)){
								$rec_num++; ?>
							<tr <?php if(($rec_num%2)==0) echo "class='data-s'";?>>   
								<td  align='center' valign='top' class='data-c1'>
									<?php echo $conDate->DateConvertSH5($arr[calen][calendar_stdate],$parts);?>
									<?php if(strtotime($arr[calen][calendar_endate]." 00:00:00")!=strtotime($arr[calen][calendar_stdate]." 00:00:00")) echo " - ".$conDate->DateConvertSH5($arr[calen][calendar_endate],$parts);?><br>
									<?php echo substr($arr[calen][calendar_sttime],0,5);?> - <?php echo substr($arr[calen][calendar_entime],0,5);?>
								</td> 
								<td  align='left' valign='top' class='data-c1'>
									<b><?php echo $arr[calen][calendar_title];?></b><br>
									<?php echo $arr[calen][calendar_detail ];?><br>
									<?php echo $arr[calen][calendar_location];?>
								</td> 
								<td  valign='top' align='left' class='data-c4'><?php echo $arr[calen][calendar_own ];?></td>
							</tr>
							<?php } #while?>
					</table>
<?php }?>
</div>
