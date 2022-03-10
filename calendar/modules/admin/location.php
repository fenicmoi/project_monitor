<?php session_start();
if(!$dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"",$depidman,$parts)){
	echo $PermisAccess;
	exit();
}
$condi="";

?>
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
			$db->add_db(TB_locat,array(
				"city_id"=>"".$_POST[city_id]."",
				"name"=>"".$_POST[location_name]."",
			), MYDBMS);
			$ProcessOutput .= "<br>&nbsp;&nbsp;&nbsp;<FONT class='f-red'>*** ได้ทำการบันทึกการแก้ไขข้อมูล  เข้าสู่ระบบเรียบร้อยแล้ว</FONT>";
		$db->closedb (MYDBMS);
		echo $ProcessOutput ;
	}else if(!$save){
	//////////////////////////////////////////// กรณีเพิ่ม Form
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class='data-tb5'>
				<form method=post action="?" name="user_Form"  ENCTYPE="multipart/form-data" onsubmit='return user_check();' >
				<input type='hidden' name='save' value='ok'>
				  <tr> 
                    <td align='right' width='150'>&nbsp;</font></td>
                    <td ><img src='images/services.png'>&nbsp;<font class='jobdata'><?php echo $jobdata?></font></td>
                  </tr>
				  <tr> 
                    <td align='right' width='120'><font class='sb1'>City</font>&nbsp;:&nbsp;</font></td>
                    <td ><select name='city_id' class='input-select'>
					<option value=''>-- Select City --</option>
					<?php
						$res = $db->select_query("select * from ".TB_city." order by city_name_eng",MYDBMS);
						while($arr = $db->fetch($res,MYDBMS)){
							?><option value='<?php echo $arr[city_id]?>' <?php if($arr[loc][city_id]){ if($arr[city_id]==$arr[loc][city_id]) echo "selected"; }?>><?php echo $arr[city_name_eng]?></option><?
						}?></select></td>
                  </tr>
				  <tr> 
                    <td align='right' width='120'><font class='sb1'>Location</font>&nbsp;:&nbsp;</font></td>
                    <td ><input type='text' name='location_name' value='<?php echo $arr[loc][name]?>' size='30' class='input-text' ></td>
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
}else if($job1== "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if($save){
		//ดึงค่า
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
		//ทำการแก้ไขข้อมูลลงดาต้าเบส
		$db->update_db(TB_locat,array(
				"city_id"=>"".$_POST[city_id]."",
				"name"=>"".$_POST[location_name]."",
			)," id='".$_POST[id]."' ",MYDBMS);

			$ProcessOutput .= "<br>&nbsp;&nbsp;&nbsp;<FONT class='f-red'>*** ได้ทำการบันทึกการแก้ไขข้อมูล  เข้าสู่ระบบเรียบร้อยแล้ว</FONT>";
		$db->closedb (MYDBMS);
		echo $ProcessOutput ;
}else if(!$save){
	//////////////////////////////////////////// กรณีแก้ไข Form
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
		$res[loc] = $db->select_query("SELECT * FROM ".TB_locat." WHERE id='".$_GET[id]."' ",MYDBMS);
		$arr[loc] = $db->fetch($res[loc],MYDBMS);

?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class='data-tb5'>
				<form method=post action="?" name="user_Form"  ENCTYPE="multipart/form-data" onsubmit='return locat_check();' >
				<input type='hidden' name='save' value='ok'>
				<input type='hidden' name='id' value='<?php echo $_GET[id]?>'>
				  <tr>  
                    <td align='right' width='150'>&nbsp;</font></td>
                    <td ><img src='images/services.png'>&nbsp;<font class='jobdata'><?php echo $jobdata?></font></td>
                  </tr>
				  <tr> 
                    <td align='right' width='120'><font class='sb1'>City</font>&nbsp;:&nbsp;</font></td>
                    <td ><select name='city_id' class='input-select'>
					<option value=''>-- Select City --</option>
					<?php
						$res[city] = $db->select_query("select * from ".TB_city." order by city_name_eng",MYDBMS);
						while($arr[city] = $db->fetch($res[city],MYDBMS)){
							?><option value='<?php echo $arr[city][city_id]?>' <?php if($arr[loc][city_id]){ if($arr[city][city_id]==$arr[loc][city_id]) echo "selected"; }?>><?php echo $arr[city][city_name_eng]?></option><?
						}?></select></td>
                  </tr>
				  <tr> 
                    <td align='right' width='120'><font class='sb1'>Location</font>&nbsp;:&nbsp;</font></td>
                    <td ><input type='text' name='location_name' value='<?php echo $arr[loc][name]?>' size='30' class='input-text' ></td>
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
	}else if($job1 =="delt"){
		//////////////////////////////////////////// กรณีลบ Form
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
			$res[loc] = $db->select_query("SELECT location FROM ".TB_hotel." WHERE location='".$_GET[id]."' ",MYDBMS);
			if($db->rows1($res[loc],MYDBMS)==0){
				$db->del(TB_locat," id='".$_GET[id]."' ",MYDBMS); 
				$db->closedb (MYDBMS);
				$ProcessOutput .= "<br>&nbsp;&nbsp;&nbsp;<FONT class='f-red'>*** Delete Data Complete</FONT>";
			}else $ProcessOutput .= "<br>&nbsp;&nbsp;&nbsp;<FONT class='f-red'>*** Can't Delete Data </FONT>";

			echo $ProcessOutput;
	}



	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
					$limit=$perpage = 30 ;
					$sumcount = $db->num_rows(TB_locat,"id","",MYDBMS);
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
				   <td width="250" align='center' class='data-f1'><font class='title-table'>Location</font></td>
				   <td width="300" align='center' class='data-f1'><font class='title-table'>City</font></td>
				   <td width="70"  class='data-f2'>&nbsp;</td>
				  </tr>  
				<?php
					$rec_num=0;
				$res = $db->select_query("SELECT * FROM ".TB_locat."  ORDER BY name LIMIT $goto, $perpage ",MYDBMS);
				while($arr = $db->fetch($res,MYDBMS)){
					$rec_num++;
				?>
					<tr <?php if($arr[id]==$id) echo "class='data-edit'";?>>   
						 <td  align='left' valign='top' class='data-c1'><?php echo $rec_num?>.<?php echo $arr[name]?></td> 
						 <td  align='left' valign='top' class='data-c1'><?php echo $dataOth->city_($arr[city_id],$parts)?></td> 
  					   <td  valign='top' align='center' class='data-c3'>
						<?php if($dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"edit",$depidman,$parts)){?>
							  &nbsp;<a href="?job=edit&id=<?php echo  $arr[id];?>"><img src="images/record_edit.gif" border="0" title="แก้ไข" ></a> 
						<?php }?>
						<?php if($dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"delt",$depidman,$parts)){?>
							  &nbsp;<a href="?job=delt&id=<?php echo  $arr[id];?>" onclick="javascript:return Conf()"><img src="images/record_delete.gif"  border="0" title="ลบ" ></a>
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
