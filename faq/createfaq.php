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
  <div class="">
  <div class="row">
    <form method="post" action="../faq/chkcreatefaq.php">
      
        <div class="row">
            <div class="col-xs-4  col-sd-5  col-md-4 form-group has-warning">
              <label class="control-label" for="faqTopic">FAQ Topic</label>
              <input class="form-control" name="FAQtopic" type="text" placeholder="FAQ Topic" minlength="6" maxlength="50" autocomplete="off" title="Allow only lowercase letters and numbers. At least 6 letters." pattern=".{6,50}" tabindex="1" required>
            </div>
            <div class="col-xs-4 col-sd-offset-1 col-sd-3 col-md-offset-1 col-md-2">
                <label for="select" class="control-label">Type</label>
                <select class="form-control" name="Type" id="Type">
                    <option value="Hardware">Hardware</option>
                    <option value="Software" selected="selected">Software</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sd-12 col-md-12">
              <label for="TroubleDetail">FAQ Detail</label>
              <textarea class="form-control" rows="30" cols="50" name="FAQdescript" id="FAQdescript"></textarea>
              <script>
                        // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.

                        CKEDITOR.replace( 'FAQdescript',
                        {
                          //height = 500;
                        });

                </script>
                <span class="help-block">Input FAQ in editor ..</span>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-8 col-sd-5 col-md-4 form-group">
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

    </form>
    </div>
    </div>
</div>


</body>
</html>
