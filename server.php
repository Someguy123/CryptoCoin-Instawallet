<?php
  include ("core/wallet.php");
  include ('templates/header.php');

  $data = shell_exec ( 'uptime' );
  $uptime = explode ( ' up ', $data );
  $uptime = explode ( ',', $uptime [1] );
  $uptime = $uptime [0] . ', ' . $uptime [1];
?>
      <div class="page-header">
        <h1>Server Information <small>Debugging for admins</small></h1>
      </div>
      <div class="row">
        <div class="span10">
          <?php
            // IPs whitelist
            $isadmin = false;
            foreach ( $adminips as $allowed ) {
              if ($_SERVER ['REMOTE_ADDR'] == $allowed) {
                $isadmin = true;
                break;
              }
            }
            if ($isadmin != true) {
              echo '<div class="alert-message error" data-alert="alert" style="margin-right:20px;">Access Denied.</div>';
            } else {
              echo '
                <div style="margin-right: 20px;">
                  <h3>Daemon statistics</h3>
                  <table class=\'zebra-striped\'>
                    <tr><td>Server balance total: </td><td>' . number_format($derp['balance'], 8) . ' ' . $coin . '</td></tr>
                    <tr><td>Server wallets created: </td><td>' . $count ['wallets'] . '</td></tr>
                    <tr><td>Server block count: </td><td>' . $derp ['blocks'] . '</td></tr>
                    <tr><td>Server connections: </td><td>' . $derp ['connections'] . '</td></tr>
                    <tr><td>Server protocolversion: </td><td>' . $derp ['protocolversion'] . '</td></tr>
                    <tr><td>Server keypoololdest: </td><td>' . $derp ['keypoololdest'] . '</td></tr>
                    <tr><td>Server keypoolsize: </td><td>' . $derp ['keypoolsize'] . '</td></tr>
                    <tr><td>Server paytxfee: </td><td>' . $derp ['paytxfee'] . '</td></tr>
                    <tr><td>Server minimun input: </td><td>' . $derp ['mininput'] . '</td></tr>
                    <tr><td>Server version: </td><td>' . $derp ['version'] . '</td></tr>
                    <tr><td>Donation address: </td><td>' . $btclient->getaccountaddress ( $don_account ) . '</td></tr>
                    <tr><td>Donations recieved: </td><td>' . $btclient->getbalance ( $don_account, 0 ) . ' LTC</td></tr>
                    <!--<tr><td>Server errors: </td><td>' . $derp ['errors'] . '</td></tr>-->
                  </table>
                  <h3>Other information</h3>
                  <table class=\'zebra-striped\'>
                    <tr><td>Server Hostname: </td><td>' . $_SERVER ['SERVER_NAME'] . '</td></tr>
                    <tr><td>Server IP Address: </td><td>' . $_SERVER ['SERVER_ADDR'] . '</td></tr>
                    <tr><td>Server requested file: </td><td>' . $_SERVER ['REQUEST_URI'] . '</td></tr>
                    <tr><td>Server time: </td><td>' . date ( "D M j G:i:s T Y" ) . '</td></tr>
                    <tr><td>Server uptime/users online: </td><td>' . $uptime . '</td></tr>
                    <tr><td>Your IP/Host: </td><td>' . gethostbyaddr ( $_SERVER ['REMOTE_ADDR'] ) . '</td></tr>
                  </table>
                </div>
                <br><br>
                <h3 style="text-align:center;">All Recent transactions</h3>
                <table class=\'table table-bordered table-condensed table-striped\'><tr><td>Confirms</td><td>Address</td><td>Amount</td><td>Fee</td><td>Transaction ID</td></tr>
              ';
              $dump = array_reverse ( $btclient->listtransactions () );
              foreach ( $dump as $herp ) {
                echo "<tr><td>" . $herp ['confirmations'] . "</td><td><input type='text' value='" . $herp ['address'] . "' /></td><td>" . number_format($herp['amount'], 8) . "</td><td>" . ($herp ['fee'] ? $herp ["fee"] : 0) . "</td><td><input type='text' value='" . $herp ['txid'] . "' /></td></tr>";
              }
              echo "</table>";
            }
          ?>
        </div>
      </div>
<?php
  include ("templates/sidebar.php");
  include ('templates/footer.php');
?>