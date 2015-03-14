<?php
session_start();

$htmlLogin = <<<STR
<form class="navbar-form navbar-right" method="post" action="chklogin.php">
  <ul class="nav navbar-nav navbar-right">
    <li><input type="text" name="txtUser" class="form-control" placeholder="Username">&nbsp</li>
    <li><div class="input-group">
     <input input type="password" name="txtPass" class="form-control" placeholder="Password">
     <span class="input-group-btn">
      <button class="btn btn-info" type="submit" value="Login">LOGIN</button>
    </span>
  </ul>
</form>
STR;



?>



<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
	<script src="js/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="css/_bootswatch.scss">
	<link rel="stylesheet" href="css/_variables.scss">

	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.min.js"></script>
</head>

<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">HELPDESK</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <?php
          if(!isset($_SESSION["login"]))
          {
          }
          else {echo $_SESSION["login"]["navbar"];}
          ?>
          <li><a href="#">About US</a></li>
        </ul>
        <?php
        if(!isset($_SESSION["login"]))
        {
          echo $htmlLogin;
        }
        else 
        {
          echo 
          "<form action=\"logout.php\">
          <ul class=\"nav navbar-nav navbar-right\">
            <li><p class=\"navbar-text\">Hello , ".$_SESSION["login"]["empName"]."</p></li>
            <li><button class=\"btn btn-danger navbar-btn\" type=\"submit\" value=\"logout\">LOGOUT</button></li>
          </ul>
        </form>";
      }
      ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div class="row">
  <div class="col-sm-3 col-sm-offset-1 col-md-1 col-md-offset-1 btn-group-vertical" role="group">
    <div class="btn-group" role="group">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
       Windows
       <span class="caret"></span>
     </button>
     <ul class="dropdown-menu" role="menu">
       <li><a href="#">Problem 1</a></li>
       <li><a href="#">Problem 2</a></li>
     </ul>
   </div>

   <div class="btn-group" role="group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
     Program
     <span class="caret"></span>
   </button>
   <ul class="dropdown-menu" role="menu">
     <li><a href="#">Problem 1</a></li>
     <li><a href="#">Problem 2</a></li>
   </ul>
 </div>
</div>


<div class="col-sm-6 col-md-8 col-md-pull1 jumbotron">
 <h3>
  วิธีใช้โปรแกรม PSR (Problem Steps Recorder)</h3>
  <ol>
    <li>
      กดปุ่ม Start</li>
      <li>
        พิมพ์คำว่า PSR ในช่อง Search</li>
        <li>
          เลือกโปรแกรมที่แสดงไว้</li>
          <li>
            จะมีหน้าต่างปรากฏ คล้ายการบันทึกไฟล์เสียงหรือวีดีโอ</li>
            <li>
              กดปุ่ม &quot;Start Recrod&quot; เพื่อเริ่มบันทึกขั้นตอนก่อนปัญหาที่เกิด จนกระทั่งเกิดปัญหา</li>
              <li>
                กดปุ่ม &quot;Stop Record&quot; เมื่อบันทึกขั้นตอนเสร็จแล้ว</li>
                <li>
                  หลังกดปุ่ม Stop Record จะพบหน้าต่างให้บันทึกไฟล์ในรูปแบบของ .ZIP</li>
                  <li>
                    ส่งไฟล์ ZIP ที่ได้ไปให้บุคคลที่เราต้องการให้เขาช่วยเหลือ</li>
                  </ol>
                  <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
                </div>

              </div>






            </div>
          </body>
          </html>