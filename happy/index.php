<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>ถวายพระพรออนไลน์</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script src="script/jquery-1.3.2.min.js" type="text/javascript" language="javascript"> </script>
    <script language="JavaScript" type="text/javascript">
        function select_(i) {
            document.getElementById("showimg").src = document.getElementById("img" + i).src;
            document.form1.imag.value = i;
            document.form2.imag2.value = i;
        }

        function check() {
            //	var age= document.getElementById("age").getAttribute('value');
            //	var province= document.getElementById("province").getAttribute('value');
            var f = document.form1;
            l = f.name.value.length;
            if (l == 0) {
                alert("กรุณาใส่ ชื่อ นามสกุล");
                event.returnValue = false;
                event.cancelBubble = true;
                f.name.focus();
            }
            else {
                f.submit();
                //	alert("บันทึกคำถวายพระพร เรียบร้อยแล้ว");
            }

            /*
                var idx=document.getElementById("msg");
                var v=document.getElementById("msg").getAttribute('value');
                alert('id='+ idx.selectedIndex +" v="+ v);
            */
        }

        function check2() {
            var f = document.form1;
            var g = document.form2;
            l = f.name.value.length;
            if (l == 0) {
                alert("กรุณาใส่ ชื่อ นามสกุล");
                event.returnValue = false;
                event.cancelBubble = true;
                f.name.focus();
            }
            else {
                document.form2.msg2.value = document.form1.msg.value;
                document.form2.name2.value = document.form1.name.value;
                g.submit();
            }
        }
    </script>
    <script language="JavaScript" type="text/JavaScript">




    function MM_preloadimage() { //v3.0
        var d = document; if (d.image) {
            if (!d.MM_p) d.MM_p = new Array();
            var i, j = d.MM_p.length, a = MM_preloadimage.arguments; for (i = 0; i < a.length; i++)
                if (a[i].indexOf("#") != 0) { d.MM_p[j] = new Image; d.MM_p[j++].src = a[i]; }
        }
    }
   
    </script>
    <link href="sty_text.css" rel="stylesheet" type="text/css">

  

<style type="text/css">

body {
	background-color: #e4e3bb;
}
.style1 {
	color: #FF0000;
	font-weight: bold;
}

</style></head>

