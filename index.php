<?php
session_start();
require "/function/function.php";

$htmlLogin = <<<STR
<form class="navbar-form navbar-right" method="post" action="/function/chklogin.php">
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

<?php navbar();?>

<!-- ---------------------------------------------------------------------------------------------------------------- NAVIGATOR BAR --------------------------------------------------------------------------------- -->

<div class="row">
  <div class="col-sm-3 col-sm-offset-1 col-md-1 col-md-offset-1 btn-group-vertical" role="group">
    <div class="btn-group" role="group">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
       Hardware
       <span class="caret"></span>
     </button>
     <ul class="dropdown-menu" role="menu">
       <li><a href="#">Problem 1</a></li>
       <li><a href="#">Problem 2</a></li>
     </ul>
   </div>

   <div class="btn-group" role="group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
     Software
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