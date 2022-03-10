<?php session_start();
if(!$dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"",$depidman,$parts)){
	echo $PermisAccess;
	exit();
}
$condi="";

?>
		<img src='images/arrow-right.png'>&nbsp;<font class='f-glay-big'>จัดการข้อมูล ยี่ห้อ</font>
			<TABLE width=100% align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD>
					<?php if($dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"add",$depidman,$parts)){?>
					 &nbsp;<IMG SRC="images/record_add.gif"  BORDER="0" align="absmiddle"> <A HREF="?job=add">เพิ่มข้อมูล</A>&nbsp;&nbsp;
					 <?php }?>
					 &nbsp;<IMG SRC="images/record_list.gif"  BORDER="0" align="absmiddle"> <A HREF="?job=listdata">แสดงข้อมูล</A>
				<?php
				//////////////////////////////////////////// แสดงรายการข่าวสาร / ประชาสัมพันธ์ 
 if($job1 == "add"){
	if($save){
	//////////////////////////////////////////// กรณีเพิ่ม Database
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
			  if ($HTTP_POST_FILES['bran_logo']['tmp_name'])
			  {
				$bran_logo = $HTTP_POST_FILES['bran_logo']['name'];
				 copy($HTTP_POST_FILES['bran_logo']['tmp_name'], "./bran/bran_images/".$bran_logo);
			  }

			$db->add_db(TB_cbrand,array(
				"bran_id"=>"".$_POST[bran_id]."",
				"bran_name"=>"".$_POST[bran_name]."",
				"bran_logo"=>"".$bran_logo."",
			), MYDBMS);
			$ProcessOutput .= "<br>&nbsp;&nbsp;&nbsp;<FONT class='f-red'>*** ได้ทำการบันทึกการแก้ไขข้อมูล  เข้าสู่ระบบเรียบร้อยแล้ว</FONT>";
		$db->closedb (MYDBMS);
		echo $ProcessOutput ;
	}else if(!$save){
	//////////////////////////////////////////// กรณีเพิ่ม Form
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class='data-tb5'>
				<form method=post action="?" name="user_Form"  ENCTYPE="multipart/form-data">
				<input type='hidden' name='save' value='ok'>
				  <tr> 
                    <td align='right' width='150'>&nbsp;</font></td>
                    <td ><img src='images/services.png'>&nbsp;<font class='jobdata'><?php echo $jobdata?></font></td>
                  </tr>
				  <tr> 
                    <td align='right' width='120'><font class='sb1'>ชื่อยี่ห้อ</font>&nbsp;:&nbsp;</font></td>
                    <td ><input type='text' name='bran_name' value='<?php echo $arr[bran][bran_name]?>' size='30' class='input-text' ></td>
                  </tr>
<!-- 				  <tr> 
                    <td align='right' width='120'><font class='sb1'>สัญลักษณ์ยี่ห้อ</font>&nbsp;:&nbsp;</font></td>
                    <td ><input type='file' name='bran_logo' size='30' class='input-text' ></td>
                  </tr>
 -->				  
				  <tr>
                    <td ></td>
					<td><br>
						<input type=submit class="submit1" value=" บันทึกข้อมูล "> 
					</td>
                  </tr>	</form>
              </table>
				

	<br><br>

<?php
	$db->closedb (MYDBMS);
	} #save
}else if($job1== "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if($save){
		//ดึงค่า
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
			$bran_logo =$_POST[bran_logo_old];
			  if ($HTTP_POST_FILES['bran_logo']['tmp_name'])
			  {
				$bran_logo = $HTTP_POST_FILES['bran_logo']['name'];
				unlink("bran/bran_images/".$_POST[bran_logo_old]);
				 copy($HTTP_POST_FILES['bran_logo']['tmp_name'], "./bran/bran_images/".$bran_logo);

			  }

		//ทำการแก้ไขข้อมูลลงดาต้าเบส
		$db->update_db(TB_cbrand,array(
				"bran_name"=>"".$_POST[bran_name]."",
				"bran_logo"=>"".$bran_logo."",
			)," bran_id='".$_POST[id]."' ",MYDBMS);

			$ProcessOutput .= "<br>&nbsp;&nbsp;&nbsp;<FONT class='f-red'>*** ได้ทำการบันทึกการแก้ไขข้อมูล  เข้าสู่ระบบเรียบร้อยแล้ว</FONT>";
		$db->closedb (MYDBMS);
		echo $ProcessOutput ;
}else if(!$save){
	//////////////////////////////////////////// กรณีแก้ไข Form
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
		$res[bran] = $db->select_query("SELECT * FROM ".TB_cbrand." WHERE bran_id='".$_GET[id]."' ",MYDBMS);
		$arr[bran] = $db->fetch($res[bran],MYDBMS);

?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class='data-tb5'>
				<form method=post action="?" name="user_Form"  ENCTYPE="multipart/form-data" onsubmit='return locat_check();' >
				<input type='hidden' name='save' value='ok'>
				<input type='hidden' name='id' value='<?php echo $_GET[id]?>'>
				<input type='hidden' name='bran_logo_old' value='<?php echo $arr[bran][bran_logo]?>'>
				
				  <tr>  
                    <td align='right' width='150'>&nbsp;</font></td>
                    <td ><img src='images/services.png'>&nbsp;<font class='jobdata'><?php echo $jobdata?></font></td>
                  </tr>
				  <tr> 
                    <td align='right' width='150'>&nbsp;</font></td>
                    <td ><img src='images/services.png'>&nbsp;<font class='jobdata'><?php echo $jobdata?></font></td>
                  </tr>
				  <tr> 
                    <td align='right' width='120'><font class='sb1'>ชื่อยี่ห้อ</font>&nbsp;:&nbsp;</font></td>
                    <td ><input type='text' name='bran_name' value='<?php echo $arr[bran][bran_name]?>' size='30' class='input-text' ></td>
                  </tr>
<!-- 				  <tr> 
                    <td align='right' width='120'><font class='sb1'>สัญลักษณ์ยี่ห้อ</font>&nbsp;:&nbsp;</font></td>
                    <td ><img src='bran/bran_images/<?php echo $arr[bran][bran_logo]?>' width='80'><br><input type='file' name='bran_logo' size='30' class='input-text' ></td>
                  </tr>
 -->
				  <tr>
                    <td ></td>
					<td><br>
						<input type=submit class="submit1" value=" บันทึกข้อมูล "> 
					</td>
                  </tr>	</form>
              </table>
			<br><br>
		<?php
			$db->closedb (MYDBMS);
		 } #save
	}else if($job1 =="delt"){
		//////////////////////////////////////////// กรณีลบ Form
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
			$res[bran] = $db->select_query("SELECT bran_logo FROM ".TB_cbrand." WHERE bran_id='".$_GET[id]."' ",MYDBMS);
			$arr[bran] = $db->fetch($res[bran],MYDBMS);
			#	unlink("bran/bran_images/".$arr[bran][bran_logo]);
				$db->del(TB_cbrand," bran_id='".$_GET[id]."' ",MYDBMS); 
				$db->closedb (MYDBMS);
				$ProcessOutput .= "<br>&nbsp;&nbsp;&nbsp;<FONT class='f-red'>*** Delete Data Complete</FONT>";
			echo $ProcessOutput;
	}



	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
					$limit=$perpage = 30 ;
					$sumcount = $db->num_rows(TB_cbrand,"bran_id","",MYDBMS);
					$page=$_GET[page_c];
					$goto=0;
					$datalink="?";
					if(!$page)
					{
						$goto=0; $en=$st+$limit;
					}else{
						$po=$page*$limit;
						$goto=$po-$limit;
					}
					$bb=$goto;

				?>
		<div style="text-align:left;"><?php $dataPC->pagecheck_normal($perpage,$datalink,$page_c,30,$sumcount,$parts);?></div>
			 <table cellspacing="0" cellpadding="0" border=0 class='data-tb3'>
				  <tr height=25>
				   <td width="200" align='center' class='data-f1'><font class='title-table'>ยี่ห้อ</font></td>
