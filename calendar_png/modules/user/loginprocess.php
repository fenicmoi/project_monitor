<?php 

  session_start();

  header('Expires: Sat, 1 Jan 2005 00:00:00 GMT');

  header('Last-Modified: '.gmdate('D, d M Y H:i:s').'GMT');

  header('Cache-Control: no-cache, must-revalidate');

  header('Pragma: no-cache');

  header('content-type: application/x-javascript; charset=UTF-8');

    $parts = '../../';

    require_once $parts.'includes/config.in.php';

    require_once $parts.'includes/connect_conf.php';

    require_once $parts.'class_files/class.mysql.php';

    require_once $parts.'class_files/user_class.php';

    require_once $parts.'class_files/other_class.php';

    require_once $parts.'class_files/date_class.php';

    $db = new DB();

    define('YENOW', $conDate->format_date1(TIMESTAMP, 'Y'));

?>




				<?php 

                if ($_POST[username] && $_POST[passwd] && $_POST[security_code]) {
                    if ($_SESSION['security_code'] != $_POST['security_code'] or empty($_POST['security_code'])) {
                        echo "<div class='alert  alert-danger'><h3>รหัสลับผิดพลาด !!!!</h3></div>";
                        login_form();
                    //echo '<meta http-equiv= "refresh" content="0; url=index.php?op=user&modules=login/>';
                    } else {
                        $db->connectdb(DB_NAME, DB_USERNAME, DB_PASSWORD, MYDBMS);

                        $sql = 'SELECT member_id , member_name , member_pri FROM '.TB_member." WHERE member_loginname='".$_POST[username]."' AND member_password='".md5($_POST[passwd])."' ";

                        $res[mem] = $db->select_query($sql, MYDBMS);

                        $rows[mem] = $db->rows1($res[mem], MYDBMS);

                        if ($rows[mem]) {
                            $arr[mem] = $db->fetch($res[mem], MYDBMS);

                            //Can Login

                            if ($arr[mem][member_id]) {
                                //Login ผ่าน

                                ob_start();

                                $_SESSION['USER_LOGIN'] = $arr[mem][member_id];

                                $_SESSION['USER_PRI'] = $arr[mem][member_pri];

                                $_SESSION['USER_LOGIN_NAME'] = $arr[mem][member_name].' '.$arr[mem][member_sname];

                                $_SESSION['USER_LOGIN_TIME'] = time();

                                session_write_close();

                                ob_end_flush();

                                $db->update_db(TB_useronline, array(
                                            'member' => ''.$arr[mem][member_id].'',
                                    ), " SID='".$_SESSION['USER_SID']."' ", MYDBMS);

                                $db->closedb('MYSQL'); ?>
                                 
									<BR><center><font class='f-blue-big'>ยินดีต้อนรับ</font><BR>
									<FONT COLOR="#336600"><B>Login Complete</B></FONT><BR><BR>
									<A HREF="?op=user"><B>ไปสู่หน้าหลักสมาชิก</B></A>
									</CENTER>
									<BR><BR> 

 								   <meta http-equiv="refresh" content="1 ; URL='?op=user&modules=main'; charset=utf-8"> 

						<?php
                            }
                        } else {
                            echo "<div class='alert  alert-danger'><h3>ชื่อเข้าใช้/รหัสผ่านผิด !!!!</h3></div>";
                            login_form();
                        }
                    }
                } else {
                    echo "<center><font class='f-red-b'>!!!! ข้อมูลผิดพลาด !!!!</font></center>";

                    login_form();
                }

            function login_form()
            {
                echo "<a href='index.php?op=user&modules=login' class='btn btn-danger'>ลองอีกครั้ง</a>";
            }

            ?>
