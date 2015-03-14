<?php

session_start();

mysql_connect("10.10.10.99", "killerboyz", "2bBGqQFjP7eduREw")or exit("cannot connect");
mysql_select_db("helpdesk")or exit("cannot select DB");
$objResult = mysql_fetch_assoc(mysql_query("SELECT * FROM emp WHERE username = '".mysql_real_escape_string($_POST['txtUser'])."' and password = '".mysql_real_escape_string($_POST['txtPass'])."'"));


if(!$objResult) {
	echo 	"<script>
	alert(\"Username or Password Incorrect !!\");
	window.location = \"/index.php\";
</script>";
exit();
}
if($objResult["Class"] == "admin") {
	$_SESSION["login"]["Class"] = $objResult["Class"];
	$_SESSION["login"]["empID"] = $objResult["empID"];
	$_SESSION["login"]["empName"] = $objResult["empName"];
	$_SESSION["login"]["pwd"] = $objResult["password"];
	$_SESSION["login"]["navbar"] = <<<STR
	<li class="dropdown">
		<button class="btn btn-info dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">FAQ<span class="caret"></span></button>
		<ul class="dropdown-menu" role="menu">
			<li><a href="createfaq.php">Create FAQ</a></li>
			<li><a href="#">Edit FAQ</a></li>
			<li class="divider"></li>
			<li><a href="#">Report</a></li>
		</ul>
	</li>
	<li class="dropdown">
		<button class="btn btn-warning dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">Ticket<span class="caret"></span></button>
		<ul class="dropdown-menu" role="menu">
			<li><a href="createticket.php">Create Ticket</a></li>
			<li><a href="tableticket.php">Table Ticket</a></li>
			<li class="divider"></li>
			<li><a href="#">Report</a></li>
		</ul>
	</li>
	<li class="dropdown">
		<button class="btn btn-success dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">User<span class="caret"></span></button>
		<ul class="dropdown-menu" role="menu">
			<li><a href="createuser.php">Create USER</a></li>
			<li class="divider"></li>
			<li><a href="#">Edit User</a></li>
			
		</ul>
	</li>
STR;
}
if($objResult["Class"] == "support") {
	$_SESSION["login"]["Class"] = $objResult["Class"];
	$_SESSION["login"]["empID"] = $objResult["empID"];
	$_SESSION["login"]["empName"] = $objResult["empName"];
	$_SESSION["login"]["navbar"] = <<<STR
	<li class="dropdown">
		<button class="btn btn-warning dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">Ticket<span class="caret"></span></button>
		<ul class="dropdown-menu" role="menu">
			<li><a href="createticket.php">Create Ticket</a></li>
			<li><a href="tableticket.php">Table Ticket</a></li>
		</ul>
	</form>
</li>
<li class="dropdown">
	<button class="btn btn-warning dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">Ticket<span class="caret"></span></button>
	<ul class="dropdown-menu" role="menu">
		<li><a href="createticket.php">Create Ticket</a></li>
		<li><a href="tableticket.php">Table Ticket</a></li>
		<li class="divider"></li>
		<li><a href="#">Report</a></li>
	</ul>
</li>
STR;
}
if($objResult["Class"] == "user") {
	$_SESSION["login"]["Class"] = $objResult["Class"];
	$_SESSION["login"]["empID"] = $objResult["empID"];
	$_SESSION["login"]["empName"] = $objResult["empName"];
	$_SESSION["login"]["navbar"] = <<<STR
	<li class="dropdown">
		<button class="btn btn-warning dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">Ticket<span class="caret"></span></button>
		<ul class="dropdown-menu" role="menu">
			<li><a href="createticket.php">Create Ticket</a></li>
			<li class="divider"></li>
			<li><a href="tableticket.php">Check Ticket</a></li>
		</ul>

	</li>
STR;
}


/*$_SESSION["login"] = array(
	"Class" => $objResult["Class"],
	"empID" => $objResult["empID"],
	"empName" => $objResult["empName"]
	);
	*/

header("location: /index.php");

/*$_SESSION["login"]["Class"] = $objResult["Class"];
$_SESSION["login"]["empID"] = $objResult["empID"];
$_SESSION["login"]["empName"] = $objResult["empName"];*/
?>

