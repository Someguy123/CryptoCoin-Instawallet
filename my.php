<?php
  include ("core/wallet.php");
  if(isset($_SESSION['key']) && !isset($_GET['key'])) {
    header( "location: /my/key/" . $_SESSION['key']);
  }
  if ($_GET ['key'] && $addr->verKey ( $_GET ['key'] )) {
    $ltcaddr = $addr->verKey ( $_GET ['key'] );
    if (! isset ( $_SESSION ["key"] )) {
      $_SESSION ["key"] = $_GET ["key"];
      header ( "location: /key/" . $_GET ["key"] );
    }
  } else {
    $ltcaddr = "Invalid Key";
  }
  include ('templates/header.php');
?>
      <div class="row push">
        <?php
          echo srsnot ( "<strong>IMPORTANT!</strong><br /><strong>Don't lose this link!</strong> This link contains your <strong>Wallet Identifier</strong>&mdash;if you lose it, you won't be able to find your account.</p>
          <p style='text-align:center;'><a href=\"/key/{$_GET['key']}\" style=\"font-size: 12px;\">http://{$_SERVER['SERVER_NAME']}/key/{$_GET['key']}</a> (ctrl+D to bookmark)" );
        ?>
        <div class="span10">
          <div class="page-header">
            <h4>Your <?php echo $coin; ?> receiving address:</h4>
            <p style="font-size:2em;text-align:center;"><?php echo $ltcaddr; ?></p>
          </div>
          <?php
            if ($_GET ['key']) {
              if (!isset($_SESSION['password']) && $addr->hasPass($_GET['key'])) {
                $loggedin = false;
                $form = "<form action='/key/{$_GET['key']}' method='post'>
                  <input type='password' name='password' />
                  <input class='btn' type='submit' value='Login' />
                </form>";
                echo "<h2>Enter the password for this account to continue.</h2>";
                if(isset($_POST['password'])) {
                  if($addr->checkPass($_GET['key'], $_POST['password']) === true) {
                    $_SESSION['password'] = "true";
                    echo "<h3>Thank you, <a href='/key/{$_GET['key']}'>click here</a> to continue.</h3>";
                  } else {
                  echo srserr("Sorry, that password is invalid, please try again:");
                  echo $form;
                }
              } else { echo $form; }
            } else { $loggedin = true; }
            if ($addr->verKey ( $_GET ['key'] )) {
              if(isset($_POST['newpass'], $_POST['passconf'])) {
                if($_POST['newpass'] == $_POST['passconf']) {
                  try {
                    if($addr->hasPass($_GET['key'])) {
                      $addr->setPass($_GET['key'], $_POST['newpass'], $_POST['currpass']);
                      echo srsnot("Password has been set successfully; we recommend you log out and back in again to finish setting the password correctly.");
                    } else {
                      $addr->setPass($_GET['key'], $_POST['newpass']);
                      echo srsnot("Password has been set successfully; we recommend you log out and back in again to finish setting the password correctly.");
                    }
                  } catch (Exception $error) {
                    switch($error) {
                      case "INV_PASSWORD":
                        echo srserr("You typed your current password incorrectly, go back and enter the correct password.");
                        break;
                      case "TOO_LONG":
                        echo srserr("Password is too long (max 32 characters).");
                        break;
                      case "TOO_SHORT":
                        echo srserr("Password is too short (at least 4 characters minimum)");
                      default:
                        echo srserr("Something went wrong, try again later.");
                    }
                  }
                } else {
                  echo srserr("Make sure you typed your password correctly.");
                }
              }
              $ltcaddr = $addr->verKey ( $_GET ['key'] );
              // Sets/updates session_key with valid provided
              if ($_POST ['amount'] && $_POST ['address'] && $loggedin == true) {
                try {
                  $addr->sanitizedSend ( $_POST ['address'], $ltcaddr, $_GET ['key'], str_replace ( ",", ".", $_POST ['amount'] ) );
                  echo '<div class="alert-message success" data-alert="alert"><a class="close" onclick="\$().alert()" href="#">&times;</a><p>Successfully sent ' . $_POST ['amount'] . " {$coin} to " . $_POST ['address'] . '.</p></div>';
                } catch ( Exception $erar ) {
                  switch ($erar->getMessage ()) {
                    case "INVALID_AMT" :
                      echo srserr ( "That isn't a valid amount" );
                      break;
                    case "INVALID_ADDR" :
                      echo srserr ( "Sending {$_POST['amount']} to {$_POST['address']} failed: Invalid {$coin} address" );
                      break;
                    case "SEND_FAILED" :
                      echo srserr ( "Sending {$_POST['amount']} to {$_POST['address']} failed: You don't have enough {$coin} in your account to do that" );
                      break;
                    case "LOW_BALANCE" :
                      echo srserr ( "Sending {$_POST['amount']} to {$_POST['address']} failed: You don't have enough {$coin} in your account to do that. Note: some transactions require a 0.005 minimum fee." );
                      break;
                    default :
                      echo srserr ( "Something has gone horribly wrong. Please contact us!" );
                  }
                }
              }
              // echo "<h4>Address: <input type='text' value='{$ltcaddr}' style='width:260px;text-align:center;' readonly='readonly' /></h4>";
              if($loggedin == true) {
                echo "<h2>Balance: " . formnum($addr->ltc->getbalance($_GET ['key'],$minconf)) . " (unconfirmed: " . formnum($addr->ltc->getbalance($_GET['key'],0) - $addr->ltc->getbalance($_GET ['key'],$minconf)) .")</h2>
                <p><em style='font-size:13px;'>Deposits are updated after {$minconf} confirmations; {$minleft} {$coin} is reserved for fees.</em><p>";
              ?>
      
                <div class='row'>
                  <div class='span6'>
                    <h4>Send <?=$coin?>:</h4>
                    <form class='form-stacked' action='/key/<?=$_GET['key']?>' method='POST'>
                      <input type='text' id='address' name='address' placeholder='<?=$coin?> address to send to' style='width: 260px;'/><br />
                      <input type='text' id='amount' name='amount' placeholder='Amount of <?=$coin?> to send' style='width: 180px;' /> &nbsp; <input type='submit' class='btn info'value='Send'/>
                    </form>
                  </div>
                  <div class='span6'>
                    <table style="width: 560px;">
                      <thead>
                        <tr><td><h4>Security:</h4></td></tr>
                      </thead>
                      <tr>
                        <td style="border: 0px;">
                          <form class='form-stacked well' method='post' action='/key/<?=$_GET['key']?>'>
                            <?php if($addr->hasPass($_GET['key'])): ?>
                              <label for="pass">Your current password</label> <input type='password' id='currpass' name='currpass' style='width: 180px; text-align: left;' /><br />
                            <?php endif; ?>
                            <input type='password' id='newpass' name='newpass' placeholder='Your new password' style='width: 180px; text-align: left;' />
                            <input type='password' id='newpassconf' name='passconf' placeholder='Retype new password' style='width: 180px; text-align: left;' />
                            &nbsp; <input type='submit' class='btn info' value='SET' /> <br /> <em>WARNING: Setting a password will require you to enter it before you have access to your funds. DO NOT FORGET YOUR PASSWORD.</em>
                          </form>
                        </td>
                      </tr>
                      <tr>
                      <td>&nbsp;</td>
                      </tr>
                    </table>
                  </div>
                </div>
      
              <?php
                echo "<br /><h4>Your last 15 transactions:</h4>";
                echo "<div style=\"margin-right: 20px;\">
                <table class='table table-bordered table-striped'>
                  <tr><td>Confirms</td><td>Transaction ID</td><td>Amount</td><td>Fee</td></tr>";
                  $dump = array_reverse ( $addr->ltc->listtransactions ( $_GET ['key'], "15" ) );
                  foreach ( $dump as $herp ) {
                    if ($herp ['account'] == $_GET ['key']) {
                      echo "<tr><td>" . $herp ['confirmations'] . "</td>
                      <td><input type='text' value='" . $herp ['txid'] . "' style='margin: 0px;width:500px;'/></td>
                      <td>" . formnum($herp ['amount']) . "</td>
                      <td>" . ($herp ['fee'] ? $herp ['fee'] : 0) . "</td>
                      </tr>";
                    }
                  }
                  echo "</table></div>";
                }
                $addr->PDO_Conn = NULL;
              } else {
                echo srserr ( "INVALID KEY..." );
              }
            } else {
              echo srserr ( "No key specified." );
            }
          ?>
        </div>
      </div>
<?php
  include ("templates/sidebar.php");
  include ('templates/footer.php');
?>
