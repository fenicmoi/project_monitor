<link rel="stylesheet" href="../css/sweetalert.css">
<script src="../js/sweetalert.min.js"></script>
<?php
date_default_timezone_set('Asia/Bangkok');
include 'function.php';
include '../library/database.php';  


$m_id=$_POST['m_id'];   //number of project

$sql="SELECT m.*,y.yname FROM project_master as m  
      INNER JOIN sys_year as y ON y.yid =  m.yid
      WHERE m_id = $m_id";
$result=dbQuery($sql);
$row=dbFetchAssoc($result);




//echo $sql;

?>  
<table border=1 width=100% class="table table-hover" >
 <tr>
     <td bgcolor="#00FFFF">รหัสโครงการ</td>
     <td colspan="3"><?php echo $m_id?>/<?php echo $row['yname']?></td>
 </tr>
 <tr>
     <td bgcolor="#00FFFF">ชื่อโครงการ</td>
     <td colspan="3"><?php echo $row['project_name']?></td>
 </tr>
 <tr>
     <td bgcolor="#00FFFF">งบประมาณ</td>
     <td colspan=3><?php echo number_format($row['money_total'],0) ?>บ.</td>

 </tr>

<tr>
    <td colspan=4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ที่</th>
                    <th>ชื่อกิจกรรม</th>
                    <th>งบประมาณ</th>
                    <th>ผลการเบิกจ่าย</th>
                    <th>หน่วยดำเนินการ</th>
                </tr>
            </thead>
            <?php 
                $sql = "SELECT p.*, d.dep_name FROM project_level1 as p
                        INNER JOIN depart as d ON p.dep_id = d.dep_id 
                        WHERE p.m_id = $m_id";
                $result = dbQuery($sql);
                $total = 0;
                $total_dub = 0;
                while ($row = dbFetchArray($result)) {?>
                <tr>
                    <td><?=$row['order_id'];?></td>
                    <td><?=$row['level1name'];?></td>
                    <td><?=number_format($row['money_total'],0);?></td>
                    <td><?=number_format($row['duplicate'],0);?></td>
                    <td><?=$row['dep_name'];?></td>
                </tr>
                    <?php  
                        $total = $total + $row['money_total'];  // งบประมาณแต่ละกิจกรรม
                        $total_dub = $total_dub + $row['duplicate']; // ผลการเบิกจ่ายแต่ละกิจกรรม

                        //คิดเปอร์เซ็นต์
                        $percen = ($total_dub*100)/$total;

                    ?>
               
               <?php } ?>
               <tr>
                    <td colspan=2>รวม</td>
                    <td><kbd><?=number_format($total,0)?></kbd></td>
                    <td><kbd><?=number_format($total_dub,0)?></kbd></td>
                </tr>
                <tr>
                    <td colspan=2>%การเบิกจ่าย</td>
                    <td bgcolor="00FF00"><kbd><?php echo number_format($percen,2)?>%</kbd></td>
                </tr>
        </table>
    </td>
</tr>
 
</table>
