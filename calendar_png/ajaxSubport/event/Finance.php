<?php session_start();
  header( "Expires: Sat, 1 Jan 2005 00:00:00 GMT" );
  header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" );
  header( "Cache-Control: no-cache, must-revalidate" );
  header( "Pragma: no-cache" );
  header( "content-type: application/x-javascript; charset=UTF-8" );
#echo print_r($_POST);
		$insyear=0;
		$priceball=0;
		$totalins=0;
		$totalprice=0;
		$pricepremonth=0;
		$sumvat=0;
		$Car_price=$_POST[Car_price];  
		$Down_price=$_POST[Down_price];  
		$Interest=$_POST[Interest];  
		$instalments=$_POST[instalments];  


	if($Car_price && $Interest && $instalments){
		$priceball=$Car_price-$Down_price;

		$insyear=$instalments/12;
		$Intyear= ($insyear*$Interest)/100;
		$totalins=($priceball*$Intyear);

		$totalprice=$totalins+$priceball;
		$pricepremonth=$totalprice/$instalments;
		$sumvat=$pricepremonth*.07;
		?>
		<b>- ค่ารถ หัก เงินดาวน์</b> <br>
		&nbsp;&nbsp;<?php echo number_format($Car_price,2);?> - <?php if($Down_price>0) echo number_format($Down_price,2); else echo "0";?><br>&nbsp;&nbsp;= <font color='red'><b><?php echo number_format(($Car_price-$Down_price),2);?></b></font><br><br>
		<b>- ดอกเบี้ยต่อปี	</b><br>
		&nbsp;&nbsp;<?php echo number_format($Interest,2);?> (<?php echo number_format($insyear,2);?> ปี)<br>&nbsp;&nbsp;= <font color='red'><b><?php echo number_format($totalins,2);?></b></font><br>
		&nbsp;&nbsp;<?php echo number_format($priceball,2);?> + <?php echo number_format($totalins,2);?><br>&nbsp;&nbsp;= <font color='red'><b><?php echo number_format($totalprice,2);?></b></font><br><br>
		<b>- ค่างวด กับ ดอกเบี๊ย 7%</b><br>
		&nbsp;&nbsp;<?php echo number_format($totalprice,2);?> / <?php echo number_format($instalments);?> งวด<br>&nbsp;&nbsp;= <font color='red'><b><?php echo number_format($pricepremonth,2);?></b></font> + <font color='red'><b><?php echo number_format($sumvat,2);?></font><br><br>
		&nbsp;&nbsp;สุทธิ&nbsp;&nbsp;<font class='f-red-big'><b><?php echo number_format($sumvat+$pricepremonth,2);?></font></b></font> บ.<br><br>

<?php 
}else echo "<font class='f-red'><b>กรุณากรอกข้อมูลให้ครบ...!</font>";?>