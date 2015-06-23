<?php
session_start();
require "../function/function.php";
include "../config/database.php";
$mysql = mysqlConnect();
$strSQL = "SELECT 
				* 
			FROM 
				emp 
			WHERE
				empID='".$_POST["empID"]."'";

$objResult = mysqli_fetch_assoc($mysql->query($strSQL));



?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>TICKET DETAIL</title>
	<script src="../js/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="../css/_bootswatch.scss">
	<link rel="stylesheet" href="../css/_variables.scss">

	<!-- Latest compiled and minified JavaScript -->
	<script src="../js/bootstrap.min.js"></script>
	<script>
		function mouseoverPass(obj) 
		{
			var obj = document.getElementById('txtPassword');
			obj.type = "text";
		}
		function mouseoutPass(obj)
		{
			var obj = document.getElementById('txtPassword');
			obj.type = "password";
		}

		function chkUserPass(e) {
			if((e.which == 8 || e.which == 9 || e.keyCode == 37 || e.keyCode == 39 || e.which >= 48 && e.which <= 57) || (e.which >= 97 && e.which <= 122)) return true;
			else return false;
		};
		function chkName(e) {
			if((e.which == 8 || e.which == 9 || e.which == 32 || e.keyCode == 37 || e.keyCode == 39 || e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122) || (e.which >= 3585 && e.which <= 3652)) return true;
			else return false;
		};
		function chkTel(e){
			if(e.which == 8 || e.which == 9 || e.keyCode == 37 || e.keyCode == 39  ||e.which == 43 || e.which == 45 || (e.which >= 48 && e.which <= 57) || (e.which >= 40 && e.which <= 41)) return true;
			else return false;
		}

	</script>
</head>

<body>
	
	<?php navbar();?>

	<!-- ---------------------------------------------------------------------------------------------------------------- USER DESCRIPTION --------------------------------------------------------------------------------- -->
	<div class="container">
		<form method="post" action="/user/chkupdateuser.php">
			<div class="row">
				<div class="panel panel-info">
					<div class="panel-heading">User Detail</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
								<label class="control-label">Employee ID</label>
								<input type="text" class="form-control" name="txtempID" readonly disable="" value="<?php echo htmlspecialchars($objResult["empID"]);?>">
							</div>
							<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
								<label class="control-label">Employee Name</label>
								<input class="form-control" type="text" name="txtempName" tabindex="1" minlength="6" maxlength="50" autocomplete="off" title="Allow only a-z A-Z ก-ฮ" pattern=".{6,50}" required onkeypress="return chkName(event);" value="<?php echo htmlspecialchars($objResult["empName"]);?>">
							</div>
						</div>

						<div class="row">
							<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
								<label class="control-label">Username</label>
								<input type="text" class="form-control" name="txtUsername" readonly disable="" value="<?php echo htmlspecialchars($objResult["username"]);?>">
							</div>
							<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
								<label class="control-label">Password</label>
								<input class="form-control" type="password" name="txtPassword" id="txtPassword" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();" minlength="6" maxlength="10" tabindex="2" required onkeypress="return chkUserPass(event);"value="<?php echo htmlspecialchars($objResult["password"]);?>">
							</div>
						</div>

						<div class="row">
							<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
								<label class="control-label">Employee Email</label>
								<input type="email" class="form-control" name="txtempEmail" minlength="6" maxlength="50" autocomplete="off" title="Allow only email (example : email@example.com)" pattern=".{6,50}" tabindex="5" required value="<?php echo htmlspecialchars($objResult["empEmail"]);?>" >
							</div>
							<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
								<label class="control-label">Employee Tel</label>
								<input type="tel" class="form-control" name="txtempTel" minlength="4" maxlength="15" autocomplete="off" pattern=".{6,15}" tabindex="6" required onkeypress="return chkTel(event);" value="<?php echo htmlspecialchars($objResult["empTel"]);?>">
							</div>
						</div>

						<div class="row">
							<div class="col-xs-8 col-sd-offset-1 col-sd-5 col-md-offset-1 col-md-4">
								<label for="select" class="control-label">Class</label>
								<select class="form-control" name="Class">
								<?php
								if($objResult["Class"] == "admin")
								{
									echo "<option value='admin' selected='selected'>Administrator</option>
										<option value='support'>Support</option>
										<option value='user'>User</option>";
								}
								else if($objResult["Class"] == "support")
								{
									echo "<option value='admin'>Administrator</option>
										<option value='support' selected='selected'>Support</option>
										<option value='user'>User</option>";
								}
								else
								{
									echo "<option value='admin'>Administrator</option>
										<option value='support'>Support</option>
										<option value='user' selected='selected'>User</option>";
								}
								?>
									
								</select>
							</div>
							<div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
								<label class="control-label">Last Log On</label>
								<text class="form-control" readonly disable="">
									<?php 
									if($objResult["last-log-on"] == null) echo "Not Yet";
									else echo $objResult["last-log-on"];
									?>
								</text>
							</div>
						</div>

						<br>
						<div class='row'>
							<div class='col-xs-10 col-sd-offset-1 col-sd-11 col-md-offset-1 col-md-9'>
								<div class='form-group'>
									<label class='control-label'>Confirm Update</label>
									<div class='input-group'>
										<span class='input-group-addon'>Type Password</span>
										<input type='password' class='form-control' name='pwdtoconfirm' id='pwdtoconfirm' autocomplete='off' minlength='5' required onmouseover='mouseoverPass();' onmouseout='mouseoutPass();'>
										<span class='input-group-btn'>
											<input class='btn btn-success' name='status' type='submit' value='Update'>
										</span>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="row center-block">
				<a class="center-block btn btn-primary btn-lg" href="../index.php">Back to Home</a>
			</div>
		</form>
	</div>


</body>
</html>