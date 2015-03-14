<?php
session_start();



?>


<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>CREATE USER</title>
  <script src="js/jquery.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="css/_bootswatch.scss">
  <link rel="stylesheet" href="css/_variables.scss">

  <!-- Latest compiled and minified JavaScript -->
  <script src="js/bootstrap.min.js"></script>

  <script>
    function chkUserPass(password) {
      var regex = [a-zA-Z0-9];
      return regex.toString(password);
    };
    function chkName(e) {
      if ((e.which > 64 && e.which < 91) || (e.which > 96 && e.which < 123) || e.which == 32) return true;
      else return false;
    };
    

  </script>


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
        <a class="navbar-brand" href="index.php">HELPDESK</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <?php
          if(!isset($_SESSION["login"])) header("location: /index.php");
          if($_SESSION["login"]["Class"] != "admin") header("location: /index.php");
          else echo $_SESSION["login"]["navbar"];
          ?>
          <li><a href="#">About US</a></li>
        </ul>
        <?php
        if(!isset($_SESSION["login"])) header("location: /index.php");
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
<!-- ---------------------------------------------------------------------------------------------------------------- NAVIGATOR BAR --------------------------------------------------------------------------------- -->

<form name="CreateTicket" method="post" action="chkcreateuser.php">
  <fieldset>
    <div class="col-md-offset-1 col-md-8">
      <div class="panel panel-info ">
        <div class="panel-heading">User DETAIL</div>
        <div class="panel-body">

          <div class="row">
            <div class="col-xs-2 col-sd-offset-1 col-md-offset-1">    
              <label class="control-label" for="username">Username</label>
              <input class="form-control" name="txtUsername"  placeholder="Username" type="text" maxlength="10" onkeypress="return chkUserPass;">
            </div>
          </div>

          <div class="row">
            <div class="col-xs-2 col-sd-offset-1 col-md-offset-1">    
              <label class="control-label" for="password">Password</label>
              <input class="form-control" name="txtPassword" placeholder="Password" type="password" maxlength="10" onkeypress="return chkUserPass;">
            </div>
            <div class="col-xs-2 col-sd-offset-1 col-md-offset-1">    
              <label class="control-label" for="confirmpassword">Confirm Password</label>
              <input class="form-control" name="txtconfirmpassword" placeholder="Confirm Password" type="password" maxlength="10">
            </div>
          </div>

          <div class="row">
            <div class="col-xs-3 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
              <label class="control-label" for="empName">Name</label>
              <input class="form-control" name="txtempName" placeholder="First and Last Name" type="text" maxlength="50" pattern"[A-Za-z]" onkeypress="return chkName(event);">
            </div>
          </div>

          <div class="row">
            <div class="col-xs-3 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
              <label class="control-label" for="empEmail">Email</label>
              <input class="form-control" name="txtempEmail" placeholder="E-mail" type="email" maxlength="50">
            </div>
          </div>

          <div class="row">
            <div class="col-xs-2 col-sd-offset-1 col-sd-3 col-md-offset-1 col-md-4">
              <label class="control-label" for="empTel">Telephone</label>
              <input class="form-control" name="txtempTel" placeholder="Telephone" type="tel" maxlength="15" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            </div>
          </div>

          <div class="row">
            <div class="col-xs-2 col-sd-offset-1 col-sd-1 col-md-offset-1 col-md-2">
              <label for="select" class="control-label">Class</label>
              <select class="form-control" name="Class">
                <option value="admin">Administrator</option>
                <option value="support">Support</option>
                <option value="user" selected="selected">User</option>
              </select>
            </div>
          </div>
        </br>



        <div class="row">
          <div class="col-xs-2 col-sd-offset-1 col-sd-3 col-md-offset-1 col-md-4">
            <label class="control-label">Type your password to CONFIRM</label>
            <div class="input-group">
              <input class="form-control" name="pwdtoconfirm" type="password" maxlength="10">
              <span class="input-group-btn">
                <button class="btn btn-success" type="submit">Confirm</button>
              </span>
            </div>
          </div>
        </div>


      </fieldset>




    </form>


  </body>
  </html>
