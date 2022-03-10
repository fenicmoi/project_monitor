<?php 
include 'library/database.php';
include include session_start();

if (!$dataUser->CheckPriority($_SESSION['USER_LOGIN'], $op1, $modules1, '', $depidman, $parts)) {
    echo  $PermisAccess;
    exit();
}

$calendarSt = '01/01/2013';
$condi = '';

if ($_SESSION['USER_PRI'] != 1) {    //กรณีไม่ใช่ admin
    $condi = " where secretary_id='".$_SESSION['USER_LOGIN']."' ";
    $condi1 = ' where '.TB_man.".secretary_id='".$_SESSION['USER_LOGIN']."' ";
}
?>
<h3>จัดการข้อมูล ตารางนัดหมายของผู้บริหาร</h3>
		<TABLE width=100% align=center cellSpacing=0 cellPadding=0 border=1>	
				<TR>
					<TD>
					<?php if ($dataUser->CheckPriority($_SESSION['USER_LOGIN'], $op1, $modules1, 'add', $depidman, $parts)) {
    ?>
					 &nbsp;&nbsp;&nbsp;&nbsp; <A class="btn btn-warning" HREF="?job=add"><i class="fa fa-plus"></i> เพิ่มข้อมูล</A>&nbsp;&nbsp;
					 <?php
}?>
					 &nbsp;<A class="btn btn-warning" HREF="?job=listdata"><i class="fa fa-list"></i> แสดงข้อมูล</A>
