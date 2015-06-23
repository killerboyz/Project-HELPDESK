<?php

function navbar()
{
	$htmlnav1 = <<<STR
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="../index.php">HELPDESK</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
STR;
	$htmlLogin = <<<STR
	<form class="navbar-form navbar-right" method="post" action="/function/chklogin.php">
		<ul class="nav navbar-nav navbar-right">
			<li><input type="text" name="txtUser" class="form-control" placeholder="Username">&nbsp</li>
			<li><div class="input-group">
				<input input type="password" name="txtPass" class="form-control" placeholder="Password">
				<span class="input-group-btn">
					<button class="btn btn-info" type="submit" value="Login">LOGIN</button>
				</span>
			</ul>
	</form>
STR;
	echo $htmlnav1;
	if(!isset($_SESSION["login"]));
	else echo navLogin();
	echo "<li><a href=\"#\">About US</a></li>
		</ul>";

	if(!isset($_SESSION["login"]))echo $htmlLogin;
	else 
	{	
		echo "<form action='/function/logout.php'>
		<ul class='nav navbar-nav navbar-right'>
			<li><p class='navbar-text'>Hello , ".$_SESSION["login"]["empName"]."</p></li>
			<li><button class='btn btn-danger navbar-btn' type='submit' value='LOGOUT'>LOGOUT</button></li>
		</ul>
	</form>";

	}
	echo "</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>";
}

function logout()
{
	session_start();
	session_destroy();
	header("location: ../index.php");
}

/*function CheckPermission();
{

}*/

function navLogin()
{
	if($_SESSION["login"]["Class"] == "admin")
	{
		$navBar = <<<STR
		<li class="dropdown">
			<button class="btn btn-info dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="true">FAQ<span class="caret"></span></button>
			<ul class="dropdown-menu" role="menu">
				<li><a href="/faq/createfaq.php">Create FAQ</a></li>
				<li><a href="/faq/tablefaq.php">Table FAQ</a></li>
				<li class="divider"></li>
				<li><a href="#">Report</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<button class="btn btn-warning dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">Ticket<span class="caret"></span></button>
			<ul class="dropdown-menu" role="menu">
				<li><a href="/ticket/createticket.php">Create Ticket</a></li>
				<li><a href="/ticket/tableticket.php">Table Ticket</a></li>
				<li class="divider"></li>
				<li><a href="#">Report</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<button class="btn btn-success dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">User<span class="caret"></span></button>
			<ul class="dropdown-menu" role="menu">
				<li><a href="/user/createuser.php">Create USER</a></li>
				<li><a href="/user/tableuser.php">Table User</a></li>
				<li class="divider"></li>
				<li><a href="#">Report</a></li>
			</ul>
		</li>
STR;
	}
	if($_SESSION["login"]["Class"] == "support")
	{
		$navBar = <<<STR
		<li class="dropdown">
			<button class="btn btn-info dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="true">FAQ<span class="caret"></span></button>
			<ul class="dropdown-menu" role="menu">
				<li><a href="/faq/createfaq.php">Create FAQ</a></li>
				<li><a href="/faq/tablefaq.php">Table FAQ</a></li>
				<li class="divider"></li>
				<li><a href="#">Report</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<button class="btn btn-warning dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">Ticket<span class="caret"></span></button>
			<ul class="dropdown-menu" role="menu">
				<li><a href="/ticket/createticket.php">Create Ticket</a></li>
				<li><a href="/ticket/tableticket.php">Table Ticket</a></li>
				<li class="divider"></li>
				<li><a href="#">Report</a></li>
			</ul>
		</li>
STR;
	}
	if($_SESSION["login"]["Class"] == "user")
	{
		$navBar = <<<STR
		<li class="dropdown">
			<button class="btn btn-info dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="true">FAQ<span class="caret"></span></button>
			<ul class="dropdown-menu" role="menu">
				<li><a href="/faq/tablefaq.php">Table FAQ</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<button class="btn btn-warning dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">Ticket<span class="caret"></span></button>
			<ul class="dropdown-menu" role="menu">
				<li><a href="/ticket/createticket.php">Create Ticket</a></li>
				<li class="divider"></li>
				<li><a href="/ticket/tableticket.php">Check Ticket</a></li>
			</ul>
		</li>
STR;
	}
	return $navBar;
}

?>