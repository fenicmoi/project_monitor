
<?php
date_default_timezone_set('Asia/Bangkok');
include "header.php"; 
$u_id=$_SESSION['ses_u_id'];
?>
<script>
	$( document ).ready( function () {
		$( "#dateSearch" ).hide();
		$( "tr" ).first().hide();


		$( "#hideSearch" ).click( function () {
			$( "tr" ).first().show( 1000 );
		} );


		$( '#typeSearch' ).change( function () {
			var typeSearch = $( '#typeSearch' ).val();
			if ( typeSearch == 4 ) {
				$( "#dateSearch" ).show( 500 );
				$( "#search" ).hide( 500 );
			} else {
				$( "#dateSearch" ).hide( 500 );
				$( "#search" ).show( 500 );
			}
		} )

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
           ?>
        </div>
    
        <div  class="col-md-10">
            <div class="panel panel-default" >
                <div class="panel-heading">
                    <i class="fa fa-envelope fa-2x" aria-hidden="true"></i>  <strong>โครงการงบจังหวัด</strong>
                    <a href="" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus " aria-hidden="true"></i> เพิ่มโครงการหลัก</a>
                    <button id="hideSearch" class="btn btn-primary pull-right"><i class="fas fa-search"> ค้นหา</i></button>
                </div>
                 <table class="table table-bordered table-hover" border=2>
                        <thead class="bg-info">
                            	<tr bgcolor="black">
                                    <td colspan="8">
                                        <form class="form-inline" method="post" name="frmSearch" id="frmSearch">
                                            <div class="form-group">
                                                <select class="form-control" id="typeSearch" name="typeSearch">
                                                    <option value="1">เลขส่ง</option>
                                                    <option value="2" selected>ชื่อเรื่อง</option>
                                                </select>

                                                <div class="input-group">
                                                    <input class="form-control" id="search" name="search" type="text" size="80" placeholder="Keyword สั้นๆ">
                                                    <div class="input-group" id="dateSearch">
                                                        <span class="input-group-addon"><i class="fas fa-calendar-alt"></i>วันที่เริ่มต้น</span>
                                                        <input class="form-control" id="dateStart" name="dateStart" type="date">
                                                        <span class="input-group-addon"><i class="fas fa-calendar-alt"></i>วันที่สิ้นสุด</span>
                                                        <input class="form-control" id="dateEnd" name="dateEnd" type="date">
                                                    </div>
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-primary" type="submit" name="btnSearch" id="btnSearch">
                                                                <i class="fas fa-search "></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            <tr>
                                <th>รหัสโครงการ</th>
                                <th>ลำดับที่</th>
                                <th>ชื่อโครงการ</th>
                                <th>งบประมาณ</th>
                                <th>ผลการเบิกจ่าย</th>
                                <th>ปีงบประมาณ</th>
                                <th>ผู้รับผิดชอบหลัก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql="SELECT p.*, y.yname, d.dep_name FROM  project_master as p
                                      INNER JOIN depart as d ON d.dep_id = p.dep_id
                                      INNER JOIN sys_year as y ON y.yid = p.yid ORDER BY p.order_id ASC";
                                // print $sql;                     
                                 //ส่วนการค้นหา
                                 if(isset($_POST['btnSearch'])){
                                     @$typeSearch = $_POST[ 'typeSearch' ]; //ประเภทการค้นหา
                                     @$txt_search = $_POST[ 'search' ]; //กล่องรับข้อความ
                                    $sql="SELECT * FROM  project_master";
                                     if ( @$typeSearch == 1 ) { //ค้นด้วยเลขเลขส่ง
                                        if($level_id <= 2){     
                                            $sql .= " WHERE m_id LIKE '%$txt_search%' ";
                                        }else{
                                            $sql .= " WHERE m_id LIKE '%$txt_search%'  AND m.dep_id=$dep_id  AND sec_id=$sec_id  ";
                                        }
                                    } elseif ( @$typeSearch == 2 ) { //ค้นด้วยชื่อชื่อเรื่อง
                                        if($level_id <=2){
                                            $sql .= " WHERE project_name LIKE '%$txt_search%' ";
                                        }else{
                                            $sql .= " WHERE project_name LIKE '%$txt_search%'   AND dep_id=$dep_id  AND sec_id=$sec_id ";
                                        }
                                        $sql .= "ORDER BY m_id DESC";
                                    }

                                 }//isset 
                                // print $level_id;
                                //print $sql;
                                $result = page_query( $dbConn, $sql, 20 );
                                while($row = dbFetchArray($result)){?>
                                    <tr>
                                        <td><?php echo $row['m_id']; ?></td>
                                        <td><?php echo $row['order_id'];?></td>
                                        <td>
                                            <?php  $m_id=$row['m_id']; ?>
                                            <a href="#" 
                                                onClick="loadData('<?php print $m_id;?>','<?php print $yid;?>');" 
                                                data-toggle="modal" data-target=".bs-example-modal-table">
                                                <?php echo $row['project_name'];?> 
                                            </a>
                                           <a class="badge badge-warning"" href="project_level1.php?m_id=<?php echo $row['m_id'];?>"> <i class="fas fa-plus"></i> โครงการย่อย</a>
                                        </td>
                                        <td><?php echo number_format($row['money_total'],0) ?></td>
                                        <?php  
                                            //ดึงข้อมูลในตารางย่อยมาหาผลการเบิกจ่าย  
                                            $sql1 = "SELECT SUM(duplicate) AS total FROM project_level1 where m_id= $row[m_id]";
                                            $result1 = dbQuery($sql1);
                                            $row1 = dbFetchArray($result1);
                                            
                                        ?>
                                        <td><?php echo number_format($row1['total'],0)?></td>
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
									page_echo_pagenums(10,true); 
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
                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i> เพิ่มโครงการหลัก</h4>
                  </div>
                  <div class="modal-body bg-success"> 
                     <form name="form" method="post" enctype="multipart/form-data">
                        <table width="800">
                            <tr>
                                <td>
                                    <div class="form-group form-inline">
                                        <label for="yid">ปีเอกสาร : </label>
                                        <input class="form-control"  name="yid" type="text" value="<?php print $yname; ?>" disabled="">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                     <div class="form-group form-inline">
                                        <label for="currentDate">วันที่ทำรายการ :</label>
                                        <input class="form-control" type="text" name="currentDate" value="<?php print DateThai();?>" disabled="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group form-inline"> 
                                        <label for="bid">แหล่งงบประมาณ: </label>
                                        <select name="budget_type" class="form-control" required>
                                            <?php 
                                                 //วัตถุประสงค์
                                                $sql="SELECT * FROM budget_type ORDER BY bid";
                                                $result = dbQuery($sql);
                                                while ($row=dbFetchArray($result)){
                                                echo "<option  value=".$row['bid'].">".$row['bname']."</option>";
                                            }?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group form-inline"> 
                                            <label for="target_id">ผลผลิต: </label>
                                            <select name="target_id" class="form-control" required>
                                                <?php 
                                                    //วัตถุประสงค์
                                                    $sql="SELECT * FROM target ORDER BY target_id";
                                                    $result = dbQuery($sql);
                                                    while ($row=dbFetchArray($result)){
                                                    echo "<option  value=".$row['target_id'].">".$row['target_name']."</option>";
                                                }?>
                                            </select>
                                    </div>   
                                </td>
                                <td>
                                 <div class="form-group form-inline">
                                     <label>เลขทะเบียนโครงการ : <kbd>ออกโดยระบบ</kbd></label>
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
                                        <input class="form-control" id="order_id"  name="order_id" type="number">
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
                                                <input class="form-control" type="text" size=100  name="project_name" id="project_name" size="50" required >
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=2>
                                        <div class="form-group">
                                            <div class="input-group">        
                                            <span class="input-group-addon">งบประมาณ : </span>
                                            <input class="form-control" type="number" size=100  name="money_total" id="money_total"  required>
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
                                            <input class="form-control" type="number" size=100   name="recive1" id="recive1"  >
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
                                            <input class="form-control" type="number" size=100   name="inver_budget" id="inver_budget"  >
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
                                            <input class="form-control" type="number" size=100   name="opra_budget" id="opra_budget"  >
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
                        <h4 class="modal-title"><i class="fa fa-info"></i> รายละเอียดโครงการ</h4>
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
    $order_id = $_POST['order_id'];
    $project_name = $_POST['project_name'];
    $money_total = $_POST['money_total'];
    $inver_budget = $_POST['inver_budget'];
    $opra_budget = $_POST['opra_budget'];
    $recive1 = $_POST['recive1'];
    $dep_id = $_POST['dep_id'];
    $yid= $yid;
    $target_id = $_POST['target_id'];
    $budget_type = $_POST['budget_type'];

        $sqlInsert="INSERT INTO project_master
                         (order_id, project_name, money_total, inver_budget, opra_budget, recive1, dep_id, yid, target_id, budget_type)    
                    VALUE($order_id, '$project_name', $money_total, $inver_budget, $opra_budget, $recive1, $dep_id, $yid, $target_id, $budget_type)";
       
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
                        window.location.href='project_master.php';
                    }
                }); 
            </script>";
        }else{
            dbQuery("ROLLBACK");
            echo "<script>
            swal({
                title:'มีบางอย่างผิดพลาด! กรุณาตรวจสอบ',
                type:'error',
                showConfirmButton:true
                },
                function(isConfirm){
                    if(isConfirm){
                        window.location.href='project_master.php';
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



<!-- Modal Reserv -->
<div id="modalReserv" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title"> <i class="fas fa-plus"></i> จองเลข</h4>
      </div>
      <div class="modal-body">
         <div class="alert alert-danger"><i class="fas fa-comments" fa-2x></i>ระบุจำนวนเอกสารที่ต้องการจอง</div>
         <form name="form" method="post" enctype="multipart/form-data">

         <div class="form-group col-sm-6">
            <div class="input-group">
                <span class="input-group-addon">เลขหน่วยงาน:</span>
                <input type="prefex" class="form-control" name="prefex" max=10  placeholder="เลขหน่วยงาน">
            </div>
          </div>

          <div class="form-group col-sm-6">
            <div class="input-group">
                <span class="input-group-addon">จำนวน:</span>
                <input type="number" class="form-control" name="num" max=100  placeholder="ไม่เกิน 10 ฉบับ">
            </div>
          </div>

             <center> <button class="btn btn-success" type="submit" name="btnReserv" id="btnReserv"><i class="fas fa-save fa-2x"></i> บันทึก</button></center>
         </form>
      </div>
      <div class="modal-footer bg-primary">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function loadData(m_id,yid) {
    var sdata = {
        m_id : m_id,
        yid : yid
    };

$('#divDataview').load('show-project.php',sdata);
}
</script>
  
