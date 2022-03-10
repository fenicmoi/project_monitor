<?php
    @session_start();
	$db = New DB();
	global $db ;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);



if($SID!=$_SESSION['XID'] || !$_SESSION['XID']){

	$IP = $_SERVER['REMOTE_ADDR'];
    echo "นี่คือ IP=".$IP;

   function format_date1($timestamp,$format) {

		$month = array("01", "02", "03", "04", "05", "06", "07", "08", "09","10","11", "12");

		preg_match_all("/[[:alpha:]]/",$format,$character);

		for($i=0;$i<count($character[0]);$i++) {

		if($character[0][$i] == 'M') {

		$formatted = $month[date("n",$timestamp)-1]; 

		}

		else {

		$formatted = date($character[0][$i],$timestamp);

		}

		$format = preg_replace("/".$character[0][$i]."/",$formatted,$format,1);

		}

		return($format);

	}



	$NDATE=format_date1(time(),'Y-M-d H:i:s');

	$db->add_db(TB_counter,array(

		"sign_date"=>"".$NDATE."",

		"sign_ip"=>"".$IP."",

	), MYDBMS);

	$XID=$SID;

	$_SESSION['XID']=$XID;

}

mysql_query("update ".TB_counthit." set count_hit=count_hit+1");

$db->closedb (MYDBMS);

?>