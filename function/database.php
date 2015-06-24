<?php 

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

?>