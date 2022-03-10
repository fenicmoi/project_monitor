<?php
include "lang-thai.php" ;
$username1 = $_POST ['username'] ;
$password1 = $_POST ['password'] ;

if ($username1 == "" or $password1 == "" ) {
$referer = $_SERVER["HTTP_REFERER"] ; 
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="include/sujane_style.css" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<title><?php echo"ระบบรับ-ส่งหนังสือ"._NAME ;?></title>
</head>

<body OnLoad="document.memberLogin.username.focus();">

<script language="JavaScript">
function check()
{
      var v1 = document.memberLogin.username.value;
      var v2 = document.memberLogin.password.value;
      
        if ( v1.length==0)
           {
           alert("��سҡ�͡ Username");
           document.memberLogin.username.focus();           
           return false;
           }
        else if (v2.length==0)
           {
          alert("��سҡ�͡ Password");
           document.memberLogin.password.focus();    
           return false;
           }
        else
           return true;
}


function open_windows(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

//-->
</script>
<?php include "include/comment.php" ;?>
<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="#">Action 1</a>
                    <a class="dropdown-item" href="#">Action 2</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
         <h3 class="display-5">ระบบรับ-ส่ง เอกสารจังหวัดพัทลุง</h3>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
    <form  method="POST" autocomplete="off" name="memberLogin" action="login.php" onsubmit="return check()">
        <div class="form-group">
          <label for=""></label>
          <input type="text" name="username" id="username" class="form-control" placeholder="ระบุ username" aria-describedby="helpId">
          <small id="helpId" class="text-muted">Username</small>
        </div>
        <div class="form-group">
          <label for=""></label>
          <input type="text" name="password" id="password" class="form-control" placeholder="ระบุ password" aria-describedby="helpId">
          <small id="helpId" class="text-muted">Password</small>
        </div>
    <INPUT TYPE="hidden" name="referer" value="<?php echo $referer?>">
    <input class="btn btn-primary" type="submit" value="ตกลง">
    <input class="btn btn-primary" type="reset" value="ล้าง" name="B2">
    </div>
    </form>
    
    <div class="col-md-4"></div>
  </div>
</div>


 <center>
�����ҹ�ӹǹ&nbsp;<? include "counter/counter.php" ;?>&nbsp;���� 
	</center>
 <center>
<?php include "include/footer.php" ;?>
	</center>

		
</body>
</html>

<?php

} else {
$referer = $_POST ['referer'] ;
if ($referer=="") {
	$referer = $_SERVER["HTTP_REFERER"] ; 
}


//include "referer/referer.php" ;
include "library/database.php" ;
$sql = "select * from user where username='$username1' and password='$password1' " ;
$result = dbQuery ($sql) ;
$num = dbNumRows ($result) ;
$r = dbFetchArray($result) ;
$status = $r ['status'] ;


if ($num<=0) {
?>
<html>

<head>
<meta http-equiv="Content-Language" content="th">
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link rel="stylesheet" href="include/sujane_style.css" type="text/css">
	
<title><?php echo "เข้าสู่ระบบ"._NAME ;?></title>
</head>

<body OnLoad="document.memberLogin.username.focus();">
<?php include "include/comment.php" ;?>

<h3 align="center"><font color="#FF0000"><span lang="en-us">&nbsp;</span></font></h3>

  <DIV align="center">
    <CENTER>
  <table border="3" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="747" id="AutoNumber1" bordercolorlight="#6699FF" bordercolordark="#0099CC" height="45" bgcolor="#D5E2FF">
    <tr>
      <td width="741" height="45">
      <p align="center"><FONT color="#0000FF">
      <SPAN style="font-size: 19pt; font-weight: 700">+:+: 
      <?php echo"ยินดีต้อนรับ"._NAME ;?> :+:+</SPAN></FONT></td>
    </tr>
  </table>
    </CENTER>
</DIV>

<h3 align="center"><font color="#800080" style="font-size: 14pt"><B><SPAN lang="en-us">&nbsp;
<IMG border="0" src="image/new4.gif" width="28" height="11">
</SPAN></B></FONT><font color="#FF0000"><span lang="en-us">Error !!&nbsp; Username
</span>���� <span lang="en-us">Password </span>���١��ͧ<SPAN lang="en-us">
</SPAN>��سҾ��������</font><font color="#800080"><IMG border="0" src="image/i_new2.gif" width="30" height="11"></font></h3>

  <center>
  <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" width="400" bordercolor="#C0C0C0">
    <form method="POST"  name="memberLogin" action="login.php" autocomplete="off" onsubmit="return check()">
     <tr>
      <td width="228" align="right"><font color="#008080"><b><span lang="en-us">Username</span></b></font></td>
      <td width="343">
      <input type="text" name="username" size="19" style="color: #FF00FF; border: 1px groove #808000; background-color: #D5E2FF"></td>
    </tr>
    <tr>
      <td width="228" align="right"><font color="#008080"><b><span lang="en-us">Password</span></b></font></td>
      <td width="343">
      <input type="password" name="password" size="19" style="color: #FF00FF; border: 1px groove #808000; background-color: #D5E2FF"></td>
    </tr>
        <INPUT TYPE="hidden" name="referer" value="<?=$referer?>">

  </table>
 <br>
    <input type="submit" value="�������к�">
    <input type="reset" value="���������" name="B2">
</center>
</form>
	 <center>
�����ҹ�ӹǹ&nbsp; <?php include "counter/counter.php" ;?>&nbsp;���� 
	</center>
 <center>
<?php include "include/footer.php" ;?>
	</center>
		<script language="JavaScript">
function check()
{
      var v1 = document.memberLogin.username.value;
      var v2 = document.memberLogin.password.value;
      
        if ( v1.length==0)
           {
           alert("��سҡ�͡ Username");
           document.memberLogin.username.focus();           
           return false;
           }
        else if (v2.length==0)
           {
          alert("��سҡ�͡ Password");
           document.memberLogin.password.focus();    
           return false;
           }
        else
           return true;
}


function open_windows(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

//-->
</script>
</body>

</html>
<?php
} else {


session_start ( ) ;
ob_start();
$_SESSION ['sess_userid'] = session_id ( ) ;
$_SESSION ['sess_username'] = $username1 ;
If ($status=="public") {
	header ("Location:index2.php") ;
} else {
	header ("Location:index.php") ;
}
}
}
?>
