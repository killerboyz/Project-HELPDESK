<?php
session_start();

$tktAdmin = <<<STR
<li class="dropdown">
  <button class="btn btn-info dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">FAQ<span class="caret"></span></button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="#">Create FAQ</a></li>
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
STR;

$tktSupport = <<<STR
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

$tktUser = <<<STR
<li class="dropdown">
  <button class="btn btn-warning dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">Ticket<span class="caret"></span></button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="createticket.php">Create Ticket</a></li>
    <li class="divider"></li>
    <li><a href="tableticket.php">Check Ticket</a></li>
  </ul>
  
</li>
STR;


?>


<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>CREATE TICKET</title>
  <script src="js/jquery.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="css/_bootswatch.scss">
  <link rel="stylesheet" href="css/_variables.scss">

  <!-- Latest compiled and minified JavaScript -->
  <script src="js/bootstrap.min.js"></script>
</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">HELPDESK</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <?php
          if(!isset($_SESSION["login"]))
          {
          }
          else if($_SESSION["login"]["Class"] == "admin") echo $tktAdmin;
          else if($_SESSION["login"]["Class"] == "support") echo $tktSupport;
          else if($_SESSION["login"]["Class"] == "user") echo $tktUser;
          ?>
          <li><a href="#">About US</a></li>
        </ul>
        <?php
        if(!isset($_SESSION["login"]))
        {
          echo $htmlLogin;
        }
        else 
        {
          echo 
          "<form action=\"logout.php\">
          <ul class=\"nav navbar-nav navbar-right\">
            <li><p class=\"navbar-text\">Hello , ".$_SESSION["login"]["empName"]."</p></li>
            <li><button class=\"btn btn-danger navbar-btn\" type=\"submit\" value=\"logout\">LOGOUT</button></li>
          </ul>
          </form>";
        }
        ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

  <form name="CreateTicket" method="post" action="chkticket.php">
    <fieldset>
      <div class="col-md-offset-1 col-md-8">
        <div class="panel panel-info ">
          <div class="panel-heading">Employee Detail</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-2 col-sd-offset-1 col-md-offset-1">    
                <label class="control-label" for="EmpName">EmpName</label>
                <input class="form-control" id="EmpName" placeholder="EmpName" type="text" disabled="" value="<?php echo htmlspecialchars($_SESSION["login"]["empName"]);?>">
              </div>
            </div>
          </div>
        </div>
      </div>
    </fieldset>
    <fieldset>
      <div class="col-md-offset-1 col-md-8">
        <div class="panel panel-danger ">
          <div class="panel-heading">Ticket Trouble Detail</div>
          <div class="panel-body">

            <div class="row">
              
              <div class="col-xs-2 col-sd-offset-1 col-sd-1 col-md-offset-1 col-md-2form-group has-warning">
                <label class="control-label" for="TicketTopic">TicketTopic</label>
                <input class="form-control" name="TicketTopic" id="TicketTopic"  type="text" placeholder="TicketTopic">
              </div>
              <div class="col-xs-2 col-sd-offset-1 col-sd-1 col-md-offset-1 col-md-2">
                <label for="select" class="control-label">Type</label>
                <select class="form-control" name="Type" id="Type">
                  <option>Program A</option>
                  <option>Program B</option>
                  <option>Program C</option>
                </select>
              </div>
            </div>

            <div class="row">

              <div class="col-xs-5 col-sd-offset-1 col-sd-6 col-md-offset-1 col-md-6">
                <label for="TroubleDetail">Trouble Detail</label>
                <textarea class="form-control" rows="4" name="TroubleDetail" id="TroubleDetail" placeholder="Trouble Detail"></textarea>
                <span class="help-block">help me ...</span>
              </div>



            </div>

            <div class="row">
             <div class="col-xs-2 col-sd-offset-1 col-sd-1 col-md-offset-1 col-md-2">
              <label for="select" class="control-label">Priority</label>
              <select class="form-control" Name="priLvl" id="priLvl">
                <option>Low</option>
                <option>Normal</option>
                <option>High</option>
              </select>
            </div>
            <div class="col-xs-4 col-sd-offset-1 col-sd-3 col-md-offset-1 col-md-3 form-group">
              <label class="control-label">Please Type</label>
              <div class="input-group">
                <span class="input-group-addon">ABC</span>
                <input class="form-control" name="ChkConfirm" id="ChkConfirm" type="text">
                <span class="input-group-btn">
                  <button class="btn btn-success" type="submit" >Confirm</button>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </fieldset>



</form>>


</body>
</html>
