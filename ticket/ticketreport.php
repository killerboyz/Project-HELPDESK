<?php
session_start();
require "../function/function.php";
include "../function/database.php";

$mysql = mysqlConnect();

$result = $mysql->query("SELECT empID, empName, Class FROM emp WHERE Class IN ('admin','support') ORDER BY empName ASC");
while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
{
	$selSupport .= "<option value=".$row["empID"].">".$row["empName"]."</option>\n";
}

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ticket REPORT</title>
	<script src="../js/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap-datepicker3.min.css">
	

	<!-- Optional theme -->
	<link rel="stylesheet" href="../css/_bootswatch.scss">
	<link rel="stylesheet" href="../css/_variables.scss">

	<!-- Latest compiled and minified JavaScript -->
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/bootstrap-datepicker.min.js"></script>
	<script src="../locales/bootstrap-datepicker.th.min.js"></script>
	
	

	
</head>

<body>
	<?php navbar();?>

	<!-- ---------------------------------------------------------------------------------------------------------------- NAVIGATOR BAR --------------------------------------------------------------------------------- -->


	<div class="container">
		<div class="row">
			<div class="jumbotron">

				<div class="row">
					
					<div class="page-header text-center">
						<h1>TICKET Report</h1>
					</div>
					
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-info">

							<div class="panel-heading">
								<h3 class="panel-title">Select Create By Month</h3>
							</div>

							<div class="panel-body">

								<form class="form-horizontal" action="/ticket/printreport.php?by=month" method="post" target="_blank">

									<div class="row">
										<label for="select" class="col-md-2 control-label">Month :</label>
										<div class="col-md-4">
											<select class="form-control input-sm" id="month" name="month">
												<option value="1"  <?PHP if(date("n")==1) echo "selected";?>>January</option>
												<option value="2"  <?PHP if(date("n")==2) echo "selected";?>>February</option>
												<option value="3"  <?PHP if(date("n")==3) echo "selected";?>>March</option>
												<option value="4"  <?PHP if(date("n")==4) echo "selected";?>>April</option>
												<option value="5"  <?PHP if(date("n")==5) echo "selected";?>>May</option>
												<option value="6"  <?PHP if(date("n")==6) echo "selected";?>>June</option>
												<option value="7"  <?PHP if(date("n")==7) echo "selected";?>>July</option>
												<option value="8"  <?PHP if(date("n")==8) echo "selected";?>>August</option>
												<option value="9"  <?PHP if(date("n")==9) echo "selected";?>>September</option>
												<option value="10" <?PHP if(date("n")==10) echo "selected";?>>October</option>
												<option value="11" <?PHP if(date("n")==11) echo "selected";?>>November</option>
												<option value="12" <?PHP if(date("n")==12) echo "selected";?>>December</option>
											</select>
										</div>
									</div>

									<br>

									<div class="row">
										<label for="select" class="col-md-2 control-label">Year :</label>
										<div class="col-md-4">
											<select class="form-control input-sm" id="year" name="year" >
												<?PHP for($i=date("Y"); $i>=date("Y")-10; $i--)
												if($year == $i)
													echo "<option value='$i' selected>$i</option>";
												else
													echo "<option value='$i'>$i</option>";
												?>
											</select>
										</div>
									</div>

									<br>

									<div class="row">
										<label class="col-md-push-2 col-md-1">
											<button type="submit" class="btn btn-primary btn-sm">CLICK FOR PREVIEW</button>
										</label>
									</div>

								</form>
							</div>
						</div>
					</div>

					<div class="col-md-6 ">
						<div class="panel panel-info">

							<div class="panel-heading">
								<h3 class="panel-title">Select by Options</h3>
							</div>

							<div class="panel-body">
								<form class="form-horizontal" action="/ticket/printreport.php?by=options" method="post" target="_blank">

									<div class="row">
										<fieldset>

											<label class="col-md-3 control-label">Status : </label>
											<div class="col-md-9">
												<label class="checkbox-inline">
													<input type="checkbox" name="Status[0]" value="Open" checked>Open
												</label>
												<label class="checkbox-inline">
													<input type="checkbox" name="Status[1]" value="Processing" checked>Processing
												</label>
												<label class="checkbox-inline">
													<input type="checkbox" name="Status[2]" value="Solved" checked>Solved
												</label>
												<label class="checkbox-inline">
													<input type="checkbox" name="Status[3]" value="Closed" checked>Closed
												</label>
											</div>

										</fieldset>
									</div>

									<br>

									<div class="row">
										<fieldset>

											<label class="col-md-3 control-label">Priority : </label>
											<div class="col-md-9">
												<label class="checkbox-inline">
													<input type="checkbox" name="Priority[0]" value="High" checked>High
												</label>
												<label class="checkbox-inline">
													<input type="checkbox" name="Priority[1]" value="Normal" checked>Normal
												</label>
												<label class="checkbox-inline">
													<input type="checkbox" name="Priority[2]" value="Low" checked>Low
												</label>
											</div>

										</fieldset>
									</div>

									<br>

									<div class="row">
										<fieldset>
											<label class="col-md-3 control-label">Type : </label>
											<div class="col-md-9">
												<label class="radio-inline">
													<input type="radio" name="type" value="all" checked>All
												</label>
												<label class="radio-inline">
													<input type="radio" name="type" value="hw">Hardware Only
												</label>
												<label class="radio-inline">
													<input type="radio" name="type" value="sw">Software Only
												</label>
											</div>
										</fieldset>
									</div>



									<br>

									<div class="row">
										<label class="col-md-3 control-label">Create ON : </label>
										<div class="col-md-8">
											<div class="input-daterange input-group" id="datepicker">
												<input type="text" class="input-sm form-control" onkeydown="return false" name="startC" autocomplete="off"/>
												<span class="input-group-addon">to</span>
												<input type="text" class="input-sm form-control" onkeydown="return false" name="endC" autocomplete="off"/>
											</div>
										</div>
									</div>

									<br>

									<div class="row">
										<label class="col-md-3 control-label">Support On : </label>
										<div class="col-md-8">
											<div class="input-daterange input-group" id="datepicker">
												<input type="text" class="input-sm form-control" onkeydown="return false" name="startS" autocomplete="off"/>
												<span class="input-group-addon">to</span>
												<input type="text" class="input-sm form-control" onkeydown="return false" name="endS" autocomplete="off"/>
											</div>
										</div>
									</div>

									<br>

									<div class="row">
										<label class="col-md-3 control-label">Support By :</label>
										<div class="col-md-8">
											<select class="form-control input-sm" id="select" name="supportBy">
												<option value="">Select all Support</option>
												<?php echo $selSupport;?>
											</select>
										</div>
									</div>

									<br>

									<div class="row">

										<label class="col-md-push-2 col-md-1">
											<button type="submit" class="btn btn-primary btn-sm">CLICK FOR PREVIEW</button>
										</label>
									</div>


								</form>
								

								<p class="text-danger">*หมายเหตุ :<br/>
								หากไม่ได้เลือกวันที่ Create On ไว้ วันที่ในหัวกระดาษจะนับจากวันที่ Create On ของ Ticket ID แรก และ สุดท้าย ในตาราง</p>
								
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>

	<script type="text/javascript">
		$('.input-daterange').datepicker({
			format: 'yyyy/mm/dd',
			endDate: "today",
			language: "th,en",
			todayBtn: "linked",
			todayHighlight: true,
			clearBtn: true,
			calendarWeeks: true,
			orientation: "top auto",
			autoclose: true,
		});

	</script>

</body>
</html>