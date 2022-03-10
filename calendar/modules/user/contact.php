<?php session_start();
if(!$dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"",$depidman,$parts)){
	echo $PermisAccess;
	exit();
}
$condi="";
?><br>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
			<TABLE width=100% align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD>&nbsp;&nbsp;<img src='images/arrow-right.png'>&nbsp;<font class='f-glay-big'>แก้ไขข้อมูลหน้า Contact</font><br>
				<?php
				//////////////////////////////////////////// แสดงรายการข่าวสาร / ประชาสัมพันธ์ 
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if($_POST[save]){
		$tent_pic=$_POST[old_tent_pic];
		if($_FILES[tent_pic][tmp_name]){
			$uploadedFile=$_FILES[tent_pic][tmp_name];
			$uploadedFile_type=$_FILES[tent_pic][type];
			if($uploadedFile_type=="image/JPG" || $uploadedFile_type=="image/jpg" || $uploadedFile_type=="image/JPEG" || $uploadedFile_type=="image/jpeg" || $uploadedFile_type=="image/pjpeg" || $uploadedFile_type=="image/pjpg"){
				unlink("contact/".$_POST[old_tent_pic]);
				copy($uploadedFile,"contact/".$_FILES[tent_pic][name]);
				chmod("contact/".$_FILES[tent_pic][name],0777);
				$tent_pic=$_FILES[tent_pic][name];
			}
		}
		$tent_map=$_POST[old_tent_map];
		if($_FILES[tent_map][tmp_name]){
			$uploadedFile=$_FILES[tent_map][tmp_name];
			$uploadedFile_type=$_FILES[tent_map][type];
			if($uploadedFile_type=="image/JPG" || $uploadedFile_type=="image/jpg" || $uploadedFile_type=="image/JPEG" || $uploadedFile_type=="image/jpeg" || $uploadedFile_type=="image/pjpeg" || $uploadedFile_type=="image/pjpg"){
				unlink("contact/".$_POST[old_tent_map]);
				copy($uploadedFile,"contact/".$_FILES[tent_map][name]);
				chmod("contact/".$_FILES[tent_map][name],0777);
				$tent_map=$_FILES[tent_map][name];
			}
		}
		$db->update_db(TB_about,array(
				"tent_pic"=>"".$tent_pic."",
				"tent_map"=>"".$tent_map."",
			)," id='1' ",MYDBMS);

		$Filename = "contact.txt";
		$txt_name = "contact/".$Filename."";
		$txt_open = @fopen("$txt_name", "w");
		@fwrite($txt_open, "".$_POST[service]."");
		@fclose($txt_open);
		chmod("contact/".$Filename,0777);
		echo "<br>";
		echo UpdateComp1;
		echo "<meta http-equiv=\"refresh\" content=\"1 ; URL='?'; charset=utf-8\">";

	}else if(!$_POST[save]){
	//////////////////////////////////////////// กรณีเพิ่ม Form
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
			if(!$dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"add",$depidman,$parts)){
				echo $PermisAccess;
				exit();
			}
			$res[ab] = $db->select_query("SELECT * FROM ".TB_about." ",MYDBMS);
			$arr[ab] = $db->fetch($res[ab],MYDBMS);


			//อ่านค่าจากไฟล์ Text เพื่อแก้ไข
			$FileNewsTopic = "contact/contact.txt";
			$file_open = @fopen($FileNewsTopic, "r");
			$TextContent = @fread ($file_open, @filesize($FileNewsTopic));
			@fclose ($file_open);

			$TextContent = stripslashes($TextContent);

			?>

		<script type="text/javascript">
			window.onload = function()
			{
				CKEDITOR.replace( 'service' );
			};
		</script>
		<form method=post action="?" name="web_Form"  ENCTYPE="multipart/form-data" onsubmit='return car_check();' >
		<input type='hidden' name='save' value='ok'>
		<input type='hidden' name='old_tent_pic' value='<?php echo $arr[ab][tent_pic]?>'>
		<input type='hidden' name='old_tent_map' value='<?php echo $arr[ab][tent_map]?>'>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class='data-tb5'>
				<tr> 
                    <td colspan=2><textarea id="editor1" name="service"><?php echo $TextContent?></textarea>
					<script type="text/javascript">
							CKEDITOR.replace( 'service',
							{
								toolbar :
								[
									['Styles', 'Format','Font','FontSize'],
									['Bold', 'Italic','Underline','TextColor','BGColor', 'NumberedList', 'BulletedList','JustifyLeft','JustifyCenter','JustifyRight', '-', 'Link', '-','Image', 'About']
								]
							});
					</script>
					</td>
                  </tr>		
							<tr ><td valign=top align='right'>ภาพเต็นท์&nbsp;:&nbsp;</td>
							<td><?php if($arr[ab][tent_pic]){?><a href='contact/<?php echo $arr[ab][tent_pic]?>' target=_blank> รูปเดิม</a>&nbsp;&nbsp;<?php }?><input name='tent_pic' type=file class='input-text'  size='50' ></td>
							</tr>
							<tr ><td valign=top align='right'>ภาพแผนที่&nbsp;:&nbsp;</td>
							<td><?php if($arr[ab][tent_map]){?><a href='contact/<?php echo $arr[ab][tent_map]?>' target=_blank> รูปเดิม</a>&nbsp;&nbsp;<?php }?><input name='tent_map' type=file class='input-text'  size='50' ></td>
							</tr>
				  <tr>
                    <td ></td>
					<td><br>
						<input type=submit class="submit1" value=" บันทึกข้อมูล "> 
					</td>
                  </tr>	
              </table>	</form>
	<?php
		$db->closedb (MYDBMS);
		} #save
	?>
		</TD>
	</TR>
</TABLE>
