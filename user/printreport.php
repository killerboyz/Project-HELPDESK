<?php
session_start();
require "../function/function.php";
include "../function/database.php";

$mysql = mysqlConnect();

$sqlSelect = $selclass = $createon = $lastlogon = $gentable = $firstdate = $lastdate = $cl = "";

if($_GET["by"] == "month") 
{
	$sqlSelect = "SELECT 
						empID, empName, empEmail, empTel, Class, Create_On, Create_On, last_log_on, MONTH(last_log_on), YEAR(last_log_on)
					FROM 
						emp
					WHERE
						(MONTH(last_log_on)=".$_POST["month"].")
					AND
						(YEAR(last_log_on)=".$_POST["year"].")
					ORDER BY 
						last_log_on ASC,
						Class ASC,
						empID ASC";

}
else if($_GET["by"] == "options") 
{

	if(isset($_POST["Class"]))
	{
		$selclass .= "WHERE Class IN (";
		if($_POST["Class"]["0"] != NULL) $selclass .= "'admin'";

		if($_POST["Class"]["1"] != NULL) 
		{
			if(substr($selclass, -2) == "n'") $selclass .= ",'support'";
			else $selclass .= "'support'";
		}

		if($_POST["Class"]["2"] != NULL)
		{
			if(substr($selclass, -1) == "'") $selclass .= ",'user'";
			else $selclass .= "'user'";
		}

		$selclass .= ")";
	}
	else
	{
		echo "<script>
				alert(\"NO DATA IN YOUR SELECTED !!\");
				window.location.href = '/user/userreport.php';
				window.close();
			</script>";
			exit();
	}
	////////////////// class
	if(!empty($_POST["startC"]) && !empty($_POST["endC"]))
	{
		if($selclass != "") $createon = " AND (Create_On BETWEEN '".$_POST["startC"]." 00:00:00' AND '".$_POST["endC"]." 23:59:59')";
		else $createon = " Create_On BETWEEN ('".$_POST["startC"]." 00:00:00' AND '".$_POST["endC"]." 23:59:59')";
	}

	if(!empty($_POST["startL"]) && !empty($_POST["endL"]))
	{
		if($selclass != "" || substr($createon, -2) == "')") $lastlogon = " AND (last_log_on BETWEEN '".$_POST["startL"]." 00:00:00' AND '".$_POST["endL"]." 23:59:59')";
		else $lastlogon = " last_log_on BETWEEN ('".$_POST["startL"]." 00:00:00' AND '".$_POST["endL"]." 23:59:59')";
	}

	//////////////// datepickup
	$sqlSelect = "SELECT empID, empName, empEmail, empTel, Class, Create_On, last_log_on FROM emp ".$selclass.$createon.$lastlogon." ORDER BY last_log_on ASC, Class ASC, empID ASC";
}



$result = $mysql->query($sqlSelect);
$lastrows = mysqli_num_rows($result);
$i = 1;




while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) 
{	
	if($i == 1) $firstdate = $row['last_log_on'];
	if($i == $lastrows) $lastdate = $row['last_log_on'];
	$i++;

	////////////////////////////// GET FIRST DATE . LAST DATE
	if($row['Class'] == "admin") 
	{
		$hilight = "<tr class='danger'>\n";
		$class = "<td><span class='label label-danger'>Admin</span></td>\n";
	}
	else if($row['Class'] == "support")
	{ 
		$hilight = "<tr class='warning'>\n";
		$class = "<td><span class='label label-warning'>Support</span></td>\n";
	}
	else 
	{
		$hilight = "<tr class='active'>\n";
		$class = "<td><span class='label label-info'>User</span></td>\n";
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////// Type
	$gentable .= 
	$hilight.
	"<td>".$row['empID']."</td>\n".
	"<td>".$row['empName']."</td>\n".
	"<td>".$row['empEmail']."</td>\n".
	"<td>".$row['empTel']."</td>\n".
	$class.
	"<td>".$row['Create_On']."</td>\n".
	"<td>".$row['last_log_on']."</td>\n
	</tr>\n";
}


?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>PRINT USER REPORT</title>
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
				<h1>USER REPORT</h1>
				<h3>
					<?php 
						if($_GET["by"] == "month")
						{
							echo date("F Y", strtotime($_POST["year"]."-".$_POST["month"]));
						}
						else if($_GET["by"] == "options")
						{
							if(!empty($_POST["startL"])  && !empty($_POST["endL"])) echo date("d F Y", strtotime($_POST["startL"]))." to ".date("d F Y", strtotime($_POST["endL"]));
							else echo date("d F Y", strtotime($firstdate))." to ".date("d F Y", strtotime($lastdate));
							// date
							if(!empty($_POST["Class"])) 
							{
								
								if($_POST["Class"][0] == "admin") $cl .= "Administrator";
								if($_POST["Class"][1] == "support") 
								{
									if(substr($cl, -1) == "r") $cl .= ", Support";
									else $cl .= "Support";
								}
								if($_POST["Class"][2] == "user") 
								{
									if(substr($cl, -1) == "r" || substr($cl, -1) == "t") $cl .= ", User";
									else $cl .= "User";
								}
								echo "<br/><small> Selected Class : ".$cl."</small>";
							}
							// selected
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
				<table id="myTable"class="table table-hover tablesorter">
					<thead>
						<tr>
							<th>#</th>
							<th>Employee Name</th>
							<th>Employee E-mail</th>
							<th>Employee Tel</th>
							<th>Class</th>
							<th>Create On</th>
							<th>Last Log On</th>
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