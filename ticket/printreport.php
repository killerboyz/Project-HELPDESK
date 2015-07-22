<?php
session_start();
require "../function/function.php";
include "../function/database.php";


$mysql = mysqlConnect();


$sqlSelect = $selStatus = $selPriority = $selType = $createOn = $supportOn = $supportBy = $gentable = $firstdate = $lastdate = $stat = $prio = $ty = $spby = "";

if($_GET["by"] == "month") 
{
	
	$sqlSelect = "SELECT 
					T.TicketID,
					T.TicketTopic,
					T.TicketType,
					T.Priority,
					T.Create_On,
					MONTH(T.Create_On),
					YEAR(T.Create_On),
					E1.empName AS Create_By,
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
					(MONTH(T.Create_On)=".$_POST["month"].")
				AND
					(YEAR(T.Create_On)=".$_POST["year"].")
				ORDER BY 
					TicketID ASC";

}
else if($_GET["by"] == "options") 
{
	if(isset($_POST["Status"]) != NULL)
	{
		$selStatus .= "WHERE Status IN (";
			if($_POST["Status"]["0"] != NULL) $selStatus .= "'Open'";

			if($_POST["Status"]["1"] != NULL) 
			{
				if(substr($selStatus, -1) == "'") $selStatus .= ",'Processing'";
				else $selStatus .= "'Processing'";
			}

			if($_POST["Status"]["2"] != NULL)
			{
				if(substr($selStatus, -1) == "'") $selStatus .= ",'Solved'";
				else $selStatus .= "'Solved'";
			}

			if($_POST["Status"]["3"] != NULL)
			{
				if(substr($selStatus, -1) == "'") $selStatus .= ",'Closed'";
				else $selStatus .= "'Closed'";
			}

			$selStatus .= ")";
	}
	////////////////// STATUS
	if(isset($_POST["Priority"]) != NULL)
	{
		if($selStatus != NULL) $selPriority .= " AND Priority IN (";
			else $selPriority .= "WHERE Priority IN (";

				if($_POST["Priority"]["0"] != NULL) $selPriority .= "'High'";

				if($_POST["Priority"]["1"] != NULL) 
				{
					if(substr($selPriority, -1) == "'") $selPriority .= ",'Normal'";
					else $selPriority .= "'Normal'";
				}

				if($_POST["Priority"]["2"] != NULL)
				{
					if(substr($selPriority, -1) == "'") $selPriority .= ",'Low'";
					else $selPriority .= "'Low'";
				}

				$selPriority .= ")";
	}
		//////////////////// Priority

	if(isset($_POST["type"]) != NULL)
	{
		if($selStatus != "" || $selPriority != "") $selType .= " AND";
		else $selType .= " WHERE";

		if($_POST["type"] == "hw") $selType .= " TicketType='Hardware'";
		else if($_POST["type"] == "sw") $selType .= " TicketType='Software'";
		else $selType .= " TicketType IN ('Hardware','Software')";
	}
		//////////////////// Type

	if(!empty($_POST["startC"]) && !empty($_POST["endC"]))
	{
		if($selStatus != "" || $selPriority != "" || $selType != "") $createOn = " AND (T.Create_On BETWEEN '".$_POST["startC"]." 00:00:00' AND '".$_POST["endC"]." 23:59:59')";
		else $createOn = " WHERE Create_On BETWEEN ('".$_POST["startC"]." 00:00:00' AND '".$_POST["endC"]." 23:59:59')";
	}
		//////////////////// Create_On

	if(!empty($_POST["startS"]) && !empty($_POST["endS"]))
	{
		if($selStatus != "" || $selPriority != "" || $selType != "" || $createOn != "") $supportOn = " AND (Support_On BETWEEN '".$_POST["startS"]." 00:00:00' AND '".$_POST["endS"]." 23:59:59')";
		else $supportOn = " WHERE Support_On BETWEEN ('".$_POST["startS"]." 00:00:00' AND '".$_POST["endS"]." 23:59:59')";
	}
		/////////////////// Support_On

	if(!empty($_POST["supportBy"]))
	{
		if($selStatus != "" || $selPriority != "" || $selType != "" || $createOn != "" || $supportOn != "") $supportBy = " AND (Support_By='".$_POST["supportBy"]."')";
		else $supportOn = " WHERE Support_By='".$_POST["supportBy"]."'";

	}
		/////////////////// Support_by

	$sqlSelect = "SELECT 
					T.TicketID,
					T.TicketTopic,
					T.TicketType,
					T.Priority,
					T.Create_On,
					E1.empName AS Create_By,
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
					".$selStatus.$selPriority.$selType.$createOn.$supportOn.$supportBy."
				ORDER BY 
					TicketID ASC";
}



$result = $mysql->query($sqlSelect);
$lastrows = mysqli_num_rows($result);
$i = 1;


