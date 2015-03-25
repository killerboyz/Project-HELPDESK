<?php
session_start();
require "../function/function.php";

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>TICKET</title>
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


	<div class="row">
		<div class="col-md-push-1 col-md-10 col-md-pull-1">
			<table class="table table-striped table-hover ">
				<thead>
					<tr>
						<th>TicketID</th>
						<th>TicketTopic</th>
						<th>Type</th>
						<th>Priority</th>
						<th>Trouble Detail</th>

					</tr>
				</thead>
				<tbody>
					<tr class="info">
						<td>1</td>
						<td>Column content</td>
						<td>
							<span class="label label-success">Program A</span>
						</td>
						<td>
							<span class="label label-danger">High</span>
						</td>
						<td>
							<button aria-describedby="popover587911" title="" data-original-title="" type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">Detail</button>

						</td>

					</tr>
					<tr class="success">
						<td>2</td>
						<td>Column content</td>
						<td>
							<span class="label label-success">Program A</span>
						</td>
						<td>
							<span class="label label-danger">High</span>
						</td>
						<td>Click for detail</td>
					</tr>
					<tr class="danger">
						<td>3</td>
						<td>Column content</td>
						<td>
							<span class="label label-success">Program B</span>
						</td>
						<td>
							<span class="label label-warning">Normal</span>
						</td>
						<td>Click for detail</td>
					</tr>
					<tr class="warning">
						<td>4</td>
						<td>Column content</td>
						<td>
							<span class="label label-success">Program B</span>
						</td>
						<td>
							<span class="label label-warning">Normal</span>
						</td>
						<td>Click for detail</td>
					</tr>
					<tr class="active">
						<td>5</td>
						<td>Column content</td>
						<td>
							<span class="label label-success">Program C</span>
						</td>
						<td>
							<span class="label label-info">Low</span>
						</td>
						<td>asd
						</td>
					</tr>
				</tbody>
			</table> 

		</div>
	</div>

</body>
</html>