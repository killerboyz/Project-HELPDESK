<?php
session_start();
require "../function/function.php";
include "../function/database.php";


$mysql = mysqlConnect();

$strSelect = $sqlSelect = $gentable = $firstdate = $lastdate ="";


if($_GET["by"] == "month") 
{
	
	$sqlSelect = "SELECT 
						faqID, faqTopic, faqType, Create_On,MONTH(Create_On), YEAR(Create_On), Create_By, hits 
					FROM 
						faq 
					WHERE
						(MONTH(Create_On)=".$_POST["month"].")
					AND
						(YEAR(Create_On)=".$_POST["year"].")
					ORDER BY 
						faqID ASC";

}
else if($_GET["by"] == "options") 
{

	if(!empty($_POST["start"]) && !empty($_POST["end"])) $pickdate = "Create_On BETWEEN '".$_POST["start"]." 00:00:00' AND '".$_POST["end"]." 23:59:59'";



	if($_POST["type"] == "hw") 
	{
		$strSelect = "WHERE faqType='Hardware'";
		if($pickdate != "") $strSelect .= " AND ".$pickdate;
	}
	else if($_POST["type"] == "sw")
	{ 
		$strSelect = "WHERE faqType='Software'";
		if($pickdate != "") $strSelect .= " AND ".$pickdate;
	}
	else 
	{
		$strSelect = "";
		if($pickdate != "") $strSelect .= "WHERE ".$pickdate;
	}

	$sqlSelect = "SELECT faqID, faqTopic, faqType, Create_On, Create_By, hits FROM faq ".$strSelect." ORDER BY faqID ASC";
	
}

$result = $mysql->query($sqlSelect);
$lastrows = mysqli_num_rows($result);
$i = 1;


while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) 
{	
	if($i == 1) $firstdate = $row['Create_On'];
	if($i == $lastrows) $lastdate = $row['Create_On'];
	$i++;
	//////////////////////////////////
	if($row['faqType'] == "Hardware") $hilight = "<tr class='info'>\n";
	else if($row['faqType'] == "Software") $hilight = "<tr class='success'>\n";
	////////////////////////////////////////////////////////////////////////////////////////////////////////// Type
	$gentable .= 
	$hilight.
	"<td>".$row['faqID']."</td>\n".
	"<td>".$row['faqTopic']."</td>\n".
	"<td><span class='label label-danger'>".$row['faqType']."</span></td>\n".
	"<td>".$row['Create_On']."</td>\n".
	"<td>".$row['Create_By']."</td>\n".
	"<td>".$row['hits']."</td>\n
	</tr>\n</form>\n";
}

if($gentable == '') 
		{
			echo "<script>
					alert(\"NO DATA IN YOUR SELECTED !!\");
					window.location.href = '/faq/faqreport.php';
					window.close();
				</script>";
				exit();
		}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>PRINT FAQ REPORT</title>
	<script src="../js/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	
	

	<!-- Optional theme -->
	<link rel="stylesheet" href="../css/_bootswatch.scss">
	<link rel="stylesheet" href="../css/_variables.scss">

	<!-- Latest compiled and minified JavaScript -->
	<script src="../js/bootstrap.min.js"></script>
	
	
	<style>
		@media print
		 {
		   thead {display: table-header-group;}
		 }
		 body { 
		    padding-top: 0px; 
		}
	</style>
	<script type="text/javascript">
	    function printpage() {
	        //Get the print button and put it into a variable
	        var printButton = document.getElementById("printpagebutton");
	        //Set the print button visibility to 'hidden' 
	        printButton.style.visibility = 'hidden';
	        //Print the page content
	        window.print()
	        //Set the print button to 'visible' again 
	        //[Delete this line if you want it to stay hidden after printing]
	        printButton.style.visibility = 'visible';
	    }
	</script>
	
	

	
</head>

<body>
	
<div class="container">

		<div class="row">
			

			<div class="page-header text-center">
				<h1>FAQ REPORT</h1>


				<h3>
					<?php 
						if($_GET["by"] == "month")
						{
							echo date("F Y", strtotime($_POST["year"]."-".$_POST["month"]));
						}
						else if($_GET["by"] == "options")
						{
							if(!empty($_POST["start"]) && !empty($_POST["end"])) echo date("d F Y", strtotime($_POST["start"]))." to ".date("d F Y", strtotime($_POST["end"]));
							else echo date("d F Y", strtotime($firstdate))." to ".date("d F Y", strtotime($lastdate));
							// date
							if(!empty($_POST["type"]))
							{
								if($_POST["type"] == "hw") $ty .= "Hardware";
								else if($_POST["type"] == "sw") $ty .= "Software";
								else $ty .= "All Type";
								echo "<br/><small> Selected Type : ".$ty."</small>";
							}
					 	}
					?>
				</h>
				<div class="col-md-offset-11">
					<input type="button" class="btn btn-primary btn-sm" id="printpagebutton" value="Print" onclick="printpage()"/>
				</div>
			</div>

			
					
		</div>

	<?php 

	
		echo '<div class="row">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>FAQ Topic</th>
							<th>Type</th>
							<th>Create On</th>
							<th>Create By</th>
							<th>View Count</th>
						</tr>
					</thead>'.
					$gentable.
					'</table>
				</div>';
			
	
	?>
	<!-- ---------------------------------------------------------------------------------------------------------------- TABLE GENERATOR --------------------------------------------------------------------------------- -->




	


</div>



</body>
</html>