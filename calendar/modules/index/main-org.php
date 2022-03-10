<?php @session_start();?>
<link rel="stylesheet" type="text/css" href="css/style_calendar.css" />
<link media="screen" rel="stylesheet" href="JQLightBox/css/colorbox.css">
<script src="JQLightBox/js/jquery.min.js"></script>
<script src="JQLightBox/js/jquery.colorbox.js"></script>
<script>
		$(document).ready(function(){
			$(".example7").colorbox({width:"600", height:"500", iframe:true});
		});
</script>

<?php

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);

	$startYear=$conDate->format_date1(TIMESTAMP,'Y');
	$XYear=$conDate->format_date1(TIMESTAMP,'Y');
	$startDay=$conDate->format_date1(TIMESTAMP,'Y-M');
	$XMonth=$conDate->format_date1(TIMESTAMP,'M')*1;
	$startDayTimeStamp=strtotime($startDay."-01 00:00:00");
	$thisDay=$conDate->format_date1(TIMESTAMP,'d')*1;
	$sumDayMonth=$conDate->format_date1($startDayTimeStamp,'t');  # จำนวนวันเดือนนี้
	$stDay=$conDate->format_date1($startDayTimeStamp,'w');  # ลำดับวันในสัปดา

	 if(!$smonth && !$syear){ 
		$syear=$startYear=$conDate->format_date1(TIMESTAMP,'Y');
		$startDay=$conDate->format_date1(TIMESTAMP,'Y-M');
		$startMonth=$conDate->format_date1(TIMESTAMP,'M')*1;
		$startDayTimeStamp=strtotime($startDay."-01 00:00:00");
		$thisDay=$conDate->format_date1(TIMESTAMP,'d')*1;
		$sumDayMonth=$conDate->format_date1($startDayTimeStamp,'t');  # จำนวนวันเดือนนี้
		$stDay=$conDate->format_date1($startDayTimeStamp,'w');  # ลำดับวันในสัปดา
		$smonth=$startMonth;
		$stDate=$startYear."-".sprintf("%02d",$smonth)."-01";
		$enDate=$startYear."-".sprintf("%02d",$smonth)."-".$sumDayMonth;
	 }else{
		 if($syear){
			 $startYear=$syear;
		 }
		$stDate=$startYear."-".sprintf("%02d",$smonth)."-01";
		$startDayTimeStamp=strtotime($stDate." 00:00:00");
		$startYear=$conDate->format_date1($startDayTimeStamp,'Y');
		$startDay=$conDate->format_date1($startDayTimeStamp,'Y-M');
		$startMonth=$conDate->format_date1($startDayTimeStamp,'M')*1;
		$startDayTimeStamp=strtotime($startDay."-01 00:00:00");
		$sumDayMonth=$conDate->format_date1($startDayTimeStamp,'t');  # จำนวนวันเดือนนี้
		$stDay=$conDate->format_date1($startDayTimeStamp,'w');  # ลำดับวันในสัปดา
		$enDate=$startYear."-".sprintf("%02d",$smonth)."-".$sumDayMonth;
	 }

	 $condi="";

	 if($manager_id)  $condi=" and manager_id='".$manager_id."' ";

	$sql="SELECT * FROM ".TB_calendar." WHERE (( calendar_stdate between '".$stDate."' and '".$enDate."') or ( calendar_endate between '".$stDate."' and '".$enDate."') or ( calendar_stdate < '".$stDate."' and calendar_endate> '".$enDate."')) $condi";
    $res[mc] = $db->select_query($sql,MYDBMS);

	while($arr[mc] = $db->fetch($res[mc],MYDBMS)){
		$calendar_stdate=$arr[mc][calendar_stdate];
		$calendar_endate=$arr[mc][calendar_endate];

		#กรณีการเลื่อมล้ำของแต่ละเดือน
		if($arr[mc][calendar_stdate]<$stDate){
			$calendar_stdate=$startDay."-01";
		}if($arr[mc][calendar_endate]>$enDate){
			$calendar_endate=$startDay."-".$sumDayMonth;
		}

		$StNumDay=(substr($calendar_stdate,8,2)*1);   #วันที่เริ่ม
		$EnNumDay=(substr($calendar_endate,8,2)*1); #วันที่สิ้นสุด
		$ballDay=($EnNumDay-$StNumDay)+1;  # จำนวนวัน
		for($cDay=$StNumDay;$cDay<=$EnNumDay;$cDay++){  # วนหลูปตามจำนวนวันเพื่อเพิ่มรายชื่อผู้บริหารลงตาราง
			$mChk="Null";
			for($dd=0;$dd<=count($MCD[$cDay]);$dd++){  # ตรวจสอบค่าซ้ำ
				if($MCD[$cDay][$dd]==$arr[mc][manager_id]) $mChk="Not Null";
			}
			if($mChk=="Null"){
					$xx=(count($MCD[$cDay])+1);
					$MCD[$cDay][$xx]=$arr[mc][manager_id]; 
			}
		}
	}
