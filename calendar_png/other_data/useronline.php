<?php 

$SID = session_id();
$time = time();
$dag = date("z");
$nu = time()-900; // Keep for 15 mins

$db = New DB();
global $db ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);

$res[sid] = $db->select_query("SELECT count(*) FROM ".TB_useronline." WHERE SID='".$SID."' ",MYDBMS);
$sid_check = mysql_result($res[sid],0);

if ($sid_check == "0") {
			$db->add_db(TB_useronline,array(
				"SID"=>"".$SID."",
				"time"=>"".$time."",
				"DAY"=>"".$dag."",
			), MYDBMS);
} else { 
		$db->update_db(TB_useronline,array(
				"time"=>"".$time."",
				"DAY"=>"".$dag."",
		)," SID='".$SID."' ",MYDBMS);
}


$guest_online = $db->num_rows(TB_useronline,"SID"," time>'".$nu."' AND DAY='".$dag."' AND member=' ' ",MYDBMS);
$user_online = $db->num_rows(TB_useronline,"SID"," time>'".$nu."' AND DAY='".$dag."' AND member!='' ",MYDBMS);
$sumall=$guest_online+$user_online;
$db->del(TB_useronline," time<'".$nu."' ",MYDBMS); 
$db->del(TB_useronline," DAY != '".$dag."' ",MYDBMS); 
$db->closedb (MYDBMS);

?>