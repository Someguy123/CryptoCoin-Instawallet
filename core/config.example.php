<?
// Donation account
$don_account = "WalletDonations";

// RPC Settings
$btclogin = array(
"username" =>   "",
"password" => "",
"host" =>       "localhost",
"port" =>       "8332");

// DB Settings
$sqlogin = array(
"host" =>       "localhost",
"dbname" =>     "",
"username" =>   "",
"password" =>   "");

// short name for the coin used for.
$coin = "BTC";
$fullcoin = "bitcoin";

$redirect = "";

// sending settings ..
$minleft  = 0.001;                        // minimum left on account
$minsend  = 0.001;                          // minimum allowed to send at a time
$minconf = 1;                           // minimum confirmations

// email
$mailUser = '';
$mailPass = '';

//captha
$publickey = "";
$privatekey = "";

// maintenance mode
$maintenance = FALSE;  // Change to TRUE to lockdown the site for all other then admins

// admin ips 
$adminips = array(
		"other" => "127.0.0.1"
);

// NOT IMPLEMENTED YET ...
$minfee   = 0;                          // min. hard fee on all transactions
$feeperc  = 2.5;                        // fee for outgoing transactions in percentage
$fee_account = "lal";  					// set to your own KEY to recieve fees there
?>
