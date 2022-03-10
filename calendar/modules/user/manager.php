<script src="https://use.fontawesome.com/7163b9b28b.js"></script>
<?php
include "../../library/database.php";
 session_start();
if(!$dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"",$depidman,$parts) || $_SESSION['USER_PRI']!=1){
	echo $PermisAccess;
	exit();
}

$condi="";
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"><h4>จัดการข้อมูลผู้บริหาร</h4></div>
					<div class="panel-body">
						<p>
							<?php if($dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"add",$depidman,$parts)){?>
						      	<a class="btn btn-success" href="?job=add"><i class="fa fa-user-plus"></i> เพิ่มข้อมูล</a>
							<?php }?>
							 <a class="btn btn-success" href="?job=listdata"><i class="fa fa-list"></i> แสดงข้อมูล</a>
						</p>
							<?php
								if($_SESSION['job1'] == "add"){

									if(isset($_POST['save'])){// กรณีเพิ่ม Database
											$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
											$uploadedFile=$_FILES[manager_pic][tmp_name];
											$uploadedFile_type=$_FILES[manager_pic][type];
											$uploadedFile_name=$_FILES[manager_pic][name];
											if($uploadedFile_type=="image/JPG" 
																	|| $uploadedFile_type=="image/jpg" 
																	|| $uploadedFile_type=="image/JPEG" 
																	|| $uploadedFile_type=="image/jpeg" 
																	|| $uploadedFile_type=="image/pjpeg"
																	|| $uploadedFile_type=="image/png"  
																	|| $uploadedFile_type=="image/pjpg")
											{
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
												"status"=>"".$_POST[status]."",
												"manager_order"=>"".$_POST[manager_order]."",
											), MYDBMS);
											          $ProcessOutput .= "<script>
																			swal('Good job!', 'เพิ่มข้อมูลแล้ว!', 'success')
																		</script>";
											$ProcessOutput .= "<meta http-equiv=\"refresh\" content=\"1 ; URL='?'; charset=utf-8\">";
										$db->closedb (MYDBMS);
										echo $ProcessOutput ;
									}else if(!isset($_POST['save'])){
											$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
									?>
										<form method="post" action="?" name="myForm"  ENCTYPE="multipart/form-data" onsubmit='return manager_check();' >
										<table class="table">
												<input type='hidden'  name='save' id='save' value='ok'>
												<tr class="bg-danger"> 
													<td colspan=2><h4><i class="fa fa-cog"></i><?php echo $jobdata?></h4></td>
												</tr>			
												<tr> 
													<td colspan=2 >
														<div class="input-group">
															<span class="input-group-addon">รูปผู้บริหาร</span>
															<input class="form-control" name='manager_pic' id='manager_pic' type=file title='เลือกรูป' required>
														</div>
													</td>
												</tr>
												<tr> 
													<td colspan=2>
														<div class="input-group">
															<span class="input-group-addon">คำนำหน้า</span>
															<input class="form-control" type='text' name='manager_pname' value='<?php echo $arr[man][manager_pname]?>' required >
														</div>
													</td>
												</tr>
												<tr> 
													<td colspan=2 >
														<div class="input-group">
															<span class="input-group-addon">ชื่อ</span>
															<input class="form-control" type='text' name='manager_name' value='<?php echo $arr[man][manager_name]?>'>
															<span class="input-group-addon">นามสกุล</span>
															<input class="form-control" type='text' name='manager_sname' value='<?php echo $arr[man][manager_sname]?>'>
													</td>
												</tr>
												<tr> 
													<td colspan=2 >
														<div class="input-group">
															<span class="input-group-addon">ตำแหน่ง</span>
															<select  class='form-control' name='manager_pos'  >
																<option value=''>-- เลือกตำแหน่ง --</option>
																<?php 
																$res[posi] = $db->select_query("SELECT * FROM ".TB_pos." order by pos_name ",MYDBMS);
																while($arr[posi] = $db->fetch($res[posi],MYDBMS)){
																	?><option value='<?php echo $arr[posi][pos_id]?>' <?php if($arr[posi][pos_id]==$arr[car][cars_pos]) echo "selected";?>><?php echo $arr[posi][pos_name]?></option><?php 
																}?>
															</select>
														</div>
													</td>
												</tr>
												<tr> 
													<td colspan=2>
														<div class="input-group">
															<span class="input-group-addon">ผู้ดูแลตารางนัดหมาย</span>
															<select class='form-control' name='secretary_id'  >
																<option value=''>-- เลือก --</option>
																<?php 
																$res[memb] = $db->select_query("SELECT * FROM ".TB_member." order by member_name ",MYDBMS);
																while($arr[memb] = $db->fetch($res[memb],MYDBMS)){
																	?><option value='<?php echo $arr[memb][member_id]?>' <?php if($arr[memb][member_id]==$arr[car][cars_member]) echo "selected";?>><?php echo $arr[memb][member_name]?></option><?php 
																}?>
															</select>
														</div>
													</td>
												</tr>
												<tr>
													<td colspan=2>
														<div class="input-group">
															<span class="input-group-addon">สถานะ</span>
															<label class="radio-inline"><input type="radio" name="status" checked>อยู่ในวาระ</label>
															<label class="radio-inline"><input type="radio" name="status">หมดวาระ</label>
														</div>
														
													</td>
												</tr>
												<tr>
													<td colspan=2>
														<div class="input-group">
															<span class="input-group-addon">ลำดับการแสดงผล</span>
															<input type="number" name="manager_order" id="manager_order" class="form-control" required >
															
														</div>
													</td>
												</tr>
												<tr>
													<td colspan=2>
														<center><input class="btn btn-primary" type=submit class="submit1" value=" บันทึกข้อมูล "> </center>
													</td>
												</tr>	
												</form>
											</table>
									<?php
									$db->closedb (MYDBMS);
									} #save
								}else if($_SESSION['job1']== "edit"){
									//////////////////////////////////////////// กรณีแก้ไข Database Edit
									if(isset($_POST['save'])){

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
												"status"=>"".$_POST[status]."",
												"manager_order"=>"".$_POST[manager_order]."",
											)," manager_id='".$_POST[id]."' ",MYDBMS);
											
											$ProcessOutput .= "<script>
																	swal('Good job!', 'แก้ไขข้อมูลแล้ว!', 'success')
																</script>";

           									 $ProcessOutput .= "<meta http-equiv=\"refresh\" content=\"1 ; URL='?job=listdata'; charset=utf-8\">";


										$db->closedb (MYDBMS);
										echo $ProcessOutput ;
								}else if(!isset($_POST['save'])){
									//////////////////////////////////////////// กรณีแก้ไข Form
										$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD,MYDBMS);
										$res[man] = $db->select_query("SELECT * FROM ".TB_man." WHERE manager_id='".$_GET[id]."' ",MYDBMS);
										$arr[man] = $db->fetch($res[man],MYDBMS);

								?>		
										<form method=post action="?" name="user_Form"  ENCTYPE="multipart/form-data" onsubmit='return user_check();' >
											<input type='hidden' name='save' value='ok'>
											<input type='hidden' name='id' value='<?php echo $_GET[id]?>'>
											<input type='hidden' name='old_manager_pic' value='<?php echo $arr[man][manager_pic]?>'>
											
											<div class="panel panel-default">
												  <div class="panel-heading">
														<h3 class="panel-title"><i class="fa fa-cog fa-2x"></i><?php echo $jobdata?></h3>
												  </div>
												  <div class="panel-body">
														<div class="form-group">
															<div class="input-group col-xs-4">
																<span class="input-group-addon">รูปผู้บริหาร</span>
																<input class="form-control col-4" name='manager_pic' id='manager_pic' type=file title='เลือกรูป'>
															</div>
														</div>

														<div class="form-group">
															<div class="input-group col-xs-3">
																<span class="input-group-addon">คำนำหน้า</span>
																<input class="form-control" type='text' name='manager_pname' value='<?php echo $arr[man][manager_pname];?>'>
															</div>
														</div>

														<div class="form-group">
															<div class="input-group col-xs-6">
																<span class="input-group-addon">ชื่อ</span>
																<input class="form-control" type='text' name='manager_name' value='<?php echo $arr[man][manager_name]?>'>
																<span class="input-group-addon">นามสกุล</span>
																<input class="form-control" type='text' name='manager_sname' value='<?php echo $arr[man][manager_sname]?>'>
															</div>
														</div>

														<div class="form-group">
															<div class="input-group col-xs-6">
																<span class="input-group-addon">ตำแหน่ง</span>
																<select class='form-control' name='manager_pos'  >
																	<option value=''>-- เลือกตำแหน่ง --</option>
																	<?php 
																	$res[posi] = $db->select_query("SELECT * FROM ".TB_pos." order by pos_id ",MYDBMS);
																	while($arr[posi] = $db->fetch($res[posi],MYDBMS)){
																		?><option value='<?php echo $arr[posi][pos_id]?>' <?php if($arr[posi][pos_id]==$arr[man][manager_pos]) echo "selected";?>><?php echo $arr[posi][pos_name]?></option><?php 
																	}?>
																</select>
															</div>
														</div>

														<div class="form-group">
															<div class="input-group col-xs-6">
																<span class="input-group-addon">ผู้ดูแลตารางนัดหมาย</span>
																<select class="form-control" class='input-select' name='secretary_id'  >
																	<option value=''>-- เลือก --</option>
																	<?php 
																	$res[memb] = $db->select_query("SELECT * FROM ".TB_member." order by member_name ",MYDBMS);
																	while($arr[memb] = $db->fetch($res[memb],MYDBMS)){
																		?><option value='<?php echo $arr[memb][member_id]?>' <?php if($arr[memb][member_id]==$arr[man][secretary_id]) echo "selected";?>><?php echo $arr[memb][member_name]?></option><?php 
																	}?>
																</select>
															</div>
														</div>
														<div class="form-group">
															<div class="input-group">
																<?php  
																	$status = $arr[man][status];
																	if($status==0){?>
																		<label class="radio-inline"><input type="radio" name="status" value=0 checked>อยู่ในวาระ</label>
																		<label class="radio-inline"><input type="radio" name="status" value=1 >หมดวาระ</label>
																	<?php }else{ ?>
																		<label class="radio-inline"><input type="radio" name="status" value=0 >อยู่ในวาระ</label>
																		<label class="radio-inline"><input type="radio" name="status" value=1 checked>หมดวาระ</label>

																	<?php }?>
															</div>
														</div>
														<div classs="form-group">
															<div class="input-group col-xs-3">
																<span class="input-group-addon">ลำดับการแสดงผล</span>
																<input type="number" name="manager_order" id="manager_order" class="form-control" value="<?php echo $arr[man][manager_order];?>">
																															</div>
														</div>
														<center><input type=submit class="btn btn-primary" value=" บันทึกข้อมูล"></center>
												  </div>
											</div>
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
											<table class="table table-bordered table-hover">
												<tr class="bg-success">
													<td><h5 class="text-center">ลำดับที่</h5></td>
													<td><h5 class="text-center">รูปผู้บริหาร</h5></td>
													<td><h5 class="text-center">ข้อมูลผู้บริหาร</h5></td>
													<td><h5 class="text-center">ผู้ดูแลตารางนัดหมาย</h5></td>
													<td><h5 class="text-center"><i class="fa fa-cog"></i> แก้ไข/ลบ</h5></td>
												</tr>  
												<?php
												$rec_num=0;
								
												$res[man] = $db->select_query("SELECT * FROM ".TB_man." $condi1 ORDER BY manager_order LIMIT $goto, $perpage ",MYDBMS);
										
												while($arr[man] = $db->fetch($res[man],MYDBMS)){
													$rec_num++;
												?>
													<tr 
														<?php 
														if($arr[man][manager_id]==$id) echo "class='data-edit'";?>>   
														<td  align='center'><?php echo $arr[man][manager_order]?></td> 
														<td  align='center' valign='top' class='data-c1'><?php if($arr[man][manager_pic]) echo "<img class='img-rounded' src='managerPic/".$arr[man][manager_pic]."' width='90'>"; else echo "&nbsp;";?></td>

														<td  align='left' valign='top' >
															<?php echo $arr[man][manager_pname]?>
															<?php echo $arr[man][manager_name]?> 
															<?php echo $arr[man][manager_sname]?>
															<br>ตำแหน่ง : <?php echo $dataOth->pos_($arr[man][manager_pos],$parts);?>
															<br>สถานะ : <?php if($arr[man][status]==0){
																echo "<kbd>อยู่ในวาระ</kbd>";
															}else{
																echo "<kbd>หมดวาระ</kbd>";
															}?>
														</td> 
														<td  align='left' valign='top'><?php echo $dataUser->member_($arr[man][secretary_id],$parts);?></td> 
														<td  valign='top' align='center'>
														<?php 
															if($dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"edit",$depidman,$parts)){?>
																<a class="btn btn-warning" href="?job=edit&id=<?php echo  $arr[man][manager_id];?>"><i class="fa fa-edit"></i></a> 
															<?php }?>
														<?php 
															if($dataUser->CheckPriority($_SESSION['USER_LOGIN'],$op1,$modules1,"delt",$depidman,$parts)){?>
															<a class="btn btn-danger" 
																href="?job=delt&id=<?php echo  $arr[man][manager_id];?>" 
																onclick="javascript:return Conf('<?php echo $arr[man][manager_pname]?><?php echo $arr[man][manager_name]?> <?php echo $arr[man][manager_sname]?>')">
																<i class="fa fa-trash"></i>
															</a>
														<?php }?>
														</td>
													</tr>
												<?php } #while?>
												</form>
												</table>

								<?php		
									$db->closedb (MYDBMS);
									?>
					</div>
			</div>
		</div> <!-- col  -->
	</div> <!-- row -->
</div> <!-- container -->


