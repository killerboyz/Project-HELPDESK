<?php
session_start();
require "../function/function.php";
include "../config/database.php";

$mysql = mysqlConnect();

$result = $mysql->query("SELECT COUNT(*) FROM ticket ORDER BY Status ASC , Priority DESC , TicketID ASC");
$row = mysqli_fetch_row($result); // fetch row
$rows = $row[0]; // rows count
$page_rows = 10; // per page
$last = ceil($rows/$page_rows); // count page
if($last < 1) $last = 1; // cannot less than 1
$pagenum = 1; // pagenum
if(isset($_GET['page'])) $pagenum = preg_replace('#[^0-9]#', '', $_GET['page']); // make sure isn't below 1
if($pagenum < 1 ) $pagenum = 1;
else if($pagenum > $last) $pagenum = $last; // range of row to query for the chosen $pagenum
$limit = 'LIMIT '.($pagenum - 1) * $page_rows.','.$page_rows; // limit page_rows
$result = $mysql->query("SELECT TicketID, TicketTopic, TicketType, Priority, Status FROM ticket ORDER BY Status ASC , Priority DESC , TicketID ASC $limit");
$text1 = "test (<b>$rows</b>)";
$text2 = "Page <b>$pagenum</b> of <b>$last</b>";
$paginationCtrls = '';
if($last != 1) 
{
	if($pagenum > 1) 
	{
		$previous = $pagenum - 1;
		$paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?page='.$previous.'">«</a></li>';
		for ($i=$pagenum-4; $i < $pagenum; $i++) 
		{ 
			if ($i > 0) $paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.'</a></li>';
		}
	}
	$paginationCtrls .= ''.$pagenum.'';
	for ($i=$pagenum+1; $i < $last; $i++)
	{ 
		$paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a></li>';
		if($i >= $pagenum+4) break;
	}
	if($pagenum != $last)
	{
		$next = $pagenum + 1;
		$paginationCtrls .='<li><a href="'.$_SERVER['PHP_SELF'].'?page='.$next.'">»</a></li>';
	}
}
$str = '';
while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) 
{	
	$ticketID = "<td><h4>".$row['TicketID']."</h></td>\n";
    ////////////////////////////////////////////////////////////////////////////////////////////////////////// TICKET ID
	$ticketTopic = "<td><h4>".$row['TicketTopic']."</h></td>\n";
    ////////////////////////////////////////////////////////////////////////////////////////////////////////// TICKET TOPIC
	$type = "<td><h4><span class='label label-primary'>".$row['TicketType']."</span></h></td>\n";
    //////////////////////////////////////////////////////////////////////////////////////////////////////////	TYPE
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
	$clickdetail = "<td><input class='btn btn-primary' type='submit' value='Click for Detail'></input></td>\n";
    ////////////////////////////////////////////////////////////////////////////////////////////////////////// TROUBLE DETAIL
	if($row['Status'] == "Open") $status = "<td><h4><span class='label label-info'>Open</span></h></td>\n";
	else if($row['Status'] == "Processing") $status = "<td><h4><span class='label label-warning'>Processing</span></h></td>\n";
	else $status = "<td><h4><span class='label label-default'>".$row['Status']."</span></td>\n";
    ////////////////////////////////////////////////////////////////////////////////////////////////////////// STATUS
	$hidden = "<input type='hidden' name='ticketID' value='".$row['TicketID']."'>";

	$end = "</tr>\n</form>\n\n";

	

	$str .= "<form method='post' action='../ticket/ticketdetail.php'>\n".
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

				<?php //genTable();?>
				<!-- ---------------------------------------------------------------------------------------------------------------- TABLE GENERATOR --------------------------------------------------------------------------------- -->
				
				<p><?php echo $str; ?></p>
			</table>
		</div>

		<div class='row'>
			<ul class="pagination">
			<?php echo $paginationCtrls; ?>
			</ul>
			<nav>
				<ul class="pager">
					<li class="previous disabled"><a href="#"><span aria-hidden="true">&larr;</span> Back</a></li>
					<li class="next"><a href="#">Next <span aria-hidden="true">&rarr;</span></a></li>
				</ul>
			</nav>
		</div>
		
		<div class="row">
		<nav>
			<ul class="pagination">
			  <li class="disabled"><a href="#">«</a></li>
			  <li class="active"><a href="#">1</a></li>
			  <li><a href="#">2</a></li>
			  <li><a href="#">3</a></li>
			  <li><a href="#">4</a></li>
			  <li><a href="#">5</a></li>
			  <li><a href="#">»</a></li>
			</ul>
		</nav>
		</div>
		
	</div>
	

</body>
</html>