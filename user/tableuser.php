<?php
session_start();
require "../function/function.php";
include "../config/database.php";

$mysql = mysqlConnect();
if(!empty($_GET["search"]))
{
	//if(isset($_GET["search"]) == "") header('Location: /ticket/tableticket.php'); 
	$search=$_GET["search"];
	$result = $mysql->query("SELECT 
									* 
								FROM 
									emp
								WHERE
									empID = '".$search."'
								OR 
									empName LIKE '%".$search."'
								OR
									empEmail LIKE '%".$search."'
								OR
									empTel = '".$search."'");

	$gentable = '';
	while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) 
	{	
		if($row['Class'] == "admin") 
		{
			$hilight = "<tr class='danger'>\n";
			$class = "<td><h4><span class='label label-danger'>Admin</span></h></td>\n";
		}
		else if($row['Class'] == "support")
		{ 
			$hilight = "<tr class='warning'>\n";
			$class = "<td><h4><span class='label label-warning'>Support</span></h></td>\n";
		}
		else 
		{
			$hilight = "<tr class='active'>\n";
			$class = "<td><h4><span class='label label-info'>User</span></h></td>\n";
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////// Class
		
		$gentable .= "<form method='post' action='../user/userdetail.php'>\n".
		$hilight.
		"<td><h4>".$row['empID']."</h></td>\n".
		"<td><h4>".$row['username']."</h></td>\n".
		"<td><h4>".$row['empName']."</h></td>\n".
		"<td><input class='btn btn-primary' type='submit' value='Click for Detail'></input></td>\n".
		$class.
		"<input type='hidden' name='empID' value='".$row['empID']."'>\n</tr>\n</form>\n\n";
	}
	$paginationCtrls = '';
}
else
{
	$count = $mysql->query("SELECT COUNT(*) FROM emp ORDER BY Class ASC, empID ASC");
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
$result = $mysql->query("SELECT empID, username, empName, Class FROM emp ORDER BY Class ASC, empID ASC $limit"); // query

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
	if($row['Class'] == "admin") 
	{
		$hilight = "<tr class='danger'>\n";
		$class = "<td><h4><span class='label label-danger'>Admin</span></h></td>\n";
	}
	else if($row['Class'] == "support")
	{ 
		$hilight = "<tr class='warning'>\n";
		$class = "<td><h4><span class='label label-warning'>Support</span></h></td>\n";
	}
	else 
	{
		$hilight = "<tr class='active'>\n";
		$class = "<td><h4><span class='label label-info'>User</span></h></td>\n";
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////// Class
	
	$gentable .= "<form method='post' action='../user/userdetail.php'>\n".
	$hilight.
	"<td><h4>".$row['empID']."</h></td>\n".
	"<td><h4>".$row['username']."</h></td>\n".
	"<td><h4>".$row['empName']."</h></td>\n".
	"<td><input class='btn btn-primary' type='submit' value='Click for Detail'></input></td>\n".
	$class.
	"<input type='hidden' name='empID' value='".$row['empID']."'>\n</tr>\n</form>\n\n";
	
}
}


?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>USER TABLE LIST</title>
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
			<form method='get' action="tableuser.php?search" id='searchuser'>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">Search User</span>
						<input type="search" class="form-control" name="search" placeholder="Employee Detail here ... ">
						<span class="input-group-btn">
							<button class="btn btn-success" type="sumbit">
								<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
							</button>
						</span>
					</div>
				</div>
			</form>

			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>username</th>
						<th>empName</th>
						<th>Detail</th>
						<th>Class</th>
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