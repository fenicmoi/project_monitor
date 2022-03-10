<?
include "chksession.php" ;
include "function.php" ;
?>
<?
$id = $_GET ['id'] ;

include "connect.php" ;
$sql = "SELECT *  from $tablenewbooks2 where id='$id' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array ($result) ;
		$nview = $r [nview] ;

		$nview = $nview+1 ;

//echo"$nview" ;
//exit();
		$sql2 = "UPDATE $tablenewbooks2 set nview='$nview' where id='$id' " ;
		mysql_db_query ($dbname, $sql2) ;
		mysql_close() ;

		header ("Location:bookview2.php?id=$id") ;
?>