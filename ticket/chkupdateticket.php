<?php
session_start();
require "../function/function.php";
include "../config/database.php";

if(htmlspecialchars($_POST['chkPassword']) != $_SESSION["login"]["pwd"])
{
	echo "<script>
		alert(\"Please type Your Password !!\");
		window.history.back();
		</script>";
	exit();
}

if($_POST["txtUpdateDetail"] == null )
{
	echo "<script>
		alert(\"Please Update !!\");
		window.history.back();
		</script>";
	exit();
}

$mysql = mysqlConnect();
$textbreak = "

**************************
";

$textfoot = "

".$_SESSION['login']['empName']."  ".date("Y-m-d H:i:s",time());

$strUpdate = "UPDATE 
					ticket 
				SET 
					TroubleDetail=concat(TroubleDetail, '".$textbreak.$_POST["txtUpdateDetail"].$textfoot."'),
					Support_On='".date("Y-m-d H:i:s",time())."', 
					Support_By='".$_SESSION["login"]["empID"]."', 
					Status='".$_POST["status"]."'
				WHERE 
					TicketID='".$_POST["tickID"]."'";

$mysql->query($strUpdate);

$objResult = mysqli_fetch_assoc($mysql->query("SELECT * FROM ticket WHERE TicketID='".$_POST['tickID']."'"));



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
								<text class="form-control" readonly disable=""><?php echo htmlspecialchars($_POST['tickID']);?></text>
							</div>
							<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
								<label class="control-label" for="TicketTopic">Ticket Topic</label>
								<text class="form-control" readonly disable=""><?php echo htmlspecialchars($objResult['TicketTopic']);?></text>

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