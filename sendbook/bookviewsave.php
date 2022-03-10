<?
include "chksession.php" ;
include "function.php" ;
?>
<?
$id = $_GET ['id'] ;

include "connect.php" ;
$sql = "SELECT *  from $tablenewbooks where id='$id' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array ($result) ;
		$nview = $r [nview] ;

		$nview = $nview+1 ;

//echo"$nview" ;
//exit();
		$sql2 = "UPDATE $tablenewbooks set nview='$nview' where id='$id' " ;
		mysql_db_query ($dbname, $sql2) ;
		mysql_close() ;

		header ("Location:bookview.php?id=$id") ;
?>