<?php 


include '/config/database.php';

/*

---------------------------------------------------------------------
|
---------------------------------------------------------------------

*/



/*
$obj = mysqlConnect();
$obj->query();

function mysqlConnect() {
	$mysqli = new mysqli("10.10.10.99", "killerboyz", "2bBGqQFjP7eduREw", "helpdesk");

	if ($mysqli->connect_errno)
	{
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		exit();
	}

	$mysqli->query("SET NAMES UTF8");

	return $mysqli;
}

*/


$mysql = mysqlConnect();
//$query = "INSERT INTO emp VALUES (NULL,'support1','support','SUPPORT SUPPORT','support@support.com','12345','support',NULL)";
//$mysql->query($query);


printf ("New Record has id %d.\n", $mysql->insert_id);
echo var_dump($mysql->insert_id);

?>