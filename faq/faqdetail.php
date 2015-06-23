<?php
session_start();
require "../function/function.php";
include "../config/database.php";


$mysql = mysqlConnect();
$strSQL = "SELECT 
				* 
			FROM 
				faq 
			WHERE
				faqID='".$_GET["faqID"]."'";

$objResult = mysqli_fetch_assoc($mysql->query($strSQL));




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
	
</head>

<body>
	
	<?php navbar();?>

	<!-- ---------------------------------------------------------------------------------------------------------------- NAVIGATOR BAR --------------------------------------------------------------------------------- -->
	
	
	<!-- ---------------------------------------------------------------------------------------------------------------- TICKET DETAIL --------------------------------------------------------------------------------- -->
	
	<div class="container">
		<div class="row">

			<div class="page-header">
				<h1><?php echo $objResult["faqTopic"];?></h1>
			</div>
			
			<div class="jumbotron">
				<?php echo htmlspecialchars_decode($objResult["faqDescript"],ENT_HTML5);?>
				<br><hr>

				<div class="pull-right">
					<h4><small>Create On </small><?php echo $objResult["Create_On"];?>
					<small>By </small> <?php echo $objResult["Create_By"];?></h4>
				</div>
			</div>

		</div>
	</div>
	<!-- ---------------------------------------------------------------------------------------------------------------- TICKET DESCRIPTION --------------------------------------------------------------------------------- -->
	<div class="container">
		
		<!-- <div class="row">
			<div class="panel panel-warning">
				<div class="panel-heading">Creator Detail</div>
				<div class="panel-body">

					<div class="row">

						<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
							<label class="control-label">Create By</label>
							<text class="form-control" readonly disable=""><?php echo $objResult["Create_By"];?></text>
						</div>
						<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
							<label class="control-label">Create On</label>
							<text class="form-control" readonly disable=""><?php echo $objResult["Create_On"];?></text>
						</div>

					</div>
				</div>
			</div> -->

			<div class="row center-block">
				<a class="center-block btn btn-primary btn-lg" href="../index.php">Back to Home</a>
			</div>

		</div>


	</body>
	</html>