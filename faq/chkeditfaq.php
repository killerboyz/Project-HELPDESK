<?php
session_start();
require "../function/function.php";
include "../function/database.php";

if($_POST['ChkConfirm'] != "CONFIRM")
{
	echo "<script>
	alert(\"Please type CONFIRM !!\");
	window.history.back();
</script>";
exit();
}

$mysql = mysqlConnect();

$strUpdate = "UPDATE
					faq
				SET 
					faqTopic='".$_POST["FAQtopic"]."',
					faqType='".$_POST["Type"]."',
					faqDescript='".htmlspecialchars($_POST['FAQdescript'],ENT_HTML5)."',
					Edit_By='".$_SESSION["login"]["empName"]."',
					Edit_On='".date("Y-m-d H:i:s",time())."'
				WHERE
					faqID='".$_POST["FAQid"]."'";
$mysql->query($strUpdate);



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
	<style>
		img {
				max-width: 100%;
				height: auto !important;
			}
	</style>
</head>

<body>

	<?php navbar();?>

	<!-- ---------------------------------------------------------------------------------------------------------------- NAVIGATOR BAR --------------------------------------------------------------------------------- -->

	<div class="container">
		<div class="row">
			<div class="alert alert-dismissible alert-success">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Well done!</strong> You Edit FAQ Successfully.
			</div>
		</div>
	</div>


	<div class="container">
		
		<div class="row">
			<div class="col-xs-4  col-sd-5  col-md-4 form-group has-warning">
				<label class="control-label" for="faqTopic">FAQ Topic</label>
				<input class="form-control" name="FAQtopic" type="text" value="<?php echo $_POST["FAQtopic"];?>" readonly disable=""></input>
			</div>
			<div class="col-xs-4 col-sd-offset-1 col-sd-3 col-md-offset-1 col-md-2">
				<label for="select" class="control-label">Type</label>
				<input class="form-control" name="FAQtopic" type="text" value="<?php echo $_POST["Type"];?>" readonly disable=""></input>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sd-12 col-md-12">
				<div class="jumbotron">
					<?php echo htmlspecialchars_decode($_POST['FAQdescript'],ENT_HTML5);?>
					<br><hr>
					<div class="pull-right">
						<h4><small>Edit By </small><?php echo $_SESSION["login"]["empName"];?></h4>
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