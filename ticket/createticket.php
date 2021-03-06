<?php
session_start();
require "../function/function.php";

?>


<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>CREATE TICKET</title>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap-filestyle.js">
  $(":file").filestyle({buttonName: "btn-primary"});
  </script>
  
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="../css/_bootswatch.scss">
  <link rel="stylesheet" href="../css/_variables.scss">


  <!-- Latest compiled and minified JavaScript -->
  <script src="../js/bootstrap.min.js"></script>
</head>

<body>

  <?php navbar();?>

  <!-- ---------------------------------------------------------------------------------------------------------------- NAVIGATOR BAR --------------------------------------------------------------------------------- -->

  <div class="container">
    <div class="row">
      
        <div class="panel panel-info ">
          <div class="panel-heading">Employee Detail</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-6 col-sd-offset-1 col-sd-5 col-md-offset-1 col-md-4">    
                <label class="control-label" for="EmpName">Employee Name</label>
                <input class="form-control" id="EmpName" placeholder="EmpName" type="text" disabled="" value="<?php echo htmlspecialchars($_SESSION["login"]["empName"]);?>">
              </div>
            </div>
          </div>
        </div>
      
    </div>
  </div>

  <div class="container">
    <form name="CreateTicket" method="post" enctype="multipart/form-data" action="/ticket/chkcreateticket.php" >
      <div class="row">
        
          <div class="panel panel-danger ">
            <div class="panel-heading">Ticket Trouble Detail</div>
            <div class="panel-body">

              <div class="row">
                <div class="col-xs-5 col-sd-offset-1 col-sd-5 col-md-offset-1 col-md-4 form-group has-warning">
                  <label class="control-label" for="TicketTopic">Ticket Topic</label>
                  <input class="form-control" name="txtTopic" id="txtTopic"  type="text" placeholder="Ticket Topic" minlength="6" maxlength="50" autocomplete="off" title="Allow only lowercase letters and numbers. At least 6 letters." pattern=".{6,50}" tabindex="1" required> 
                </div>
                <div class="col-xs-5 col-sd-offset-1 col-sd-5 col-md-offset-1 col-md-4">
                  <label for="select" class="control-label">Type</label>
                  <select class="form-control" name="Type" id="Type" tabindex="2">
                    <option value="Hardware">Hardware</option>
                    <option value="Software">Software</option>
                    
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-10 col-sd-offset-1 col-sd-11 col-md-offset-1 col-md-9">
                  <label for="TroubleDetail">Trouble Detail</label>
                  <textarea class="form-control" rows="4" name="txtDetail" id="txtDetail" placeholder="Trouble Detail" autocomplete="off" minlength="6" tabindex="3" required></textarea>
                  <span class="help-block">help me ...</span>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-4 col-sd-offset-1 col-sd-4 col-md-offset-1 col-md-4">
                  <label class="control-label">Upload PSR file</label>
                  <input type="file" name="psrUpload" class="filestyle" data-buttonName="btn-primary" data-iconName="glyphicon-inbox"  data-size="md" accept=".zip">

                </div>
              </div>

              <div class="row">
               <div class="col-xs-5 col-sd-offset-1 col-sd-5 col-md-offset-1 col-md-4">
                <label for="select" class="control-label">Priority</label>
                <select class="form-control" Name="priLvl" id="priLvl" tabindex="4">
                  <option value="Low">Low</option>
                  <option value="Normal">Normal</option>
                  <option value="High">High</option>
                </select>
              </div>
              <div class="col-xs-5 col-sd-offset-1 col-sd-5 col-md-offset-1 col-md-4 form-group">
                <label class="control-label">Please Type</label>
                <div class="input-group">
                  <span class="input-group-addon">CONFIRM</span>
                  <input class="form-control" name="ChkConfirm" id="ChkConfirm" type="text" autocomplete="off" tabindex="5" required>
                  <span class="input-group-btn">
                    <button class="btn btn-success" type="submit" >Confirm</button>
                  </span>
                </div>
              </div>
            </div>

          </div>
        
      </div>
    </form>
  </div>
</body>
</html>
