
<?php
date_default_timezone_set('Asia/Bangkok');
include "header.php"; 
$u_id=$_SESSION['ses_u_id'];
?>
<script>
	$( document ).ready( function () {

        $('.depart').select2();
	} );
</script>
<?php    
   //ตรวจสอบปีเอกสารว่าเป็นปีปัจจุบันหรือไม่
    list($yid,$yname,$ystatus)=chkYear();  
    $yid=$yid;
    $yname=$yname;
    $ystatus=$ystatus;
?>
        <div class="col-md-2" >
           <?php
                $menu =  checkMenu($level_id);
                include $menu;

                //ดึงข้อมูลโครงการหลัก
                $m_id = $_GET['m_id'];
                echo $m_id;
                $sql = "SELECT * FROM project_master WHERE m_id = $m_id ";
                $result = dbQuery($sql);
                $row = dbFetchAssoc($result);

           ?>
        </div>
    
        <div  class="col-md-10">
            <div class="panel panel-default" >
                <div class="panel-heading">
                <a class="btn btn-warning" href="project_master.php">กลับโครงการหลัก</a>  <strong><?php echo $row['project_name'];?></strong>
                    <a href="" class="btn btn-default btn-md pull-right" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus " aria-hidden="true"></i> เพิ่มโครงการย่อย</a>
                    <button id="hideSearch" class="btn btn-default pull-right"><i class="fas fa-search"> ค้นหา</i></button>
                </div>
                 <table class="table table-bordered table-hover" border=2>
                        <thead class="bg-info">
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ชื่อโครงการ</th>
                                <th>ความก้าวหน้า(%)</th>
                                <th>งบประมาณ</th>
                                <th>งบลงทุน</th>
                                <th>งบดำเนินการ</th>
                                <th>งวดที่1</th>
                                <th>งวดที่2</th>
                                <th>งวดที่3</th>
                                <th>ปีงบประมาณ</th>
                                <th>ผู้รับผิดชอบหลัก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql="SELECT l1.*,d.dep_name, y.yname FROM project_level1  as l1 
                                      INNER JOIN depart as d  ON d.dep_id = l1.dep_id
                                      INNER JOIN sys_year as y on y.yid = l1.yid 
                                      WHERE l1.m_id =$m_id  ORDER BY l1.order_id ASC
                                     ";
             
                                $result = page_query( $dbConn, $sql, 20 );
                                while($row = dbFetchArray($result)){?>
                                    <tr>
                                       
                                        <td><?php echo $row['order_id'];?></td>
                                        <td>
                                            <?php  $cid=$row['']; ?>
                                            <a href="#" 
                                                onClick="loadData('<?php print $m_id;?>','<?php print $u_id; ?>');" 
                                                data-toggle="modal" data-target=".bs-example-modal-table">
                                                <?php echo $row['level1name'];?> 
                                            </a>
                                            <i class="fas fa-plus"></i> <a href="">แผนงานย่อย</a>
                                        </td>
                                        <td><?php echo $row['percentage']; ?></td>
                                        <td><?php echo number_format($row['money_total'],0) ?></td>
                                        <td><?php echo number_format($row['inver_budget'],0)?></td>
                                        <td><?php echo number_format($row['opra_budget'],0)?></td>
                                        <td><?php echo number_format($row['recive1'],0)?></td>
                                        <td><?php echo number_format($row['recive2'],0)?></td>
                                        <td><?php echo number_format($row['recive3'],0)?></td>
                                        <td><?php echo $row['yname'] ?></td>
                                        <td><?php echo $row['dep_name'] ?></td>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                    <div class="panel-footer">
							<center>
								<a href="flow-normal.php" class="btn btn-primary"><i class="fas fa-home"></i> หน้าหลัก</a>
								<?php 
									page_link_border("solid","1px","gray");
									page_link_bg_color("lightblue","pink");
									page_link_font("14px");
									page_link_color("blue","red");
									page_echo_pagenums(20,true); 
								?>
							</center>
					</div>
            </div> <!-- panel -->
           
             <!-- Model -->
            <!-- เพิ่มโครงการ -->
            <div id="modalAdd" class="modal fade" role="dialog">
              <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i> เพิ่มโครงการย่อย</h4>
                  </div>
                  <div class="modal-body bg-success"> 
                     <form name="form" method="post" enctype="multipart/form-data">
                        <table width="800">
                            <tr>
                                <td>
                                    <div class="form-group form-inline">
                                        <label for="yid">ปีงบประมาณ : </label>
                                        <input class="form-control"  name="yid" type="text" value="<?php print $yname; ?>" disabled="">
                                    </div>
                                </td>
                                <td>
                                     <div class="form-group form-inline">
                                        <label for="currentDate">วันที่ทำรายการ :</label>
                                        <input class="form-control" type="text" name="currentDate" value="<?php print DateThai();?>" disabled="">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    <div class="form-group form-inline"> 
                                            <label for="dep_id">หน่วยรับผิดชอบ: </label>
                                            <select name="dep_id" class="depart" style="width: 50%"  required>
                                                <?php 
                                                    //หน่วยรับผิดชอบ
                                                    $sql="SELECT * FROM depart ORDER BY dep_id";
                                                    $result = dbQuery($sql);
                                                    while ($row=dbFetchArray($result)){
                                                             echo "<option  value=".$row['dep_id'].">".$row['dep_name']."</option>";
                                                    }?>
                                            </select>
                                    </div>   
                                </td>
                                <td>
                                    <div class="form-group form-inline">
                                        <label for="order_id">ลำดับที่โครงการ : </label>
                                        <input class="form-control" id="order_id"  name="order_id" type="number"  value='0' require>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                    <td colspan=2>
                                        <div class="form-group">
                                            <div class="input-group col-4">
                                                <span class="input-group-addon">ร้อยละความสำเร็จ : </span>
                                                <input class="form-control" type="text"   name="percentage" id="percentage" value='0' required >
                                                <span class="input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </td>
                            </tr>
                            <tr>
                            <td colspan=2>
                                        <div class="form-group">
                                            <div class="input-group col-4">
                                                <span class="input-group-addon">หมายเหตุ : </span>
                                                <input class="form-control" type="text"   name="remark" id="remark" value="-" require>
                                                
                                            </div>
                                        </div>
                                    </td>
                            </tr>
                        </table>
                        </div>

                        <i class="badge">รายละเอียด</i>
                        <div class="well">  
                            <table width=100%>
                                <tr>
                                    <td colspan=2>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">ชื่อโครงการ : </span>
                                                <input class="form-control" type="text" size=100  name="level1name" id="level1name" size="50" required >
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=2>
                                        <div class="form-group">
                                            <div class="input-group">        
                                            <span class="input-group-addon">งบประมาณ : </span>
                                            <input class="form-control" type="number" size=100  name="money_total" id="money_total" value="0"  required>
                                            <span class="input-group-addon">บาท : </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=2>
                                        <div class="form-group">
                                            <div class="input-group">
                                            <span class="input-group-addon">งบลงทุน : </span>
                                            <input class="form-control" type="number" size=100   name="inver_budget" id="inver_budget" value="0"   require >
                                            <span class="input-group-addon">บาท : </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=2>
                                        <div class="form-group">
                                            <div class="input-group">
                                            <span class="input-group-addon">งบดำเนินงาน : </span>
                                            <input class="form-control" type="number" size=100   name="opra_budget" id="opra_budget" value="0"  require >
                                            <span class="input-group-addon">บาท : </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=2>
                                        <div class="form-group">
                                            <div class="input-group">
                                            <span class="input-group-addon">งวด1 : </span>
                                            <input class="form-control" type="number" size=100   name="recive1" id="recive1" value="0"  require >
                                            <span class="input-group-addon">บาท : </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=2>
                                        <div class="form-group">
                                            <div class="input-group">
                                            <span class="input-group-addon">งวด2 : </span>
                                            <input class="form-control" type="number" size=100   name="recive2" id="recive2" value="0"  require >
                                            <span class="input-group-addon">บาท : </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=2>
                                        <div class="form-group">
                                            <div class="input-group">
                                            <span class="input-group-addon">งวด3 : </span>
                                            <input class="form-control" type="number" size=100   name="recive3" id="recive3" value="0"  require >
                                            <span class="input-group-addon">บาท : </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                         </div> <!-- class well -->    
                         
                               <center>
                                    <button class="btn btn-primary btn-lg" type="submit" name="save">
                                    <i class="fa fa-floppy-o fa-2x"></i> บันทึก
                                    <input id="u_id" name="u_id" type="hidden" value="<?php echo $u_id; ?>"> 
                                    <input id="yid" name="yid" type="hidden" value="<?php echo $yid; ?>"> 
                                    <input id = "m_id" name="m_id" type="hidden" value="<?php echo $m_id;?>">
                                    </button>
                               </center>    
                     </form>
                  </div>
                  <div class="modal-footer bg-primary">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                  </div>
                </div>  <!-- model content -->
              </div>
            </div>
            <!-- End Model -->     
            </div>

        </div>  <!-- col-md-10 -->
    </div>  <!-- container -->
    <!--  modal แสงรายละเอียดข้อมูล -->
        <div  class="modal fade bs-example-modal-table" tabindex="-1" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-info"></i> รายละเอียด</h4>
                    </div>
                    <div class="modal-body no-padding">
                        <div id="divDataview">
                            <!-- สวนสำหรับแสดงผลรายละเอียด   อ้างอิงกับไฟล์  show_command_detail.php -->                             
                        </div>     
                    </div> <!-- modal-body -->
                    <div class="modal-footer bg-info">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                    </div>
                </div>
            </div>
        </div>
    </div>                                                 
<?php

include_once 'function.php';
error_reporting( error_reporting() & ~E_NOTICE );//ปิดการแจ้งเตือน
date_default_timezone_set('Asia/Bangkok'); //วันที่


if(isset($_POST['save'])){   //กดปุ่มบันทึกจากฟอร์มบันทึก
    $m_id = $_POST['m_id']; 
    $order_id = $_POST['order_id'];
    $level1name = $_POST['level1name'];
    $money_total = $_POST['money_total'];
    $inver_budget = $_POST['inver_budget'];
    $opra_budget = $_POST['opra_budget'];
    $recive1 = $_POST['recive1'];
    $recive2 = $_POST['recive2'];
    $recive3 = $_POST['recive3'];
    $dep_id = $_POST['dep_id'];
    $yid= $_POST['yid'];
    $percentage = $_POST['percentage'];
    $remark = $_POST['remark'];

        $sqlInsert="INSERT INTO project_level1
                         (m_id, order_id, level1name, money_total, inver_budget, opra_budget, recive1, recive2,recive3, yid,dep_id, percentage,remark)    
                    VALUE($m_id, $order_id, '$level1name', $money_total, $inver_budget, $opra_budget, $recive1, $recive2, $recive3, $yid, $dep_id, $percentage, '$remark')
                
                    ";
      // echo $sqlInsert;
       
        $result=dbQuery($sqlInsert);
         if($result){
            echo "<script>
            swal({
                title:'เรียบร้อย',
                type:'success',
                showConfirmButton:true
                },
                function(isConfirm){
                    if(isConfirm){
                        window.location.href='project_level1.php?m_id=$m_id';
                    }
                }); 
            </script>";
        }else{
            echo "<script>
            swal({
                title:'มีบางอย่างผิดพลาด! กรุณาตรวจสอบ',
                type:'error',
                showConfirmButton:true
                },
                function(isConfirm){
                    if(isConfirm){
                        window.location.href='project_level1.php?m_id=$m_id';
                    }
                }); 
            </script>";
        } 
        
        
}


if(isset($_POST['update'])){
    $cid = $_POST['cid'];
    $obj = $_POST['obj'];
    $dateout = $_POST['dateout'];
    $speed = $_POST['speed'];
    $secret = $_POST['secret'];
    $sendfrom = $_POST['sendfrom'];
    $sendto = $_POST['sendto'];
    $title = $_POST['title'];
    $refer = $_POST['refer'];
    $attachment = $_POST['attachment'];
    $practice = $_POST['practice'];
    $file_location = $_POST['file_location'];

     $sql = "UPDATE flownormal SET
                    obj_id = $obj,
                    title = '$title',
                    speed_id = $speed,
                    sendfrom = '$sendfrom',
                    sendto = '$sendto',
                    refer = '$refer',
                    attachment = '$attachment',
                    practice = '$practice',
                    file_location = '$file_location',
                    dateout = '$dateout'
            WHERE cid = $cid";
    $resUpdate = dbQuery($sql);
    if(!$resUpdate){
        echo "<script>swal(\"Good job!\", \"ไม่สำเร็จ!\", \"error\")</script>";                 
        echo "<meta http-equiv='refresh' content='1;URL=flow-normal.php'>";  
        exit;
    }else{
      echo "<script>swal(\"Good job!\", \"แก้ไขข้อมูลแล้ว!\", \"success\")</script>";                 
      echo "<meta http-equiv='refresh' content='1;URL=flow-normal.php'>";  
    }
}       
?>

<script type="text/javascript">
function loadData(cid,u_id) {
    var sdata = {
        cid : cid,
        u_id : u_id 
    };
$('#divDataview').load('show-flow-normal.php',sdata);
}
</script>
  
