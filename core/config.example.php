<?php
//Site info
$sitename = "Instant Wallet";
$sitemail = "instawallet@somesite.com";

// Donation account
$don_account = "WalletDonations";

// RPC settings
$btclogin = array(
"username" =>   "",
"password" =>   "",
"host" =>       "localhost",
"port" =>       "8332");

// Database settings
$sqlogin = array(
"host" =>       "localhost",
"dbname" =>     "",
"username" =>   "",
"password" =>   "");

// Coin symbol and name.
$coin     = "LTC";
$fullcoin = "litecoin";

$redirect = "";

// Outgoing transfers settings
$minleft  = 0.001;     // minimum left on account
$minsend  = 0.001;     // minimum allowed to send at a time
$minconf  = 1;         // minimum confirmations

// Email ??
$mailUser = '';
$mailPass = '';

// Captha keys
$publickey  = "";
$privatekey = "";

// Maintenance mode
$maintenance = FALSE;  // Change to TRUE to lockdown the site for all other then admins

// Admin IPs 
$adminips = array(
  "other" => "127.0.0.1"
);

// NOT YET IMPLEMENTED
$minfee      = 0;      // min. hard fee on all transactions
$feeperc     = 2.5;    // fee for outgoing transactions in percentage
$fee_account = "lal";  // set to your own KEY to recieve fees there
?>