<?php @session_start();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<?php 

	require_once("includes/session_data.php");

	require_once("mainfile.php");

?>

<title><?php echo WEB_TITLE?> <?php echo WEB_URL?></title>

<meta name="subject" content="<?php echo WEB_KEYWORD?>"> 

<meta http-equiv="keywords" content="<?php echo WEB_KEYWORD?>"> 

<meta http-equiv="Description" content="<?php echo WEB_KEYWORD?>"> 

<link rel="stylesheet" type="text/css" href="css/font.css" />

<link rel="stylesheet" type="text/css" href="css/style_laout.css" />

<link rel="stylesheet" type="text/css" href="css/style_text.css" />

<script type="text/javascript" src="js/js.js"></script>

<script type="text/javascript" src="js/ajax_main.js"></script>

<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/check_input_data.js"></script>

</head>

<body>

<div id="headerBG">

		<?php require_once "other_data/topheader.php";?>

</div>

<div class="tap_clear"></div>

			<div id='MenuContent'>

			<div id="topmenu">

				&nbsp;<img src='images/dot.jpg'><a href='<?php echo $parts?>index.php?op=index' class="aaa">หน้าหลัก</a>&nbsp;&nbsp;&nbsp;&nbsp;

				&nbsp;<img src='images/dot.jpg'><a href='<?php echo $parts?>index.php?op=mcalendar&modules=mcalendarday' class="aaa">รายการนัดหมายประจำวัน</a>&nbsp;&nbsp;&nbsp;&nbsp;

				&nbsp;<img src='images/dot.jpg'><a href='<?php echo $parts?>index.php?op=mcalendar' class="aaa">รายการนัดหมายของผู้บริหาร</a>&nbsp;&nbsp;&nbsp;&nbsp;

				<?php	if(!$_SESSION['USER_LOGIN']){?>&nbsp;<img src='images/dot.jpg'>&nbsp;<a href='?op=user&modules=login' class="aaa">เข้าสู่ระบบ</a><?php }?>

			</div>

			<?php	if($_SESSION['USER_LOGIN']){?>

				<img src='images/user.jpg' style="float:left;margin-left:5px;">

				<?php 

					echo "<font class='f-green-b'>".$_SESSION['USER_LOGIN_NAME']."</font><br>";

					if($_SESSION['USER_PRI']==1) echo "<font class='f-green'>ผู้ดูแลระบบ</font>"; else echo "<font class='f-green'>ผู้ใช้งานทั่วไป</font>";

				?>

				

				<div id='userMenuList'>

<!-- 					<img src='images/dot.jpg'>&nbsp;<a href='?op=user'>หน้าหลักผู้ใช้งาน</a><br>

 -->					<?php if($_SESSION['USER_PRI']==1){?>

								<img src='images/dot.jpg'>&nbsp;<a href='?op=user&modules=manager'>จัดการข้อมูลผู้บริหาร</a>&nbsp;&nbsp;&nbsp;&nbsp;

						<?php }?>

					<img src='images/dot.jpg'>&nbsp;<a href='?op=user&modules=mancalendar'>จัดการข้อมูลวาระผู้บริหาร</a>&nbsp;&nbsp;&nbsp;&nbsp;

					<?php if($_SESSION['USER_PRI']==1){?>

						<img src='images/dot.jpg'>&nbsp;<a href='?op=user&modules=user'>จัดการข้อมูล ผู้ใช้งาน</a>&nbsp;&nbsp;&nbsp;&nbsp;

					<?php }?>

					<?php	if($_SESSION['USER_LOGIN']){?>

					<img src='images/dot.jpg'>&nbsp;<a href='?op=user&modules=logout'>ออกจากระบบ</a>&nbsp;&nbsp;&nbsp;&nbsp;

					<?php }?>

				</div>

			<?php }?>

			</div><!-- MenuContent -->

<div class="tap_clear"></div>







<div id="mainContainer">

	<?php

		GETMODULE($_SESSION['op1'],$_SESSION['modules1']);   

		$modules1=$_SESSION['modules1'];

		$job1=$_SESSION['job1'];

		$PHP_SELF = "index.php";



		?>



			<?php

					if($_SESSION['op1']=="user" && !$_SESSION['USER_LOGIN']){

						require_once "modules/user/login.php";

					}else{

						include ("".$MODPATHFILE."");

					 }

					 ?>	

			<?php

	?>

</div><!-- end of main_container -->

<div id="footer"><?php echo cCopyright?></div>        

<?php require_once "other_data/counter.php";?>

<?php require_once "other_data/useronline.php";?>

</body>

</html>