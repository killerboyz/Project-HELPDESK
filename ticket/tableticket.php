<?php
session_start();
require "../function/function.php";
include "../config/database.php";
header("refresh:180;url=../ticket/tableticket.php");

$mysql = mysqlConnect();
if(empty($_GET["search"]))
{
	if($_SESSION["login"]["Class"] == "user")
	{
		$count = $mysql->query("SELECT COUNT(*) FROM ticket WHERE Create_By = '".$_SESSION["login"]["empID"]."' ORDER BY Status ASC , Priority DESC , TicketID ASC");
	}
	else 
	{
		$count = $mysql->query("SELECT 
									COUNT(T.TicketID),
										T.TicketTopic,
										T.TicketType,
										T.Priority,
										E.empName AS Create_By,
										T.Status
									FROM
										ticket AS T
									INNER JOIN 
										emp AS E
									ON 
										T.Create_By = E.empID
									ORDER BY 
										Status ASC, 
										Priority DESC, 
										TicketID ASC ");
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
		$result = $mysql->query("SELECT 
										TicketID, TicketTopic, TicketType, Priority, Status
									FROM 
										ticket 
									WHERE 
										Create_By = '".$_SESSION["login"]["empID"]."' 
									ORDER BY 
										Status ASC , Priority DESC , TicketID ASC
										$limit");
	}
	else 
	{
		$result = $mysql->query("SELECT 
										T.TicketID,
										T.TicketTopic,
										T.TicketType,
										T.Priority,
										E.empName AS Create_By,
										T.Status
									FROM
										ticket AS T
									INNER JOIN 
										emp AS E
									ON 
										T.Create_By = E.empID
									ORDER BY 
										Status ASC, 
										Priority DESC, 
										TicketID ASC $limit");
		
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

		if($_SESSION["login"]["Class"] != "user") $Create_By =  "<td><h4>".$row['Create_By']."</h></td>\n";
		else $Create_By = "";

		$gentable .= "<form method='get' action='../ticket/ticketdetail.php'>\n".
		$hilight.
		"<td><h4>".$row['TicketID']."</h></td>\n".
		"<td><h4>".$row['TicketTopic']."</h></td>\n".
		"<td><h4><span class='label label-primary'>".$row['TicketType']."</span></h></td>\n".
		$priority.
		"<td><input class='btn btn-primary' type='submit' value='Click for Detail'></input></td>\n".
		$Create_By.
		$status.
		"<input type='hidden' name='ticketID' value='".$row['TicketID']."'>\n</tr>\n</form>\n\n";


	}
}
	
if(!empty($_GET["search"]))
{
	$search="";
	if($_GET["search"] == "ticket") 
	{
		if(empty($_GET["searchT"])) header('Location: /ticket/tableticket.php');
		$search = $_GET["searchT"];
		$strSQL = "SELECT 
						T.TicketID,
						T.TicketTopic,
						T.TicketType,
						T.Priority,
						E.empName AS Create_By,
						T.Status
					FROM
						ticket AS T
					INNER JOIN 
						emp AS E
					ON 
						T.Create_By = E.empID
					WHERE
						T.TicketID = '".$search."'
					OR 
						T.TicketTopic LIKE '%".$search."%'
					ORDER BY 
						Status ASC, 
						Priority DESC, 
						TicketID ASC";
		$strSQLcount = "SELECT 
							COUNT(T.TicketID),
								T.TicketTopic,
								T.TicketType,
								T.Priority,
								E.empName AS Create_By,
								T.Status
							FROM
								ticket AS T
							INNER JOIN 
								emp AS E
							ON 
								T.Create_By = E.empID
							WHERE
								T.TicketID = '".$search."'
							OR 
								T.TicketTopic LIKE '%".$search."%'
							ORDER BY 
								Status ASC, 
								Priority DESC, 
								TicketID ASC";
		
	}
	else if($_GET["search"] == "emp") 
	{
		if(empty($_GET["searchE"])) header('Location: /ticket/tableticket.php');
		$search = $_GET["searchE"]; 
		$strSQL = "SELECT 
						T.TicketID,
						T.TicketTopic,
						T.TicketType,
						T.Priority,
						E.empName AS Create_By,
						T.Status
					FROM
						ticket AS T
					INNER JOIN 
						emp AS E
					ON 
						T.Create_By = E.empID
					WHERE
						T.Create_By= '".$search."'
					OR 
						E.empName LIKE '%".$search."%'
					ORDER BY 
						Status ASC, 
						Priority DESC, 
						TicketID ASC";
		$strSQLcount = "SELECT 
							COUNT(T.TicketID),
								T.TicketTopic,
								T.TicketType,
								T.Priority,
								E.empName AS Create_By,
								T.Status
							FROM
								ticket AS T
							INNER JOIN 
								emp AS E
							ON 
								T.Create_By = E.empID
							WHERE
								T.Create_By= '".$search."'
							OR 
								E.empName LIKE '%".$search."%'
							ORDER BY 
								Status ASC, 
								Priority DESC, 
								TicketID ASC";
	}
	else
	{
		$search = $_GET["search"]; 
		$strSQL = "SELECT 
						TicketID, TicketTopic, TicketType, Priority, Status 
					FROM 
						ticket
					WHERE
						Create_By = '".$_SESSION["login"]["empID"]."'
					AND ( 
							TicketTopic LIKE '%".$search."%'
					OR 
							TicketID= '".$search."'
							)
					ORDER BY 
						Status ASC, 
						Priority DESC, 
						TicketID ASC";
		$strSQLcount = "SELECT 
							COUNT(TicketID), TicketTopic, TicketType, Priority, Status
							FROM 
								ticket 
							WHERE 
								Create_By = '".$_SESSION["login"]["empID"]."' 
								AND ( 
								TicketTopic LIKE '%".$search."%'
							OR 
								TicketID= '".$search."'
								)
							ORDER BY 
								Status ASC , Priority DESC , TicketID ASC";
	}

	$count = $mysql->query($strSQLcount);
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
	$result = $mysql->query($strSQL." ".$limit);
	
	$paginationCtrls = '';
	if(isset($_GET["searchT"]) || isset($_GET["searchE"])) $strValue = $_SERVER['PHP_SELF']."?searchT=".$_GET["searchT"].'&search='.$_GET["search"]."&searchE=".$_GET["searchE"];
	else if(isset($_GET["search"])) $strValue = $_SERVER['PHP_SELF']."?search=".$_GET["search"];
	if($last != 1) 
	{
		if($pagenum > 1) 
		{
			$paginationCtrls .= "<li><a href=".$_SERVER['PHP_SELF']."?page=1>«</a></li>\n";
			for ($i=$pagenum-1; $i < $pagenum; $i++) 
			{ 
				if ($i > 0) $paginationCtrls .= "<li><a href=".$strValue."&page=".$i.">".$i."</a></li>\n";
			}
		}
		if($paginationCtrls == '') $paginationCtrls .= "<li class='active'><a href='#'>".$pagenum."</a></li>\n";
		else $paginationCtrls .= "<li class='active'><a href='#'>".$pagenum."</a></li>\n";

		for ($i=$pagenum+1; $i < $last; $i++)
		{ 
			$paginationCtrls .= "<li><a href=".$strValue."&page=".$i.">".$i."</a></li>\n";
			if($i >= $pagenum+1) break;

		}
		if($pagenum != $last)
		{
			$next = $pagenum+1;
			if($pagenum == ($last-1)) $paginationCtrls .= "<li><a href=".$strValue."&page=".$last.">".$last."</a></li>\n";
			$paginationCtrls .= "<li><a href=".$strValue."&page=".$last.">»</a></li>\n";
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

		if($_SESSION["login"]["Class"] != "user") $Create_By =  "<td><h4>".$row['Create_By']."</h></td>\n";
		else $Create_By = "";

		$gentable .= "<form method='get' action='../ticket/ticketdetail.php'>\n".
		$hilight.
		"<td><h4>".$row['TicketID']."</h></td>\n".
		"<td><h4>".$row['TicketTopic']."</h></td>\n".
		"<td><h4><span class='label label-primary'>".$row['TicketType']."</span></h></td>\n".
		$priority.
		"<td><input class='btn btn-primary' type='submit' value='Click for Detail'></input></td>\n".
		$Create_By.
		$status.
		"<input type='hidden' name='ticketID' value='".$row['TicketID']."'>\n</tr>\n</form>\n\n";
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
			<form method='get' action="tableticket.php?search" id='searchticket'>

			<?php

			if($_SESSION["login"]["Class"] == "user")
			{
				echo "<div class='form-group'>
						<div class='input-group'>
							<span class='input-group-addon'>Search Ticket</span>
							<input type='search' class='form-control' name='search' placeholder='Ticket ID , Ticket Topic here ... ' autocomplete='off'>
							<span class='input-group-btn'>
								<button class='btn btn-success' type='sumbit'>
									<span class='glyphicon glyphicon-search' aria-hidden='true'></span>
								</button>
							</span>
						</div>
					</div>";		
				
			}
			else
			{
				echo "<div class='form-group'>
						<div class='input-group'>
						
							<span class='input-group-addon'>
								<input type='radio' name='search' value='ticket' aria-label='...'> Search By Ticket
							</span>
								<input type='search' class='form-control' name='searchT' placeholder='Ticket ID , Ticket Topic here ... ' autocomplete='off'>
								
							<span class='input-group-addon'>
								<input type='radio' name='search' value='emp' aria-label='...'> Search By Employee
							</span>
								<input type='search' class='form-control' name='searchE' placeholder='Emp ID , Emp Name here ... ' autocomplete='off'>

							<span class='input-group-btn'>
								<button class='btn btn-success' type='sumbit'>
									<span class='glyphicon glyphicon-search' aria-hidden='true'></span>
								</button>
							</span>

						</div>
					</div>";

			}
			?>

			</form>

			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Ticket Topic</th>
						<th>Type</th>
						<th>Priority</th>
						<th>Trouble Detail</th>
						<?php if($_SESSION["login"]["Class"] != "user" || !empty($_GET["searchT"]) || !empty($_GET["searchE"])) echo "<th>Create By</th>";?>
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