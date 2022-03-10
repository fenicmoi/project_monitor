<?php @session_start();

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
		$db->update_db(TB_useronline,array(
				"time"=>"".$time."",
				"userlogin"=>"",
		)," SID='".$SID."' ",MYDBMS);
		$db->closedb (MYDBMS);
		session_unset();
		session_destroy();
		$_SESSION['SID']=$SID;
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>Logout from System</B></FONT><BR><BR>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<meta http-equiv=\"refresh\" content=\"1 ; URL='?op=index'; charset=utf-8\">";
		ECHO $ProcessOutput;
?>