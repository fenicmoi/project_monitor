<?php session_start();
include "../../library/database.php";
if(!$dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"",$depidman,$parts) && $_SESSION['USER_PRI']==1){
	echo $PermisAccess;
	exit();
}
$condi="";
?><img src='images/arrow-right.png'>&nbsp;<font class='f-glay-big'>จัดการข้อมูลผู้ใช้งาน</font>
			<TABLE width=100% align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD>
					<?php if($dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"add",$depidman,$parts)){?>
					 &nbsp;<IMG SRC="images/record_add.gif"  BORDER="0" align="absmiddle"> <A HREF="?job=add">เพิ่มข้อมูล</A>&nbsp;&nbsp;
					 <?php }?>
					 &nbsp;<IMG SRC="images/record_list.gif"  BORDER="0" align="absmiddle"> <A HREF="?job=listdata">แสดงข้อมูล</A>
				<?php

 if($job1 == "add"){

	if(isset($_POST['save'])){   //กรณีเพิ่ม Database
		echo "yes";
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
			$db->add_db(TB_member,array(
				"member_name"=>"".$_POST[member_name]."",
				"member_loginname"=>"".$_POST[member_loginname]."",
				"member_password"=>"".md5($_POST[member_password])."",
				"member_pri"=>"2",
			), MYDBMS);
			$ProcessOutput .= "<br>&nbsp;&nbsp;&nbsp;<FONT class='f-red'>*** ได้ทำการบันทึกข้อมูล  เข้าสู่ระบบเรียบร้อยแล้ว</FONT>";
		$db->closedb (MYDBMS);
		echo $ProcessOutput ;
	}else if(!isset($_POST['save'])){  // กรณีเพิ่ม Form
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
?>
				<form method=post action="?" name="user_Form"  ENCTYPE="multipart/form-data" onsubmit='return user_check();' >
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class='data-tb5'>
				<input type='hidden' name='save' id="save" value='ok'>
				  <tr> 
                    <td align='right' width='150'>&nbsp;</font></td>
                    <td ><img src='images/services.png'>&nbsp;<font class='jobdata'><?php echo $jobdata?></font></td>
                  </tr>
				  
				 <tr> 
                    <td align='right' width='120'><font class='sb1'>ชื่อผู้ใช้งานระบบ</font>&nbsp;:&nbsp;</font></td>
                    <td ><input type='text' name='member_name' value='<?php echo $arr[mem][member_name]?>' size='20' class='input-text' >
					
					</td>
                  </tr>
				  <tr> 
                    <td align='right' width='120'><font class='sb1'>ชื่อเข้าใช้งานระบบ</font>&nbsp;:&nbsp;</font></td>
                    <td ><input type='text' name='member_loginname' value='<?php echo $arr[teach][member_loginname]?>' size='10' class='input-text' onkeypress='return CheckEng(this.value)'></td>
                  </tr>
				  <tr> 
                    <td align='right' width='120'><font class='sb1'>รหัสผ่าน</font>&nbsp;:&nbsp;</font></td>
                    <td ><input type='password' name='member_password' value='<?php echo $arr[teach][user_cong]?>' size='12' class='input-text' onkeypress='return CheckEng(this.value)'></td>
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
	if(isset($_POST['save'])){
		//ดึงค่า
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
		if($_POST[member_password]) $member_password=md5($_POST[member_password]); else  $member_password=$old_member_password;

		//ทำการแก้ไขข้อมูลลงดาต้าเบส
		$db->update_db(TB_member,array(
				"member_name"=>"".$_POST[member_name]."",
				"member_loginname"=>"".$_POST[member_loginname]."",
				"member_password"=>"".$member_password."",
				"member_pri"=>"".$_POST[member_pri]."",
			)," member_id='".$_POST[id]."' ",MYDBMS);

			$ProcessOutput .= "<br>&nbsp;&nbsp;&nbsp;<FONT class='f-red'>*** ได้ทำการบันทึกการแก้ไขข้อมูล  เข้าสู่ระบบเรียบร้อยแล้ว</FONT>";
		$db->closedb (MYDBMS);
		echo $ProcessOutput ;
}else if(!isset($_POST['save'])){
	//////////////////////////////////////////// กรณีแก้ไข Form
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
		$res[mem] = $db->select_query("SELECT * FROM ".TB_member." WHERE member_id='".$_GET[id]."' ",MYDBMS);
		$arr[mem] = $db->fetch($res[mem],MYDBMS);

?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class='data-tb5'>
				<form method=post action="?" name="user_Form"  ENCTYPE="multipart/form-data" onsubmit='return user_check();' >
				<input type='hidden' name='save' value='ok'>
				<input type='hidden' name='id' value='<?php echo $_GET[id]?>'>
				<input type='hidden' name='old_member_password' value='<?php echo $arr[mem][member_password]?>'>
				<input type='hidden' name='member_pri' value='<?php echo $arr[mem][member_pri]?>'>
				  <tr>  
                    <td align='right' width='150'>&nbsp;</font></td>
                    <td ><img src='images/services.png'>&nbsp;<font class='jobdata'><?php echo $jobdata?></font></td>
                  </tr>
									  <tr> 
				  
				 <tr> 
                    <td align='right' width='120'><font class='sb1'>ชื่อผู้ใช้งานระบบ</font>&nbsp;:&nbsp;</font></td>
                    <td ><input type='text' name='member_name' value='<?php echo $arr[mem][member_name]?>' size='20' class='input-text' >
					
					</td>
                  </tr>
				  <tr> 
                    <td align='right' width='120'><font class='sb1'>ชื่อเข้าใช้งานระบบ</font>&nbsp;:&nbsp;</font></td>
                    <td ><input type='text' name='member_loginname' value='<?php echo $arr[mem][member_loginname]?>' size='10' class='input-text' onkeypress='return CheckEng(this.value)'></td>
                  </tr>
				  <tr> 
                    <td align='right' width='120'><font class='sb1'>รหัสผ่าน</font>&nbsp;:&nbsp;</font></td>
                    <td ><input type='password' name='member_password' value='' size='12' class='input-text' onkeypress='return CheckEng(this.value)'></td>
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
			$db->del(TB_member," member_id='".$_GET[id]."' ",MYDBMS); 
			$db->closedb (MYDBMS);
			$ProcessOutput .= "<br>&nbsp;&nbsp;&nbsp;<FONT class='f-red'>*** ได้ทำการลบข้อมูล เรียบร้อยแล้ว</FONT>";
			echo $ProcessOutput;
	}



	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
					$limit=$perpage = 10 ;
					$sumcount = $db->num_rows(TB_member,"member_id","$condi",MYDBMS);
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
				   <td width="300" align='center' class='data-f1'><font class='title-table'>ชื่อผู้ใช้งานระบบ</font></td>
				   <td width="250" align='center' class='data-f1'><font class='title-table'>ชื่อเข้าใช้งาน</font></td>
				   <td width="70"  class='data-f2'>&nbsp;</td>
				  </tr>  
				<?php
					$rec_num=0;
				$res[mem] = $db->select_query("SELECT * FROM ".TB_member." $condi1 ORDER BY member_id DESC LIMIT $goto, $perpage ",MYDBMS);
				while($arr[mem] = $db->fetch($res[mem],MYDBMS)){
					$rec_num++;
				?>
					<tr <?php if($arr[mem][member_id]==$id) echo "class='data-edit'";?>>   
						 <td  align='left' valign='top' class='data-c1'><?php echo $rec_num?>.<?php echo $arr[mem][member_name]?></td> 
						 <td  align='left' valign='top' class='data-c1'><?php echo $arr[mem][member_loginname]?></td> 
  					   <td  valign='top' align='center' class='data-c3'>
						<?php if($dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"edit",$depidman,$parts)){?>
							  &nbsp;<a href="?job=edit&id=<?php echo  $arr[mem][member_id];?>"><img src="images/record_edit.gif" border="0" title="แก้ไข" ></a> 
						<?php }?>
						<?php if($dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"delt",$depidman,$parts)){?>
							  &nbsp;<a href="?job=delt&id=<?php echo  $arr[mem][member_id];?>" onclick="javascript:return Conf()"><img src="images/record_delete.gif"  border="0" title="ลบ" ></a>
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
