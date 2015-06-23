<?php
session_start();
require "../function/function.php";
include "../config/database.php";

$mysql = mysqlConnect();
if(!empty($_GET["search"]))
{
	$search=$_GET["search"];
	$result = $mysql->query("SELECT 
									faqID, faqTopic, faqType, Create_By 
								FROM 
									faq
								WHERE
									faqID= '".$search."'
								OR 
									faqTopic LIKE '%".$search."%'
								OR
									Create_By= '".$search."'
								ORDER BY
									Create_On DESC,
									faqID ASC");
	$count = $mysql->query("SELECT 
									COUNT(faqID), faqTopic, faqType, Create_By 
								FROM 
									faq
								WHERE
									faqID= '".$search."'
								OR 
									faqTopic LIKE '%".$search."%'
								OR
									Create_By= '".$search."'
								ORDER BY
									Create_On DESC,
									faqID ASC");
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
	$result = $mysql->query("SELECT 
									faqID, faqTopic, faqType, Create_By 
								FROM 
									faq
								WHERE
									faqID= '".$search."'
								OR 
									faqTopic LIKE '%".$search."%'
								OR
									Create_By= '".$search."'
								ORDER BY
									Create_On DESC,
									faqID ASC 
									$limit");
	
	$strValue = $_SERVER['PHP_SELF']."?search=".$_GET["search"];
	$paginationCtrls = '';
	if($last != 1) 
	{
		if($pagenum > 1) 
		{
			$paginationCtrls .= "<li><a href=".$strValue."?page=1>«</a></li>\n";
			for ($i=$pagenum-1; $i < $pagenum; $i++) 
			{ 
				if ($i > 0) $paginationCtrls .= "<li><a href=".$strValue."?page=".$i.">".$i."</a></li>\n";
			}
		}
		if($paginationCtrls == '') $paginationCtrls .= "<li class='active'><a href='#'>".$pagenum."</a></li>\n";
		else $paginationCtrls .= "<li class='active'><a href='#'>".$pagenum."</a></li>\n";
		
		for ($i=$pagenum+1; $i < $last; $i++)
		{ 
			$paginationCtrls .= "<li><a href=".$strValue."?page=".$i.">".$i."</a></li>\n";
			if($i >= $pagenum+1) break;

		}
		if($pagenum != $last)
		{
			$next = $pagenum+1;
			if($pagenum == ($last-1)) $paginationCtrls .= "<li><a href=".$strValue."?page=".$last.">".$last."</a></li>\n";
			$paginationCtrls .= "<li><a href=".$strValue."?page=".$last.">»</a></li>\n";
		}
		
		$gentable = '';
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) 
		{	
			if($row['faqType'] == "Hardware") 
			{
				$hilight = "<tr class='info'>\n";
				$type = "<td><h4><span class='label label-danger'>Hardware</span></h></td>\n";
			}
			else if($row['faqType'] == "Software")
			{ 
				$hilight = "<tr class='success'>\n";
				$type = "<td><h4><span class='label label-warning'>Software</span></h></td>\n";
			}
			////////////////////////////////////////////////////////////////////////////////////////////////////////// Type
			$gentable .= "<form method='get' action='../faq/faqdetail.php'>\n".
			$hilight.
			"<td><h4>".$row['faqTopic']."</h></td>\n".
			$type.
			"<td><input class='btn btn-primary' type='submit' value='Click for Detail'></input></td>\n
			<td><h4>".$row['Create_By']."</h></td>\n
			<input type='hidden' name='faqID' value='".$row['faqID']."'>\n</tr>\n</form>\n\n";
		}
		$paginationCtrls = '';
	}
}
else
{
	$count = $mysql->query("SELECT COUNT(*) FROM faq ORDER BY Create_On DESC , faqID ASC");
	

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
	$result = $mysql->query("SELECT faqID, faqTopic, faqType, Create_By, Create_On FROM faq ORDER BY Create_On DESC , faqID ASC $limit");
	

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
		if($row['faqType'] == "Hardware") 
		{
			$hilight = "<tr class='info'>\n";
			$type = "<td><h4><span class='label label-danger'>Hardware</span></h></td>\n";
		}
		else if($row['faqType'] == "Software")
		{ 
			$hilight = "<tr class='success'>\n";
			$type = "<td><h4><span class='label label-warning'>Software</span></h></td>\n";
		}
	////////////////////////////////////////////////////////////////////////////////////////////////////////// Type
		$gentable .= "<form method='get' action='../faq/faqdetail.php'>\n".
		$hilight.
		"<td><h4>".$row['faqTopic']."</h></td>\n".
		$type.
		"<td><input class='btn btn-primary' type='submit' value='Click for Detail'></input></td>\n
		<td><h4>".$row['Create_By']."</h></td>\n
		<input type='hidden' name='faqID' value='".$row['faqID']."'>\n</tr>\n</form>\n\n";
	}
}


?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>FAQ TABLE LIST</title>
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
			<form method='get' action="tablefaq.php?search" id='searchfaq'>
			<div class="form-group">
				<div class="input-group">
				<span class="input-group-addon">Search FAQ</span>
					<input type="search" class="form-control" name="search" placeholder="FAQID , FAQ Topic , Create_By here ... " autocomplete="off">
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
						<th>FAQ Topic</th>
						<th>Type</th>
						<th>FAQ Detail</th>
						<th>Create By</th>
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