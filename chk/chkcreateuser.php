<?php
session_start();
require "../function/function.php";
include "../config/database.php";

$mysql = mysqlConnect();
$chkUser = mysqli_fetch_array($mysql->query("SELECT 'username' FROM emp WHERE username = '".mysql_real_escape_string($_POST['txtUsername'])."'"),MYSQLI_ASSOC);


if($_POST["pwdtoconfirm"] != $_SESSION["login"]["pwd"])
{
	echo "<script>alert('Please type your correct Password!');window.history.back();</script>";
	exit();
	
}
else
{
	if($chkUser) 
	{
		echo "<script>alert('Username already exists!');window.history.back();</script>";
		exit();
	}
	if($_POST["txtPassword"] != $_POST["txtconfirmpassword"])
	{
		echo "<script>alert('Password not Match!');window.history.back();</script>";
		exit();
	}
	if (!filter_var($_POST["txtempEmail"], FILTER_VALIDATE_EMAIL)) 
	{
		echo "<script>alert('Please input Correct E-mail (example : email@example.com)');window.history.back();</script>";
		exit();
	}

	$strInsert = "INSERT INTO emp VALUES 
		(NULL,'"
		.$_POST["txtUsername"]."','"
		.$_POST["txtPassword"]."','"
		.$_POST["txtempName"]."','"
		.$_POST["txtempEmail"]."','"
		.$_POST["txtempTel"]."','"
		.$_POST["Class"]."',
		NULL)";
	$mysql->query($strInsert);
	echo var_dump($mysql->query($strInsert))."</br>";
	echo $strInsert."</br>";
	echo "empID = ".$mysql->insert_id."</br>";
	echo "CREATE USER SUCCESFULL!";
}



?>