<?php
ob_start();
session_start();
require '../libs/config.inc.php';
require '../libs/ajax.php'; 
require '../libs/mysql.php';
require '../libs/function.php';
require '../funcs/func_chat.php';

logout();


ob_end_flush();
?><BR><CENTER><FONT SIZE="4" COLOR="#FF00CC">คุณได้ออกจากระบบห้องสนทนาเรียบร้อยแล้วครับ ขอบคุณที่เข้ามาใช้งาน</FONT></CENTER><BR>
<CENTER><input type="button" value="ปิดหน้าต่างนี้" onClick="javascript:window.close()" ></CENTER>