<body>



    <form name="form1" method="post" action="postmsg.php">
        <input name="imag" type="hidden" value="7" id="imag">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td background="image/be_head_02.jpgs">&nbsp;</td> <!-- bg head left -->
                <td width="955">
                    <img src="image/head.jpeg" width="955" height="203"></td>
                <td background="image/bg_head_02.jpg">&nbsp;</td> <!-- bg head right -->
            </tr>
            <tr>
                <td background="">&nbsp;</td> <!-- bg bottom main left -->
                <td>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" background=""> <!-- bg center -->
                        <tr>
                            <td width="52%" height="322" valign="top">
                                <table width="472" border="0" align="center" cellpadding="0" cellspacing="0">

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="image/sq_top_08.jpg" width="12" height="15"></td>

                                        <td background="image/sq_top_10.jpg">
                                            <img src="image/sq_top_10.jpg" width="11" height="15"></td>

                                        <td>
                                            <img src="image/sq_top_12.jpg" width="13" height="15"></td>
                                    </tr>
                                    <tr>
                                        <td background="image/sq_mid_17.jpg">
                                            <img src="image/sq_mid_17.jpg" width="12" height="12"></td>
                                        <td width="450" bgcolor="#e9e9d6">
                                            <table width="85%" border="0" align="center" cellpadding="4" cellspacing="0">
                                                <tr>
                                                    <td align="center">
                                                        <table width="120" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td height="80" align="center" >
                                                                    <img src="image/img1.jpeg" name="img1" width="140" height="100" border="0" id="img1" style='cursor: pointer' onclick='select_(1)'></td>
                                                            </tr>
                                                        </table>                                                    </td>
                                                    <td align="center">
                                                        <table width="120" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td height="80" align="center" >
                                                                    <img src="image/img2.jpeg" border="0" width="140" height="100" id="img2" style='cursor: pointer' onclick='select_(2)'></td>
                                                            </tr>
                                                        </table>                                                    </td>
                                                    <td align="center">
                                                        <table width="120" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td height="80" align="center" >
                                                                    <img src="image/img3.jpeg" border="0" width="140" height="100" id="img3" style='cursor: pointer' onclick='select_(3)'></td>
                                                            </tr>
                                                        </table>                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <table width="120" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td height="80" align="center" >
                                                                    <img src="image/img4.jpeg" border="0" width="140" height="100" id="img4" style='cursor: pointer' onclick='select_(4)'></td>
                                                            </tr>
                                                        </table>                                                    </td>
                                                    <td align="center">
                                                        <table width="120" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td height="80" align="center" >
                                                                    <img src="image/img5.jpeg" border="0" width="140" height="100" id="img5" style='cursor: pointer' onclick='select_(5)'></td>
                                                            </tr>
                                                        </table>                                                    </td>
                                                    <td align="center">
                                                        <table width="120" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td height="80" align="center" >
                                                                    <img src="image/img6.jpeg" border="0" width="140" height="100" id="img6" style='cursor: pointer' onclick='select_(6)'></td>
                                                            </tr>
                                                        </table>                                                    </td>
                                                </tr>

                                                <tr>
                                               <!--     <td align="center">
                                                        <table width="120" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td height="80" align="center" >
                                                                    </td>
                                                            </tr>
                                                        </table>
                                                    </td>-->
                                                  <td colspan="3" align="center" bgcolor="#e9e9d6"><table  border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td height="5" align="center" ><span class="style1">กรุณาเลือกพระบรมฉายาลักษณ์                                                              </span></td>
                                                    </tr>
                                                    </table>
                                                    <p>&nbsp;</p>
                                                    <p>&nbsp;</p>
                                                  <p><a href="https://web.ocsc.go.th/forking" target="_blank" ><img src="https://www.ocsc.go.th/sites/default/files/field/image/forking-create-02-tn.jpg" width="300" height="110" /></a><br>
                                                    <br>
                                                        <strong class="style1">ขอเชิญร่วมลงนามถวายสัตย์ปฏิญาณฯ ออนไลน์ </strong><br>
                                                  </p>
                                                  </td><!-- <td align="center">
                                                        <table width="120" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td height="80" align="center" >
                                                                    </td>
                                                            </tr>
                                                        </table>
                                                    </td>-->
                                                </tr>
                                            </table>

                                      </td>
                                        <td background="image/sq_mid_19.jpg">
                                            <img src="image/sq_mid_19.jpg" width="13" height="6"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="image/sq_bottom_21.jpg" width="12" height="13"></td>
                                        <td background="image/sq_bottom_22.jpg">
                                            <img src="image/sq_bottom_22.jpg" width="11" height="13"></td>
                                        <td>
                                            <img src="image/sq_bottom_23.jpg" width="13" height="13"></td>
                                    </tr>
                              </table>
                            </td>
                            <td width="48%" valign="top">
                                <table width="440" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="image/sq_top_08.jpg" width="12" height="15"></td>
                                        <td background="image/sq_top_10.jpg">
                                            <img src="image/sq_top_10.jpg" width="11" height="15"></td>
                                        <td>
                                            <img src="image/sq_top_12.jpg" width="13" height="15"></td>
                                    </tr>
                                    <tr>
                                        <td background="image/sq_mid_17.jpg">
                                            <img src="image/sq_mid_17.jpg" width="12" height="12"></td>
                                        <td width="440" height="265" valign="top" bgcolor="#e9e9d6">
                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" class="text">
                                                <tr>
                                                    <td colspan="2">
                                                        <img src="image/img1.jpeg" name="showimg" width="400" height="250" border="1" id='showimg'></td>
                                                </tr>
                                                <tr>
                                                    <td align="left">เลือกข้อความ</td>
                                                    <td>
                                                        <label>
                                                            <input id='01' type='radio' name='msg' value='01' checked><label for='01'>ขอพระองค์ทรงพระเจริญ</label><br><input id='02' type='radio' name='msg' value='02' ><label for='02'>ขอพระองค์ทรงพระเจริญยิ่งยืนนาน</label><br><input id='03' type='radio' name='msg' value='03' ><label for='03'>ขอพระราชทานถวายพระพรชัยมงคล ขอพระองค์ทรงพระเจริญ</label><br>                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>ชื่อ - นามสกุล</td>
                                                    <td>
                                                        <label>
                                                            <input id="name" name="name" type="text" size='35' maxlength='50'>
                                                        </label>
                                                    </td>
                                                </tr>

                                              
                                                <tr>
                                                    <td colspan="2" align="center">
                                                        <label>
                                                            <input name="button1" type="button" value="ลงนามถวายพระพร" onClick="check();">
                                                        </label>
    </form></br>
    <form method="post" action="print.php" style="display: inline-block" name="form2" target="_blank">
      <label>
            <input type="hidden" name="imag2" value="" id="imag2" />
            <input type="hidden" name="msg2" value="" id="msg2" />
            <input type="hidden" name="name2" value="" id="name2" />
      </label>
    </form>
    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        <marquee height="72" direction="up" onmouseover="stop();" onmouseout="start();" scrolldelay="300" class="text style2"><font color="#000000">
                        &nbsp;ขอพระองค์ทรงพระเจริญ ข้าพระพุทธเจ้า :: โรงบาลปล่อยเชื้อ ในรัฐบาล ...<br>&nbsp;ขอพระองค์ทรงพระเจริญ ข้าพระพุทธเจ้า :: เพราะต้องกราบกาลกินี แตดเน่าบ้านเมืองวุ่นวาย ...<br>&nbsp;ขอพระองค์ทรงพระเจริญ ข้าพระพุทธเจ้า :: กู เจี๊ยบสาวปลดแอกวิภาราม หวังฆ่าตู่เลยปล่อยเชื้อโ ...<br>&nbsp;ขอพระราชทานถวายพระพรชัยมงคล ขอพระองค์ทรงพระเจริญ ข้าพระพุทธเจ้า :: ข้าราชการ มว.ดย.มทบ.16 ...<br>&nbsp;ขอพระองค์ทรงพระเจริญยิ่งยืนนาน ข้าพระพุทธเจ้า :: นางรวมพร สุพรศิลป์ชัย ...<br>&nbsp;ขอพระองค์ทรงพระเจริญยิ่งยืนนาน ข้าพระพุทธเจ้า :: อดิเทพ มะลิทอง ...<br>&nbsp;ขอพระองค์ทรงพระเจริญยิ่งยืนนาน ข้าพระพุทธเจ้า :: ข้าราชการ มว.ดย.มทบ.16 ...<br>                    </td>
                </tr>
    <tr></tr>
    </table>
