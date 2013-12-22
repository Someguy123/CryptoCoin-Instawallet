<?
include("core/wallet.php");
include('templates/header.php');

// index page
?>


        <div class="page-header">
          <h1>Welcome to LTC.PE's Instant Wallet</h1>
        </div>
        <div class="row">
          <div class="span10">
            <h3>Your versatile <?=$fullcoin?> <b>LTC.PE Wallet</b> just a click away [BETA!]</h3>
            <? if (isset($_SESSION["key"])) { ?>
            <a href='/key/<?=$_SESSION['key']?>'><button class="btn info"/>Return to my wallet</button></a>
          <? } else { ?>
            <form action="getaddress" method='post'>
            <input type="hidden" name="iwantaddress" value="true" />
            <button class="btn danger"/>Make an address</button>
            <? echo recaptcha_get_html($publickey, NULL, true); ?>
            </form>
            <? } ?>


<?
echo '
             <center><h3>Recent transactions (by other users)</h3></center>

            <table class=\'table table-condensed table-bordered table-striped\'><tr><td>Confirms</td><td>Type</td><td>Amount</td><td>Fee</td></tr>';
              $dump = array_reverse($btclient->listtransactions());



              

           	foreach ($dump as $herp) {
           		if ($herp['category'] != "move") {
           			if ($herp['category'] == "send") {
           				$herp['category'] = '<span class="label label-important">'.$herp['category'].'</span>';
           				$herp['amount'] = (float) $herp['amount'] * -1;
           				
           				$color = "maroon";
           			} else {
           				$herp['category'] = '<span class="label label-success">'.$herp['category'].'</span>';
           				$color = "green";
           			}
           			$herp["fee"] = $herp["fee"] * -1;
           			echo "<tr><td>" . $herp['confirmations'] . "</td><td>" . $herp['category'] .
           			"</td><td><font color='{$color}'>" . formnum($herp['amount']) . "</font></td><td>" . ($herp['fee'] ?
           					$herp["fee"] : 0) . "</td></tr>";
           		}
           	}
              	
              	
              	              	
              
              echo "</table>";
?>
          </div>
</div>

<?
include("templates/sidebar.php");
include('templates/footer.php');
?>
