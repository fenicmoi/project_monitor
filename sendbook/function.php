<?
function displaydate ($x) {
	$thai_m = array ("���Ҥ�", "����Ҿѹ��", "�չҤ�", "����¹", "����Ҥ�", "�Զع�¹", "�á�Ҥ�", "�ԧ�Ҥ�", "�ѹ��¹", "���Ҥ�", "��Ȩԡ�¹", "�ѹ�Ҥ�") ;
	$date_array = explode ("-", $x) ;
$y = $date_array [0] ;
$m = $date_array [1] -1 ;
$d = $date_array [2] ;

$m = $thai_m [$m] ;
$y = $y + 543 ;

$displaydate = "$d $m $y" ;
return $displaydate ;

}

function checkemail ($checkemail) {
	if (ereg(   "^[^\.\$_\'\"<>].+[^\.\$_\'\"|[:space:]<>]@[^\.\$_\'\"|[:space:]<>].+\..+[^\.\$_\'\"<>]$", $checkemail) ) {
		return true ;
	}	else {
		return false ;
	}
}

?>