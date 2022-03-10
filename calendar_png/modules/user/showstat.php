<?php
	session_start();
	$yearnow=YENOW;
	if($_GET[ye]) $yearnow=$_GET[ye];
	
	$pda=$yearnow."-".MONOW."-".DANOW;
	if($_GET[da] && !$_GET[mo]) $pda=$yearnow."-".MONOW."-".$_GET[da];
	if($_GET[da] && $_GET[mo]) $pda=$yearnow."-".$_GET[mo]."-".$_GET[da];

	$pmo=$yearnow."-".MONOW;
	if($_GET[mo]){
		$pmo=$yearnow."-".$_GET[mo];
		$mox=$_GET[mo];
	}else $mox=MONOW;
	$pye=$yearnow;

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
?>
	&nbsp;&nbsp;<img src='images/arrow-right.png'>&nbsp;<font class='f-glay-big'>สถิติผู้เข้าชม</font><br><br>
		<img src='images/graph2.gif'><font class='f-blue-big'>&nbsp;สถิติหน้าที่ถูกเปิด</font>&nbsp;&nbsp;&nbsp;&nbsp;<font class='f-red-big1'>
		<?php		  
		$sql="SELECT * FROM ".TB_counthit." ";
			$res[ct] = $db->select_query($sql,MYDBMS);
			$arr[ct] = $db->fetch($res[ct],MYDBMS);
			echo number_format($arr[ct][count_hit]);
			?></font><br><br>

	<?php if((!$_GET[mo] && !$_GET[ye]) || ($_GET[mo] && $_GET[ye])){?>
	<img src='images/graph2.gif'><font class='f-blue-big'>&nbsp;สถิติวัน<?php if($_GET[da]) echo "&nbsp;ที่ ".$_GET[da]; else echo "นี้";?></font>
				  <?php
				  $c=0;
				  $sql="SELECT * FROM ".TB_counter." where sign_date like '".$pda."%' ";
					$res[std] = $db->select_query($sql,MYDBMS);
					while($arr[std] = $db->fetch($res[std],MYDBMS)){
						$herN=substr($arr[std][sign_date],11,2);
						$pd++;
						if($herN!=$herB){
							$c++;
							$pd=1;
							$statda[$c][H]=$herN;
						}
						$statda[$c][T]=$pd;
						$herB=$herN;
					}
					?>
			<table cellspacing="0" cellpadding="0" border=0 class='data-tb3'>
				  <tr height=25>
				   <td width="250" align='center' class='data-f1'><font class='title-table'>เวลา</font></td>
				   <td width="220" align='center' class='data-f2'><font class='title-table'>จำนวน</font></td>
			  </tr>  
		  <?php for($a=1;$a<=$c;$a++){?>
					<tr >   
						 <td  align='center' valign='top' class='data-c1'><?php echo $statda[$a][H].".00 น. - ".$statda[$a][H].".59 น.";?></td> 
						 <td  align='center' valign='top' class='data-c4'><?php echo number_format($statda[$a][T])?></td> 
					</tr>
					<?php
					} #for?>

				</table><br>
				<?php }?>
	<img src='images/graph2.gif'><font class='f-blue-big'>&nbsp;สถิติเดือน<?php if($_GET[mo]) echo "&nbsp;".$conDate->mon_full(($_GET[mo]*1),"th"); else echo "นี้";?></font>
				  <?php
				  $c=0;
				  $sql="SELECT * FROM ".TB_counter." where sign_date like '".$pmo."%' ";
					$res[std] = $db->select_query($sql,MYDBMS);
					while($arr[std] = $db->fetch($res[std],MYDBMS)){
						$herN=substr($arr[std][sign_date],8,2);
							$pd++;
							if($herN!=$herB){
								$c++;
								$pd=1;
								$statda[$c][H]=$herN;
							}
							$statda[$c][T]=$pd;
							$herB=$herN;

					}
					?>
			<table cellspacing="0" cellpadding="0" border=0 class='data-tb3'>
				  <tr height=25>
				   <td width="250" align='center' class='data-f1'><font class='title-table'>วันที่</font></td>
				   <td width="220" align='center' class='data-f2'><font class='title-table'>จำนวน</font></td>
			  </tr>  
		  <?php for($a=1;$a<=$c;$a++){?>
					<tr >   
						 <td  align='center' valign='top' class='data-c1'><a href='?ye=<?php echo $yearnow;?>&mo=<?php echo $mox;?>&da=<?php echo $statda[$a][H];?>'><?php echo $statda[$a][H];?></a></td> 
						 <td  align='center' valign='top' class='data-c4'><?php echo number_format($statda[$a][T])?></td> 
					</tr>
					<?php
					} #for?>

				</table><br>

					<img src='images/graph2.gif'><font class='f-blue-big'>&nbsp;สถิติปี <?php echo $yearnow?></font>
					<?php if(!$_GET[ye] || $_GET[ye]==YENOW){?>
					&nbsp;&nbsp;<a href='?ye=<?php echo $yearnow-1?>'>&nbsp;สถิติปี <?php echo $yearnow-1?></a>
					<?php }else if($_GET[ye] && $_GET[ye]<YENOW){?>
					&nbsp;&nbsp;<a href='?ye=<?php echo $yearnow+1?>'>&nbsp;สถิติปี <?php echo $yearnow+1?></a>
					<?php }?>

				  <?php
				  $c=0;
				  $sql="SELECT * FROM ".TB_counter." where sign_date like '".$pye."%' ";
					$res[std] = $db->select_query($sql,MYDBMS);
					while($arr[std] = $db->fetch($res[std],MYDBMS)){
						$herN=substr($arr[std][sign_date],5,2);
						$pd++;
						if($herN!=$herB){
							$c++;
							$pd=1;
							$statda[$c][H]=$herN;
						}
						$statda[$c][T]=$pd;
						$herB=$herN;
					}
					?>
			<table cellspacing="0" cellpadding="0" border=0 class='data-tb3'>
				  <tr height=25>
				   <td width="250" align='center' class='data-f1'><font class='title-table'>เดือน</font></td>
				   <td width="220" align='center' class='data-f2'><font class='title-table'>จำนวน</font></td>
			  </tr>  
		  <?php for($a=1;$a<=$c;$a++){?>
					<tr >   
						 <td  align='center' valign='top' class='data-c1'><a href='?ye=<?php echo $yearnow;?>&mo=<?php echo $statda[$a][H];?>'><?php echo $conDate->mon_full(($statda[$a][H]*1),"th");?></a></td> 
						 <td  align='center' valign='top' class='data-c4'><?php echo number_format($statda[$a][T])?></td> 
					</tr>
					<?php
					} #for?>

				</table><br>


