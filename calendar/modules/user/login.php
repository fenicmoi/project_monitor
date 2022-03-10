						 
<div class="row">
	<div class="col-md-4 col-sm-6 col-xs=12">
	</div>
	<div class="col-md-4 col-sm-6 col-xs=12">
		<div class="well">
			<div id='fLogin'  class='flogin' >
				<body id='login' onload='javascript:document.loginForm.username.focus();'>
				<center><h3>เข้าสู่ระบบ</h3></center>
				<form METHOD="POST" name="loginForm" id="loginForm" ACTION="#" onsubmit="return login_check()">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input  type="text" class="form-control" id="username" name="username"  placeholder="Username">
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input name="passwd" type="password" class="form-control"name="passwd" placeholder="Password">
					</div>
					<div class="form-group">
						<label for="capcha">รหัสลับ:</label>
						<img src="capcha/CaptchaSecurityImages.php?width=100&height=25&characters=5"  align="absmiddle"/>
					</div>
					<div class="input-group">
						<span class="input-group-addon">รหัสลับ</span>
						<input type="text" class="form-control" name="security_code" id="security_code" placeholder="ระบุสิ่งที่เห็น">
					</div>
					<br>
					<center><input class="btn btn-primary" type="submit" value="เข้าสู่ระบบ"></center>
				</form>
				</body>
		</div> 
	</div>
	<div class="col-md-4 col-sm-6 col-xs=12">
	</div>
</div>



							


