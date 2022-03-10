

<!DOCTYPE html>
<html>
    
<head>
	<title><?php echo"เข้าสู่ระบบ"._NAME ;?></title>
	<meta charset="UTF-8">
<?php include "header.php";?>
<link rel="stylesheet" href="login.css">
</head>
<!--Coded with love by Mutiullah Samim-->
<?php   
include "lang-thai.php" ;
include "library/database.php";

?>
<script>
	function check(){
		var v1 = document.memberLogin.username.value;
		var v2 = document.memberLogin.password.value;
		if(v1.length==0){
			alert('กรุณาระบุชื่อผู้ใช้งาน');
			document.memberLogin.username.focus();
			return false;
		}else if(v2.length==0){
			alert('กรุณาระบุรหัสผ่าน');
			document.memberLogin.password.focus();
			return false;
		}else{
			return true;
		}
	}
</script>
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="images/logo-2.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form method="POST" name="memberLogin" action="login.php" onsubmit="return check()">
						<div class="form-label">ระบบรับ-ส่งเอกสารจังหวัดพัทลุง</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" class="form-control input_user" value="" placeholder="username">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass" value="" placeholder="password">
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Remember me</label>
							</div>
						</div>
							<div class="d-flex justify-content-center mt-3 login_container">
					<INPUT TYPE="hidden" name="referer" value="<?php echo $referer?>">
					<input type="submit" name="btnLogin" id="btnLogin" class="btn login_btn" value="Login">
				 	<!-- <button type="button" name="button" class="btn login_btn">Login</button> -->
				   </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Don't have an account? <a href="#" class="ml-2">Sign Up</a>
					</div>
					<div class="d-flex justify-content-center links">
						<a href="#">Forgot your password?</a>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php
if($_POST['btnLogin']){
	$username1 = $_POST ['username'] ;
	$password1 = $_POST ['password'] ;
	$sql = "select * from user where username='$username1' and password='$password1' " ;
	$result = dbQuery($sql);
	$num = dbNumRows($result);
	$r = dbFetchArray($result);
	$status = $r['status'];
	if($num <= 0){
	echo "<script> alert('ไม่พบข้อมูล')</script>";
	}else{
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
</body>
</html>