?>



<div id='main'>
	<div id='calendar-main'>
		<div id='month-name'>
		<form class="form-inline" method=post action="?" name="webForm">
				<div class="form-group ">
					<div class="input-group">
						<label for="manager_id" class="input-group-addon">เลือกผู้บริหาร</label>
						<select class="form-control" name='manager_id'   onchange='reloadPage()'>
							<option value=''>-- ผู้บริหารทั้งหมด --</option>
							<?php 
								$res[man] = $db->select_query("SELECT * FROM ".TB_man." order by manager_order",MYDBMS);
								while($arr[man] = $db->fetch($res[man],MYDBMS)){?>
									<option 
										value='<?php echo $arr[man][manager_id]?>' 
										<?php if($arr[man][manager_id]==$manager_id) echo "selected";?> >
										<?php echo $arr[man][manager_pname]?>
										<?php echo $arr[man][manager_name]?><?php echo $arr[man][manager_sname]?>
										 : <?php echo $dataOth->pos_($arr[man][manager_pos],$parts);?>
									</option>
								<?php } ?>
						</select>

						<label class="input-group-addon">เลือกเดือน</label>
						<select class='form-control' name='smonth'  onchange='reloadPage()'>
							<?php 
								for($month=1;$month<=12;$month++){?>
								<option value='<?php echo $month;?>' <?php if($month==$smonth) echo "selected";?>><?php echo $conDate->mon_full($month,"th");?></option>
							<?php }?>
						</select>

						<label class="input-group-addon">เลือกปี</label>
						<select class='form-control' name='syear'  onchange='reloadPage()'>
							<?php for($year=2013;$year<=((YENOW*1)+2);$year++){?>
								<option value='<?php echo $year;?>' <?php if($year==$syear) echo "selected";?>><?php echo ($year+543);?></option><?php 
							}?>
						</select>
					</div>
					<a class="btn btn-default" href='calendar/prinpreview.php?manager_id=<?php echo $_POST['manager_id']?>&smonth=<?php echo $_POST['smonth']?>&syear=<?php echo $_POST['syear']?>' target='_blank'><img src='images/print_version.gif' border='0' >สั่งพิมพ์</a>
				</div>
		   </form>
		</div>

		<?php 
		$stDay=($stDay-($stDay*2))+1;
		$endDay=$sumDayMonth;
		$week=0;?>
		<div class='sunname'>
			<?php echo $conDate->day_full(0,"th");?>
		</div>
		<?php 
		for($w=1;$w<6;$w++){?>
			<div class='dayname'><?php echo $conDate->day_full($w,"th");?></div>
		<?php }?>

		<div class='satname'>
			<?php echo $conDate->day_full(6,"th");?>
		</div>

		<?php 
			for($day=$stDay;$day<=$endDay;$day++){
				if(($week%7)==0) echo "<div class='tap_clear'></div>";
				$week++;
				if($day<1){ ?>
					<div class='daynum-none'>&nbsp;</div>
			<?php }else{

					if($day==$thisDay && $XMonth==$startMonth && $XYear==$syear){?>
							<div class='thisday'>
								<p class='daynum'><?php echo $day?></p>
								<div class='mcd1'>
									<?php 
										for($dd=1;$dd<=count($MCD[$day]);$dd++){?>
											<a href='ajaxSubport/event/mshowdetail.php?cdate=<?php echo $startDay."-".$day;?>&manid=<?php echo $MCD[$day][$dd]?>' class="example7 cboxElement" title='<?php ?>'><?php echo $dataUser->man_($MCD[$day][$dd],$parts);?></a><br>
									<?php }?>
								</div>
							</div>
				<?php }else{?>
							<div class='day'>
								<p class='daynum'><?php echo $day?></p>
								<div class='mcd'>
								<?php 
									for($dd=1;$dd<=count($MCD[$day]);$dd++){?>
										<a href='ajaxSubport/event/mshowdetail.php?cdate=<?php echo $startDay."-".$day;?>&manid=<?php echo $MCD[$day][$dd]?>' class="example7 cboxElement" title='<?php ?>'><?php echo $dataUser->man_($MCD[$day][$dd],$parts);?></a><br>
								<?php }?>
								</div>
							</div>
			<?php } # if	
			}# else if
		}  #for
		?>
	</div>
</div>

    <?php #echo $thisDay."x".$XMonth."==".$startMonth." && ".$XYear."==".$syear;?>