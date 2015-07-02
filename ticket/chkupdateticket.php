<?php
session_start();
require "../function/function.php";
include "../function/database.php";
require '../function/email/PHPMailerAutoload.php';

if(htmlspecialchars($_POST['txtPassword']) != $_SESSION["login"]["pwd"])
{
	echo "<script>
		alert(\"Please type Your Password !!\");
		window.location.hostname;
		</script>";
	exit();
}

if($_POST["txtUpdateDetail"] == null )
{
	echo "<script>
		alert(\"Please Update !!\");
		window.location.hostname;
		</script>";
	exit();
}

$mysql = mysqlConnect();
$textbreak = "<br/>

**************************<br/>
";

$textfoot = "<br/>

Support On : ".date("Y-m-d H:i:s",time())." By : ".$_SESSION['login']['empName'];

$strUpdate = "UPDATE 
					ticket 
				SET 
					TroubleDetail=concat(TroubleDetail, '".htmlspecialchars($textbreak,ENT_HTML5).htmlspecialchars($_POST["txtUpdateDetail"],ENT_HTML5).$textfoot."'),
					Support_On='".date("Y-m-d H:i:s",time())."', 
					Support_By='".$_SESSION["login"]["empID"]."', 
					Status='".$_POST["status"]."'
				WHERE 
					TicketID='".$_POST["tickID"]."'";

$mysql->query($strUpdate);

$objResult = mysqli_fetch_assoc($mysql->query("SELECT 
													T.TicketID,
													T.TicketTopic,
													T.TicketType,
													T.TroubleDetail,
													T.Priority,
													T.psrPath,
													T.Create_On,
													E1.empName AS Create_By,
													E1.empEmail AS empEmail,
													E1.empTel AS empTel,
													T.Support_On,
													E2.empName AS Support_By,
													T.Status
												FROM
													ticket AS T
												INNER JOIN 
													emp AS E1
												ON 
													T.Create_By = E1.empID
												LEFT JOIN
													emp AS E2
												ON 
													T.Support_By = E2.empID
												WHERE
			TicketID='".$_POST['tickID']."'"));

if($_POST["status"] != "Open")
{
	$mail = new PHPMailer;
	
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'project.helpdesk.siam@gmail.com';                   // SMTP username
	$mail->Password = 'HELPDESK2015';               // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
	$mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
	$mail->setFrom('project.helpdesk.siam@gmail.com', 'PROJECT HELPDESK');     //Set who the message is to be sent from
	//$mail->addReplyTo('email@domain.com', 'First Last');  //Set an alternative reply-to address
	$mail->addAddress($objResult["empEmail"], $objResult["Create_By"]);  // Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional
	//$mail->addCC('email@domain.com', 'First Last');
	//$mail->addBCC('bcc@example.com');
	//$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	//$mail->addAttachment('/usr/labnol/file.doc');         // Add attachments
	//$mail->addAttachment('/images/image.jpg', 'new.jpg'); // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML
	
	$mail->Subject = 'Your Trouble is '.$objResult["Status"].' (Ticket ID : '.$objResult["TicketID"].')';
	$mail->Body    = '<h1><span style="color:#FF0000;"><strong>Your Trouble is '.$objResult["Status"].'.</strong></span></h1>

	<p>&nbsp;</p>

	<ul>
		<li>
			<h3><strong><span style="background-color:#00FFFF;">Ticket ID :</span></strong></h3>'.$objResult["TicketID"].'
		</li>
		<li>
			<h3><strong><span style="background-color:#00FFFF;">Ticket Topic :</span></strong></h3>'.$objResult["TicketTopic"].'
		</li>
		<li>
			<h3><strong><span style="background-color:#00FFFF;">Trouble Detail :</span></strong></h3>'.htmlspecialchars_decode($objResult["TroubleDetail"],ENT_HTML5).'
		</li>
		<li>
			<h3><strong><span style="background-color:#00FFFF;">Suppory On&nbsp;:</span></strong></h3>'.$objResult["Support_On"].'
		</li>
		<li>
			<h3><strong><span style="background-color:#00FFFF;">Support By&nbsp;:</span></strong></h3>'.$objResult["Support_By"].'
		</li>
	</ul>

	<hr />
	<h2><strong><span style="background-color:#FFA07A;">This Ticket Create On</span></strong> :</h2>'.$objResult["Create_On"].'

	<p>&nbsp;</p>

	<h3><strong>If you have any problem , Please tell us.</strong></h3>

	<p>&nbsp;</p>

	<p>&nbsp;</p>
	';
	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
	
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		exit;
	}

}




?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>UPDATE TICKET SUCCESS</title>
	<script src="../js/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="../css/_bootswatch.scss">
	<link rel="stylesheet" href="../css/_variables.scss">

	<!-- Latest compiled and minified JavaScript -->
	<script src="../js/bootstrap.min.js"></script>
</head>

<body>

	<?php navbar();?>

	<!-- ---------------------------------------------------------------------------------------------------------------- NAVIGATOR BAR --------------------------------------------------------------------------------- -->

	<div class="container">
		<div class="row">
			<div class="alert alert-dismissible alert-success">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Well done!</strong> Update Successful.
			</div>
		</div>
	</div>


	<div class="container">
		<div class="row">
			<div class="panel panel-info">
				<div class="panel-heading">Ticket Detail</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
								<label class="control-label" for="TicketID">Ticket ID</label>
								<text class="form-control" readonly disable=""><?php echo $_POST['tickID'];?></text>
							</div>
							<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
								<label class="control-label" for="TicketTopic">Ticket Topic</label>
								<text class="form-control" readonly disable=""><?php echo htmlspecialchars_decode($objResult['TicketTopic'],ENT_HTML5);?></text>

							</div>
						</div>

						<div class="row">
							<div class="col-xs-10 col-sd-offset-1 col-sd-11 col-md-offset-1 col-md-9">
								<label class="control-label" for="TroubleDetail">Trouble Detail</label>
								<textarea class="form-control" rows="10" style="resize: none;"readonly disabled><?php echo $objResult["TroubleDetail"];?></textarea>
							</div>
						</div>

						<div class="row">
							

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