<?
$host="localhost";
$dbuser="phatthalun_sbook";
$dbpassword="qrCvVl8L";
$dbname= "phatthalun_sendbooks";

$tablenewbooks = "newbooks" ;
$tableanswer = "answers" ;
$tableuser = "user" ;

$tablenewbooksfromschool = "bookfromschool" ;
//////
$tablenewbooks2 = "newbooks2" ;
$tablenewbooksfromschool2 = "bookfromschool2" ;
$tableanswer2 = "answers2" ;
#######
$ontblname = "user_online";

mysql_connect( $host,$dbuser,$dbpassword) or die ("�Դ��͡Ѻ�ҹ������ Mysql ����� ");
mysql_select_db($dbname) or die("���͡�ҹ�����������"); 
mysql_query("SET NAMES tis620");

?>
