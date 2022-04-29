<?php 
 include 'library/config.php';
 include 'library/database.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="ระบบงานบริหารโครงการจังหวัดพัทลุง">
    <meta name="author" content="นายสมศักดิ์  แก้วเกลี้ยง">
    <link rel="icon" href="images/favicon.png">
    <title><?php echo $title ?></title>

    <!-- popup -->
    <link rel="stylesheet" href="css/popup.css">

    <!-- datatable  -->
    
    <link rel="stylesheet" href="cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
    <link rel="stylesheet" href="css/loader.css"> 
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/text-hilight.js"></script>

    <link rel="stylesheet" href="css/fontawesome5.0.8/web-fonts-with-css/css/fontawesome-all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Taviraj" rel="stylesheet">
    <link rel="stylesheet" href="css/sweetalert.css">
    <script src="js/sweetalert.min.js"></script>   
 

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<style>
  body{
    font-family: 'Taviraj', serif;
    height:100%;
  }
</style>

  </head>
  <body>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-header">
           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
           </button>
            <img src="images/logo.png" class="navbar-brand" height="80" width="80">
            <a class="navbar-brand" href="index.php"><?php echo $title;
?></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav ">
              <li><a class="nav-link active"  href="index.php"><i class="fas fa-home"></i> หน้าแรก</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a class="btn btn-default"  data-toggle="modal" data-target="#myModal"><i class="fas fa-key"></i> เข้าสู่ระบบ </a></li>
            <li><i class="fas fa-key"></i></li>
          </ul>
    </nav>
      
<!-- Modal Login -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fas fa-user-secret"></i>เข้าสู่ระบบ</h4>
              </div>
              <div class="modal-body">
                  <form method="post" action="checkUser.php">
                      <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                          <input class="form-control" type="text" name="username" placeholder="username"  >
                      </div>
                      <br>
                      <div class="input-group">
                         <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                         <input class="form-control" type="password" name="password" placeholder="password"  >
                      </div>
                      <br>
                          <center><input type="submit" class="btn btn-success btn-lg" value="Login"/></center>
                  </form>
              </div>
              <div class="modal-footer bg-primary">
                <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
              </div>
            </div>
          </div>
        </div>
