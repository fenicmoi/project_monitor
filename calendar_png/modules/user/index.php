
<?php
    require_once 'includes/session_data.php';
    require_once 'mainfile.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo WEB_TITLE; ?> <?php echo WEB_URL; ?></title>
    <meta name="subject" content="<?php echo WEB_KEYWORD; ?>">
    <meta http-equiv="keywords" content="<?php echo WEB_KEYWORD; ?>">
    <meta http-equiv="Description" content="<?php echo WEB_KEYWORD; ?>">

    <!-- bootstrap3 / font awasome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/7163b9b28b.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- dataTable  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <!-- css/js ต้นฉบับ -->
    <link rel="stylesheet" type="text/css" href="css/font.css" />
     <link rel="stylesheet" type="text/css" href="css/style_laout.css" />
    <link rel="stylesheet" type="text/css" href="css/style_text.css" />

    <script type="text/javascript" src="js/js.js"></script>
    <script type="text/javascript" src="js/ajax_main.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/check_input_data.js"></script>


    <style>
      .navbar-brand {
        font-size:30px;
       }

    </style>
</head>
<body>
    <nav class="navbar navbar-inverse ">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">วาระผู้บริหารจังหวัดพังงา</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo $parts; ?>index.php?op=index"><i class="fa fa-home fa-2x"></i> หน้าหลัก</a></li>
            <li><a href="<?php echo $parts; ?>index.php?op=mcalendar&modules=mcalendarday"><i class="fa fa-calendar fa-2x"></i> รายการนัดหมายประจำวัน</a></li>
            <li><a href="<?php echo $parts; ?>index.php?op=mcalendar"><i class="fa fa-address-card fa-2x"></i> รายการนัดหมายของผู้บริหาร</a></li>
            <li><?php if (!$_SESSION['USER_LOGIN']) {
    ?><a href="?op=user&modules=login"><i class="fa fa-sign-in fa-2x"></i> เข้าสู่ระบบ</a></li> <?php
}?>
        </ul>
    </div>
    </nav>
    <div class="container-fluid">
				<?php
                    if ($_SESSION['USER_LOGIN']) {
                        ?>   <!-- ถ้ามีการ login เข้ามา  -->
						<div class="well">
							<i class="fa fa-user fa-2x"></i>
							<?php
                                echo $_SESSION['USER_LOGIN_NAME'];    //แสดงชื่อผู้ใช้งาน
                        if ($_SESSION['USER_PRI'] == 1) {
                            echo "<font class='f-green'>ผู้ดูแลระบบ</font>";
                        } else {
                            echo "<font class='f-green'>ผู้ใช้งานทั่วไป</font>";
                        } ?>

							<!-- ตรวจสอบการ ถ้าเป็น Admin ระบบจะแสดง เมนู 1 และ 3-->
							<?php if ($_SESSION['USER_PRI'] == 1) {
                            ?>    
								<a class="btn btn-primary" href='?op=user&modules=manager'> <i class="fa fa-user-plus"></i> จัดการข้อมูลผู้บริหาร</a>
							<?php
                        } ?>
								<a class="btn btn-primary" href='?op=user&modules=mancalendar'><i class="fa fa-calendar"></i> จัดการข้อมูลวาระผู้บริหาร</a>
							<?php if ($_SESSION['USER_PRI'] == 1) {
                            ?>
								<a class="btn btn-primary " href='?op=user&modules=user'><i class="fa fa-users"></i> จัดการข้อมูล ผู้ใช้งาน</a>
							<?php
                        } ?>
							<?php	if ($_SESSION['USER_LOGIN']) {
                            ?>
								<a class="btn btn-danger" href='?op=user&modules=logout'><i class="fa fa-sign-out"></i>  ออกจากระบบ</a>
							<?php
                        } ?>

						</div>


                <?php
                    }?>
                <!-- </div>MenuContent -->
    <div class="tap_clear"></div>


   <!-- <div id="mainContainer"> -->
    <div class="container-fluid">
        <?php
            GETMODULE($_SESSION['op1'], $_SESSION['modules1']);       //ใช้ฟังค์ชั่น GETMODULE ส่งค่าไปตรวจสอบ
            $modules1 = $_SESSION['modules1'];
            $job1 = $_SESSION['job1'];
            $PHP_SELF = 'index.php';
            ?>
                <?php
                        if ($_SESSION['op1'] == 'user' && !$_SESSION['USER_LOGIN']) {
                            require_once 'modules/user/login.php';
                        } else {
                            include ''.$MODPATHFILE.'';
                        }
                        ?>
                <?php
        ?>
    </div><!-- end of main_container -->
    </div>
    <div class="container-fluid" style="margin-top: 25px;">
	<div class="row">
		<legend></legend>
        <p>สำนักงานจังหวัดพังงา<span class="pull-right"><a href="http://www.phangnga.go.th">เว็บไซต์หลัก</a> | ประสานงาน ฝ่ายเลขานุการ 076-481423 | </p>
	</div>
</div>
    <?php //require_once "other_data/counter.php";?>
    <?php //require_once "other_data/useronline.php";?>
</body>
</html>

<?php echo $sql; ?>