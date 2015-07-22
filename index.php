<?php
session_start();
require "function/function.php";

/* USER-AGENTS
================================================== */
function check_user_agent ( $type = NULL ) {
        $user_agent = strtolower ( $_SERVER['HTTP_USER_AGENT'] );
        if ( $type == 'bot' ) {
                // matches popular bots
                if ( preg_match ( "/googlebot|adsbot|yahooseeker|yahoobot|msnbot|watchmouse|pingdom\.com|feedfetcher-google/", $user_agent ) ) {
                        return true;
                        // watchmouse|pingdom\.com are "uptime services"
                }
        } else if ( $type == 'browser' ) {
                // matches core browser types
                if ( preg_match ( "/mozilla\/|opera\//", $user_agent ) ) {
                        return true;
                }
        } else if ( $type == 'mobile' ) {
                // matches popular mobile devices that have small screens and/or touch inputs
                // mobile devices have regional trends; some of these will have varying popularity in Europe, Asia, and America
                // detailed demographics are unknown, and South America, the Pacific Islands, and Africa trends might not be represented, here
                if ( preg_match ( "/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent ) ) {
                        // these are the most common
                        return true;
                } else if ( preg_match ( "/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent ) ) {
                        // these are less common, and might not be worth checking
                        return true;
                }
        }
        return false;
}

?>



<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Home</title>
  <script src="js/jquery.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
 
  

  <!-- Optional theme -->
  <link rel="stylesheet" href="css/_bootswatch.scss">
  <link rel="stylesheet" href="css/_variables.scss">

  <!-- Latest compiled and minified JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <link rel="chrome-webstore-item" href="https://chrome.google.com/webstore/detail/iabmpiboiopbgfabjmgeedhcmjenhbla">
  <style type="text/css">
  /* Sticky footer styles
  -------------------------------------------------- */
  html {
    position: relative;
    min-height: 100%;
  }
  body {
    /* Margin bottom by footer height */
    margin-bottom: 60px;
  }
  .footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    /* Set the fixed height of the footer here */
    height: 100px;
    background-color: #ffffff;
  }</style>

  <script>
  // please note, that IE11 now returns undefined again for window.chrome
    var isChromium = window.chrome,
        vendorName = window.navigator.vendor;
    if(isChromium !== null && isChromium !== undefined && vendorName === "Google Inc.") {
       // is Google chrome 
    } else { 
       // not Google chrome 
    }
  </script>

    

</head>

<body>

    <?php navbar();

    //----------------------------------------------------- NAVIGATOR BAR -------------------------------------------------
    echo '<div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 jumbotron">';
    $end = '</div>
        </div>
    </div>';
   

    if(!empty($_SESSION["login"]))
    {
        if($_SESSION["login"]["Class"] != "user")
        {
            $ismobile = check_user_agent('mobile');
            if($ismobile) 
            {
                echo '<div class="page-header text-center">
                        <h2>ติดตั้ง VNC® Viewer for Mobile Device</h2>
                        <hr/>
                        <br />
                            <a href="https://geo.itunes.apple.com/th/app/vnc-viewer/id352019548?mt=8">
                              <img alt="iOS app on App Store"
                                   src="http://linkmaker.itunes.apple.com/images/badges/en-us/badge_appstore-lrg.svg" />
                            </a>
                            <a href="https://play.google.com/store/apps/details?id=com.realvnc.viewer.android">
                              <img alt="Android app on Google Play"
                                   src="https://developer.android.com/images/brand/en_app_rgb_wo_45.png" />
                            </a>
                            
                        </div>'.$end;

            } 
            else
            {
                if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false)
                {
                    echo '<div class="page-header">
                            <h2>วิธีการติดตั้ง VNC® Viewer for Google Chrome™</h2>
                            <hr/>
                            <ol>
                                <li>กดคลิก &gt;&gt; <a href="https://chrome.google.com/webstore/detail/iabmpiboiopbgfabjmgeedhcmjenhbla">Install from Google WebStore</a></li>
                                <br />
                                <li>กดที่ปุ่ม ADD TO CHROME ตามรูป<br />
                                <br />
                                <img class="img-responsive" alt="" height="614" src="/faq/upload/images/instVNC/1.jpg" width="983" /></li>
                                <br />
                                <li>จะมี popup เด้งขึ้นมา ให้กด Add เพื่อทำการเพิ่มเข้าไปใน Google App ตามรูป<br />
                                <br />
                                <img class="img-responsive" alt="" height="219" src="/faq/upload/images/instVNC/2.jpg" width="369" /></li>
                                <br />
                                <li>สามารถใช้งาน VNC® Viewer for Google Chrome™ ได้ทันที</li>
                            </ol>
                        </div>'.$end;

                    echo '<footer class="footer">
                            <div class="container">
                              <div class="row">
                                <hr/>
                                <div class="btn-group btn-group-justified">
                                    <a class="btn btn-info" onclick="VNCWindow()">Click to open VNC Viewer</a>
                                    <a href="#" class="btn btn-success" onclick="ChatWindow()">Click for Chat</a>
                                </div>
                            </div>
                        </footer>';

                    
                }
                else
                {
                    echo '<div class="page-header">
                            <h2>วิธีการติดตั้ง VNC® Viewer for Desktop</h2>
                            <hr/>
                            <ol>
                                <li>กดคลิก &gt;&gt; <a href="https://www.realvnc.com/download/viewer/">Download VNC Viwer</a></li>
                                <br />
                                <li>เลือก VNC Viewer ตามระบบปฏิบัติการที่ใช้งาน<br/>
                                <br/>
                                <img class="img-responsive" alt="" height="982" src="/faq/upload/images/instVNC/11.jpg" width="900" /></li>
                                <br />
                                <li>จะได้ไฟล์ ชื่อประมาณว่า&nbsp;"VNC-Viewer-X.X.X-XXX-32/64bit.exe"</li>
                                <br />
                                <li>ดับเบิ้ลคลิกที่ไฟล์นั้น จะสามารถใช้งาน VNC Viewer ได้ทันที<br/>
                                <br/>
                                <img class="image-responsive" alt="" height="216" src="/faq/upload/images/instVNC/10.jpg" width="420" /></li>
                            </ol>
                        </div>'.$end;

                    
                }
            
            }
        }
        else
        {
            echo '<div class="page-header">
                    <h2>วิธีใช้โปรแกรม PSR (Problem Steps Recoder)</h2>
                    <hr/>
                    <ol>
                        <li>กดปุ่ม Windows + R ที่แป้นคีย์บอร์ด</li><br />
                        <li>พิมพ์คำว่า PSR ในช่อง Search ตามรูป<br />
                        <br />
                        <img class="img-responsive" alt="" height="216" src="/faq/upload/images/psr/1.jpg" width="415" /></li>
                        <br />
                        <li>จะมีโปรแกรมขึ้นมา และทำการกดปุ่ม Start Record เพื่อเริ่มบันทึกขั้นตอนก่อนปัญหาที่เกิด จนกระทั่งเกิดปัญหา ตามรูป<br />
                        <br />
                        <img class="img-responsive" alt="" height="74" src="/faq/upload/images/psr/2.jpg" width="385" /></li>
                        <br />
                        <li>กดปุ่ม &quot;Stop Record&quot; เมื่อบันทึกขั้นตอนเสร็จแล้ว<br />
                        <br />
                        <img class="img-responsive" alt="" height="76" src="/faq/upload/images/psr/3.jpg" width="391" /></li>
                        <br />
                        <li>หลังกดปุ่ม Stop Record ให้กดปุ่ม Save เพื่อทำการบันทึกเป็น .zip ไฟล์<br />
                        <br />
                        <img class="img-responsive" alt="" height="393" src="/faq/upload/images/psr/4.jpg" width="835" /></li>
                        <br />
                        <li>นำ .zip ไฟล์ที่ทำการบันทึกไว้ไป Upload ในขั้นตอนของการแจ้ง Ticket</li>
                    </ol>
                </div>'.$end;
            echo '<footer class="footer">
                    <div class="container">
                      <div class="row">
                        <hr/>
                        <div class="btn-group btn-group-justified">
                            <a href="#" class="btn btn-success" onclick="ChatWindow()">Click for Chat</a>
                        </div>
                    </div>
                    </footer>';
        }
    }
    else
    {
        echo '<h1>HELPDESK SERVICE SITE</h1>'.$end;
    }

    

    
    ?>



     <script>
        function VNCWindow() {
            var ChatWindow = window.open('/function/js-vnc-demo-project/static/index.html',
                                        'VNC',
                                        'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1440,height=900,top=50,left=250');
            ChatWindow.focus();
            
        }

        function ChatWindow() {
            var ChatWindow = window.open('/function/chat/chat.php',
                                        'Chat',
                                        'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=220,left=600');
            ChatWindow.focus();
        }
    </script>

</body>
</html>