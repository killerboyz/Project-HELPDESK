<?php
session_start();

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>TICKET</title>
	<script src="js/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="css/_bootswatch.scss">
	<link rel="stylesheet" href="css/_variables.scss">

	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.min.js"></script>
</head>

<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">HELPDESK</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <?php
          if(!isset($_SESSION["login"]))
          {
          }
          else echo $_SESSION["login"]["navbar"];
          ?>
          <li><a href="#">About US</a></li>
        </ul>
        <?php
        if(!isset($_SESSION["login"]))
        {
          header("location: /index.php");
        }
        else 
        {
          echo 
          "<form action=\"logout.php\">
          <ul class=\"nav navbar-nav navbar-right\">
            <li><p class=\"navbar-text\">Hello , ".$_SESSION["login"]["empName"]."</p></li>
            <li><button class=\"btn btn-danger navbar-btn\" type=\"submit\" value=\"logout\">LOGOUT</button></li>
          </ul>
        </form>";
      }
      ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


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