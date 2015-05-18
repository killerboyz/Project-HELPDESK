<?php
session_start();
require "../function/function.php";

?>


<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>CREATE FAQ</title>
  
  <script src="../js/jquery.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="../css/_bootswatch.scss">
  <link rel="stylesheet" href="../css/_variables.scss">

  <!-- Latest compiled and minified JavaScript -->
  <script src="../js/bootstrap.min.js"></script>
  <script src="../ckeditor/ckeditor.js"></script>
</head>

<body>

  <?php navbar();?>

  <!-- ---------------------------------------------------------------------------------------------------------------- NAVIGATOR BAR --------------------------------------------------------------------------------- -->

  <div class="container">
    <div class="row">
      <div class="col-md-12">
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
  </div>

  <div class="container">
    <form name="CreateTicket" method="post" action="../chk/chkcreatefaq.php">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-danger ">
            <div class="panel-heading">FAQ Detail</div>
            <div class="panel-body">

              <div class="row">
               <div class="col-xs-4 col-sd-offset-1 col-sd-5 col-md-offset-1 col-md-4 form-group has-warning">
                <label class="control-label" for="faqTopic">FAQ Topic</label>
                <input class="form-control" name="FAQtopic" id="FAQtopic"  type="text" placeholder="FAQ Topic" minlength="6" maxlength="50" autocomplete="off" title="Allow only lowercase letters and numbers. At least 6 letters." pattern=".{6,50}" tabindex="1" required>
              </div>
              <div class="col-xs-4 col-sd-offset-1 col-sd-5 col-md-offset-1 col-md-4">
                <label for="select" class="control-label">Type</label>
                <select class="form-control" name="Type" id="Type">
                  <option>Program A</option>
                  <option>Program B</option>
                  <option>Program C</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-10 col-sd-push-1 col-sd-10 col-md-push-1 col-md-10">
                <label for="TroubleDetail">FAQ Detail</label>
                <textarea class="form-control" rows="20" cols="" name="FAQdescript" id="FAQdescript" >Input FAQ in here ..</textarea>
                <script>
                  // Replace the <textarea id="editor1"> with a CKEditor
                  // instance, using default configuration.
                  CKEDITOR.replace( 'FAQdescript',{
                  "filebrowserImageUploadUrl": "/path_to/ckeditor/plugins/imgupload.php"
                } );
                </script>
                <span class="help-block">Input FAQ in here ..</span>
              </div>
            </div>

            <div class="row">

              <div class="col-xs-8 col-sd-offset-1 col-sd-5 col-md-offset-1 col-md-4 form-group">
                <label class="control-label">Please Type</label>
                <div class="input-group">
                  <span class="input-group-addon">ABC</span>
                  <input class="form-control" name="ChkConfirm" id="ChkConfirm" type="text" autocomplete="off" tabindex="5" required>
                  <span class="input-group-btn">
                    <button class="btn btn-success" type="submit" >Confirm</button>
                  </span>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </form>
</div>


</body>
</html>
