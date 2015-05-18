<?php
session_start();
require "../function/function.php";
include "../config/database.php";
$mysql = mysqlConnect();
$strSQL = "SELECT 
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
				TicketID='".$_POST["ticketID"]."'";

$objResult = mysqli_fetch_assoc($mysql->query($strSQL));

function ConfirmUpdate()
{
	global $objResult;
	
	echo 
		"<div class='row'>
			<div class='col-xs-10 col-sd-offset-1 col-sd-11 col-md-offset-1 col-md-9'>
				<div class='form-group'>
					<label class='control-label'>Confirm Update</label>
					<div class='input-group'>
						<span class='input-group-addon'>Type Password</span>
						<input type='password' class='form-control' id='chkPassword' autocomplete='off' minlength='5' required onmouseover='mouseoverPass();'' onmouseout='mouseoutPass();''>
						<span class='input-group-btn'>";



					 
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

					
echo "					
</span>
</div>
</div>
</div>
</div>";
}

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
				<div class="panel-heading">Creator Detail</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
							<label class="control-label">Create By</label>
							<text class="form-control" readonly disable=""><?php echo htmlspecialchars($objResult["Create_By"]);?></text>
						</div>
						<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
							<label class="control-label">Create On</label>
							<text class="form-control" readonly disable=""><?php echo htmlspecialchars($objResult["Create_On"]);?></text>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
							<label class="control-label">Employee Email</label>
							<text class="form-control" readonly disable=""><?php echo htmlspecialchars($objResult["empEmail"]);?></text>
						</div>
						<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
							<label class="control-label">Employee Tel</label>
							<text class="form-control" readonly disable=""><?php echo htmlspecialchars($objResult["empTel"]);?></text>
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
				<div class="panel-heading">Ticket Detail</div>
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
							<text class="form-control" readonly disable="">

							<?php 
							if($objResult["Support_By"] == null) echo "Not Yet";
							else echo $objResult["Support_By"];
							?>

							</text>
						</div>
						<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
							<label class="control-label">Support On</label>
							<text class="form-control" readonly disable="">
							<?php 
							date("Y-m-d H:i:s",time());
							if($objResult["Support_On"] == null) echo "Not Yet";
							?>
							</text>
						</div>
					</div>

					<?php

					if($_SESSION["login"]["Class"] != "user")
					{
					echo "
					<div class='row'>
						<div class='col-xs-10 col-sd-offset-1 col-sd-11 col-md-offset-1 col-md-9'>
							<label class='control-label'>Trouble Detail</label>
							<textarea class='form-control' name='txtDetail' id='txtDetail' autocomplete='off' minlength='6' rows='4' style='resize: none;'></textarea>
						</div>
					</div>";
					}
					else 
					{
						echo "
					<div class='row'>
						<div class='col-xs-10 col-sd-offset-1 col-sd-11 col-md-offset-1 col-md-9'>
							<label class='control-label'>Trouble Detail</label>
							<textarea class='form-control' name='txtDetail' id='txtDetail' autocomplete='off' minlength='6' rows='4' readonly style='resize: none;'></textarea>
						</div>
					</div>";
					}

					if($objResult["psrPath"] != null) echo "
						<br>
					<div class='row'>
						<div class='col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4'>
							<input class='btn btn-primary' type='button' value='Download PSR'>
						</div>
					</div>
					<br>";

					if($_SESSION["login"]["Class"] != "user") ConfirmUpdate();

					?>
				
				</div>
			</div>
		</div>

		<div class="row center-block">
			<a class="center-block btn btn-primary btn-lg" href="../index.php">Back to Home</a>
		</div>

	</div>


</body>
</html>