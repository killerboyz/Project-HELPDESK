<?php
session_start();
require "../function/function.php";
include "../config/database.php";
$mysql = mysqlConnect();
$objResult = mysqli_fetch_assoc($mysql->query("SELECT * FROM ticket INNER JOIN emp ON ticket.`Create-By`=emp.`empID` WHERE TicketID='".$_POST["ticketID"]."'"));

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>TICKET DETAIL</title>
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
			var obj = document.getElementById('chkPassword');
			obj.type = "text";
		}
		function mouseoutPass(obj)
		{
			var obj = document.getElementById('chkPassword');
			obj.type = "password";
		}
	</script>
</head>

<body>
	<?php navbar();?>

	<!-- ---------------------------------------------------------------------------------------------------------------- NAVIGATOR BAR --------------------------------------------------------------------------------- -->
	<div class="container">
		<div class="row">
			<div class="panel panel-success">
				<div class="panel-heading">Ticket Detail</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
							<label class="control-label">Create By</label>
							<text class="form-control" readonly disable=""><?php echo htmlspecialchars($objResult["empName"]);?></text>
						</div>
						<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
							<label class="control-label">Create On</label>
							<text class="form-control" readonly disable=""><?php echo htmlspecialchars($objResult["Create-On"]);?></text>
						</div>

					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- ---------------------------------------------------------------------------------------------------------------- TICKET DETAIL --------------------------------------------------------------------------------- -->
	<div class="container">
		<div class="row">
			<div class="panel panel-info">
				<div class="panel-heading">Ticket Description</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
							<label class="control-label">Ticket ID</label>
							<text class="form-control" readonly disable=""><?php echo htmlspecialchars($_POST["ticketID"]);?></text>
						</div>
						<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
							<label class="control-label">Ticket Topic</label>
							<text class="form-control" readonly disable=""><?php echo htmlspecialchars($objResult["TicketTopic"]);?></text>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-10 col-sd-offset-1 col-sd-11 col-md-offset-1 col-md-9">
							<label class="control-label">Trouble Detail</label>
							<textarea class="form-control" rows="6" style="resize: none;"readonly disabled><?php echo htmlspecialchars($objResult["TroubleDetail"]);?></textarea>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
							<label class="control-label">Type</label>
							<text class="form-control" readonly disable=""><?php echo htmlspecialchars($objResult["TicketType"]);?></text>
						</div>
						<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
							<label class="control-label">Priority</label>
							<text class="form-control" readonly disable=""><?php echo htmlspecialchars($objResult["Priority"]);?></text>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ---------------------------------------------------------------------------------------------------------------- TICKET DESCRIPTION --------------------------------------------------------------------------------- -->
	<div class="container">
		<div class="row">
			<div class="panel panel-warning">
				<div class="panel-heading">Support Detail</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
							<label class="control-label">Support By</label>
							<text class="form-control" readonly disable=""><?php echo $_SESSION["login"]["empName"];?></text>
						</div>
						<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
							<label class="control-label">Support On</label>
							<text class="form-control" readonly disable=""><?php echo date("Y-m-d H:i:s",time());?></text>
						</div>
					</div>

					<?php

					echo "
					<div class='row'>
						<div class='col-xs-10 col-sd-offset-1 col-sd-11 col-md-offset-1 col-md-9'>
							<label class='control-label'>Trouble Detail</label>
							<textarea class='form-control' name='txtDetail' id='txtDetail' autocomplete='off' minlength='6' rows='4' style='resize: none;'></textarea>
						</div>
					</div>";

					if($objResult["psrPath"] != null) echo "
						<br>
						<div class='row'>
							<div class='col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4'>
								<input class='btn btn-primary' type='button' value='Download PSR'>
							</div>
						</div>
						<br>";
					?>
					
					<div class="row">
					<div class="col-xs-10 col-sd-offset-1 col-sd-11 col-md-offset-1 col-md-9 ">
						<div class="form-group">
							<label class="control-label">Confirm Update</label>
							<div class="input-group">
								<span class="input-group-addon" >Type Password</span>
								<input type="password" class="form-control" id="chkPassword" autocomplete="off" minlength="5" required onmouseover="mouseoverPass();" onmouseout="mouseoutPass();">
								<span class="input-group-btn">

								<?php 
								if($objResult["Status"] == "Open") echo "
									<input class='btn btn-info disabled' type='submit' value='Open'>
									<input class='btn btn-success' type='submit' value='Processing'>
									<input class='btn btn-warning' type='submit' value='Solved'>
									<input class='btn btn-danger' type='submit' value='Closed'>";
								elseif ($objResult["Status"] == "Processing") echo "
									<input class='btn btn-info disabled' type='submit' value='Open'>
									<input class='btn btn-success' type='submit' value='Processing'>Processing</input>
									<input class='btn btn-warning' type='submit' value='Solved'>Solved</input>
									<input class='btn btn-danger' type='submit' value='Closed'>";
								elseif ($objResult["Status"] == "Solved") echo "
									<input class='btn btn-info disabled' type='submit' value='Open'>
									<input class='btn btn-success disabled' type='submit' value='Processing'>Processing</input>
									<input class='btn btn-warning disabled' type='submit' value='Solved'>Solved</input>
									<input class='btn btn-danger' type='submit' value='Closed'>";
								else echo "
									<input class='btn btn-info disabled' type='submit' value='Open'>
									<input class='btn btn-success disabled' type='submit' value='Processing'>Processing</input>
									<input class='btn btn-warning disabled' type='submit' value='Solved'>
									<input class='btn btn-danger disabled' type='submit' value='Closed'>";

								?>
								</span>
								
							</div>
						</div>
					</div>
					</div>

				</div>
			</div>
		</div>
	</div>


</body>
</html>