<?php
session_start();
mysql_connect("10.10.10.99", "killerboyz", "2bBGqQFjP7eduREw")or exit("cannot connect");
mysql_select_db("helpdesk")or exit("cannot select DB");

if($_POST["pwdtoconfirm"] != $_SESSION["login"]["pwd"])
{
	echo "<script>alert('Please type your correct Password!');window.history.back();</script>";
	exit();
	
}
else{
	
	if(mysql_fetch_assoc(mysql_query("SELECT 'username' FROM emp WHERE username = '".mysql_real_escape_string($_POST['txtUsername'])."'"))) 
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

	$countEmpId = mysql_fetch_assoc(mysql_query("SELECT COUNT(empID) as CountID FROM emp"));

	$strInsert = "INSERT INTO emp (empID,username,password,empName,empEmail,empTel,Class) VALUES ('"
		.(intval($countEmpId["CountID"])+1)."','"
		.$_POST["txtUsername"]."','"
		.$_POST["txtPassword"]."','"
		.$_POST["txtempName"]."','"
		.$_POST["txtempEmail"]."','"
		.$_POST["txtempTel"]."','"
		.$_POST["Class"]."')";
$queryString = mysql_query($strInsert);

echo "empID = ".(intval($countEmpId["CountID"])+1);
echo "</br>CREATE USER SUCCESFULL!";


}



?>