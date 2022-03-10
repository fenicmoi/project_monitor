<?php
 @session_start();
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
	$calendarSt="01/01/2013";
	$ndate=substr(NOWDATESH,8,2)."/".substr(NOWDATESH,5,2)."/".substr(NOWDATESH,0,4);

	if($_POST[calendar_stdate])			
		$sdate=substr($_POST[calendar_stdate],6,4)."-".substr($_POST[calendar_stdate],3,2)."-".substr($_POST[calendar_stdate],0,2);
	else 
		$sdate=NOWDATESH;
	if($_POST[calendar_endate])
		$endate=substr($_POST[calendar_endate],6,4)."-".substr($_POST[calendar_endate],3,2)."-".substr($_POST[calendar_endate],0,2);
	else $endate=$sdate;
?>

		<!-- firebug lite -->
		<script type="text/javascript" src="./JQcalendar/firebug.js"></script>
        <!-- jQuery -->
		<script type="text/javascript" src="./JQcalendar/jquery.min.js"></script>
        <!-- required plugins -->
		<script type="text/javascript" src="./JQcalendar/date.js"></script>
		<!--[if IE]><script type="text/javascript" src="scripts/jquery.bgiframe.min.js"></script><![endif]-->
        <!-- jquery.datePicker.js -->
		<script type="text/javascript" src="./JQcalendar/jquery.datePicker.js"></script>
        <!-- datePicker required styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="./JQcalendar/datePicker.css">
        <!-- page specific styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="./JQcalendar/demo.css">
        <script type="text/javascript" charset="utf-8">
			$(function()

            {

				$('.date-pick').datePicker({startDate:'<?php echo $calendarSt?>'});

				$('.date-pick').datePicker()

				$('#start-date').bind(

					'dpClosed',

					function(e, selectedDates)

					{

						var d = selectedDates[0];

						if (d) {

							d = new Date(d);

							$('#end-date').dpSetStartDate(d.addDays(0).asString());

						}

					}

				);

				$('#end-date').bind(

					'dpClosed',

					function(e, selectedDates)

					{

						var d = selectedDates[0];

						if (d) {

							d = new Date(d);

							$('#start-date').dpSetEndDate(d.addDays(0).asString());

						}

					}

				);

            });

		</script>

<!-- <div id='main'> -->
	<div class="row">
		<div class="col-md-12">
		<form method=post action="?" name="webForm">
				   
					<p class='well'>
						<font class='f-blue-big'>ตารางนัดหมายของผู้บริหาร </font>
						<?php if(!$_POST[calendar_stdate])	echo "<font class='f-green-big'>วัน".$conDate->DateConvertSH4(NOWDATESH,$parts)."</font>";?> 
					</p>					
					<div class="tap_clear"></div>
					<p class='detailtext'>
						<font class='f-red1-big'>หรือ</font> <font class='f-green-big'>ตั้งแต่ วันที่&nbsp;&nbsp;</font>
					</p>
					<p class='detailtext'>
							<input name="calendar_stdate" value='<?php echo $_POST['calendar_stdate'];?>' id="start-date" class="date-pick dp-applied" style='font-size:1em;width:100px;color:#F00' onkeypress="javascript:return  true;">
					</p>
					<p class='detailtext'>
						&nbsp;&nbsp;<font class='f-green-big'>ถึงวันที่</font>&nbsp;:&nbsp;
					</p>
					<p class='detailtext'>
						<input name="calendar_endate" value='<?php echo $_POST['calendar_endate']?>' id="end-date" class="date-pick dp-applied" onkeypress="javascript:return  true;" style='font-size:1em;width:100px;color:#F00'>
					</p>
					<p class='detailtext'>
						&nbsp;&nbsp;<input type='submit' class="btn btn-danger" value=' แสดงข้อมูล '>	
					</p>	
					<p class='detailtext'>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='calendar/prinpreviewonday.php?sdate=<?php echo $sdate?>&endate=<?php echo $endate?>' target='_blank'><i class="fa fa-print fa-2x"></i></a>					
					</p>
		</form>
	  <hr>
	  <br>
	  <br> 
	  	<table class="table table-bordered"  id="myTable">
		  <thead class="bg-primary">
			<tr>
				<th>วันที่-เวลา</th>
				<th>รายการ</th>
				<th>สถานที่</th>
				<th>เจ้าของเรื่อง</th>
				<th>หมายเหตุ</th>
			</tr>
		</thead>
			
				<?php
					$rec_num=0;
					$sql="SELECT * FROM ".TB_calendar." where (( calendar_stdate between '".$sdate."' and '".$endate."') or ( calendar_endate between '".$sdate."' and '".$endate."') or ( calendar_stdate < '".$sdate."' and calendar_endate> '".$endate."')) and calendar_endate ORDER BY manager_id,calendar_sttime,calendar_entime";
				$res[calen] = $db->select_query($sql,MYDBMS);
				while($arr[calen] = $db->fetch($res[calen],MYDBMS)){
					$rec_num++;
					$stdate=substr($arr[calen][calendar_stdate],0,10)." 00:00:00";
					$endate=substr($arr[calen][calendar_endate],0,10)." 00:00:00";
						if($arr[calen][manager_id]!=$mmid){
							$res[man] = $db->select_query("SELECT * FROM ".TB_man." where manager_id='".$arr[calen][manager_id]."' ",MYDBMS);
							$arr[man] = $db->fetch($res[man],MYDBMS);
							?><tr><td colspan='5' class='data-c4' bgcolor='#F0F0F0'>&nbsp;<font class='f-black-big1'><?php echo $arr[man][manager_pname].$arr[man][manager_name]." ".$arr[man][manager_sname];?></font>&nbsp;&nbsp;&nbsp;<font class='f-black-b'>( <?php echo $dataOth->pos_($arr[man][manager_pos],$parts);?> )</font></td></tr>
					<?php }?>
					<tr <?php if(($rec_num%2)==0) echo "class='data-s'";?>>   
						 <td  align='center' valign='top' class='data-c1'><?php echo $conDate->DateConvertSH5($arr[calen][calendar_stdate],$parts);?> <?php if(strtotime($arr[calen][calendar_endate]." 00:00:00")!=strtotime($arr[calen][calendar_stdate]." 00:00:00")) echo " - ".$conDate->DateConvertSH5($arr[calen][calendar_endate],$parts);?><br>
						 <?php echo substr($arr[calen][calendar_sttime],0,5);?> - 
						<?php echo substr($arr[calen][calendar_entime],0,5);?>
						 </td> 
						 <td  align='left' valign='top' class='data-c1'><b><?php echo $arr[calen][calendar_title];?></b><br><?php echo $arr[calen][calendar_detail ];?><br><?php echo $arr[calen][calendar_location];?></td> 
 						 <td  align='left' valign='top' class='data-c1'><?php echo $arr[calen][calendar_location];?></td> 
 					     <td  valign='top' align='left' class='data-c4'><?php echo $arr[calen][calendar_own ];?></td>
						 <td  valign='top' align='left' class='data-c4'><?php echo $arr[calen][calendar_remark ];?></td>
					</tr>
				<?php 	$mmid=$arr[calen][manager_id];
						 } #while?>
				</table>
		 </div> <!-- col -->
	</div> <!-- class row -->
<!-- </div> -->

<script>
$(document).ready(function(){
    $('#myTable').DataTable();
});
</script>