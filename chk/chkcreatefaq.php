<?php
session_start();
require "../function/function.php";
include "../config/database.php";

//$mysql = mysqlConnect();


if($_POST['ChkConfirm'] != "ABC")
{
	echo "<script>
		alert(\"Please type ABC !!\");
		window.history.back()
		</script>";
	exit();
}

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>CREATE FAQ SUCCESS</title>
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
				<strong>Well done!</strong> You Create FAQ Successfully.
			</div>
		</div>
	</div>


	<div class="container">
		<div class="row">
			<div class="panel panel-info">
				<div class="panel-heading">FAQ Detail</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-2 col-sd-offset-1 col-sd-1 col-md-offset-1 col-md-2">
								<label class="control-label" for="FAQID">FAQ ID</label>
								<text class="form-control" readonly disable=""><?php echo htmlspecialchars($mysql->insert_id);?></text>
							</div>
							<div class="col-xs-2 col-sd-offset-1 col-sd-1 col-md-offset-1 col-md-2">
								<label class="control-label" for="FAQtopic">FAQ Topic</label>
								<text class="form-control" readonly disable=""><?php echo htmlspecialchars($_POST['FAQtopic']);?></text>

							</div>
						</div>

						<div class="row">
							<div class="col-xs-5 col-sd-offset-1 col-sd-8 col-md-offset-1 col-md-8">
								<label class="control-label" for="FAQdescript">FAQ Description</label>
								<textarea class="form-control" rows="8" readonly disabled><?php echo htmlspecialchars($_POST['FAQdescript'],ENT_HTML5);?></textarea>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-2 col-sd-offset-1 col-sd-1 col-md-offset-1 col-md-2">
								<label class="control-label" for="Type">Type</label>
								<text class="form-control" readonly disable=""><?php echo htmlspecialchars($_POST['Type']);?></text>
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