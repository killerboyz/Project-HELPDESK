<?php
session_start();
require "../function/function.php";
include "../function/database.php";
require '../function/email/PHPMailerAutoload.php';

$mysql = mysqlConnect();

if($_POST["pwdtoconfirm"] != $_SESSION["login"]["pwd"])
{
	echo "<script>
		alert('Please type your correct Password!');
		window.history.back();</script>";
	exit();
	
}

if (!filter_var($_POST["txtempEmail"], FILTER_VALIDATE_EMAIL)) 
{
	echo "<script>
		alert('Please input Correct E-mail (example : email@example.com)');
		window.history.back();</script>";
	exit();
}

$strUpdate = "UPDATE 
					emp 
				SET 
					empName='".$_POST["txtempName"]."',
					password='".$_POST["txtPassword"]."', 
					empEmail='".$_POST["txtempEmail"]."', 
					empTel='".$_POST["txtempTel"]."',
					Class='".$_POST["Class"]."'
				WHERE 
					empID='".$_POST["txtempID"]."'";
$mysql->query($strUpdate);

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'project.helpdesk.siam@gmail.com';                   // SMTP username
$mail->Password = 'HELPDESK2015';               // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
$mail->setFrom('project.helpdesk.siam@gmail.com', 'PROJECT HELPDESK');     //Set who the message is to be sent from
$mail->addAddress($_POST["txtempEmail"], $_POST["txtempName"]);  // Add a recipient
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Your Account of HELPDESK SERVICE has been Update Successfully';
$mail->Body    = '<h1><strong><span style="color:#0000FF;">Your Account has been Create Succesfully</span></strong></h1>

					<hr />
					<ul>
						<li>
							<h3><span style="color:#008080;">Employee ID : '.$mysql->insert_id.'</span></h3>
						</li>
						<li>
							<h3><span style="color:#008080;">Username : '.$_POST["txtUsername"].'</span></h3>
						</li>
						<li>
							<h3><span style="color:#008080;">Password : '.$_POST["txtPassword"].'</span></h3>
						</li>
						<li>
							<h3><span style="color:#008080;">Employee Name : '.$_POST["txtempName"].'</span></h3>
						</li>
						<li>
							<h3><span style="color:#008080;">Employee E-mail : '.$_POST["txtempEmail"].'</span></h3>
						</li>
						<li>
							<h3><span style="color:#008080;">Employee Tel : '.$_POST["txtempTel"].'</span></h3>
						</li>
						<li>
							<h3><span style="color:#008080;">Class : '.$_POST["Class"].'</span></h3>
						</li>
					</ul>

					<hr />
					<h2><span style="color:#FF8C00;">Your Account has been Update By : '.$_SESSION["login"]["empName"].'</span></h2>

					<p><strong>If you have any problem , Please tell us.</strong></p>';


if(!$mail->send()) {
	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
	exit;
}

?>


<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>UPDATE USER SUCCESS</title>
	<script src="../js/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="../css/_bootswatch.scss">
	<link rel="stylesheet" href="../css/_variables.scss">

	<!-- Latest compiled and minified JavaScript -->
	<script src="../js/bootstrap.min.js"></script>
	<script>
		function mouseoverPass(obj) 
		{
			var obj = document.getElementById('txtPassword');
			obj.type = "text";
		}
		function mouseoutPass(obj)
		{
			var obj = document.getElementById('txtPassword');
			obj.type = "password";
		}
	</script>

</head>

<body>

	<?php navbar();?>

	<!-- ---------------------------------------------------------------------------------------------------------------- NAVIGATOR BAR --------------------------------------------------------------------------------- -->

	<div class="container">
		<div class="row">
			<div class="alert alert-dismissible alert-success">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Well done!</strong> You Update User Successfully.
			</div>
		</div>
	</div>


	<div class="container">
		<div class="row">
			<div class="panel panel-info">
				<div class="panel-heading">User Detail</div>
				<div class="panel-body">

					<div class="row">
						<div class="col-xs-8 col-sd-offset-1 col-sd-5 col-md-offset-1 col-md-4">
							<label class="control-label" for="User ID">User ID</label>
							<text class="form-control" readonly disable=""><?php echo htmlspecialchars($_POST['txtempID']);?></text>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1">
							<label class="control-label" for="username">Username</label>
							<text class="form-control" readonly disable=""><?php echo htmlspecialchars($_POST['txtUsername']);?></text>
						</div>
						<div class="col-xs-4">
							<label class="control-label" for="password">Password</label>
							<input class="form-control" type="password" name="txtPassword" id="txtPassword" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();" value="<?php echo htmlspecialchars($_POST['txtPassword']);?>" readonly disable="">
						</div>
					</div>

					<div class="row">
						<div class="col-xs-8 col-sd-offset-1 col-sd-5 col-md-offset-1 col-md-4">
							<label class="control-label" for="txtempName">Employee Name</label>
							<text class="form-control" readonly disable=""><?php echo htmlspecialchars($_POST['txtempName']);?></text>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-8 col-sd-offset-1 col-sd-5 col-md-offset-1 col-md-4">
							<label class="control-label" for="txtempEmail">Employee Email</label>
							<text class="form-control" readonly disable=""><?php echo htmlspecialchars($_POST['txtempEmail']);?></text>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-8 col-sd-offset-1 col-sd-5 col-md-offset-1 col-md-4">
							<label class="control-label" for="txtempTel">Employee Telephone</label>
							<text class="form-control" readonly disable=""><?php echo htmlspecialchars($_POST['txtempTel']);?></text>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-8 col-sd-offset-1 col-sd-5 col-md-offset-1 col-md-4">
							<label class="control-label" for="Class">Class</label>
								<text class="form-control" readonly disable=""><?php echo htmlspecialchars($_POST['Class']);?></text>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="row center-block">
				<a class="center-block btn btn-primary btn-lg" href="../index.php">Back to Home</a>
			</div>

		</div>
	</body>
	</html>