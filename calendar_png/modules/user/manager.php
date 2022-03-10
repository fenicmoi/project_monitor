<?php session_start();
if(!$dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"",$depidman,$parts) || $_SESSION['USER_PRI']!=1){
	echo $PermisAccess;
	exit();
}

$condi="";
?><img src='images/arrow-right.png'>&nbsp;<font class='f-glay-big'>จัดการข้อมูล ผู้บริหาร</font>
			<TABLE width=100% align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD>
					<?php if($dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"add",$depidman,$parts)){?>
					 &nbsp;&nbsp;&nbsp;&nbsp;<IMG SRC="images/record_add.gif"  BORDER="0" align="absmiddle"> <A HREF="?job=add">เพิ่มข้อมูล</A>&nbsp;&nbsp;
					 <?php }?>
					 &nbsp;<IMG SRC="images/record.gif"  BORDER="0" align="absmiddle"> <A HREF="?job=listdata">แสดงข้อมูล</A>
				<?php
				//////////////////////////////////////////// แสดงรายการข่าวสาร / ประชาสัมพันธ์ 
 if($_SESSION['job1'] == "add"){
	if($save){
	//////////////////////////////////////////// กรณีเพิ่ม Database
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
			$uploadedFile=$_FILES[manager_pic][tmp_name];
			$uploadedFile_type=$_FILES[manager_pic][type];
			$uploadedFile_name=$_FILES[manager_pic][name];
			if($uploadedFile_type=="image/JPG" || $uploadedFile_type=="image/jpg" || $uploadedFile_type=="image/JPEG" || $uploadedFile_type=="image/jpeg" || $uploadedFile_type=="image/pjpeg" || $uploadedFile_type=="image/pjpg"){

				  #  เปลี่ยนชื่อไฟล์
				  $file_surname=explode(".",$uploadedFile_name);
				  $manager_picname=$exportfiles=time().".".$file_surname[1];
				  $images = $uploadedFile;
				  $dataPic->resizeJPG_($images,$exportfiles,170,"managerPic/");
	 			  chmod("managerPic/".$exportfiles,0777);
			}



			$db->add_db(TB_man,array(
				"secretary_id"=>"".$_POST[secretary_id]."",
				"manager_pos"=>"".$_POST[manager_pos]."",
				"manager_pname"=>"".$_POST[manager_pname]."",
				"manager_name"=>"".$_POST[manager_name]."",
				"manager_sname"=>"".$_POST[manager_sname]."",
				"manager_pic"=>"".$manager_picname."",
			), MYDBMS);
			$ProcessOutput .= "<br>&nbsp;&nbsp;&nbsp;<FONT class='f-red'>*** ได้ทำการบันทึกข้อมูล  เข้าสู่ระบบเรียบร้อยแล้ว</FONT>";
			$ProcessOutput .= "<meta http-equiv=\"refresh\" content=\"1 ; URL='?'; charset=utf-8\">";
		$db->closedb (MYDBMS);
		echo $ProcessOutput ;
	}else if(!$save){
	//////////////////////////////////////////// กรณีเพิ่ม Form
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
?>
		<form method=post action="?" name="myForm"  ENCTYPE="multipart/form-data" onsubmit='return manager_check();' >
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class='data-tb5'>
				<input type='hidden' name='save' value='ok'>
				  <tr> 
                    <td align='right' width='150'>&nbsp;</td>
                    <td ><img src='images/services.png'>&nbsp;<font class='jobdata'><?php echo $jobdata?></font></td>
                  </tr>
				  				  

				 <tr> 
                    <td align='right' ><font class='sb1'>รูปผู้บริหาร</font>&nbsp;:&nbsp;</td>
                    <td ><input name='manager_pic' id='manager_pic' type=file title='เลือกรูป' class='input-text'  size='20'>
					</td>
                  </tr>
				 <tr> 
                    <td align='right' ><font class='sb1'>คำนำหน้าชื่อ</font>&nbsp;:&nbsp;</td>
                    <td ><input type='text' name='manager_pname' value='<?php echo $arr[man][manager_pname]?>' size='15' class='input-text' >
					
					</td>
                  </tr>
				 <tr> 
                    <td align='right' ><font class='sb1'>ชื่อ</font>&nbsp;:&nbsp;</td>
                    <td ><input type='text' name='manager_name' value='<?php echo $arr[man][manager_name]?>' size='20' class='input-text' >&nbsp;&nbsp;&nbsp;&nbsp;นามสกุล <input type='text' name='manager_sname' value='<?php echo $arr[man][manager_sname]?>' size='20' class='input-text' >
					
					</td>
                  </tr>
				 <tr> 
                    <td align='right' ><font class='sb1'>ตำแหน่ง</font>&nbsp;:&nbsp;</td>
                    <td ><select class='input-select' name='manager_pos'  >
						<option value=''>-- เลือกตำแหน่ง --</option>
						<?php 
						$res[posi] = $db->select_query("SELECT * FROM ".TB_pos." order by pos_name ",MYDBMS);
						while($arr[posi] = $db->fetch($res[posi],MYDBMS)){
							?><option value='<?php echo $arr[posi][pos_id]?>' <?php if($arr[posi][pos_id]==$arr[car][cars_pos]) echo "selected";?>><?php echo $arr[posi][pos_name]?></option><?php 
						}?></select>
					</td>
                  </tr>

				 <tr> 
                    <td align='right' ><font class='sb1'>ผู้ดูแลตารางนัดหมาย</font>&nbsp;:&nbsp;</td>
                    <td ><select class='input-select' name='secretary_id'  >
						<option value=''>-- เลือก --</option>
						<?php 
						$res[memb] = $db->select_query("SELECT * FROM ".TB_member." order by member_name ",MYDBMS);
						while($arr[memb] = $db->fetch($res[memb],MYDBMS)){
							?><option value='<?php echo $arr[memb][member_id]?>' <?php if($arr[memb][member_id]==$arr[car][cars_member]) echo "selected";?>><?php echo $arr[memb][member_name]?></option><?php 
						}?></select>
						
					</td>
                  </tr>

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
}else if($_SESSION['job1']== "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if($save){
		//ดึงค่า
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);

			$manager_picname=$_POST[old_manager_pic];

			$uploadedFile=$_FILES[manager_pic][tmp_name];
			$uploadedFile_type=$_FILES[manager_pic][type];
			$uploadedFile_name=$_FILES[manager_pic][name];
			if($uploadedFile_type=="image/JPG" || $uploadedFile_type=="image/jpg" || $uploadedFile_type=="image/JPEG" || $uploadedFile_type=="image/jpeg" || $uploadedFile_type=="image/pjpeg" || $uploadedFile_type=="image/pjpg"){
				  #  เปลี่ยนชื่อไฟล์
				  $file_surname=explode(".",$uploadedFile_name);
				  $manager_picname=$exportfiles=time().".".$file_surname[1];
				  $images = $uploadedFile;
				  $dataPic->resizeJPG_($images,$exportfiles,170,"managerPic/");
	 			  chmod("managerPic/".$exportfiles,0777);
				  if($_POST[old_manager_pic])
						unlink("managerPic/".$_POST[old_manager_pic]);
			}



			$db->update_db(TB_man,array(
				"secretary_id"=>"".$_POST[secretary_id]."",
				"manager_pos"=>"".$_POST[manager_pos]."",
				"manager_pname"=>"".$_POST[manager_pname]."",
				"manager_name"=>"".$_POST[manager_name]."",
				"manager_sname"=>"".$_POST[manager_sname]."",
				"manager_pic"=>"".$manager_picname."",
			)," manager_id='".$_POST[id]."' ",MYDBMS);
			$ProcessOutput .= "<br>&nbsp;&nbsp;&nbsp;<FONT class='f-red'>*** ได้ทำการบันทึกการแก้ไขข้อมูล  เข้าสู่ระบบเรียบร้อยแล้ว</FONT>";
		$db->closedb (MYDBMS);
		echo $ProcessOutput ;
}else if(!$save){
	//////////////////////////////////////////// กรณีแก้ไข Form
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
		$res[man] = $db->select_query("SELECT * FROM ".TB_man." WHERE manager_id='".$_GET[id]."' ",MYDBMS);
		$arr[man] = $db->fetch($res[man],MYDBMS);

?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class='data-tb5'>
				<form method=post action="?" name="user_Form"  ENCTYPE="multipart/form-data" onsubmit='return user_check();' >
				<input type='hidden' name='save' value='ok'>
				<input type='hidden' name='id' value='<?php echo $_GET[id]?>'>
				<input type='hidden' name='old_manager_pic' value='<?php echo $arr[man][manager_pic]?>'>
				  <tr>  
                    <td align='right' width='150'>&nbsp;</td>
                    <td ><img src='images/services.png'>&nbsp;<font class='jobdata'><?php echo $jobdata?></font></td>
                  </tr>
			  
				 				 <tr> 
                    <td align='right' ><font class='sb1'>รูปผู้บริหาร</font>&nbsp;:&nbsp;</td>
                    <td ><input name='manager_pic' id='manager_pic' type=file title='เลือกรูป' class='input-text'  size='20'>
					</td>
                  </tr>
				 <tr> 
                    <td align='right' ><font class='sb1'>คำนำหน้าชื่อ</font>&nbsp;:&nbsp;</td>
                    <td ><input type='text' name='manager_pname' value='<?php echo $arr[man][manager_pname]?>' size='15' class='input-text' >
					
					</td>
                  </tr>
				 <tr> 
                    <td align='right' ><font class='sb1'>ชื่อ</font>&nbsp;:&nbsp;</td>
                    <td ><input type='text' name='manager_name' value='<?php echo $arr[man][manager_name]?>' size='20' class='input-text' >&nbsp;&nbsp;&nbsp;&nbsp;นามสกุล <input type='text' name='manager_sname' value='<?php echo $arr[man][manager_sname]?>' size='20' class='input-text' >
					
					</td>
                  </tr>
				 <tr> 
                    <td align='right' ><font class='sb1'>ตำแหน่ง</font>&nbsp;:&nbsp;</td>
                    <td ><select class='input-select' name='manager_pos'  >
						<option value=''>-- เลือกตำแหน่ง --</option>
						<?php 
						$res[posi] = $db->select_query("SELECT * FROM ".TB_pos." order by pos_name ",MYDBMS);
						while($arr[posi] = $db->fetch($res[posi],MYDBMS)){
							?><option value='<?php echo $arr[posi][pos_id]?>' <?php if($arr[posi][pos_id]==$arr[man][manager_pos]) echo "selected";?>><?php echo $arr[posi][pos_name]?></option><?php 
						}?></select>
					</td>
                  </tr>

				 <tr> 
                    <td align='right' ><font class='sb1'>ผู้ดูแลตารางนัดหมาย</font>&nbsp;:&nbsp;</td>
                    <td ><select class='input-select' name='secretary_id'  >
						<option value=''>-- เลือก --</option>
						<?php 
						$res[memb] = $db->select_query("SELECT * FROM ".TB_member." order by member_name ",MYDBMS);
						while($arr[memb] = $db->fetch($res[memb],MYDBMS)){
							?><option value='<?php echo $arr[memb][member_id]?>' <?php if($arr[memb][member_id]==$arr[man][secretary_id]) echo "selected";?>><?php echo $arr[memb][member_name]?></option><?php 
						}?></select>
						
					</td>
                  </tr>

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
	}else if($_SESSION['job1'] =="delt"){
		//////////////////////////////////////////// กรณีลบ Form
			
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);

			$res[man] = $db->select_query("SELECT manager_pic FROM ".TB_man." WHERE manager_id='".$_GET[id]."' ",MYDBMS);
			$arr[man] = $db->fetch($res[man],MYDBMS);
			if($arr[man][manager_pic])
				unlink("managerPic/".$arr[man][manager_pic]);

			$db->del(TB_calendar," manager_id='".$_GET[id]."' ",MYDBMS); 
			$db->del(TB_man," manager_id='".$_GET[id]."' ",MYDBMS); 
			$db->closedb (MYDBMS);
			$ProcessOutput .= "<br>&nbsp;&nbsp;&nbsp;<FONT class='f-red'>*** ได้ทำการลบข้อมูล เรียบร้อยแล้ว</FONT>";
			echo $ProcessOutput;
	}



	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
					$limit=$perpage = 20 ;
					$sumcount = $db->num_rows(TB_man,"manager_id","$condi",MYDBMS);
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
				   <td width="30" align='center' class='data-f1'>&nbsp;</td>
				   <td width="100" align='center' class='data-f1'><font class='title-table'>รูปผู้บริหาร</font></td>
				   <td width="300" align='center' class='data-f1'><font class='title-table'>ข้อมูลผู้บริหาร</font></td>
				   <td width="160" align='center' class='data-f1'><font class='title-table'>ผู้ดูแลตารางนัดหมาย</font></td>
				   <td width="70"  class='data-f2'>&nbsp;</td>
				  </tr>  
				<?php
					$rec_num=0;
				$res[man] = $db->select_query("SELECT * FROM ".TB_man." $condi1 ORDER BY manager_id LIMIT $goto, $perpage ",MYDBMS);
				while($arr[man] = $db->fetch($res[man],MYDBMS)){
					$rec_num++;
				?>
					<tr <?php if($arr[man][manager_id]==$id) echo "class='data-edit'";?>>   
						 <td  align='center' class='data-c1'><?php echo $rec_num?></td> 
						 <td  align='center' valign='top' class='data-c1'><?php if($arr[man][manager_pic]) echo "<img src='managerPic/".$arr[man][manager_pic]."' width='90'>"; else echo "&nbsp;";?></td>

						 <td  align='left' valign='top' class='data-c1'>
						 <?php echo $arr[man][manager_pname]?><?php echo $arr[man][manager_name]?> <?php echo $arr[man][manager_sname]?><br>ตำแหน่ง : <?php echo $dataOth->pos_($arr[man][manager_pos],$parts);?></td> 
						 <td  align='left' valign='top' class='data-c1'><?php echo $dataUser->member_($arr[man][secretary_id],$parts);?></td> 
  					   <td  valign='top' align='center' class='data-c3'>
						<?php if($dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"edit",$depidman,$parts)){?>
							  &nbsp;<a href="?job=edit&id=<?php echo  $arr[man][manager_id];?>"><img src="images/record_edit.gif" border="0" title="แก้ไข" ></a> 
						<?php }?>
						<?php if($dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"delt",$depidman,$parts)){?>
							  &nbsp;<a href="?job=delt&id=<?php echo  $arr[man][manager_id];?>" onclick="javascript:return Conf('<?php echo $arr[man][manager_pname]?><?php echo $arr[man][manager_name]?> <?php echo $arr[man][manager_sname]?>')"><img src="images/record_delete.gif"  border="0" title="ลบ" ></a>
						  <?php }?>
						  </td>
					</tr>
				<?php } #while?>
				</form>
				</table>
	&nbsp;<font class='f-red'>หมายเหตุ</font>&nbsp;&nbsp;<!-- <img src="images/record.gif" border="0" alt="แสดงรายละเอียด" align="absmiddle"> : แสดงรายละเอียด&nbsp;,&nbsp;&nbsp; --><img src="images/record_edit.gif" border="0" alt="แก้ไข" align="absmiddle"> : แก้ไขข้อมูล&nbsp;,&nbsp;&nbsp;<img src="images/record_delete.gif"  border="0" alt="ลบ" align="absmiddle"> : ลบข้อมูล&nbsp;

<?php		
	$db->closedb (MYDBMS);
	?>
		</TD>
	</TR>
</TABLE>
