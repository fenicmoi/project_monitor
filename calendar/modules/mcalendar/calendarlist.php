<?php @session_start();
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
?>
<div id='main'>
<font class='f-blue-big'>ตารางนัดหมายของผู้บริหารประจำ </font><font class='f-green-big'>วัน <?php echo $conDate->DateConvertSH4(NOWDATE,$parts);?></font>
<table cellspacing="0" cellpadding="0" border=0 class='data-tb3'>
				  <tr height=25>
				   <td width="100" align='center' class='data-f1'><font class='title-table'>เวลา</font></td>
				   <td width="180" align='center' class='data-f1'><font class='title-table'>ชื่อผู้บริหาร</font></td>
				   <td width="340" align='center' class='data-f1'><font class='title-table'>รายการ</font></td>
				   <td width="150" align='center' class='data-f2'><font class='title-table'>เจ้าของเรื่อง</font></td>
				  </tr>  
				<?php
					$rec_num=0;
					$sql="SELECT * FROM ".TB_calendar." where '".NOWDATESH."' between calendar_stdate and calendar_endate ORDER BY calendar_sttime,calendar_entime ,manager_id";
				$res[calen] = $db->select_query($sql,MYDBMS);
				while($arr[calen] = $db->fetch($res[calen],MYDBMS)){
					$rec_num++;
					$stdate=substr($arr[calen][calendar_stdate],0,10)." 00:00:00";
					$endate=substr($arr[calen][calendar_endate],0,10)." 00:00:00";
				?>
					<tr <?php if(($rec_num%2)==0) echo "class='data-s'";?>>   
						 <td  align='center' valign='top' class='data-c1'>
						 <?php echo substr($arr[calen][calendar_sttime],0,5);?> - 
						
						<?php echo substr($arr[calen][calendar_entime],0,5);?>

						 </td> 
						 <td  align='left' valign='top' class='data-c1'><?php echo $dataUser->man_($arr[calen][manager_id],$parts)?></td>

						 <td  align='left' valign='top' class='data-c1'><b><?php echo $arr[calen][calendar_title];?></b><br><?php echo $arr[calen][calendar_detail ];?><br><?php echo $arr[calen][calendar_location];?></td> 
  					   <td  valign='top' align='left' class='data-c4'><?php echo $arr[calen][calendar_own ];?></td>
					</tr>
				<?php } #while?>
				</table>
</div>