while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) 
	{	
		if($i == 1) 
		{
			$firstdate = $row['Create_On'];
			$spby = $row['Support_By'];
		}
		if($i == $lastrows) $lastdate = $row['Create_On'];
		$i++;

		if($row['Priority'] == "High") 
		{
			$hilight = "<tr class='danger'>\n";
			$priority = "<td><h><span class='label label-danger'>High</span></h></td>\n";
		}
		else if($row['Priority'] == "Normal")
		{ 
			$hilight = "<tr class='warning'>\n";
			$priority = "<td><h><span class='label label-warning'>Normal</span></h></td>\n";
		}
		else 
		{
			$hilight = "<tr class='active'>\n";
			$priority = "<td><h><span class='label label-info'>Low</span></h></td>\n";
		}
	////////////////////////////////////////////////////////////////////////////////////////////////////////// Priority
		if($row['Status'] == "Open") $status = "<td><h><span class='label label-info'>Open</span></h></td>\n";
		else if($row['Status'] == "Processing") $status = "<td><h><span class='label label-warning'>Processing</span></h></td>\n";
		else $status = "<td><h><span class='label label-default'>".$row['Status']."</span></td>\n";
    ////////////////////////////////////////////////////////////////////////////////////////////////////////// STATUS

		$gentable .=
		$hilight.
		"<td>".$row['TicketID']."</td>\n".
		"<td>".$row['TicketTopic']."</td>\n".
		"<td><span class='label label-primary'>".$row['TicketType']."</span></td>\n".
		$priority.
		"<td>".$row['Create_On']."</td>\n".
		"<td>".$row['Create_By']."</td>\n".
		"<td>".$row['Support_On']."</td>\n".
		"<td>".$row['Support_By']."</td>\n".
		$status.
		"</tr>\n";

	}

if($gentable == '') 
		{
			echo "<script>
					alert(\"NO DATA IN YOUR SELECTED !!\");
					window.location.href = '/ticket/ticketreport.php';
					window.close();
				</script>";
				exit();
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
				<h1>TICKET REPORT</h1>
				<h3>
					<?php 
						if($_GET["by"] == "month")
						{
							echo date("F Y", strtotime($_POST["year"]."-".$_POST["month"]));
						}
						else if($_GET["by"] == "options")
						{
							
							if(!empty($_POST["startC"]) && !empty($_POST["endC"])) echo date("d F Y", strtotime($_POST["startC"]))." to ".date("d F Y", strtotime($_POST["endC"]));
							else echo date("d F Y", strtotime($firstdate))." to ".date("d F Y", strtotime($lastdate));
							/////// date
							if(!empty($_POST["Status"])) 
							{
								
								if($_POST["Status"][0] == "Open") $stat .= "Status : Open";
								if($_POST["Status"][1] == "Processing") 
								{
									if(substr($stat, -1) == "n") $stat .= ", Processing";
									else $stat .= "Status : Processing";
								}
								if($_POST["Status"][2] == "Solved") 
								{
									if(substr($stat, -1) == "n" || substr($stat, -1) == "g") $stat .= ", Solved";
									else $stat .= "Status : Solved";
								}
								if($_POST["Status"][3] == "Closed") 
								{
									if(substr($stat, -1) == "n" || substr($stat, -1) == "g" || substr($stat, -1) == "d") $stat .= ", Closed";
									else $stat .= "Status : Closed";
								}


								echo "<br/><small>".$stat."</small>";
							}
							// status
							if(!empty($_POST["Priority"])) 
							{
								
								if($_POST["Priority"][0] == "High") $prio .= "Priority : High";
								if($_POST["Priority"][1] == "Normal") 
								{
									if(substr($prio, -1) == "h") $prio .= ", Normal";
									else $prio .= "Priority : Normal";
								}
								if($_POST["Priority"][2] == "Low") 
								{
									if(substr($prio, -1) == "h" || substr($prio, -1) == "l") $prio .= ", Low";
									else $prio .= "Priority : Low";
								}
								echo "<br/><small>".$prio."</small>";
							}
							// priority
							if(!empty($_POST["type"]))
							{
								if($_POST["type"] == "hw") $ty .= "Hardware";
								else if($_POST["type"] == "sw") $ty .= "Software";
								else $ty .= "All Type";
								echo "<br/><small>Type : ".$ty."</small>";
							}
							// type
							if(!empty($_POST["supportBy"]))
							{
								echo "<br/><small>Support By : ".$spby."</small>";
							}
							// support by
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
							<th>Ticket Topic</th>
							<th>Ticket Type</th>
							<th>Priority</th>
							<th>Create On</th>
							<th>Create By</th>
							<th>Support On</th>
							<th>Support By</th>
							<th>Status</th>
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