
<?php 
	require_once("includes/session_data.php");
	require_once("mainfile.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo WEB_TITLE?> <?php echo WEB_URL?></title>
    <meta name="subject" content="<?php echo WEB_KEYWORD?>"> 
    <meta http-equiv="keywords" content="<?php echo WEB_KEYWORD?>"> 
    <meta http-equiv="Description" content="<?php echo WEB_KEYWORD?>"> 

    <!-- bootstrap3 / font awasome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="#">วาระผู้บริหารจังหวัดพังงา</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo $parts?>index.php?op=index">หน้าหลัก</a></li>
            <li><a href="<?php echo $parts?>index.php?op=mcalendar&modules=mcalendarday">รายการนัดหมายประจำวัน</a></li>
            <li><a href="<?php echo $parts?>index.php?op=mcalendar">รายการนัดหมายของผู้บริหาร</a></li>
    <li><?php if(!$_SESSION['USER_LOGIN']){?><a href="?op=user&modules=login">เข้าสู่ระบบ</a></li> <?php }?>    
        </ul>
        <button class="btn btn-danger navbar-btn">Button</button>
    </div>
    </nav>

    <div class="container-fluid">
    <div class="tap_clear"></div>
                <div id='MenuContent'>
                <?php	if($_SESSION['USER_LOGIN']){?>
                    <img src='images/user.jpg' style="float:left;margin-left:5px;">
                    <?php 
                        echo "<font class='f-green-b'>".$_SESSION['USER_LOGIN_NAME']."</font><br>";
                        if($_SESSION['USER_PRI']==1) echo "<font class='f-green'>ผู้ดูแลระบบ</font>"; else echo "<font class='f-green'>ผู้ใช้งานทั่วไป</font>";
                    ?>
                    <div id='userMenuList'>
    				<?php if($_SESSION['USER_PRI']==1){?>
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
    </div>
   
    <div id="footer"><?php echo cCopyright?></div>        
    <?php require_once "other_data/counter.php";?>
    <?php require_once "other_data/useronline.php";?>
</body>
</html>