<!-- 				   <td width="120" align='center' class='data-f1'><font class='title-table'>สัญลักษณ์</font></td>
 -->				   <td width="70"  class='data-f2'>&nbsp;</td>
				  </tr>  
				<?php
					$rec_num=0;
				$res[bran] = $db->select_query("SELECT * FROM ".TB_cbrand."  ORDER BY bran_name LIMIT $goto, $perpage ",MYDBMS);
				while($arr[bran] = $db->fetch($res[bran],MYDBMS)){
					$rec_num++;
				?>
					<tr <?php if($arr[bran][bran_id]==$id) echo "class='data-edit'";?>>   
						 <td  align='left' valign='top' class='data-c1'><?php echo $rec_num?>.<?php echo $arr[bran][bran_name]?></td> 
<!-- 						 <td  align='center' valign='top' class='data-c1'><img src='bran/bran_images/<?php echo $arr[bran][bran_logo]?>'></td> 
 -->  					   <td  valign='top' align='center' class='data-c3'>
						<?php if($dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"edit",$depidman,$parts)){?>
							  &nbsp;<a href="?job=edit&id=<?php echo  $arr[bran][bran_id];?>"><img src="images/record_edit.gif" border="0" title="แก้ไข" ></a> 
						<?php }?>
						<?php if($dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"delt",$depidman,$parts)){?>
							  &nbsp;<a href="?job=delt&id=<?php echo  $arr[bran][bran_id];?>" onclick="javascript:return Conf()"><img src="images/record_delete.gif"  border="0" title="ลบ" ></a>
						  <?php }?>
						  </td>
					</tr>
				<?php } #while?>
				</form>
				</table>
	&nbsp;<font class='f-red'>หมายเหตุ</font>&nbsp;&nbsp;<!-- <img src="images/record.gif" border="0" alt="แสดงรายละเอียด" align="absmiddle"> : แสดงรายละเอียด&nbsp;,&nbsp;&nbsp; --><img src="images/record_edit.gif" border="0" alt="แก้ไข" align="absmiddle"> : แก้ไขข้อมูล&nbsp;,&nbsp;&nbsp;<img src="images/record_delete.gif"  border="0" alt="ลบ" align="absmiddle"> : ลบข้อมูล&nbsp;
		</TD>
	</TR>
</TABLE>
