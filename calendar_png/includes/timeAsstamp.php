<?
function format_date($timestamp,$format) {
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
?>