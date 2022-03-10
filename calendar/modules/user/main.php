<?php @session_start();
if(!$dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"",$depidman,$parts)){
	echo $PermisAccess;
	exit();
}?>

