<?php
// pre html functions.. get rid of getaddress.php, retaddress.php

// todo: session based anti request-spam system ..

?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Litecoin Instawallet</title>
        <link rel="stylesheet" href="/assets/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/bootstrap-responsive.css">
        <link rel="stylesheet" href="/assets/style.css">
            <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="/js/html5shiv.js"></script>
        <![endif]-->
      <script src="/assets/jquery.min.js"></script>
      <script src="/assets/jquery-migrate-1.1.1.min.js"></script>
        <script src="/assets/bootstrap.min.js"></script>
        <script>
           function enableBeforeUnload() {
                alert("Dev Mode Activated");
                window.onbeforeunload = function (e) {
                    return "Discard changes?";
                };
            }
        </script>
        <script src="/assets/main.js"></script>
        <script type="text/javascript">
         var RecaptchaOptions = {
            theme : 'clean'
         };
         </script>
</head>
    <body>
        <div class="wrapper">
            <div class="navbar navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container">
                        <a class="brand">LTC.PE Instant Wallet<font size='4pt' style='color: red'> BETA </font></a>
                                                <div class="nav-collapse">
                            <ul class="nav">
                                <?if (isset($_SESSION["key"])) mnu_btn("/key/$_SESSION[key]", "My Vault");?>
                                <?
                                // menu
                                mnu_btn("/index", "Home");
                                foreach ($adminips as $allowed) {
                                  if ($_SERVER['REMOTE_ADDR'] == $allowed) {
                                    mnu_btn("/server", "Server");
                                    break;
                                  }
                                }
                                if ($_SESSION["key"])
                                mnu_btn("/logout", "Logout");
                                mnu_btn("/about", "About Us");
                                mnu_btn("/contact", "Contact Us");
                                ?>
                            </ul>
<div class="pull-right" style="padding-top: 11px; font-size: 11px;">Blockcount: <?=number_format($derp["blocks"]);?> - <?=$derp["connections"]?> p2p nodes</div>
                        </div>
                      </div>
                </div>
            </div>
          </ul>
          <!--<form action="" class="pull-right">
          <input class="input-small" type="text" value="Switch key.." style="width: 150px;">
          </form>-->
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row-fluid">
      <!-- END HEADER.PHP -->
      <?php
      if ($maintenance == true && !in_array($_SERVER['REMOTE_ADDR'], $adminips)) {
      	include("./maintenance.php");
      	include("footer.php");
      	die();
      }
      // put something here to tell admin that its active so dosnt forget... 
      ?>
