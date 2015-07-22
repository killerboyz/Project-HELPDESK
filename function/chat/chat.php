<?php
session_start();
if(empty($_SESSION["login"])) header("location: /index.php");
require_once dirname(__FILE__)."/src/phpfreechat.class.php";
$params = array();
$params["title"] = "HELPDESK SERVICE CHAT";
$params["channels"] = array("HELPDESK");
$params["theme"] = "default";
$params["nick"] = $_SESSION["login"]["empName"];  // setup the intitial nickname
//$params['firstisadmin'] = false;
if($_SESSION["login"]["Class"] != "user") $params["isadmin"] = true; // makes everybody admin: do not use it on production servers ;)
$params["serverid"] = "7d19b8a692aa021a925b53112d27a885"; // calculate a unique id for this chat
$params["debug"] = false;
$chat = new phpFreeChat( $params );



?>
<!DOCTYPE html">
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>CHAT</title>
  <link rel="stylesheet" href="/function/chat/style/bootstrap.min.css">
   
 </head>
 <body>





<div class="">
  <?php $chat->printChat(); ?>
  
</div>

    
</body></html>
