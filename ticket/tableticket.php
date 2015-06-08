<?php
session_start();
require "../function/function.php";
include "../config/database.php";

$mysql = mysqlConnect();

if($_SESSION["login"]["Class"] == "user")
{
	$count = $mysql->query("SELECT COUNT(*) FROM ticket WHERE Create_By = '".$_SESSION["login"]["empID"]."' ORDER BY Status ASC , Priority DESC , TicketID ASC");
}
else 
{
	$count = $mysql->query("SELECT COUNT(*) FROM ticket ORDER BY Status ASC , Priority DESC , TicketID ASC ");
}

$row = mysqli_fetch_row($count); // fetch row
$rows = $row[0]; // rows count
$page_rows = 10; // per page
$last = ceil($rows/$page_rows); // count page
if($last < 1) $last = 1; // cannot less than 1
$pagenum = 1; // pagenum
if(isset($_GET['page'])) $pagenum = preg_replace('#[^0-9]#', '', $_GET['page']); // make sure isn't below 1
if($pagenum < 1 ) $pagenum = 1;
else if($pagenum > $last) $pagenum = $last; // range of row to query for the chosen $pagenum
$limit = 'LIMIT '.($pagenum - 1) * $page_rows.','.$page_rows; // limit page_rows
if($_SESSION["login"]["Class"] == "user")
{
	$result = $mysql->query("SELECT TicketID, TicketTopic, TicketType, Priority, Status FROM ticket WHERE Create_By = '".$_SESSION["login"]["empID"]."' ORDER BY Status ASC , Priority DESC , TicketID ASC $limit");
}
else 
{
	
	$result = $mysql->query("SELECT TicketID, TicketTopic, TicketType, Priority, Status FROM ticket ORDER BY Status ASC , Priority DESC , TicketID ASC $limit");
	header("refresh:180;url=../ticket/tableticket.php");
}

$paginationCtrls = '';
if($last != 1) 
{
	if($pagenum > 1) 
	{
		$paginationCtrls .= "<li><a href=".$_SERVER['PHP_SELF']."?page=1>«</a></li>\n";
		for ($i=$pagenum-1; $i < $pagenum; $i++) 
		{ 
			if ($i > 0) $paginationCtrls .= "<li><a href=".$_SERVER['PHP_SELF']."?page=".$i.">".$i."</a></li>\n";
		}
	}
	if($paginationCtrls == '') $paginationCtrls .= "<li class='active'><a href='#'>".$pagenum."</a></li>\n";
	else $paginationCtrls .= "<li class='active'><a href='#'>".$pagenum."</a></li>\n";
	
	for ($i=$pagenum+1; $i < $last; $i++)
	{ 
		$paginationCtrls .= "<li><a href=".$_SERVER['PHP_SELF']."?page=".$i.">".$i."</a></li>\n";
		if($i >= $pagenum+1) break;

	}
	if($pagenum != $last)
	{
		$next = $pagenum+1;
		if($pagenum == ($last-1)) $paginationCtrls .= "<li><a href=".$_SERVER['PHP_SELF']."?page=".$last.">".$last."</a></li>\n";
		$paginationCtrls .= "<li><a href=".$_SERVER['PHP_SELF']."?page=".$last.">»</a></li>\n";
	}
}
$gentable = '';
while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) 
{	
	if($row['Priority'] == "High") 
	{
		$hilight = "<tr class='danger'>\n";
		$priority = "<td><h4><span class='label label-danger'>High</span></h></td>\n";
	}
	else if($row['Priority'] == "Normal")
	{ 
		$hilight = "<tr class='warning'>\n";
		$priority = "<td><h4><span class='label label-warning'>Normal</span></h></td>\n";
	}
	else 
	{
		$hilight = "<tr class='active'>\n";
		$priority = "<td><h4><span class='label label-info'>Low</span></h></td>\n";
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////// Priority
	if($row['Status'] == "Open") $status = "<td><h4><span class='label label-info'>Open</span></h></td>\n";
	else if($row['Status'] == "Processing") $status = "<td><h4><span class='label label-warning'>Processing</span></h></td>\n";
	else $status = "<td><h4><span class='label label-default'>".$row['Status']."</span></td>\n";
    ////////////////////////////////////////////////////////////////////////////////////////////////////////// STATUS
	
	$gentable .= "<form method='post' action='../ticket/ticketdetail.php'>\n".
					$hilight.
					"<td><h4>".$row['TicketID']."</h></td>\n".
					"<td><h4>".$row['TicketTopic']."</h></td>\n".
					"<td><h4><span class='label label-primary'>".$row['TicketType']."</span></h></td>\n".
					$priority.
					"<td><input class='btn btn-primary' type='submit' value='Click for Detail'></input></td>\n".
					$status.
					"<input type='hidden' name='ticketID' value='".$row['TicketID']."'>\n</tr>\n</form>\n\n";
	

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

				<?php echo $gentable;?>
				<!-- ---------------------------------------------------------------------------------------------------------------- TABLE GENERATOR --------------------------------------------------------------------------------- -->
			</table>
		</div>

		
		<div class='row'>
			<div class="text-center">
				<ul class="pagination pagination-lg">
					<?php echo $paginationCtrls; ?>
				</ul>
			</div>
		</div>
		
	</div>
	

</body>
</html>