</td>
            <td background="image/sq_mid_19.jpg">
                <img src="image/sq_mid_19.jpg" width="13" height="6"></td>
    </tr>
          <tr>
              <td>
                  <img src="image/sq_bottom_21.jpg" width="12" height="13"></td>
              <td background="image/sq_bottom_22.jpg">
                  <img src="image/sq_bottom_22.jpg" width="11" height="13"></td>
              <td>
                  <img src="image/sq_bottom_23.jpg" width="13" height="13"></td>
          </tr>

    </table></td>
      </tr>
    
</table></td>
    <td background="">&nbsp;</td> <!-- bg main right -->
    </tr>
  <tr>
      <td background=""><br></td> <!-- bg bottom left -->
      <td>
          <img src="image/footer.jpeg" width="955" height="80">      </td>
      <td background="">&nbsp;</td> <!-- bg bottom right -->
  </tr>

    <tr>
        <td height="25" background="">&nbsp;</td> <!-- bg bottom center left -->
        <td background="">&nbsp;</td> <!-- bg bottom center  -->
        <td background="">&nbsp;</td> <!-- bg bottom center rtght-->

    </tr>
    </table>
    <div align="center"><font color="darkgreen" size="2"><b>จำนวนผู้ลงนามถวายพระพร&nbsp;<img src='image_number/0.gif'><img src='image_number/0.gif'><img src='image_number/0.gif'><img src='image_number/1.gif'><img src='image_number/7.gif'><img src='image_number/8.gif'><img src='image_number/8.gif'><img src='image_number/8.gif'>&nbsp;ครั้ง </font>    </div>
    <table width="100%">
      <tr></tr>
</table>

</body>

</html>
