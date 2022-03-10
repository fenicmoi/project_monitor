<?php 
	class user{
		function CheckPriority($recid,$op,$modules,$job,$man_recid,$parts)
		{
			if($_SESSION['USER_LOGIN']){
				$db = New DB();
				global $db ;
				$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
				$res[data] = $db->select_query("select * from ".TB_useronline." where member='".$recid."' and SID='".$_SESSION['USER_SID']."' ",MYDBMS);
				if($db->rows1($res[data] ,MYDBMS)>0){
					if($this->chkJob_($recid,$op,$modules,$job,$man_recid,$parts))
						return true;
				}else return "";
				$db->closedb (MYDBMS);       
			}else return "";
		}#function
		function chkJob_($recid,$op,$modules,$job,$man_recid,$parts){
			if($_SESSION['USER_PRI'] && $_SESSION['USER_PRI']==1) 
				return true;
			else {
				if($modules!="user"){
					return true;
				}
			}
		}
	 function member_($recid,$parts){
		$db = New DB();
		global $db ;
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
		$res[data] = $db->select_query("select member_name from ".TB_member." where member_id='".$recid."' ",MYDBMS);
		$arr[data]= $db->fetch($res[data],MYDBMS);
		return $arr[data][member_name];
		$db->closedb (MYDBMS);
	}
	 function man_($recid,$parts){
		$db = New DB();
		global $db ;
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
		$res[data] = $db->select_query("select * from ".TB_man." where manager_id='".$recid."' ",MYDBMS);
		$arr[data]= $db->fetch($res[data],MYDBMS);
		return $arr[data][manager_pname].$arr[data][manager_name]." ".$arr[data][manager_sname];
		$db->closedb (MYDBMS);
	}

} # class perSo
$dataUser=new user();