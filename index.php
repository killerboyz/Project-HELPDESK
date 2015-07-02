<?php
session_start();
require "/function/function.php";

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



  <div class="container">
    <?php
    
    if(!empty($_SESSION["login"]))
    {
      echo '<div class="row">
              <div class="btn-group btn-group-justified">
                <a href="#" class="btn btn-success">Click for Chat</a>

                <a href="#" class="btn btn-info">Click for Open VNC Client</a>
              </div>
            </div>
            <hr/>';
    }
    ?>
    <div class="row">
      <div class="col-sm-12 col-md-12 jumbotron">
       <h3>วิธีใช้โปรแกรม PSR (Problem Steps Recorder)</h3>
       <ol>
        <li>กดปุ่ม Start</li>
        <li> พิมพ์คำว่า PSR ในช่อง Search</li>
        <li>เลือกโปรแกรมที่แสดงไว้</li>
        <li>จะมีหน้าต่างปรากฏ คล้ายการบันทึกไฟล์เสียงหรือวีดีโอ</li>
        <li>กดปุ่ม &quot;Start Recrod&quot; เพื่อเริ่มบันทึกขั้นตอนก่อนปัญหาที่เกิด จนกระทั่งเกิดปัญหา</li>
        <li>กดปุ่ม &quot;Stop Record&quot; เมื่อบันทึกขั้นตอนเสร็จแล้ว</li>
        <li>หลังกดปุ่ม Stop Record จะพบหน้าต่างให้บันทึกไฟล์ในรูปแบบของ .ZIP</li>
        <li>ส่งไฟล์ ZIP ที่ได้ไปให้บุคคลที่เราต้องการให้เขาช่วยเหลือ</li>
      </ol>
      <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
    </div>
  </div>
</div>

</body>
</html>