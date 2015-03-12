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



$_SESSION["login"] = array(
	"Class" => $objResult["Class"],
	"empID" => $objResult["empID"],
	"empName" => $objResult["empName"]
);

header("location: /index.php");

/*$_SESSION["login"]["Class"] = $objResult["Class"];
$_SESSION["login"]["empID"] = $objResult["empID"];
$_SESSION["login"]["empName"] = $objResult["empName"];*/
?>

