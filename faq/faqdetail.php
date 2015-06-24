<?php
session_start();
require "../function/function.php";
include "../function/database.php";


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
	<style>
		img {
				max-width: 100%;
				height: auto !important;
			}
		hr {
			display: block; height: 1px;
    		border: 0; border-top: 1px solid #ccc;
    	margin: 1em 0; padding: 0;
			}
		
	</style>
	
</head>

<body>
	
	<?php navbar();?>

	<!-- ---------------------------------------------------------------------------------------------------------------- NAVIGATOR BAR --------------------------------------------------------------------------------- -->
	
	
	<!-- ---------------------------------------------------------------------------------------------------------------- FAQ DETAIL --------------------------------------------------------------------------------- -->
	
	<div class="container">
		<div class="row">

			<div class="page-header">
				<?php
				if($_SESSION["login"]["Class"] != "user")
				{
					echo "<div class='pull-right'>
					<a href='/faq/editfaq.php?faqid=".$objResult["faqID"]."' class='btn btn-info'>EDIT THIS FAQ</a>
				</div>";
				}
				?>
				
				<h1><?php echo $objResult["faqTopic"];?></h1>
				
			</div>

			
			<div class="jumbotron">
				<div class="container">
					<div class="row">
					<?php echo htmlspecialchars_decode($objResult["faqDescript"],ENT_HTML5);?>
					
					</div>
					<hr>
					<div class="row">
						<div class="pull-right">
							<h5><small>Create On </small><?php echo $objResult["Create_On"];?>
							<small>By </small><?php echo $objResult["Create_By"];?></h5>
							
							<?php
							if ($objResult["Edit_By"] != NULL) 
							{
								echo "
									<div class='pull-right'>
									<h6><small>Last Edit On </small>".$objResult['Edit_On']."
									<small>By </small>".$objResult['Edit_By']."</h6>
									</div>";
							}
							?>
						</div>
					</div>
				
			</div>

		</div>
	</div>


	
		<div class="row">
			<div class="center-block">
				<a class="center-block btn btn-primary btn-lg" href="../index.php">Back to Home</a>
			</div>
		</div>
	</div>


</body>
</html>