<?php
if ($_SESSION['job1'] == 'add') {
        if ($_POST['save']) {
            $db->connectdb(DB_NAME, DB_USERNAME, DB_PASSWORD, MYDBMS);
            $calendar_stdate = substr($_POST[calendar_stdate], 6, 4).'-'.substr($_POST[calendar_stdate], 3, 2).'-'.substr($_POST[calendar_stdate], 0, 2).' '.sprintf('%02d', $_POST[stH]).':'.sprintf('%02d', $_POST[stM]).':00';
            $calendar_sttime = sprintf('%02d', $_POST[stH]).':'.sprintf('%02d', $_POST[stM]).':00';

            if ($_POST[calendar_endate]) {
                $calendar_endate = substr($_POST[calendar_endate], 6, 4).'-'.substr($_POST[calendar_endate], 3, 2).'-'.substr($_POST[calendar_endate], 0, 2);
            } else {
                $calendar_endate = substr($_POST[calendar_stdate], 6, 4).'-'.substr($_POST[calendar_stdate], 3, 2).'-'.substr($_POST[calendar_stdate], 0, 2);
            }

            $calendar_entime = sprintf('%02d', $_POST[enH]).':'.sprintf('%02d', $_POST[enM]).':00';
            /*
                        $db->add_db(TB_calendar, array(
                                        'manager_id' => ''.$_POST[manager_id].'',
                                        'calendar_stdate' => ''.$calendar_stdate.'',
                                        'calendar_sttime' => ''.$calendar_sttime.'',
                                        'calendar_endate' => ''.$calendar_endate.'',
                                        'calendar_entime' => ''.$calendar_entime.'',
                                        'calendar_title' => ''.$_POST[calendar_title].'',
                                        'calendar_own' => ''.$_POST[calendar_own].'',
                                        'calendar_detail' => ''.$_POST[calendar_detail].'',
                                        'calendar_location' => ''.$_POST[calendar_location].'',
                                        'calendar_remark' => ''.$_POST[calendar_remark].'',
                                    ), MYDBMS);
            */
            $manager_id = $_POST['manager_id'];
            $calendar_stdate = $calendar_stdate;
            $calendar_sttime = $calendar_sttime;
            $calendar_endate = $calendar_endate;
            $calendar_entime = $calendar_entime;
            $calendar_title = $_POST['calendar_title'];
            $calendar_own = $_POST['calendar_own'];
            $calendar_detail = $_POST['calendar_detail'];
            $calendar_location = $_POST['calendar_location'];
            $calendar_remark = $_POST['calendar_remark'];

            $sql = "INSERT INTO calendar(manager_id,calendar_stdate,calendar_sttime,calendar_endate,calendar_entime,calendar_title,
			                              calendar_own,calendar_detail,calendar_location,calendar_remark)
					VALUES( 
				  			 $manager_id,'$calendar_stdate','$calendar_sttime','$calendar_endate','$calendar_entime',
				   			'$calendar_title','$calendar_own','$calendar_detail','$calendar_location','$calendar_remark'
				    )";
            $result = dbQuery($sql);

            if ($result) {
				 $ProcessOutput .= "<br>&nbsp;&nbsp;&nbsp;<FONT class='f-red'>*** ได้ทำการบันทึกข้อมูล  เข้าสู่ระบบเรียบร้อยแล้ว</FONT>";
				 $ProcessOutput .= "<meta http-equiv=\"refresh\" content=\"1 ; URL='?'; charset=utf-8\">";
				  echo $ProcessOutput;
            } else {
                echo 'บันทึกไม่ได้';
            }
        } elseif (!$save) {  //////////////////////////////////////////// กรณีเพิ่ม Form
           
            // $db->connectdb(DB_NAME, DB_USERNAME, DB_PASSWORD, MYDBMS);?>



		<script type="text/javascript" src="./JQcalendar/firebug.js"></script>
		<script type="text/javascript" src="./JQcalendar/jquery.min.js"></script>  
		<script type="text/javascript" src="./JQcalendar/date.js"></script>
		<!--[if IE]><script type="text/javascript" src="scripts/jquery.bgiframe.min.js"></script><![endif]-->  
		<script type="text/javascript" src="./JQcalendar/jquery.datePicker.js"></script>      
		<link rel="stylesheet" type="text/css" media="screen" href="./JQcalendar/datePicker.css">		
		<link rel="stylesheet" type="text/css" media="screen" href="./JQcalendar/demo.css">
        <script type="text/javascript" charset="utf-8">
			$(function()
            {
				$('.date-pick').datePicker({startDate:'<?php echo $calendarSt; ?>'});
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

      

		<form method="post" action="?" name="myForm"  ENCTYPE="multipart/form-data" onsubmit='return mcalendar_check();' >
			<input type='hidden' name='save' value='ok'>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 well">
					<div class="input-group">
						<span class="input-group-addon">ผู้บริหาร</span>
						<select class='form-control' name='manager_id'  >
							<option value=''>-- เลือกผู้บริหาร --</option>
							<?php 
                            $res[calen] = $db->select_query('SELECT * FROM '.TB_man." $condi order by manager_id ", MYDBMS);
            while ($arr[calen] = $db->fetch($res[calen], MYDBMS)) {
                ?><option value='<?php echo $arr[calen][manager_id]; ?>' <?php if ($arr[calen][manager_id] == $arr[car][cars_member]) {
                    echo 'selected';
                } ?>><?php echo $arr[calen][manager_pname]; ?><?php echo $arr[calen][manager_name]; ?> <?php echo $arr[calen][manager_sname]; ?> <?php //echo $arr[calen][manager_name]?> : <?php echo $dataOth->pos_($arr[calen][manager_pos], $parts); ?></option><?php
            } ?>
						</select>
					</div>
					<br>
					<div class="form-group form-inline">
							<label for="start-date">ตั้งแต่วันที่:</label>
							<input name="calendar_stdate" id="start-date" class="date-pick dp-applied" value='<?php echo $calendar_stdate; ?>' require>
							<label for="end-date">ถึงวันที่:</label>
							<input  name="calendar_endate" id="end-date" class="date-pick dp-applied"  value='<?php echo $calendar_endate; ?>' >
							(<font class='f-red'>กรณี 1 วันไม่จำเป็นต้องเลือกวันสิ้นสุด</font>)
					</div>
						
						<div class="form-group form-inline">
							<label for="">ตั้งแต่เวลา:</label>
							<select class='form-control' name='stH'  >
							<?php 
                            for ($H = 0; $H <= 23; ++$H) {
                                ?><option value='<?php echo $H; ?>' <?php if ($H == $stH) {
                                    echo 'selected';
                                } ?>><?php echo $H; ?></option><?php
                            } ?>
							</select> น. 
							
							<select class='form-control' name='stM'  >
							<?php 
                            for ($H = 0; $H <= 59; ++$H) {
                                ?><option value='<?php echo $H; ?>' <?php if ($H == $stM) {
                                    echo 'selected';
                                } ?>><?php echo $H; ?></option><?php
                            } ?>
							</select> นาที&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class='f-black-b'>
							ถึงเวลา</font>&nbsp;:&nbsp;
							<select class='form-control' name='enH'  >
							<?php 
                            for ($H = 0; $H <= 23; ++$H) {
                                ?><option value='<?php echo $H; ?>' <?php if ($H == $enH) {
                                    echo 'selected';
                                } ?>><?php echo $H; ?></option><?php
                            } ?>
							</select> น.
							 <select class='form-control' name='enM'  >
							<?php 
                            for ($H = 0; $H <= 59; ++$H) {
                                ?><option value='<?php echo $H; ?>' <?php if ($H == $enM) {
                                    echo 'selected';
                                } ?>><?php echo $H; ?></option><?php
                            } ?></select> นาที	
						</div>
						<div class="input-group">
							<span class="input-group-addon">หัวข้อภารกิจ</span>
							<input type='text' name='calendar_title' value='<?php echo $arr[calen][manager_pname]; ?>' size='80' class='form-control' require >
						</div>
						<div class="input-group">
							<label for="">รายละเอียดภารกิจ:</label>
							<textarea name='calendar_detail' cols='80' rows='5' class='input-textarea form-control'><?php echo $arr[calen][calendar_detail]; ?></textarea>
						</div>

						<div class="input-group">
							<span class="input-group-addon">สถานที่</span>
							<input type='text' name='calendar_location' value='<?php echo $arr[calen][calendar_location]; ?>' size='60' class='form-control' require >	
						</div>
						<div class="input-group">
							<span class="input-group-addon">เจ้าของเรื่อง</span>
							<input type='text' name='calendar_own' value='<?php echo $arr[calen][calendar_own]; ?>' size='70' class='form-control' require>
						</div>
						<div class="input-group">
							<span class="input-group-addon">หมายเหตุ</span>
							<input type='text' name='calendar_remark' value='<?php echo $arr[calen][calendar_remark]; ?>' size='70' class='form-control' require >
						</div>
						<br>
						<center><input type="submit" class="btn btn-primary" value=" บันทึกข้อมูล "> </center>

				</div> <!-- col-md-6 -->
				<div class="col-md-3"></div>
		    </div>  <!--row  -->
<?php

    $db->closedb(MYDBMS);
        } //save
    } elseif ($_SESSION['job1'] == 'edit') {
        if ($save) {
            $db->connectdb(DB_NAME, DB_USERNAME, DB_PASSWORD, MYDBMS);
            $calendar_stdate = substr($_POST[calendar_stdate], 6, 4).'-'.substr($_POST[calendar_stdate], 3, 2).'-'.substr($_POST[calendar_stdate], 0, 2).' '.sprintf('%02d', $_POST[stH]).':'.sprintf('%02d', $_POST[stM]).':00';
            $calendar_sttime = sprintf('%02d', $_POST[stH]).':'.sprintf('%02d', $_POST[stM]).':00';
            if ($_POST[calendar_endate]) {
                $calendar_endate = substr($_POST[calendar_endate], 6, 4).'-'.substr($_POST[calendar_endate], 3, 2).'-'.substr($_POST[calendar_endate], 0, 2);
            } else {
                $calendar_endate = substr($_POST[calendar_stdate], 6, 4).'-'.substr($_POST[calendar_stdate], 3, 2).'-'.substr($_POST[calendar_stdate], 0, 2);
            }
            $calendar_entime = sprintf('%02d', $_POST[enH]).':'.sprintf('%02d', $_POST[enM]).':00';

            $db->update_db(TB_calendar, array(
                'manager_id' => ''.$_POST[manager_id].'',

                'calendar_stdate' => ''.$calendar_stdate.'',

                'calendar_sttime' => ''.$calendar_sttime.'',

                'calendar_endate' => ''.$calendar_endate.'',

                'calendar_entime' => ''.$calendar_entime.'',

                'calendar_title' => ''.$_POST[calendar_title].'',

                'calendar_own' => ''.$_POST[calendar_own].'',

                'calendar_detail' => ''.$_POST[calendar_detail].'',

                'calendar_location' => ''.$_POST[calendar_location].'',
                'calendar_remark' => ''.$_POST[calendar_remark].'',
            ), " calendar_id='".$_POST[id]."' ", MYDBMS);

            $ProcessOutput .= "<br>&nbsp;&nbsp;&nbsp;<FONT class='f-red'>*** ได้ทำการบันทึกการแก้ไขข้อมูล  เข้าสู่ระบบเรียบร้อยแล้ว</FONT>";

            $ProcessOutput .= "<meta http-equiv=\"refresh\" content=\"1 ; URL='?job=listdata'; charset=utf-8\">";

            $db->closedb(MYDBMS);

            echo $ProcessOutput;
        } elseif (!$save) {
            //////////////////////////////////////////// กรณีแก้ไข Form

            //ดึงค่า

            $db->connectdb(DB_NAME, DB_USERNAME, DB_PASSWORD, MYDBMS);

            $res[calen] = $db->select_query('SELECT * FROM '.TB_calendar." WHERE calendar_id='".$_GET[id]."' ", MYDBMS);

            $arr[calen] = $db->fetch($res[calen], MYDBMS);

            $calendar_stdate = substr($arr[calen][calendar_stdate], 8, 2).'/'.substr($arr[calen][calendar_stdate], 5, 2).'/'.substr($arr[calen][calendar_stdate], 0, 4);

            $calendar_endate = substr($arr[calen][calendar_endate], 8, 2).'/'.substr($arr[calen][calendar_endate], 5, 2).'/'.substr($arr[calen][calendar_endate], 0, 4);

            $stH = substr($arr[calen][calendar_sttime], 0, 2) * 1;

            $stM = substr($arr[calen][calendar_sttime], 3, 2) * 1;

            $enH = substr($arr[calen][calendar_entime], 0, 2) * 1;

            $enM = substr($arr[calen][calendar_entime], 3, 2) * 1; ?>

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

				$('.date-pick').datePicker({startDate:'<?php echo $calendarSt; ?>'});

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

		<form   method=post action="?" name="myForm"  ENCTYPE="multipart/form-data" onsubmit='return mcalendar_check();' >
			<input type='hidden' name='id' value='<?php echo $_GET[id]; ?>'>
			<input type='hidden' name='save' value='ok'>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6 well">
						<label><i class="fa fa-pencil"></i> <?php echo $jobdata; ?></label><br>

						<div class="form-group form-inline">
							<label for="manager_id">ผู้บริหาร:</label>
							<select class='form-control' name='manager_id'  >
								<option value=''>-- เลือกผู้บริหาร --</option>
								<?php 
                                $res[man] = $db->select_query('SELECT * FROM '.TB_man." $condi order by manager_id ", MYDBMS);
            while ($arr[man] = $db->fetch($res[man], MYDBMS)) {
                ?><option value='<?php echo $arr[man][manager_id]; ?>' <?php if ($arr[man][manager_id] == $arr[calen][manager_id]) {
                    echo 'selected';
                } ?>><?php echo $arr[man][manager_pname]; ?><?php echo $arr[man][manager_name]; ?> <?php echo $arr[man][manager_sname]; ?> <?php //echo $arr[man][manager_name]?> , <?php echo $dataOth->pos_($arr[man][manager_pos], $parts); ?></option><?php
            } ?>
							</select>
						</div>

						<div class="form-group form-inline">
							<label for="start-date">ตั้งแต่วันที่:</label>
							<input name="calendar_stdate" id="start-date" class="date-pick dp-applied" value='<?php echo $calendar_stdate; ?>'>
							<label for="end-date">ถึงวันที่:</label>
							<input  name="calendar_endate" id="end-date" class="date-pick dp-applied"  value='<?php echo $calendar_endate; ?>' >
							(<font class='f-red'>กรณี 1 วันไม่จำเป็นต้องเลือกวันสิ้นสุด</font>)
						</div>
						
						<div class="form-group form-inline">
							<label for="">ตั้งแต่เวลา:</label>
							<select class='form-control' name='stH'  >
							<?php 
                            for ($H = 0; $H <= 23; ++$H) {
                                ?><option value='<?php echo $H; ?>' <?php if ($H == $stH) {
                                    echo 'selected';
                                } ?>><?php echo $H; ?></option><?php
                            } ?>
							</select> น. 
							
							<select class='form-control' name='stM'  >
							<?php 
                            for ($H = 0; $H <= 59; ++$H) {
                                ?><option value='<?php echo $H; ?>' <?php if ($H == $stM) {
                                    echo 'selected';
                                } ?>><?php echo $H; ?></option><?php
                            } ?>
							</select> นาที&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class='f-black-b'>
							ถึงเวลา</font>&nbsp;:&nbsp;
							<select class='form-control' name='enH'  >
							<?php 
                            for ($H = 0; $H <= 23; ++$H) {
                                ?><option value='<?php echo $H; ?>' <?php if ($H == $enH) {
                                    echo 'selected';
                                } ?>><?php echo $H; ?></option><?php
                            } ?>
							</select> น.
							 <select class='form-control' name='enM'  >
							<?php 
                            for ($H = 0; $H <= 59; ++$H) {
                                ?><option value='<?php echo $H; ?>' <?php if ($H == $enM) {
                                    echo 'selected';
                                } ?>><?php echo $H; ?></option><?php
                            } ?></select> นาที	
						</div>
						
						<div class="form-group form-inline">
							<label for="">หัวข้อภารกิจ:</label>
							<input type='text' name='calendar_title' value='<?php echo $arr[calen][calendar_title]; ?>' size='80' class='input-text form-control' >
						</div>

						<div class="form-group form-inline">
							<label for="">รายละเอียดภารกิจ:</label>
							<textarea name='calendar_detail' cols='80' rows='5' class='input-textarea form-control'><?php echo $arr[calen][calendar_detail]; ?></textarea>
						</div>

						<div class="form-group form-inline">
							<label>สถานที่:</label>
							<input type='text' name='calendar_location' value='<?php echo $arr[calen][calendar_location]; ?>' size='60' class='input-text form-control' >	
						</div>
						<div class="form-group form-inline">
							<label>เจ้าของเรื่อง/โทรศัพท์</label>
							<input type='text' name='calendar_own' value='<?php echo $arr[calen][calendar_own]; ?>' size='70' class='input-text form-control' >
						</div>
						<div class="form-group form-inline">
							<label>หมายเหตุ</label>
							<input type='text' name='calendar_remark' value='<?php echo $arr[calen][calendar_remark]; ?>' size='70' class='input-text form-control' >
						</div>
						<center><input type=submit class="btn btn-primary" value=" บันทึกข้อมูล "> </center>
					</div> <!-- col-md-6 -->
					<div class="col-md-3"></div>
				</div> <!-- row -->
		</form>
		<?php

            $db->closedb(MYDBMS);
        } //save
    } elseif ($_SESSION['job1'] == 'delt') {
        //////////////////////////////////////////// กรณีลบ Form

        $db->connectdb(DB_NAME, DB_USERNAME, DB_PASSWORD, MYDBMS);

        $res[calen] = $db->select_query('SELECT manager_pic FROM '.TB_man." WHERE manager_id='".$_GET[id]."' ", MYDBMS);

        $arr[calen] = $db->fetch($res[calen], MYDBMS);

        if ($arr[calen][manager_pic]) {
            unlink('managerPic/'.$arr[calen][manager_pic]);
        }

        $db->del(TB_calendar, " calendar_id='".$_GET[id]."' ", MYDBMS);

        $db->del(TB_man, " manager_id='".$_GET[id]."' ", MYDBMS);

        $db->closedb(MYDBMS);

        //$ProcessOutput .= "<br>&nbsp;&nbsp;&nbsp;<FONT class='f-red'>*** ได้ทำการลบข้อมูล เรียบร้อยแล้ว</FONT>";
        $ProcessOutput .= "<script>
								swal('Good job!', 'ลบข้อมูลแล้ว!', 'success')
								</script>";

        echo $ProcessOutput;
    } elseif ($_SESSION['job1'] == 'listdata' || !$_SESSION['job1']) {
        $db->connectdb(DB_NAME, DB_USERNAME, DB_PASSWORD, MYDBMS);

        $limit = $perpage = 20;

        $sql = 'SELECT '.TB_calendar.'.*,'.TB_man.'.manager_id FROM '.TB_calendar.' INNER JOIN '.TB_man.' ON '.TB_man.'.manager_id='.TB_calendar.".manager_id $condi1 ORDER BY ".TB_calendar.'.calendar_stdate DESC ';

        $res[calen] = $db->select_query($sql, MYDBMS);

        $sumcount = $db->rows1($res[calen], MYDBMS);

        $page = $_GET[page_c];

        $goto = 0;

        $datalink = '?';

        if (!$page) {
            $goto = 0;
            $en = $st + $limit;
        } else {
            $po = $page * $limit;

            $goto = $po - $limit;
        }

        $bb = $goto; ?>

		<div style="text-align:left;"><?php $dataPC->pagecheck_normal($perpage, $datalink, $page_c, 30, $sumcount, $parts); ?></div>

			 <table class='table table-bordered table-striped'>
				  <thead class="bg-success">
					<tr >
						<td width="30" align='center' >&nbsp;</td>
						<td width="200" align='center' ><font class='title-table'>ชื่อผู้บริหาร</font></td>
						<td  align='center' ><font class='title-table'>วัน เวลา</font></td>
						<td  align='center' ><font class='title-table'>รายการ</font></td>
						<td>แก้ไข</td>
						<td>ลบ</td>
					</tr>  
				</thead>					 
				<?php
                $rec_num = 0;
        $res[calen] = $db->select_query($sql." LIMIT $goto, $perpage", MYDBMS);

        while ($arr[calen] = $db->fetch($res[calen], MYDBMS)) {
            ++$rec_num;
            $stdate = substr($arr[calen][calendar_stdate], 0, 10).' 00:00:00';
            $endate = substr($arr[calen][calendar_endate], 0, 10).' 00:00:00'; ?>

					<tr <?php if ($arr[calen][manager_id] == $id) {
                echo "class='data-edit'";
            } ?>>   

						 <td><?php echo $rec_num; ?></td> 
						 <td  align='left' valign='top'><?php echo $dataUser->man_($arr[calen][manager_id], $parts); ?></td>
						 <td  align='center' valign='top'>
							<?php echo $conDate->DateConvertSH5($arr[calen][calendar_stdate], $parts); ?>
							<?php echo substr($arr[calen][calendar_sttime], 0, 5); ?> - 						
							<?php if (strtotime($stdate) != strtotime($endate)) {
                echo $conDate->DateConvertSH5($arr[calen][calendar_endate], $parts);
            } ?> 
							<?php echo substr($arr[calen][calendar_entime], 0, 5); ?>
						 </td> 
						 <td  align='left' valign='top'><?php echo $arr[calen][calendar_title]; ?> , <i class="fa fa-map-marker"></i>สถานที่ : <?php echo $arr[calen][calendar_location]; ?></td> 
  					     <td  valign='top' align='center'>
							<?php if ($dataUser->CheckPriority($_SESSION['USER_LOGIN'], $op1, $modules1, 'edit', $depidman, $parts)) {
                ?>
								&nbsp;<a class="btn btn-success btn-xs" href="?job=edit&id=<?php echo  $arr[calen][calendar_id]; ?>"><i class="fa fa-pencil fa-2x"></i></a> 
							<?php
            } ?> 						
						  </td>
						  <td>
						  <?php if ($dataUser->CheckPriority($_SESSION['USER_LOGIN'], $op1, $modules1, 'delt', $depidman, $parts)) {
                ?>
							  &nbsp;<a class="btn btn-danger btn-xs" href="?job=delt&id=<?php echo  $arr[calen][calendar_id]; ?>" onclick="javascript:return Conf('<?php echo $arr[calen][calendar_title]; ?>')"><i class="fa fa-trash fa-2x"></i></a>							  
						  <?php
            } ?>
						  </td>
					</tr>

				<?php
        } //while?>

				</form>

				</table>

	&nbsp;<font class='f-red'>หมายเหตุ</font>&nbsp;&nbsp;<i class="fa fa-pencil fa-2x"></i> : แก้ไขข้อมูล&nbsp;,&nbsp;&nbsp;<i class="fa fa-trash fa-2x"></i> : ลบข้อมูล&nbsp;



<?php	

    $db->closedb(MYDBMS);
    }

    ?>

		</TD>

	</TR>

</TABLE>

