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

<?php
 if($job1== "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if($save){
		//ดึงค่า
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
		//ทำการแก้ไขข้อมูลลงดาต้าเบส
		if($_POST[password]) $password=md5($_POST[password]); else $password=$_POST[Pass_Old];

		if($_SESSION['USER_LOGIN_TYPE']=="hotel"){
			$db->update_db(TB_hotel,array(
						"username"=>"".$_POST[username]."",
						"password"=>"".$password."",
			)," id='".$_SESSION['USER_LOGIN']."' ",MYDBMS);
		}else if($_SESSION['USER_LOGIN_TYPE']=="user"){
			$db->update_db(TB_user,array(
						"name"=>"".$_POST[username]."",
						"password"=>"".$password."",
			)," id='".$_SESSION['USER_LOGIN']."' ",MYDBMS);
		}
	$db->closedb (MYDBMS);


		echo UpdateComp1;
		echo "<meta http-equiv=\"refresh\" content=\"1 ; URL='?modules=index'; charset=utf-8\">";
}else if(!$save){
	//////////////////////////////////////////// กรณีแก้ไข Form
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
		if($_SESSION['USER_LOGIN_TYPE']=="hotel"){
			$res[hotel] = $db->select_query("SELECT id,username,password  FROM ".TB_hotel." WHERE id='".$_SESSION['USER_LOGIN']."' ",MYDBMS);
			$arr[hotel] = $db->fetch($res[hotel],MYDBMS);
			$username=$arr[hotel][username];
			$old_password=$arr[hotel][password];
		}else if($_SESSION['USER_LOGIN_TYPE']=="user"){
			$res[user] = $db->select_query("SELECT id,name,password FROM ".TB_user." WHERE id='".$_SESSION['USER_LOGIN']."' ",MYDBMS);
			$arr[user] = $db->fetch($res[user],MYDBMS);
			$username=$arr[user][name];
			$old_password=$arr[user][password];
	}
				//อ่านค่าจากไฟล์ Text เพื่อแก้ไข
?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class='data-tb5'>
				<form method=post action="?" name="web_Form"  ENCTYPE="multipart/form-data" onsubmit='return editlogin_check();' >
				<input type='hidden' name='save' value='ok'>
				<input type='hidden' name='id' value='<?php echo $_GET[id]?>'>
				<input type='hidden' name='Pass_Old' value='<?php echo $old_password?>'>
				  <tr> 
                    <td align='right' width='150'>&nbsp;</font></td>
                    <td ><img src='images/services.png'>&nbsp;<font class='jobdata'><?php echo $jobdata?></font></td>
                  </tr>
				  <tr> 
                    <td align='right' width='120'><font class='sb1'>Login Name</font>&nbsp;:&nbsp;</font></td>
                    <td ><input type='text' name='username' value='<?php echo $username?>' size='10' class='input-text' onkeypress='return CheckEng()'></td>
                  </tr>
				  <tr> 
                    <td align='right' width='120'><font class='sb1'>Password</font>&nbsp;:&nbsp;</font></td>
                    <td ><input type='password' name='password' size='12' class='input-text' onkeypress='return CheckEng()'> [ Old Password Encoding Fill New Password ] </td>
                  </tr>
				  <tr> 
                    <td align='right' width='120'><font class='sb1'>Confirm Password</font>&nbsp;:&nbsp;</font></td>
                    <td ><input type='password' name='ConfirmPass' size='12' class='input-text' onkeypress='return CheckEng()'></td>
                  </tr>
				  <tr>
                    <td ></td>
					<td><br>
						<input type=submit class="submit1" value=" Update Data "> 
					</td>
                  </tr>	</form>
              </table>
			<br><br>
		<?php
			$db->closedb (MYDBMS);
		 } #save
	}
	?>
		</TD>
	</TR>
</TABLE>
