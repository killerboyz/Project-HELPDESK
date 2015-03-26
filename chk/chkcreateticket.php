<?php
session_start();
require "../function/function.php";
include "../config/database.php";

$mysql = mysqlConnect();



if($_POST['ChkConfirm'] != "ABC")
{
	echo "<script>
		alert(\"Please type ABC !!\");
		window.history.back();
		</script>";
	exit();

	
}
else 
{
	
	$strInsert1 = "INSERT INTO ticket (TicketTopic,TicketType,TroubleDetail,Priority,psrPath,`Create-By`,Status)
				VALUES ('".$_POST["txtTopic"]."','".$_POST["Type"]."','".$_POST["txtDetail"]."','".$_POST["priLvl"]."',NULL,".$_SESSION["login"]["empID"].",'Open')";
	
	$mysql->query($strInsert1);

	
	echo "Ticket ID : ".$mysql->insert_id."</br>";
	echo "Ticket Topic : ".$_POST['txtTopic']."</br>";
	echo "Type : ".$_POST['Type']."</br>";
	echo "Trouble Detail : ".$_POST['txtDetail']."</br>";
	echo "Priority : ".$_POST['priLvl']."</br>";
	echo "Create By : ".$_SESSION["login"]["empName"]."</br>";
	echo "Create Ticket Succes!";
}
?>