<?php		
class other{
   	 function pos_($recid,$parts){
		$db = New DB();
		global $db ;
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
		$res[data] = $db->select_query("select pos_name from ".TB_pos." where pos_id='".$recid."' ",MYDBMS);
		$arr[data]= $db->fetch($res[data],MYDBMS);
		return $arr[data][pos_name];
		$db->closedb (MYDBMS);
	}
   	 function gen_($recid,$parts){
		$db = New DB();
		global $db ;
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
		$res[data] = $db->select_query("select gen_name from ".TB_cgen." where gen_id='".$recid."' ",MYDBMS);
		$arr[data]= $db->fetch($res[data],MYDBMS);
		return $arr[data][gen_name];
		$db->closedb (MYDBMS);
	}

} # class perSo
$dataOth=new other();