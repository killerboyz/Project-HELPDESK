<?php
session_start();
require "../function/function.php";


?>


<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>CREATE USER</title>
  <script src="../js/jquery.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="../css/_bootswatch.scss">
  <link rel="stylesheet" href="../css/_variables.scss">

  <!-- Latest compiled and minified JavaScript -->
  <script src="../js/bootstrap.min.js"></script>

  <script>
    function chkUserPass(e) {
      if((e.which == 8 || e.which == 9 || e.keyCode == 37 || e.keyCode == 39 || e.which >= 48 && e.which <= 57) || (e.which >= 97 && e.which <= 122)) return true;
      else return false;
    };
    function chkName(e) {
      if((e.which == 8 || e.which == 9 || e.which == 32 || e.keyCode == 37 || e.keyCode == 39 || e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122) || (e.which >= 3585 && e.which <= 3652)) return true;
      else return false;
    };
    function chkTel(e){
      if(e.which == 8 || e.which == 9 || e.keyCode == 37 || e.keyCode == 39  ||e.which == 43 || e.which == 45 || (e.which >= 48 && e.which <= 57)) return true;
      else return false;
    }
    

  </script>


</head>

<body>

  <?php navbar();?>

  <!-- ---------------------------------------------------------------------------------------------------------------- NAVIGATOR BAR --------------------------------------------------------------------------------- -->
  
  <div class="container">
    <form name="CreateTicket" method="post" action="/chk/chkcreateuser.php">
      <div class="row">

        <div class="col-md-12">
          <div class="panel panel-info ">
            <div class="panel-heading">USER DETAIL</div>
            <div class="panel-body">

              <div class="row">
                <div class="col-xs-2 col-sd-offset-1 col-md-offset-1">    
                  <label class="control-label" for="username">Username</label>
                  <input class="form-control" name="txtUsername"  placeholder="Username" type="text" minlength="6" maxlength="10"  autocomplete="off" title="Allow only lowercase letters and numbers. At least 6 letters." pattern=".{6,10}" tabindex="1" required onkeypress="return chkUserPass(event);" >
                </div>
                <div style="margin-top:35px"><p class="text-warning">Allow only lowercase letters and numbers. At least 6 letters.</p></div>
              </div>


              <div class="row">
                <div class="col-xs-2 col-sd-offset-1 col-md-offset-1">    
                  <label class="control-label" for="password">Password</label>
                  <input class="form-control" name="txtPassword" placeholder="Password" type="password" minlength="6" maxlength="10"  autocomplete="off" title="Allow only lowercase letters and numbers. At least 6 letters." pattern=".{6,10}" tabindex="2" required onkeypress="return chkUserPass(event);">
                </div>
                <div class="col-xs-2">    
                  <label class="control-label" for="confirmpassword">Confirm Password</label>
                  <input class="form-control" name="txtconfirmpassword" placeholder="Confirm Password" type="password" minlength="6" maxlength="10"  autocomplete="off" title="Allow only lowercase letters and numbers. At least 6 letters." pattern=".{6,10}" tabindex="3" required onkeypress="return chkUserPass(event);">
                </div>

              </div>

              <div class="row">
                <div class="col-xs-3 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
                  <label class="control-label" for="empName">Name</label>
                  <input class="form-control" name="txtempName" placeholder="First and Last Name" type="text" minlength="6" maxlength="50" autocomplete="off" title="Allow only a-z A-Z ก-ฮ" pattern=".{6,50}"tabindex="4" required onkeypress="return chkName(event);">
                </div>
              </div>

              <div class="row">
                <div class="col-xs-3 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
                  <label class="control-label" for="empEmail">Email</label>
                  <input class="form-control" name="txtempEmail" placeholder="E-mail" type="email" minlength="6" maxlength="50" autocomplete="off" title="Allow only email (example : email@example.com)" pattern=".{6,50}" tabindex="5" required >
                </div>
              </div>

              <div class="row">
                <div class="col-xs-2 col-sd-offset-1 col-sd-3 col-md-offset-1 col-md-4">
                  <label class="control-label" for="empTel">Telephone</label>
                  <input class="form-control" name="txtempTel" placeholder="Telephone" type="tel" minlength="4" maxlength="15" autocomplete="off" pattern=".{6,15}" tabindex="6" required onkeypress="return chkTel(event);">
                </div>
              </div>

              <div class="row">
                <div class="col-xs-2 col-sd-offset-1 col-sd-1 col-md-offset-1 col-md-2">
                  <label for="select" class="control-label">Class</label>
                  <select class="form-control" name="Class" tabindex="7">
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
                  <input class="form-control" name="pwdtoconfirm" type="password" minlength="4" maxlength="10" autocomplete="off" title="Type your Password" pattern=".{4,10}" tabindex="8" required onkeypress="return chkUserPass(event);">
                  <span class="input-group-btn">
                    <button class="btn btn-success" type="submit">Confirm</button>
                  </span>
                </div>
              </div>
            </div>

          </div>
        </form>
      </div>
    </body>
    </html>
