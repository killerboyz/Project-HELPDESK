<?php
session_start();
include '../config/database.php';


$mysql = mysqlConnect();
$objResult = mysqli_fetch_assoc($mysql->query("SELECT * FROM emp WHERE username = '".mysql_real_escape_string($_POST['txtUser'])."' and password = '".mysql_real_escape_string($_POST['txtPass'])."'"));

if(!$objResult) {
	echo 	"<script>
	alert(\"Username or Password Incorrect !!\");
	window.location = \"../index.php\";
</script>";
exit();
}
$_SESSION["login"] = array(
							"Class" => $objResult["Class"],
							"empID" => $objResult["empID"],
							"empName" => $objResult["empName"],
							"pwd" => $objResult["password"]
						);
$mysql->query("UPDATE emp SET `last-log-on`='".date("Y-m-d H:i:s",time())."' WHERE empID=".$objResult["empID"]);
//echo "UPDATE emp SET last-log-on=NOW() WHERE empID=".$objResult["empID"];

header("location: ../index.php");

/*
$_SESSION["login"]["Class"] = $objResult["Class"];
$_SESSION["login"]["empID"] = $objResult["empID"];
$_SESSION["login"]["empName"] = $objResult["empName"];
*/
?>

