<?
include "chksession.php" ;
?>
<?
include "lang-thai.php";
include "connect.php" ;
$sql = "select * from $tableuser where username='$sess_username' " ;
$result = mysql_db_query ($dbname, $sql) ;
$r = mysql_fetch_array($result) ;
$school = $r [school] ;
$status = $r [status] ;
$code = $r [code] ;
$name = $r [admin_name] ;
$position = $r [position] ;
$privateno = $r [pri_no] ;
$officenumber = $r [off_no] ;
mysql_close () ;

//echo "$status" ;
//exit ();
 if ($status=="public") {
	 $goback = "index2.php" ;
 } else {
	 $goback = "index.php" ;
 }

if ($code=="") {
?>
<p align="center"><b><font color="#008080">+:+: </font><font color="#800080">
เปลี่ยน <span lang="en-us">Password </span>ระบบงานสารบรรณ
<font color="#008080">:+:+</font></font></b></p>
</h2>


<div align="center">
  <center>
  <table border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="800" height="64">
    <tr>
      <td width="100%" valign="top" height="20"><u><b>
      <font face="MS Sans Serif" color="#FF0000">ข้อตกลงในการเปลี่ยนรหัสผ่าน ครั้งแรก</font></b></u></td>
    </tr>
    <tr>
      <td width="100%" valign="top" height="19">
      <ol>
        <li><font face="MS Sans Serif" color="#800080" size="2">เดิม สำนักงานจังหวัดพัทลุง 
        เป็นผู้กำหนดรหัสผ่านงานสารบรรณให้กับหน่วยงานของท่าน 
        เพื่อความปลอดภัยในการใช้งานท่านควรทำการเปลี่ยนรหัสผ่านเป็นของตนเอง</font></li>
        <li>
        <font face="MS Sans Serif" color="#008080" size="2">
        การเปลี่ยนรหัสผ่านควรกระทำโดยเจ้าหน้าที่สารบรรณหรือผู้ที่ได้รับมอบหมายงานสารบรรณเท่านั้น (ซึ่งต่อไปนี้ท่านคือ<B><FONT SIZE="" COLOR="red"> ผู้ดูแลระบบงานสารบรรณ</FONT></B>)</font></li>
        <li><font face="MS Sans Serif" color="#008080" size="2">ในการเปลี่ยนรหัสผ่านครั้งแรก ท่านจะต้องกำหนดรหัสลับ 
        สำหรับหน่วยงานของท่านก่อน (รหัสลับควรใช้ตัวเลข 0-9 หรืออักษรภาษาอังกฤษ
        <span lang="en-us">a-z </span>เท่านั้น)&nbsp; 
        จากนั้นจึงกำหนดรหัสผ่านใหม่ (ใช้ตัวเลขหรืออักษรภาษาอังกฤษเช่นกัน)</font></li>
        <li>
        <font face="MS Sans Serif" color="#800080" size="2">การให้กำหนดรหัสลับมีจุดประสงค์เพื่อป้องกันมิให้บุคคลที่ไม่เกี่ยวข้องเข้ามาเปลี่ยนรหัสผ่านของระบบงานสารบรรณ 
        ซึ่งอาจส่งผลเสียต่อทางราชการ</font></li>
        <li><font face="MS Sans Serif" color="#008080" size="2">หลังจากกำหนดรหัสลับและรหัสผ่านใหม่สำหรับหน่วยงายของท่านแล้ว 
        ให้เจ้าหน้าที่สารบรรณบอกรหัสผ่านกับเจ้าหน้าที่คนอื่น ๆ ในหน่วยงานของท่าน 
        เพื่อการเข้าใช้งานสารบรรณ และให้เก็บรหัสลับไว้เป็นความลับ</font></li>
        <li><font face="MS Sans Serif" color="#800080" size="2">หากมีความจำเป็นต้องเปลี่ยนรหัสผ่านในครั้งต่อ ๆ ไป 
        ระบบจะถามรหัสลับก่อน</font></li>
        <li><font face="MS Sans Serif" color="#008080" size="2">ในการเปลี่ยนรหัสผ่านครั้งแรก 
        ท่านต้องให้ข้อมูลส่วนตัวของท่านตามแบบฟอร์มที่ปรากฏ</font></li>
        <li><font face="MS Sans Serif" color="#800080" size="2">ระบบ รับส่งหนังสือราชการ <span lang="en-us">(</span>งานสารบรรณ) 
        สงวนสิทธิ์ สำหรับหน่วยงานสังกัด<? echo _NAME ;?>เท่านั้น</font></li>
      </ol>
      </td>
    </tr>
  </table>
  </center>
  <p><font color="#800000"><b>กรุณากรอกข้อมูลส่วนตัวของผู้ดูแลระบบงานสารบรรณ และกำหนด 
  รหัสลับ/รหัสผ่านใหม่<br>
&nbsp;</b></font></div>
<div align="center">
  <center>
  <table border="0" cellpadding="3" style="border-collapse: collapse" bordercolor="#111111" width="800">
    <tr>
      <td width="244" align="right"><b><font color="#000080">ชื่อ-สกุล</font></b></td>
      <td width="556">
      <form method="POST" action="changepwd.php">
   
<input type="text" name="name" size="40"></td>
    </tr>
    <tr>
      <td width="244" align="right"><b><font color="#000080">ตำแหน่ง</font></b></td>
      <td width="556"><input type="text" name="position" size="40"></td>
    </tr>
       <tr>
      <td width="244" align="right"><b><font color="#000080">หมายเลขโทรศัพท์ 
      มือถือ/บ้าน</font></b></td>
      <td width="556"><input type="text" name="privateno" size="31"><span lang="en-us">
      </span></td>
    </tr>
    <tr>
      <td width="244" align="right"><b><font color="#000080">หมายเลขโทรศัพท์ 
      ที่ทำงาน</font></b></td>
      <td width="556"><input type="text" name="officenumber" size="31"></td>
    </tr>
    <tr>
      <td width="244" align="right"><b><font color="#000080">รหัสลับ</font></b></td>
      <td width="556"><input type="text" name="code" size="31"><span lang="en-us">
      </span><font color="#FF0000">(</font><font face="MS Sans Serif" color="#FF0000" size="2">ใช้ตัวเลข 
      0-9 หรืออักษรภาษาอังกฤษ
        <span lang="en-us">a-z </span>เท่านั้น)</font></td>
    </tr>
    <tr>
      <td width="244" align="right">
      <p align="right"><b><font color="#000080"><span lang="en-us">Password
      </span>ใหม่</font></b></td>
      <td width="556"><input type="text" name="newpass" size="31">
      <font color="#FF0000">(</font><font face="MS Sans Serif" color="#FF0000" size="2">ใช้ตัวเลข 
      0-9 หรืออักษรภาษาอังกฤษ
        <span lang="en-us">a-z </span>เท่านั้น)</font></td>
    </tr>
    <tr>
      <td width="244" align="right">
      <p align="right"><b><font color="#000080">กรอก<span lang="en-us"> Password
      </span>ใหม่ อีกครั้ง</font></b></td>
      <td width="556"><input type="text" name="newpass2" size="31">
      <font color="#FF0000">(</font><font face="MS Sans Serif" color="#FF0000" size="2">ใช้ตัวเลข 
      0-9 หรืออักษรภาษาอังกฤษ
        <span lang="en-us">a-z </span>เท่านั้น) </font><b>
      <font face="MS Sans Serif" size="2">เหมือนกับครั้งแรก</font></b></td>
    </tr>
  </table>
  <br>
  <input type="submit" value="ส่งข้อมูล" >&nbsp;<input type="reset" value="ตั้งค่าใหม่" >&nbsp;  <input type="button" value="กลับหน้าหลัก" onClick="window.location='<?=$goback?>'">
     </form></center>
</div>
 <center>
<? include "include/footer.html" ;?>
	</center>
<? } else {
?>
<center><h2><font color="#800000">เปลี่ยนรหัสผ่านใหม่ สำหรับงานสารบรรณ</font></h2></center>
&nbsp;</b></font></div>
<div align="center">
  <center>
  <table border="0" cellpadding="3" style="border-collapse: collapse" bordercolor="#111111" width="800">
    <tr>
      <td width="242" align="right">&nbsp;</td>
      <td width="558">
      <form method="POST" action="changepwd.php" autocomplete="off">
   
<input type="hidden" name="name" size="40" value="<?=$name?>"><input type="hidden" name="officenumber" size="31" value="<?=$officenumber?>"><input type="hidden" name="position" size="40" value="<?=$position?>"><input type="hidden" name="privateno" size="31" value="<?=$privateno?>"></td>
    </tr>
    <tr>
      <td width="242" align="right"><b><font color="#000080">พิมพ์รหัสลับที่เคยตั้งไว้</font></b></td>
      <td width="558"><input type="text" name="code" size="31"><span lang="en-us">
      </span><font color="#FF0000">(</font><font face="MS Sans Serif" color="#FF0000" size="2">ใช้ตัวเลข 
      0-9 หรืออักษรภาษาอังกฤษ
        <span lang="en-us">a-z </span>เท่านั้น)</font></td>
    </tr>
    <tr>
      <td width="242" align="right">
      <p align="right"><b><font color="#000080"><span lang="en-us">Password
      </span>ใหม่</font></b></td>
      <td width="558"><input type="text" name="newpass" size="31">
      <font color="#FF0000">(</font><font face="MS Sans Serif" color="#FF0000" size="2">ใช้ตัวเลข 
      0-9 หรืออักษรภาษาอังกฤษ
        <span lang="en-us">a-z </span>เท่านั้น)</font></td>
    </tr>
    <tr>
      <td width="242" align="right">
      <p align="right"><b><font color="#000080">กรอก<span lang="en-us"> Password
      </span>ใหม่ อีกครั้ง</font></b></td>
      <td width="558"><input type="text" name="newpass2" size="31">
      <font color="#FF0000">(</font><font face="MS Sans Serif" color="#FF0000" size="2">ใช้ตัวเลข 
      0-9 หรืออักษรภาษาอังกฤษ
        <span lang="en-us">a-z </span>เท่านั้น) </font><b>
      <font face="MS Sans Serif" size="2">เหมือนกับครั้งแรก</font></b></td>
    </tr>
  </table>
  <br>
  <input type="submit" value="ส่งข้อมูล" >&nbsp;<input type="reset" value="ตั้งค่าใหม่" >&nbsp; <input type="button" value="กลับหน้าหลัก" onClick="window.location='<?=$goback?>'">
     </form></center>
</div>

 <center>
<? include "include/footer.html" ;?>
	</center>

<?
}
?>