<?php
session_start();
require "../function/function.php";
include "../function/database.php";

if($_POST['ChkConfirm'] != "ABC")
{
	echo "<script>
		alert(\"Please type ABC !!\");
		window.history.back();
		</script>";
	exit();
}


$mysql = mysqlConnect();
$strInsert = "INSERT INTO ticket (TicketTopic,TicketType,TroubleDetail,Priority,psrPath,Create_By)
VALUES ('".$_POST["txtTopic"]."','".$_POST["Type"]."','".$_POST["txtDetail"]."','".$_POST["priLvl"]."',NULL,".$_SESSION["login"]["empID"].")";
$mysql->query($strInsert);
$ticketID = $mysql->insert_id;
$psrPath = "psrFiles/psrOf_".$ticketID.".zip";




if(!empty($_FILES['psrUpload']['size']))
{
	global $psrPath;
	if(move_uploaded_file($_FILES["psrUpload"][0],$psrPath));
	$strUpdate = "UPDATE ticket SET psrPath='".$psrPath."' WHERE TicketID='".$ticketID."'";
	$mysql->query($strUpdate);
}






?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>CREATE TICKET SUCCESS</title>
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
				<strong>Well done!</strong> You Create Ticket Successfully.
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
								<text class="form-control" readonly disable=""><?php echo htmlspecialchars($ticketID);?></text>
							</div>
							<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
								<label class="control-label" for="TicketTopic">Ticket Topic</label>
								<text class="form-control" readonly disable=""><?php echo htmlspecialchars($_POST['txtTopic']);?></text>

							</div>
						</div>

						<div class="row">
							<div class="col-xs-10 col-sd-offset-1 col-sd-11 col-md-offset-1 col-md-9">
								<label class="control-label" for="TroubleDetail">Trouble Detail</label>
								<textarea class="form-control" rows="6" style="resize: none;"readonly disabled><?php echo htmlspecialchars($_POST['txtDetail']);?></textarea>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
								<label class="control-label" for="Type">Type</label>
								<text class="form-control" readonly disable=""><?php echo htmlspecialchars($_POST['Type']);?></text>
							</div>
							<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
								<label class="control-label" for="Priority">Priority</label>
								<text class="form-control" readonly disable=""><?php echo htmlspecialchars($_POST['priLvl']);?></text>
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