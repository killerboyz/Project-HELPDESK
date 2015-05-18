<?php
session_start();
require "../function/function.php";
include "../config/database.php";

//$mysql = mysqlConnect();
//$result = $mysql->query("SELECT TicketID, TicketTopic, TicketType, Priority, Status FROM ticket ORDER BY Status ASC , Priority DESC , TicketID ASC LIMIT 21");
//$objResult = mysqli_fetch_assoc($mysql->query("SELECT * FROM ticket ORDER BY status ASC , Priority DESC"));

function genTable()
{
	$mysql = mysqlConnect();

	if($_SESSION["login"]["Class"] == "user")
	{
		$result = $mysql->query("SELECT TicketID, TicketTopic, TicketType, Priority, Status FROM ticket WHERE Create_By = '".$_SESSION["login"]["empID"]."' ORDER BY Status ASC , Priority DESC , TicketID ASC LIMIT 10");
	}
	else $result = $mysql->query("SELECT TicketID, TicketTopic, TicketType, Priority, Status FROM ticket ORDER BY Status ASC , Priority DESC , TicketID ASC LIMIT 10");

	while ($row = mysqli_fetch_array($result, MYSQL_NUM)) 
	{	
		echo "<form method='post' action='../ticket/ticketdetail.php'>\n";
		
		if($row[3] == "High") echo "<tr class='danger'>\n";
		else if($row[3] == "Normal") echo "<tr class='warning'>\n";
		else echo "<tr class='active'>\n";

		echo "<td><h4>".$row[0]."</h></td>\n";
	    ////////////////////////////////////////////////////////////////////////////////////////////////////////// TICKET ID
		echo "<td><h4>".$row[1]."</h></td>\n";
	    ////////////////////////////////////////////////////////////////////////////////////////////////////////// TICKET TOPIC
		echo "<td><h4><span class='label label-primary'>".$row[2]."</span></h></td>\n";
	    //////////////////////////////////////////////////////////////////////////////////////////////////////////	TYPE
		if($row[3] == "High") echo "<td><h4><span class='label label-danger'>High</span></h></td>\n";
		else if($row[3] == "Normal") echo "<td><h4><span class='label label-warning'>Normal</span></h></td>\n";
		else echo "<td><h4><span class='label label-info'>Low</span></h></td>\n";
		////////////////////////////////////////////////////////////////////////////////////////////////////////// PRIORITY
		echo "<td><input class='btn btn-primary' type='submit' value='Click for Detail'></input></td>\n";
	    ////////////////////////////////////////////////////////////////////////////////////////////////////////// TROUBLE DETAIL
		if($row[4] == "Open") echo "<td><h4><span class='label label-info'>Open</span></h></td>\n";
		else if($row[4] == "Processing") echo "<td><h4><span class='label label-warning'>Processing</span></h></td>\n";
		else echo "<td><h4><span class='label label-default'>".$row[4]."</span></td>\n";
	    ////////////////////////////////////////////////////////////////////////////////////////////////////////// STATUS
		echo "<input type='hidden' name='ticketID' value='".$row[0]."'>";

		echo "</tr>\n</form>\n\n";
	}
}

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>TICKET TABLE LIST</title>
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

			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>TicketTopic</th>
						<th>Type</th>
						<th>Priority</th>
						<th>Trouble Detail</th>
						<th>Status</th>

					</tr>
				</thead>

				<?php genTable();?>
				<!-- ---------------------------------------------------------------------------------------------------------------- TABLE GENERATOR --------------------------------------------------------------------------------- -->
			</table>
		</div>

		<div class='row'>
			<nav>
				<ul class="pager">
				<li class="previous disabled"><a href="#"><span aria-hidden="true">&larr;</span> Back</a></li>
					<li class="next"><a href="#">Next <span aria-hidden="true">&rarr;</span></a></li>
				</ul>
			</nav>
		</div>
		
	</div>
	

</body>
</html>